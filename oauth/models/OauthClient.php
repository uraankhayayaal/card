<?php

namespace oauth\models;

use Yii;

/**
 * This is the model class for table "oauth_client".
 *
 * @property integer $id
 * @property integer $client_id
 * @property string $client_secret
 * @property integer $user_id
 */
class OauthClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oauth_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'client_secret', 'user_id'], 'required'],
            [['client_id', 'user_id'], 'integer'],
            [['client_secret'], 'string', 'max' => 255],
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
            'client_secret' => 'Client Secret',
            'user_id' => 'User ID',
        ];
    }
}
