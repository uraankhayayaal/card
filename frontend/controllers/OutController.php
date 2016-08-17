<?php

namespace frontend\controllers;

use yii;
use yii\rest\ActiveController;
use frontend\models\AuthForm;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
/**
* 
*/
class OutController extends ActiveController
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

	public $modelClass = 'frontend\models\AuthForm';
	
	public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['index']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        return $actions;
    }

    public function actionCreate(){
        $user_id = \Yii::$app->user->identity->id;
        if(\common\models\Gtoken::find()->where(['user_id' => $user_id])->exists()){
            $model = \common\models\Gtoken::find()->where(['user_id' => $user_id])->One();
            $model->user_id = null;
            $model->save();
        }
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['result' => 'Вы вышли из системы: '.$user_id];
    }

    public function actionIndex(){
        return true;
    }
    public function actionUpdate(){
        return true;
    }
    public function actionDelete(){
        return true;
    }
    public function actionView(){
        return true;
    }
}