<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Keywords" content="дисконтные, дисконт, бонус, бонусные, карты, карточки, дисконтка, в одном, приложении, кошелек, картмоне, кардмоне, cardmone, discount, bonus, электронные, дисконтная, бонусная, карта, приложение, android, ios"/>
    <meta name="Description" content="Если вы забыли вашу дисконтную или бонусную карту дома, то с нашим приложением ваша дисконтная или бонусная карта всегда будет в вашем телефоне. Забудьте о десятки дисконтных карт в вашем кошельке, сохраняйте ваши дисконтные карты в своем телефоне.Получайте номер бонусной карты у кассы в магазинах или воспользуйтесь сканером QR-кодов и штрих кодов чтобы добавить вашу бонусную карту. При покупке товаров покажите штрих код прямо из телефона на кассе магазина. Будьте в курсе о всех скидках и акциях ваших любимых магазинов.Ваши дисконтные и бонусные карты хранятся в облаке, вы можете синхронизировать свои дисконтные и бонусные карты с другим устройством Android в том числе iOS. Пожалуйста, сообщайте об ошибках и пишите предложения в комментариях или на почту разработчика. Мы будем рады внести новые изменения в приложении."/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']]
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->email . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
