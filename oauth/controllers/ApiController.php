<?php
namespace oauth\controllers;

use Yii;
use yii\web\Controller;

class ApiController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionDiscount()
    {
    	if ($post = Yii::$app->request->post()) {
    		$this->log("Api");
    		exit();
    	}
		$this->log("No");
		exit();
    }

    private function log($message)
    {
        $file = Yii::getAlias('@oauth').'/web/log/oauth.log';
        if (!file_exists($file)) {
            fopen($file, 'w+');
        }
        date_default_timezone_set('Asia/Yakutsk');
        file_put_contents($file, "Date: ".date("Y-m-d H:i:s")." | ".$message."\n", FILE_APPEND | LOCK_EX);
        return true;
    }
}