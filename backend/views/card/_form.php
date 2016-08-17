<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Company;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Card */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-form">

    <?php $form = ActiveForm::begin([
    	'options' => [
            'enctype'=>'multipart/form-data',
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'path')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*',],
    ]) ?>

    <?= $form->field($model, 'company_id')->dropDownList(ArrayHelper::map(Company::find()->all(),'id','name'),['prompt' => 'Выберите компанию...']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
