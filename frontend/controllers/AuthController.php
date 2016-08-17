<?php

namespace frontend\controllers;

use yii;
use yii\rest\ActiveController;
use frontend\models\AuthForm;
/**
* 
*/
class AuthController extends ActiveController
{
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
        
        /*if (!Yii::$app->user->isGuest) {
        	Yii::$app->user->generateToken()->save();
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            //return ['error' => "Вы уже авторизованы"];
            return ['token' => \Yii::$app->user->access_token];
        }*/

        $model = new AuthForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = Yii::$app->user->identity;
            $user->generateToken();
            $user->save();
            //$usercard = $user->userCards();
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['token' => $user->access_token,
                    //'usercard' => $usercard,
            ];

        } else {
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['error' => $model->getErrors()];
        }
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