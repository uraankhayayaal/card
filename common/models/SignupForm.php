<?php
namespace common\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    //public $username;
    public $email;
    public $password;
    public $checkPassword;


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
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            [['password', 'checkPassword'], 'required'],
            [['password', 'checkPassword'], 'string', 'min' => 6],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'checkPassword' => 'Повторите пароль',
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
        
        if ($this->password != $this->checkPassword) {
            return null;
        }

        $user = new User();
        //$user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateToken();
        $user->generatePasswordResetToken();
    
        \Yii::$app->mailer->compose()
            ->setFrom('admin@dty.su')
            ->setTo($this->email)
            ->setSubject('Регистрация на сайте Card.dty.su')
            ->setTextBody('Перейдите по ссылке для подтверждения почтового адреса')
            ->setHtmlBody('<b>Перейдите по ссылке для подтверждения почтового адреса: https://card.dty.su/cabinet/confirm-email?email='.$this->email.'&token='.$user->password_reset_token.'</b>')
            ->send();
        
        return $user->save() ? $user : null;
    }
}
