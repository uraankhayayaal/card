<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Card */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'path',
            [
                'label' => 'Адресс',
                'value'  => call_user_func(function ($data) {
		    $render = '';
                    foreach ($data->addresses as $key => $address) {
                        $render .= $address->value . "<br/>";
                    }
                    return $render;
                }, $model),
                'format' => 'raw',
            ],
            'company.name',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'user.email',
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'label'=>'Карты',
                'format' => 'raw',
                'value' => function ($data) {                  
                    return Html::a($data->barCode, Url::to(['usercard/view', 'id'=>$data->id]));
                },
                'options' => [
                    'multiple' => true,
                ],
            ],
            'number',
            //'company_id',
        ],
    ]); ?>

</div>
