<?php

namespace frontend\controllers;

use yii;
use yii\rest\ActiveController;
use frontend\models\SignForm;

class SignController extends ActiveController
{
    public $modelClass = 'frontend\models\SignForm';

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
        
        $model = new SignForm();
        if ($model->load(Yii::$app->request->post())) {
        	if(!$model->validate()) return $model->getErrors();
            if ($user = $model->signup()) {
            	if (Yii::$app->getUser()->login($user)) {
                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['token' => $user->access_token];
                }
            }
        }
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['error' => 'Ошибка'];
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

?>