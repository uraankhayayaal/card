<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="headingOne">
		<h4 class="panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#<?= $model->id ?>" aria-expanded="false" aria-controls="collapseOne">
			<?= $model->name; ?>
		</h4>
	</div>
	<div id="<?= $model->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		<div class="panel-body">
			<p><?= $model->content; ?></p>
			<p>
				<?= Html::a("Добавить карту", Url::to(['card/create', 'company_id'=>$model->id]), ['class' => 'btn btn-success']); ?>
			</p>
			<div class="row">
				<?php foreach ($model->cards as $card) {
					echo '<div class="col-lg-3">';
					echo '<a href="card/view?id='.$card->id.'"><img src="'.$card->path.'" style="width:120px; height:70px;">'.'<br>';
					echo $card->name . '</a>';
					echo '</div>';
				} ?>
			</div>
			<br>
			<p>
				<?= Html::a("Добавить адрес", Url::to(['address/create', 'company_id'=>$model->id]), ['class' => 'btn btn-success']); ?>
			</p>
			<div class="row">
				<?php foreach ($model->addresses as $address) {
					echo '<div class="col-lg-3">';
					echo '<a href="address/view?id='.$address->id.'">' . $address->value . '</a>';
					echo '</div>';
				} ?>
			</div>
		</div>
	</div>
</div>