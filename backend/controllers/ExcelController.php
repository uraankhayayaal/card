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
use yii\helpers\Json;

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
    
    /*public function actionImport()
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
    }*/

    public function actionImport()
    {
        $UploadForm = new UploadForm();
        if (Yii::$app->request->isPost) {
            $UploadForm->imageFile = UploadedFile::getInstance($UploadForm, 'imageFile');
            $fileName = $UploadForm->imageFile->name = time()."_".$UploadForm->imageFile->name;
            if ($UploadForm->upload()) {
                $file = file_get_contents('upload/'.$fileName);
                $file = iconv('cp1251','utf-8',$file);
                $file = Json::decode($file);

                $newCount = 0;

                foreach ($file as $key => $value) {
                    if (!Excel::findOne(['card_number' => $value['card_number']])) {
                        $model = new Excel();
                        $model->card_number = $value['card_number'];
                        $model->name = $value['name'];
                        $model->discount = $value['discount'];
                        $model->save();
                        $newCount++;
                    }
                }
                echo $newCount;
            }
        } else {
            return $this->render('import', [
                'UploadForm' => $UploadForm,
            ]);
        }
    }
/*
$file = file_get_contents('C:\OpenServer\domains\hozmarket.dty.local\frontend\views\site\goods.json');
$file = iconv('cp1251','utf-8',$file);
$file = Json::decode($file);

function get_child($arr, $lvl = 0, $parent_name = '', $parent_id = 0) {
    if (is_array($arr)) {
        foreach ($arr as $key => $value) {
            if (is_array($value))$res .= get_child($value, $lvl+1, $parent_name, $parent_id);
            if (is_string($value)) {
                if (isset($arr['name'])) {
                    echo '<div class="row">';
                    echo '<div class="col-lg-12">';
                    echo 'Имя родителя: ' . $parent_name . '<br>';
                    echo 'ID родителя: ' . $parent_id . '<br>';
                    echo 'Уровень: ' . $lvl . ' | Категория: ' . $arr['name'] . '<br>';
                    
                    $parent_name = ($arr['name']);
                    $category = new Category();
                    $category->name = $arr['name'];
                    $category->parent_id = $parent_id;
                    if (!$category->save()) {
                        echo 'Ошибка: '; var_dump($category);
                    }
                    $parent_id = $category->id;

                    echo '</div>';
                    echo '</div>';
                    echo "-------------------------------------------------------------------------------------------------------------------------------------------------";
                }
                if (isset($arr['ОсновнойШтрихКод'])) {
                    echo '<div class="row">';
                    echo '<div class="col-lg-12">';
                    if (stristr($arr['Товар'], 'АКЦИЯ')) {
                        echo 'Акция: Да<br>';
                    } else {
                        echo 'Акция: Нет<br>';
                    }
                    echo 'Имя родителя: ' . $parent_name . '<br>';
                    echo 'ID родителя: ' . $parent_id . '<br>';
                    echo 'ОсновнойШтрихКод: '. $arr['ОсновнойШтрихКод'] . "<br>";
                    echo 'ТоварКод: '. $arr['ТоварКод'] . "<br>";
                    echo 'Товар: '. $arr['Товар'] . "<br>";
                    echo 'Цена: '. $arr['Цена'] . "<br>";
                    echo 'Остаток: '. $arr['Остаток'] . "<br>";

                    $goods = new Goods();
                    $goods->category_id = $parent_id;
                    $goods->name = $arr['Товар'];
                    $goods->product_code = $arr['ТоварКод'];
                    $goods->bar_code = $arr['ОсновнойШтрихКод'];
                    $goods->price = $arr['Цена'];
                    if (stristr($arr['Товар'], 'АКЦИЯ')) {
                        $goods->sale = 1;
                    } else {
                        $goods->sale = 0;
                    }
                    $goods->count = $arr['Остаток'];
                    if (!$goods->save()) {
                        echo 'Ошибка: '; var_dump($goods);
                    }

                    echo '</div>';
                    echo '</div>';
                    echo "-------------------------------------------------------------------------------------------------------------------------------------------------";
                    break;
                }
            }
        }
    }
}
get_child($file);*/

}
