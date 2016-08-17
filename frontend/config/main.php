<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,//true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'suffix' => '.html',
            'enableStrictParsing' => true,
            'rules' => [
                '' => 'site/index',
                'signup'=>'site/signup',
                'contact'=>'site/contact',
                'about'=>'site/about',
                'login'=>'site/login',
                'privacy'=>'site/privacy',
                'terms'=>'site/terms',

                ['class' => 'yii\rest\UrlRule', 'controller' => 'card'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'sign'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'auth'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'out'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'usercard'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'article'],
            ],
        ], 
         'assetManager' => [
             'basePath' => '@webroot/assets',
             'baseUrl' => '@web/assets'
        ],  
        'request' => [
            'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'application/json; charset=UTF-8' => 'yii\web\JsonParser',
            ],
            'enableCsrfValidation' => false,
        ],
    ],
    'params' => $params,
];
