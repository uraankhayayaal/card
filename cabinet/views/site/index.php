<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\ListView;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <h1>Мои предприятия</h1>
	<div class="form-group">
        <?= Html::button(Yii::t('app', 'Добавить предприятие'), [
            // other options
            'class' => 'btn btn-success',
            'data' => [
                'toggle' => 'modal',
                'target' => '#AddCompany',
           ],
        ]) ?>
        <?php Modal::begin([
            'id' => 'AddCompany',
            'header' => '<b>' . Yii::t('app', 'Новое предприятие') . '</b>',
            //'footer' => Html::submitButton(Yii::t('app', 'Save')), // Subscribe checkbox
        ]);
            echo $this->render('_form', ['model' => $model]);
        Modal::end();?>
    </div>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php yii\widgets\Pjax::begin(['id' => 'companies']) ?> 
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_list',
                'summary' => false,
                'options' => [
                    'tag' => 'div',
                    'class' => 'row'
                ],
                'itemOptions' => [
                    'tag' => 'div',
                    'class' => 'col-lg-12'
                ],
            ]); ?>
        <?php yii\widgets\Pjax::end() ?>
    </div>
</div>
