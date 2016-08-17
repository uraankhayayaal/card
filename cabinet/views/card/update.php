<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Card */

$this->title = 'Изменить карту: ' . $model->name;
$this->params['breadcrumbs'][] = \common\models\Company::findOne($model->company_id)->name;
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="card-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
