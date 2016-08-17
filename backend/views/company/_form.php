<?php

use yii\helpers\Html;


use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">
<?php $this->registerJs(
   '$("document").ready(function(){ 
        $("#new_company").on("pjax:end", function() {
            $.pjax.reload({container:"#companies"});  //Reload GridView
            $(".modal").modal("hide");
        });
    });'
);
?>
<?php yii\widgets\Pjax::begin(['id' => 'new_company']) ?>
    <?php $form = ActiveForm::begin([
    	'options' => ['data-pjax' => true ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end() ?>

</div>
