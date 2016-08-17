<?php

namespace frontend\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use common\models\Notification;
use yii\helpers\ArrayHelper;

class ArticleController extends ActiveController
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

    public $modelClass = 'common\models\Notification';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex(){
    	$query = Notification::find()/*->where(['status' => 1])*/;

    	$usercards = array_unique(ArrayHelper::getColumn(\common\models\Usercard::find()->where(['user_id' => Yii::$app->user->identity->id])->all(), 'card_id'));

    	if(empty($usercards)) return null;

    	$query->andFilterWhere(['in', 'card_id', $usercards]);


		$provider = new \yii\data\ActiveDataProvider([
		    'query' => $query,
		    'pagination' => [
		        'pageSize' => 50,
		    ],
		    'sort' => [
		        'defaultOrder' => [
		            /*'created_at' => SORT_DESC,
		            'title' => SORT_ASC, */
		            'id' => SORT_DESC,
		        ]
		    ],
		]);

		// returns an array of Post objects
		$posts = $provider->getModels();

		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $posts;
    }
}

?>