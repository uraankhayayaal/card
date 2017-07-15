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

                <!--<div style="color:#999;margin:1em 0">
                    <?= Html::a('Забыли пароль?', ['site/request-password-reset']) ?>
                </div>-->

                <div class="form-group">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            Если вы ещё на зарегистрированны, то можете скачать приложение:
            <a class="google-play" target="_blank" href='https://play.google.com/store/apps/details?id=ru.admin14.dtycard&utm_source=global_co&utm_medium=prtnr&utm_content=Mar2515&utm_campaign=PartBadge&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Доступно в Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/ru_badge_web_generic.png'/></a>
        </div>
    </div>
</div>