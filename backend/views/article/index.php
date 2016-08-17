<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-index">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="form-group">
    <?= Html::button(Yii::t('app', 'Создать новость'), [
        // other options
        'class' => 'btn btn-success',
        'data' => [
            'toggle' => 'modal',
            'target' => '#NotificationCreate',
       ],
    ]) ?>
    <?php Modal::begin([
        'id' => 'NotificationCreate',
        'header' => '<b>' . Yii::t('app', 'Новая новость') . '</b>',
        //'footer' => Html::submitButton(Yii::t('app', 'Save')), // Subscribe checkbox
    ]);
        echo $this->render('_form', ['model' => $model]);
    Modal::end();?>
</div>

<div class="form-group">
    <?php Html::button(Yii::t('app', 'Push'), [
        // other options
        'class' => 'btn btn-success',
        'data' => [
            'toggle' => 'modal',
            'target' => '#push',
       ],
    ]) ?>
    <?php Modal::begin([
        'id' => 'push',
        'header' => '<b>' . Yii::t('app', 'Новая новость') . '</b>',
        //'footer' => Html::submitButton(Yii::t('app', 'Save')), // Subscribe checkbox
    ]);
        echo $this->render('_push', ['model' => $model]);
    Modal::end();?>
</div>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?php yii\widgets\Pjax::begin(['id' => 'countries']) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'title',
                'description:ntext',
                [
                    'attribute' => 'card',
                    'value' => 'card.name'
                ],
                'created_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php yii\widgets\Pjax::end() ?>
</div>
