<?php

namespace frontend\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class CardController extends ActiveController
{
	public function behaviors()
    {
        $behaviors = parent::behaviors();
	    $behaviors['authenticator'] = [
	        'class' => CompositeAuth::className(),
	        'authMethods' => [
	            HttpBasicAuth::className(),
	            HttpBearerAuth::className(),
	            QueryParamAuth::className(),
	        ],
	    ];
	    return $behaviors;
    }

    public $modelClass = 'common\models\Card';
}

?>