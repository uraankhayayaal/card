<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Card */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-form">
<?php $this->registerJs(
   '$("document").ready(function() { 
        $("#new_card").on("pjax:end", function() {
            $.pjax.reload({container:"#companies"});  //Reload GridView
            $(".modal").modal("hide");
        });
    });'
);
?>

<?php yii\widgets\Pjax::begin(['id' => 'new_card']) ?>
    <?php $form = ActiveForm::begin([
    	'options' => ['data-pjax' => true],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'path')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end() ?>

</div>
