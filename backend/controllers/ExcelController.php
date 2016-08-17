<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use common\models\Excel;
use common\models\UploadForm;
use yii\db\QueryBuilder;

/**
 * Site controller
 */
class ExcelController extends Controller
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
                        'actions' => ['index', 'import'],
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

    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionImport()
    {
        $UpForm = new UploadForm();
        require_once 'Classes/PHPExcel.php';
        if (Yii::$app->request->isPost) {
            $UpForm->imageFile = UploadedFile::getInstance($UpForm, 'imageFile');
            $fileName = $UpForm->imageFile->name;
            if ($UpForm->upload()) {
                $pExcel = \PHPExcel_IOFactory::load('upload/'.$fileName.'');
                foreach ($pExcel->getWorksheetIterator() as $worksheet) {
                    $tables = $worksheet->toArray();
                }
                foreach ($tables as $key => $table) {
                    $model = new Excel();
                    if ($key <= 1) {
                        unset($tables[$key]);
                    } else {
                        $model->card_number = $table[0];
                        $model->name = $table[1].' ';
                        $model->description = $table[2];
                        $models[] = $model;
                    }
                }
                Yii::$app->db->createCommand()->batchInsert('excel', ['id', 'name', 'card_number', 'description', 'user_id'], $models)->execute();
            }
            return $this->render('import', [
                'UpForm' => $UpForm,
            ]);
        } else {
            return $this->render('import', [
                'UpForm' => $UpForm,
            ]);
        }
    }
}
