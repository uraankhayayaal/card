<?php

namespace cabinet\controllers;

use Yii;
use common\models\Notification;
use cabinet\models\NotificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

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
                        'actions' => ['login', 'signup', 'requestPasswordReset', 'resetPassword', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'push', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
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
        $model->is_push = $model->is_push * 1;
        if ($model->is_push == 1) {
          $last = Notification::find()->where(['is_push' => 1])->orderBy(['created_at' => SORT_DESC])->one();

          $date_from = strtotime($last->created_at);
          $date_from = date("Y-m-d", $date_from);
          $date_till = date("Y-m-d");

          $date_from = explode('-', $date_from);
          $date_till = explode('-', $date_till);
   
          $time_from = mktime(0, 0, 0, $date_from[1], $date_from[2], $date_from[0]);
          $time_till = mktime(0, 0, 0, $date_till[1], $date_till[2], $date_till[0]);
          
          $diff = ($time_till - $time_from)/60/60/24;
          if ($diff > 5) {
            $noty = $model;
            $model = new Notification(); //reset model

            $usercards = \common\models\Usercard::find()->where(['card_id' => $noty->card_id])->all();
            $users = [];
            foreach ($usercards as $usercard) {
              $users[] = $usercard->user_id; 
            }
            
            $gcm = Yii::$app->gcm;
            $push_tokens = ArrayHelper::getColumn(\common\models\Gtoken::find()->joinWith('user')->where(['os' => 2])->andWhere(['not', ['user_id' => null]])->andWhere(['in', 'user.id', array_unique($users)])->all(), 'value');
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
            $ios_push_tokens = ArrayHelper::getColumn(\common\models\Gtoken::find()->joinWith('user')->where(['os' => 1])->andWhere(['not', ['user_id' => null]])->andWhere(['in', 'user.id', array_unique($users)])->all(), 'value');
            $apns->sendMulti($ios_push_tokens, $message,
              //[
              //  'customProperty_1' => 'Hello',
              //  'customProperty_2' => 'World'
              //],
              [
                'sound' => 'default',
                'badge' => 1
              ]
            );
          }
        }
      }

      return $this->render('index', [
          'model' => $model,
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          'cards' => $searchModel->cards(),
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
