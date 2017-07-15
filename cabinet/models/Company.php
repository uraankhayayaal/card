<?php

namespace cabinet\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property integer $user_id
 *
 * @property Card[] $cards
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['content'], 'string'],
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название предприятия',
            'content' => 'Описание предприятия',
            'user_id' => 'Представитель предприятия',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function getCards()
    {
        return $this->hasMany(\common\models\Card::className(), ['company_id' => 'id']);
    }

    public function getAddresses()
    {
        return $this->hasMany(\common\models\Address::className(), ['company_id' => 'id']);
    }
}
