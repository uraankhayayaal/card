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

    <?php/* yii\widgets\Pjax::begin(['id' => 'companies']) */?>        
        <?/*= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                //'name',
                //'content:ntext',
                [
                    'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                    'label'=>'Компании',
                    'format' => 'raw',
                    'value' => function ($data) {
                        $result = "";
                            $result = $result. '<h3>'. $data->name.'</h3><br />';
                            $result = $result. $data->content;                 
                        return $result;
                    },
                    'options' => [
                        'multiple' => true,
                    ],
                    'contentOptions'=>['style'=>'max-width: 300px;'],
                ],
                [
                    'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                    'label'=>'Карты',
                    'format' => 'raw',
                    'value' => function ($data) {
                        $result = "";
                        foreach ($data->cards as $card) {
                            $result = $result. Html::a(Html::img($card->path, ['width'=>'120px']), Url::to(['card/view', 'id' => $card->id])).'<br />';
                            $result = $result. Html::a($card->name, Url::to(['card/view', 'id' => $card->id])).'<br />';
                        }                     
                        return $result.Html::a("", Url::to(['card/create', 'company_id'=>$data->id]), ['class' => 'glyphicon glyphicon-plus btn btn-success', 'title' => 'Добавить карту']);
                    },
                    'options' => [
                        'multiple' => true,
                    ],
                ],

                [
                    'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                    'label'=>'Адреса',
                    'format' => 'raw',
                    'value' => function ($data) {
                        $result = "";
                        foreach ($data->addresses as $adrress) {
                            $result = $result. Html::a($adrress->value, Url::to(['address/view', 'id' => $adrress->id])).'<br />';
                        }                     
                        return $result.Html::a("", Url::to(['address/create', 'company_id'=>$data->id]), ['class' => 'glyphicon glyphicon-plus btn btn-success', 'title' => 'Добавить адрес']);
                    },
                    'options' => [
                        'multiple' => true,
                    ],
                ],

                [
                   'class' => 'yii\grid\ActionColumn',
                   'template' => '{update} {delete}'
                ]
            ],
        ]); */?>
    <?php/* yii\widgets\Pjax::end() */?>
</div>
