<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\ListView;
use kartik\file\FileInput;

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

<?php Modal::begin([
    'id' => 'AddCard',
    'header' => '<b>' . Yii::t('app', 'Новая карта') . '</b>',
]); ?>
    <form action="card/create/" method="post" id="card_create" enctype="multipart/form-data">
        <p><label for="name" class="control-label">Название</label>
        <input type="text" name="Card[name]" id="name" class="form-control"></p>
        <p><label for="path">Изображение</label>
        <input type="file" name="Card[path]" id="path"></p>
        <input type="hidden" name="Card[company_id]" id="company_id">
        <input type="submit" id="submit" value="Отправить" class="btn btn-success">
    </form>
<?php Modal::end(); ?>

<?php Modal::begin([
    'id' => 'Address',
    'header' => '<b>' . Yii::t('app', 'Список адресов') . '</b>',
]); ?>
    <div id="address"></div>
    <div style="background-color: white; height: 35px;"><button class="btn btn-success pull-right" id="btn-add-address" data-add_address="">Добавить</button></div>
<?php Modal::end(); ?>


<?php Modal::begin([
    'id' => 'AddAddress',
    'header' => '<b>' . Yii::t('app', 'Добавить адрес') . '</b>',
]); ?>
    <form action="address/create/" method="post" id="address_create" enctype="multipart/form-data">
        <p><label for="value" class="control-label">Адрес</label>
        <input type="text" name="Address[value]" id="address-value" class="form-control"></p>
        <input type="hidden" name="Address[company_id]" id="address-company_id">
        <input type="submit" id="submit" value="Отправить" class="btn btn-success">
    </form>
<?php Modal::end(); ?>