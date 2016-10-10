<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "card".
 *
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property integer $company_id
 *
 * @property Company $company
 * @property Notification[] $notifications
 * @property UserCard[] $userCards
 */
class Card extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['company_id', 'type'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['path'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif', 'maxFiles' => 1, 'maxWidth' => 3500, 'maxHeight' => 3500],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'path' => 'Изображение',
            'company_id' => 'Company ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
    public function getAddresses()
    {
        return Address::find()->where(['company_id' => $this->company_id])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCards()
    {
        return $this->hasMany(UserCard::className(), ['card_id' => 'id']);
    }

    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['card_id' => 'id']);
    }
    public function extraFields()
    {
        return ['addresses'];
    }
}
