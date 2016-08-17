<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gtoken".
 *
 * @property integer $id
 * @property string $value
 * @property integer $os
 * @property integer $user_id
 *
 * @property User $user
 */
class Gtoken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gtoken';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'os'], 'required'],
            [['os', 'user_id'], 'integer'],
            ['value', 'unique'],
            [['value'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'os' => 'Os',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
