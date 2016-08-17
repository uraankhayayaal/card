<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Компании';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <div class="form-group">
        <?= Html::button(Yii::t('app', 'Добавить компанию'), [
            // other options
            'class' => 'btn btn-success',
            'data' => [
                'toggle' => 'modal',
                'target' => '#AddCompany',
           ],
        ]) ?>
        <?php Modal::begin([
            'id' => 'AddCompany',
            'header' => '<b>' . Yii::t('app', 'Новая компания') . '</b>',
            //'footer' => Html::submitButton(Yii::t('app', 'Save')), // Subscribe checkbox
        ]);
            echo $this->render('_form', ['model' => $model]);
        Modal::end();?>
    </div>

    <?php yii\widgets\Pjax::begin(['id' => 'companies']) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
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
                            $result = $result. Html::a($data->name, Url::to(['card/view', 'id' => $data->id]),['style' => 'font-size:2rem;']).'<br />';
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

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php yii\widgets\Pjax::end() ?>
</div>
