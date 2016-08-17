<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_card".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $card_id
 * @property integer $barFormatId
 * @property string $barCode
 * @property string $number
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 *
 * @property Card $card
 * @property User $user
 */
class Usercard extends \yii\db\ActiveRecord
{
    public $type;
    public $lastname;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[/*'user_id',*/ 'card_id', 'barFormatId', 'barCode'], 'required'],
            [['user_id', 'card_id', 'barFormatId', 'status', 'type'], 'integer'],
            ['barCode', 'unique', 'targetAttribute' => ['barCode', 'card_id'],'message'=>'This bar code alredy has been taken'],
            [['number', 'description', 'barCode'], 'string', 'max' => 255],
            [['card_id'], 'exist', 'skipOnError' => true, 'targetClass' => Card::className(), 'targetAttribute' => ['card_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['created_at', 'updated_at', 'lastname'], 'safe'],
            ['type', 'validateHozMarket'],
        ];
    }

    public function validateHozMarket($attribute, $params)
    {
        if ($this->type == 1) {
            if (Excel::find()->where(['card_number' => $this->barCode])->andFilterWhere(['like', 'name', $this->lastname])->exists()) {
                return true;
            }
            $this->addError($attribute, 'Unknown lastname or number');
            return false;
        }
        $this->addError($attribute, 'Dont hozmarket');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'card_id' => 'Card ID',
            'number' => 'Number',
            'barCode' => 'Bar code',
            'barFormatId' => 'Bar format',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCard()
    {
        return $this->hasOne(Card::className(), ['id' => 'card_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            date_default_timezone_set('Asia/Yakutsk');
            if($this->isNewRecord) $this->created_at = date("Y-m-d H:i:s");
            $this->updated_at = date("Y-m-d H:i:s");

            if(!Yii::$app->user->isGuest){
                $this->user_id = Yii::$app->user->identity->id;
            }
     
            return true;
        }
        return false;
    }
}