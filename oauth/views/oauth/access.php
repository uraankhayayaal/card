<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'O.Auth 2.0';
?>

<div class="oauth-access">
    <div class="row">
        <div class="col-lg-5">
            <p>
                <?= Html::a('Выйти (' . Yii::$app->user->identity->email . ')', ['logout', 'client_id' => $client_id, 'redirect_uri' => $redirect_uri], [
                    'data' => [
                        'method' => 'post',
                        //'confirm' => 'Are you sure?',
                        //'params'=>['MyParam1'=>'100', 'MyParam2'=>true],
                    ],
                ]) ?>
            </p>
            <p>
                <?= Html::a('Разрешить', ['access', 'client_id' => $client_id, 'redirect_uri' => $redirect_uri], [
                    'data' => [
                        'method' => 'post',
                        'params' => ['access'=> 1],
                    ],
                ]) ?>
                <?= Html::a('Отмена', ['access', 'client_id' => $client_id, 'redirect_uri' => $redirect_uri], [
                    'data' => [
                        'method' => 'post',
                        'params' => ['access'=> 0],
                    ],
                ]) ?>
            </p>
        </div>
    </div>
</div>