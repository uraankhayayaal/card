<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Card;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-form">
<?php $this->registerJs(
   '$("document").ready(function(){ 
        $("#new_country").on("pjax:end", function() {
            $.pjax.reload({container:"#countries"});  //Reload GridView
            $(".modal").modal("hide");
        });
    });'
);
?>
<?php yii\widgets\Pjax::begin(['id' => 'new_country']) ?>
    <?php $form = ActiveForm::begin([
    	//'action' => 'create',
    	'options' => ['data-pjax' => true ],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'card_id')->dropDownList(ArrayHelper::map(Card::find()->where(['in', 'id', $cards])->all(),'id','name'),['prompt' => 'Выберите компанию...']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end() ?>

</div>
