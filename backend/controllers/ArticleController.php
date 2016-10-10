<?php

namespace backend\controllers;

use Yii;
use common\models\Notification;
use common\models\NotificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use common\models\Gtoken;
use common\models\User;

/**
 * ArticleController implements the CRUD actions for Notification model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'dalete', 'push'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->email);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Notification models.
     * @return mixed
     */
    public function actionIndex()
    {
      $model = new Notification();
      $searchModel = new NotificationSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      if ($model->load(Yii::$app->request->post()) && $model->save())
      {
        $noty = $model;
        $model = new Notification(); //reset model

        if ($noty->user_id_for_push) {
          $message = \yii\helpers\BaseJson::encode(['id' => $noty->id, 'title' => $noty->title, 'body' => $noty->description, 'company_card_id' => $noty->card_id]);
          $gtoken = Gtoken::find()->where(['user_id' => $noty->user_id_for_push])->one();
          $push_token = $gtoken->value;

          if ($gtoken->os == 2) {
            $gcm = Yii::$app->gcm;
            $result= $gcm->send($push_token, $message,
              [
                'customerProperty' => 1,
              ],
              [
                'timeToLive' => 3
              ]
            );
          } else {
            $iosMsg = $noty->description;
            $apns = Yii::$app->apns;
            $apns->send($push_token, $iosMsg,
              /*[
                'customProperty_1' => 'Hello',
                'customProperty_2' => 'World'
              ],*/
              [
                'sound' => 'default',
                'badge' => 1
              ]
            );
          }
        } else {
          $gcm = Yii::$app->gcm;
          var_dump($gcm);
          die();
          //$users = User::find()->with('userCards.card')->where(['userCards.card.copmany_id' => $noty->card_id])->all();
          /*$push_tokens = ArrayHelper::getColumn(\common\models\Gtoken::find()->where(['os' => $noty->os])->andWhere(['in', 'user_id', $users])->all(), function ($element) {
              return $element['value'];
          });*/
          $push_tokens = ArrayHelper::getColumn(\common\models\Gtoken::find()->where(['os' => 2])->all(), 'value');
          //echo "dfgdfgsdfg: ".$push_tokens[0];
          $message = \yii\helpers\BaseJson::encode(['id' => $noty->id, 'title' => $noty->title, 'body' => $noty->description, 'company_card_id' => $noty->card_id]);
          $result= $gcm->sendMulti($push_tokens, $message,
            [
              'customerProperty' => 1,
            ],
            [
              'timeToLive' => 3
            ]
          );

          $apns = Yii::$app->apns;
          $ios_push_tokens = ArrayHelper::getColumn(\common\models\Gtoken::find()->where(['os' => 1])->all(), 'value');
          $apns->sendMulti($ios_push_tokens, $message,
            /*[
              'customProperty_1' => 'Hello',
              'customProperty_2' => 'World'
            ],*/
            [
              'sound' => 'default',
              'badge' => 1
            ]
          );
        }
      }

      return $this->render('index', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
      ]);
    }

    /**
     * Displays a single Notification model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      return $this->render('view', [
        'model' => $this->findModel($id),
      ]);
    }

    /**
     * Creates a new Notification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notification();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

          if ($mode->user_id_for_push) {
            var_dump($model->user_id_for_push);
            die();
          } else {
            var_dump($model);
            die();
          }

          $gcm = Yii::$app->gcm;
          $push_tokens = ArrayHelper::getColumn(\common\models\Gtoken::find()->where(['os' => $model->os])->all(), function ($element) {
              return $element['value'];
          });
          $result = $gcm->sendMulti($push_tokens, $model->title."\n".$model->description,
            [
              'customerProperty' => 1,
            ],
            [
              'timeToLive' => 3
            ]
          );

          return $this->redirect(['view', 'id' => $model->id]);
        } else {
          return $this->render('create', [
              'model' => $model,
          ]);
        }

    }

    public function actionPush()
    {
        $model = new Notification();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $gcm = Yii::$app->gcm;
            $push_tokens = ArrayHelper::getColumn(\common\models\Gtoken::find()->where(['os' => $model->os])->all(), function ($element) {
                return $element['value'];
            });
            $result = $gcm->sendMulti($push_tokens, $model->title."\n".$model->description,
              [
                'customerProperty' => 1,
              ],
              [
                'timeToLive' => 3
              ]
            );
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Notification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Notification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
