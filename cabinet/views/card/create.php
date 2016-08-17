<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Card */

$this->title = 'Create Card';
$this->params['breadcrumbs'][] = \common\models\Company::findOne($model->company_id)->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
