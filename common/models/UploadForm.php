<?php

namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadForm extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls'],
        ];
    }
    
    public function upload()
    {
        if ($this->imageFile->saveAs('upload/' . $this->imageFile->baseName . '.' . $this->imageFile->extension)) {
            return true;
        } else {
            return false;
        }
    }
}