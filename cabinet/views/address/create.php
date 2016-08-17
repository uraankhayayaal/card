<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Address */

$this->title = 'Новый адресс';
$this->params['breadcrumbs'][] = $model->company->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
