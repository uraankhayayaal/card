<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'username',
            //'auth_key',
            //'access_token',
            //'password_hash',
            // 'password_reset_token',
            'email:email',
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'label'=>'Карты',
                'format' => 'raw',
                'value' => function ($data) {
                    $result = '<div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'
                        .count($data->userCards).' карт '
                        .'<span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">';
                    foreach ($data->userCards as $card) {
                        $result = $result.'<li class="dropdown-header">';
                        $result = $result. Html::a(Html::img($card->card->path, ['width'=>'70px', 'style' => 'margin-right:5px; margin-bottom:5px;']), Url::to(['usercard/view', 'id' => $card->id]),['style' => 'display:inline;',]);
                        $result = $result. Html::a($card->card->name, Url::to(['usercard/view', 'id' => $card->id]),['style' => 'display:inline;',]).' ';
                        $result = $result. Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', ['user/deleteusercard', 'id' => $card->id], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Вы действительно хотите удалить карту этого пользователя?',
                                'method' => 'post',
                            ],
                            'style' => 'display:inline;',
                        ]).'<br />';
                        $result = $result.'</li>';
                    }                     
                    return $result.'</ul></div>';
                },
                'options' => [
                    'multiple' => true,
                ],
            ],
            'status',
            // 'created_at',
            // 'updated_at',
            'gtoken',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
