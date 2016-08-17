<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $card_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 *
 * @property Card $card
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['card_id', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
            //[['card_id'], 'exist', 'skipOnError' => true, 'targetClass' => Card::className(), 'targetAttribute' => ['card_id' => 'id']],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'card_id' => 'Card ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCard()
    {
        return $this->hasOne(Card::className(), ['id' => 'card_id']);
    }

    public function getCompany()
    {
        return Company::find()->where(['id' => $this->card->company_id])->one();
        return $this->hasOne(Company::className(), ['id' => 'card_id']);
    }

    public function extraFields()
    {
        return ['card','company'];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
       
            date_default_timezone_set('Asia/Yakutsk');
            if($this->isNewRecord) $this->created_at = date("Y-m-d H:i:s");
            $this->updated_at = date("Y-m-d H:i:s");
     
            return true;
        }
        return false;
    }
}
