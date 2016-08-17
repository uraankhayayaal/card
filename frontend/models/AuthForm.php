<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Gtoken;

/**
 * Auth form
 */
class AuthForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;
    public $gtoken;
    public $os;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['os', 'integer'],
            ['gtoken', 'string', 'max' => 255],
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {

            if(!Gtoken::find()->where( [ 'value' => $this->gtoken ] )->exists()){
                $this->clean();
                $gtoken = new Gtoken();
                $gtoken->value = $this->gtoken;
                $gtoken->os = $this->os;
                $gtoken->user_id = $this->getUser()->id;
                $gtoken->save();
            }else{
                //$this->clean();
                $gtoken = Gtoken::find()->where( [ 'value' => $this->gtoken ] )->One();
                $gtoken->user_id = $this->getUser()->id;
                $gtoken->os = $this->os;
                $gtoken->save();
            }

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    protected function clean(){
        $models = Gtoken::find()->where(['user_id' => $this->getUser()->id])->all();
        foreach ($models as $model) {
            $model->delete();
        }
        return true;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
