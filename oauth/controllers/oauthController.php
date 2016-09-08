<?php
namespace oauth\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use common\models\LoginForm;
use oauth\models\OauthClient;
use oauth\models\OauthAccessToken;

/**
 * Site controller
 */
class OauthController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionAuthorize($client_id, $redirect_uri)
    {
        if (OauthClient::findOne(['client_id' => $client_id])) {
            if (!Yii::$app->user->isGuest) {
                return $this->redirect(['access', 'client_id' => $client_id, 'redirect_uri' => $redirect_uri]);
            }

            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack(['access', 'client_id' => $client_id, 'redirect_uri' => $redirect_uri]);
            } else {
                return $this->render('authorize', [
                    'model' => $model,
                ]);
            }
        }
        return 'Access Denied';
    }

    public function actionAccess($client_id, $redirect_uri)
    {
        if (OauthClient::findOne(['client_id' => $client_id])) {
            if (OauthAccessToken::find()->where(['client_id' => $client_id, 'user_id' => Yii::$app->user->identity->id])->one()) {
                $url = "{$redirect_uri}?client_id={$client_id}&redirect_uri={$redirect_uri}&code={$user_id}&status_code={$access}";
                return $this->redirect(Url::to($url));
            }
            if (Yii::$app->request->post()) {
                $access = Yii::$app->request->post()['access'];
                if ($access == 1) {
                    $user_id = Yii::$app->user->identity->id;
                    $model = new OauthAccessToken();
                    $model->client_id = $client_id;
                    $model->user_id = $user_id;
                    if ($model->save()) {
                        $url = "{$redirect_uri}?client_id={$client_id}&redirect_uri={$redirect_uri}&code={$user_id}&status_code={$access}";
                        return $this->redirect(Url::to($url));
                    }
                } else {
                    $url = "{$redirect_uri}?client_id={$client_id}&redirect_uri={$redirect_uri}&status_code={$access}";
                    return $this->redirect(Url::to($url));
                }
            }

            return $this->render('access', [
                'client_id' => $client_id,
                'redirect_uri' => $redirect_uri,
            ]);
        }
        return 'Access Denied';
    }

    public function actionLogout($client_id, $redirect_uri)
    {
        Yii::$app->user->logout();

        return $this->redirect(['authorize', 'client_id' => $client_id, 'redirect_uri' => $redirect_uri]);
    }
}