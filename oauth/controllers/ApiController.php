<?php
namespace oauth\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use oauth\models\OauthAccessToken;
use common\models\Usercard;
use common\models\Excel;
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
    		if (OauthAccessToken::find()->where(['user_id' => $post['id'], 'access_token' => $post['access_token']])->one()) {
    			if ($model = Usercard::find()->where(['user_id' => $post['id'], 'card_id' => 19])->one()) {
    				if ($card = Excel::find()->where(['card_number' => $model->barCode])->one()) {
    					return $card->discount;
    				}
    			}
    		}
    	}
    	return false;
    }
}