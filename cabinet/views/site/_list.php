<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

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
				<button class="btn btn-success btn-address" data-toggle="modal" data-target="#Address" data-company_id="<?= $model->id ?>">Адреса</button>
			</p>
			<div class="row center-block">
				<div id="cards-<?= $model->id ?>">
				<?php foreach ($model->cards as $card) {
					echo '<a href="card/view?id='.$card->id.'"><img src="'.$card->path.'" class="cabinet-card pull-left"></a>';
				} ?>
				</div>
				<img src="web/images/add_b.png" class="cabinet-card add_card_btn pull-left" data-toggle="modal" data-target="#AddCard" id="<?= $model->id ?>">;
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	.cabinet-card {
		border: 3px solid #2196f3;
		border-radius: 3px;
		width: 160px;
		height: 85px;
		margin: 10px 10px 4px 15px;
		cursor: pointer;
	}
</style>