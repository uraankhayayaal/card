<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
/* @var $this yii\web\View */

$this->title = 'DTY Card Картмоне - дисконтные карты в твоем смартфоне';
?>

        <header>
            <div class="container">
            <div class="logo">
                <h1 class="text-center pull-left"><img src="/images/logo.png" alt="картмоне - logo"> КАРТМОНЕ</h1>
            </div>
            <div class="nav pull-right">
                <ul>
                    <li><a href="#">О проекте</a></li>
                    <li><a href="#">Для бизнеса</a></li>
                </ul>
            </div>
            </div>
        </header>
        
        
        <section class="introduction" id="project">
            <div class="container">
                <div class="my_wrapepr_img">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="my_label">
                            ДИСКОНТНЫЕ КАРТЫ<br />ВСЕГДА ПОД РУКОЙ
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                        <div class="links">
                            <a target="_blank" href="https://play.google.com/store/apps/details?id=ru.admin14.dtycard" class="btn gstore"></a>
                            <a href="#" class="btn istore"></a>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                        
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                         <img src="/images/all_in_r_hand.png" class="img-responsive all_in_r_hand" alt="картмоне - ДИСКОНТНЫЕ КАРТЫ ВСЕГДА ПОД РУКОЙ">   
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                    <div class="card install">
                        <h3>УСТАНОВИ</h3>
                        <p class="h4">Набери в поиске "КАРТМОНЕ"</p>
                        <img src="/images/install.png" alt="">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                    <div class="card add">
                        <h3>ДОБАВЬ КАРТУ</h3>
                        <p class="h4">Просканируй штрих код</p>
                        <img src="/images/add.png" alt="">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                    <div class="card show">
                        <h3>ПОЛЬЗУЙСЯ</h3>
                        <p class="h4">Покажи штрих код на кассе</p>
                        <img src="/images/show.png" alt="">
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </section>
        <div class="clear"></div>




        <section class="for_users">
            <div class="container">
                <div class="row text-center">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 content_block">
                        <h2>БЕСПЛАТНОЕ ОПТИМИЗИРОВАННОЕ ПРИЛОЖЕНИЕ</h2>
                        <br />
                        <span class="line_decor">Используйте мобильный телефон вместо пластиковых карт</span>
                        <span class="line_decor">Будьте в курсе всех акций ваших любимых магазинов</span>
                        <div class="clear"></div>
                        <a target="_blank" href="https://play.google.com/store/apps/details?id=ru.admin14.dtycard" class="btn gstore"></a>
                        <a href="#" class="btn istore"></a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 phone_stack">
                        <img src="/images/andapp.png" class="img-responsive andapp_img" alt="Картмоне">
                        <img src="/images/iosapp.png" class="img-responsive iosapp_img" alt="Картмоне">
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </section>




        <!-- Contact -->
            <section class="contact">
                <div class="container">
                    <header class="row col-xs-12 text-center">
                        <h2>ПЕРЕНЕСИТЕ ВАШУ ДИСКОНТНУЮ КАРТУ НА СМАРТФОНАХ ВАШИХ КЛИЕНТОВ</h2>
                        <p>По вопросам сотрудничества Заполните бланк ниже, и наш менеджер свяжется с вами</p>
                    </header>
                    <!--<form id="contact" method="post" action="#" role="form" class="contact row col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Имя" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <textarea name="message" class="form-control" placeholder="Сообщение"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-default" value="Отправить" />
                        </div>
                    </form>-->
                    <div class="contact row col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10 col-xs-12">
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <?= $form->field($model, 'name')->textInput(['placeholder' => $model->getAttributeLabel('name')])->label(false) ?>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <?= $form->field($model, 'phone')->textInput(['placeholder' => $model->getAttributeLabel('phone')])->label(false) ?>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <?= $form->field($model, 'subject')->textInput(['placeholder' => $model->getAttributeLabel('subject')])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?= $form->field($model, 'body')->textArea(['rows' => 6, 'placeholder' => $model->getAttributeLabel('body')])->label(false) ?>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"></div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </section>


        <!-- Footer -->
            <section class="footer text-center">
                <div class="container">
                    <ul>
                        <li class="pull-left text-left">
                            <a target="_blank" href="/privacy">Разрешение на обработку персональных данных</a><br/>
                        </li>
                        <li class="pull-right text-right">
                            <a target="_blank" href="/terms">Пользовательское соглашение</a><br/>
                        </li>
                        <div class="clear"></div>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </section>
            <section class="footer footer-copyright text-center">
                <div class="bg">
                </div>
                <div class="container">
                    <ul>
                        <li class="pull-left text-left">
                            По всем другим вопросам обращаться: <a href="mailto:info@dty.su" target="_top">info@dty.su</a><br/>
                        </li>
                        <li class="pull-right text-right">
                            Card DTY Картмоне, <a target="_blank" href="http://dty.su">&copy; Цифровые технологии Якутии, <?= date(Y) ?></a>
                        </li>
                        <div class="clear"></div>
                    </ul>
                    <div class="clear"></div>
                </div>
            </section>
            <div class="clear"></div>

