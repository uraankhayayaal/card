<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-oauth',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'oauth\controllers',
    'components' => [
        'request' => [
            'baseUrl' => '/oauth',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'application/json; charset=UTF-8' => 'yii\web\JsonParser',
            ],
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            //'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-oauth',
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
            'errorAction' => 'oauth/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'oauth/authorize',
                'access' => 'oauth/access',
                'logout' => 'oauth/logout',
            ],
        ],
    ],
    'params' => $params,
];
