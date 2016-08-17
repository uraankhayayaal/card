<?php

namespace console\controllers;

use Yii;
use yii\console\Exception;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\db\QueryBuilder;

use common\models\Excel;
use common\models\UploadForm;

class CronController extends \yii\console\Controller
{
	public function actionIndex()
	{
		$file = FileHelper::findFiles('backend\web\upload', ['only'=>['*.xls']]);
        require_once '/Classes/PHPExcel.php';
        $pExcel = \PHPExcel_IOFactory::load($file[0].'');
        foreach ($pExcel->getWorksheetIterator() as $worksheet) {
            $tables = $worksheet->toArray();
        }
        foreach ($tables as $key => $table) {
            $model = new Excel();
            if ($key <= 1) {
                unset($tables[$key]);
            } else {
                $model->card_number = $table[0];
                $model->name = $table[1].' ';
                $model->description = $table[2];
                $models[] = $model;
            }
        }
        Yii::$app->db->createCommand()->batchInsert('excel', ['id', 'name', 'card_number', 'description', 'user_id'], $models)->execute();
        return true;
		//$this->stdout('SSSSSSSSSSSSSSS'."\n", Console::FG_GREEN);
	}
}