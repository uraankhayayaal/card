<?php

namespace oauth\models;

use Yii;

/**
 * This is the model class for table "oauth_access_token".
 *
 * @property integer $id
 * @property integer $client_id
 * @property integer $user_id
 * @property string $access_token
 * @property string $refresh_token
 */
class OauthAccessToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oauth_access_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'user_id'], 'required'],
            [['client_id', 'user_id'], 'integer'],
            [['access_token', 'refresh_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'user_id' => 'User ID',
            'access_token' => 'Access Token',
            'refresh_token' => 'Refresh Token',
        ];
    }

    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString();
    }
}
