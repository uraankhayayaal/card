<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'O.Auth 2.0';
?>

<div class="oauth-authorize">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div style="color:#999;margin:1em 0">
                    <?= Html::a('Забыли пароль?', ['site/request-password-reset']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>