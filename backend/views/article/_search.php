<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Card;

/* @var $this yii\web\View */
/* @var $model common\models\NotificationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php $form->field($model, 'id') ?>

    <?php $form->field($model, 'title') ?>

    <?php $form->field($model, 'description') ?>

    <?= $form->field($model, 'card_id')->dropDownList(ArrayHelper::map(Card::find()->all(),'id','name'),['prompt' => 'Выберите компанию...'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
