<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Asia/Yakutsk',
            'locale' => 'ru-RU',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    //'language' => 'ru-RU',
    'sourceLanguage'=>'en_US',
    'charset'=>'utf-8',
];
