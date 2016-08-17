<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Usercard */

$this->title = 'Create Usercard';
$this->params['breadcrumbs'][] = ['label' => 'Usercards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usercard-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
