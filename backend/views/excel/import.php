<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Card */

$this->title = 'Excel Import';
$this->params['breadcrumbs'][] = ['label' => 'Excel Import', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="excel-import">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($UpForm, 'imageFile')->fileInput() ?>

    <button>Submit</button>

	<?php ActiveForm::end() ?>

</div>
