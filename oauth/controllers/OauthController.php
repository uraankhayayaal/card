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
    public function actionAuthorize($client_id, $redirect_uri, $id)
    {
	$this->log("Authorize...");
        if (OauthClient::findOne(['client_id' => $client_id])) {
            if (!Yii::$app->user->isGuest) {
                return $this->redirect(['access', 'client_id' => $client_id, 'redirect_uri' => $redirect_uri, 'id' => $id]);
            }

            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack(['access', 'client_id' => $client_id, 'redirect_uri' => $redirect_uri,  'id' => $id]);
            } else {
                return $this->render('authorize', [
                    'model' => $model,
                ]);
            }
        }
        return 'Access Denied';
    }

    public function actionAccess($client_id, $redirect_uri, $id)
    {
	$this->log("Access");
        if (OauthClient::findOne(['client_id' => $client_id])) {
		$this->log("Access - One if");
            if ($model = OauthAccessToken::find()->where(['client_id' => $client_id, 'user_id' => Yii::$app->user->identity->id])->one()) {
		$this->log("Access - Two if");
                $url = "{$redirect_uri}?client_id={$client_id}&redirect_uri={$redirect_uri}&code={$model->user_id}&id={$id}&status_code=200";
                return $this->redirect(Url::to($url));
            }
            if (Yii::$app->request->post()) {
                $access = Yii::$app->request->post()['access'];
                if ($access == 200) {
                    $user_id = Yii::$app->user->identity->id;
                    $model = new OauthAccessToken();
                    $model->client_id = $client_id;
                    $model->user_id = $user_id;
                    if ($model->save()) {
                        $url = "{$redirect_uri}?client_id={$client_id}&redirect_uri={$redirect_uri}&code={$model->user_id}&id={$id}&status_code={$access}";
                        return $this->redirect(Url::to($url));
                    }
                } else {
                    $url = "{$redirect_uri}?client_id={$client_id}&redirect_uri={$redirect_uri}&id={$id}&status_code={$access}";
                    return $this->redirect(Url::to($url));
                }
            }

            return $this->render('access', [
                'client_id' => $client_id,
                'redirect_uri' => $redirect_uri,
                'id' => $id
            ]);
        }
        return 'Access Denied';
    }

    public function actionLogout($client_id, $redirect_uri)
    {
        Yii::$app->user->logout();

        return $this->redirect(['authorize', 'client_id' => $client_id, 'redirect_uri' => $redirect_uri]);
    }

    public function actionGenerateAccessToken($client_id, $client_secret, $code, $redirect_uri, $id)
    {
        $this->log("GAT");
        if (OauthClient::find()->where(['client_secret' => $client_secret, 'client_id' => $client_id])->one())
        {
            $this->log('1');
            if ($model = OauthAccessToken::find()->where(['client_id' => $client_id, 'user_id' => $code])->one()) {
                    $this->log('2');
                    $model->generateAccessToken();
                if ($model->save()) {
                    $this->log('3');
                    if($curl = curl_init()) {
                        curl_setopt($curl, CURLOPT_URL, $redirect_uri.'?client_id='.$client_id.'&redirect_uri='.$redirect_uri.'&id='.$id.'&status_code=200.1&access_token='.$model->access_token.'&code='.$code);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        $out = curl_exec($curl);
                        $this->log('4');
                        echo $out;
                        curl_close($curl);
                        $this->log('5');
                        exit();
                    }
                }
            }
        }
        $this->log('10');
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
