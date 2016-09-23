<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "excel".
 *
 * @property integer $id
 * @property string $name
 * @property integer $card_number
 * @property integer $user_id
 * @property string $description
 */
class Excel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'excel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_number'], 'required'],
            [['card_number', 'user_id', 'discount'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'card_number' => 'Card Number',
            'user_id' => 'User ID',
            'description' => 'Description',
        ];
    }
}
