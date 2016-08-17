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
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png">
    <meta name="yandex-verification" content="45b15b568c4873f8" />
    <meta name="google-site-verification" content="6js2MDfKY3uY_t_gt6Akh2p9bIft5QtXcFUDmnnv4bs" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Keywords" content="дисконтные, дисконт, бонус, бонусные, карты, карточки, дисконтка, в одном, приложении, кошелек, картмоне, кардмоне, cardmone, discount, bonus, электронные, дисконтная, бонусная, карта, приложение, android, ios"/>
    <meta name="Description" content="Если вы забыли вашу дисконтную или бонусную карту дома, то с нашим приложением ваша дисконтная или бонусная карта всегда будет в вашем телефоне. Забудьте о десятки дисконтных карт в вашем кошельке, сохраняйте ваши дисконтные карты в своем телефоне.Получайте номер бонусной карты у кассы в магазинах или воспользуйтесь сканером QR-кодов и штрих кодов чтобы добавить вашу бонусную карту. При покупке товаров покажите штрих код прямо из телефона на кассе магазина. Будьте в курсе о всех скидках и акциях ваших любимых магазинов.Ваши дисконтные и бонусные карты хранятся в облаке, вы можете синхронизировать свои дисконтные и бонусные карты с другим устройством Android в том числе iOS. Пожалуйста, сообщайте об ошибках и пишите предложения в комментариях или на почту разработчика. Мы будем рады внести новые изменения в приложении."/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!--[if lte IE 8]><script src="js/ie/html5shiv.js"></script><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

        <?= $content ?>

<?php $this->endBody() ?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter38691555 = new Ya.Metrika({
                    id:38691555,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/38691555" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
<?php $this->endPage() ?>