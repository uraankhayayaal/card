<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Card', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'path',
            'company_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
