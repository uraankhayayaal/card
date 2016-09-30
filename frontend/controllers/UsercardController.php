<?php

namespace frontend\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use common\models\Usercard;

class UsercardController extends ActiveController
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

    public $modelClass = 'common\models\Usercard';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    public function actionIndex(){  
        $model = Usercard::find()->where(['user_id' => \Yii::$app->user->identity->id])->all();
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $model;
    }

    public function actionCreate(){  
        $model = new Usercard();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(),'') && $model->save()) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $model;
        } else {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['error' => $model->getErrors()];
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->getRequest()->getBodyParams(),'') && $model->save()) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $model;
        } else {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['error' => $model->getErrors()];
        }
    }

    public function actionDelete($id)
    {
        if (Usercard::find()->where(['user_id' => Yii::$app->user->identity->id, 'id' => $id])->one()) {
            if ($this->findModel($id)->delete()) {
                return true;
            }
        } else {
            return false;
        }
    }
    
    protected function findModel($id)
    {
        if (($model = Usercard::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

?>