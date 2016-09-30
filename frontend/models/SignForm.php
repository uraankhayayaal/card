<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\Gtoken;

/**
 * Signup form
 */
class SignForm extends Model
{
    //public $username;
    public $email;
    public $password;
    public $token;
    public $gtoken;
    public $os;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],*/

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['os', 'integer'],
            [['email', 'gtoken'], 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'message' => 'Password should contain at least 6 characters.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        //$user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateToken();
        $this->token = $user->access_token;

        if($user->save()){

            if(!Gtoken::find()->where( [ 'value' => $this->gtoken ] )->exists()){
                $gtoken = new Gtoken();
                $gtoken->value = $this->gtoken;
                $gtoken->os = $this->os;
                $gtoken->user_id = $user->id;
                $gtoken->save();
            }else{
                $gtoken = Gtoken::find()->where( [ 'value' => $this->gtoken ] )->One();
                $gtoken->os = $this->os;
                $gtoken->user_id = $user->id;
                $gtoken->save();
            }

            return $user;
        }
        return false;
    }
}
