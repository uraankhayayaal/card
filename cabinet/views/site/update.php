<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Company */

$this->title = 'Изменить магазин: ' . $model->name;
$this->params['breadcrumbs'][] = $model->name;
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="company-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
