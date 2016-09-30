<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Asia/Yakutsk',
            'locale' => 'ru-RU',
        ],
    ],
    //'language' => 'ru-RU',
    'sourceLanguage'=>'en_US',
    'charset'=>'utf-8',
];
