<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-cabinet',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'cabinet\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'language' => 'ru-RU',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
            'rules' => [
                '' => 'site/index',
                '<action>'=>'site/<action>',
            ],
        ], 
         'assetManager' => [
             'basePath' => '@webroot/assets',
             'baseUrl' => '@web/assets'
        ],  
        'request' => [
            'baseUrl' => '/cabinet',
        ],
        'apns' => [
            'class' => 'bryglen\apnsgcm\Apns',
            'environment' => \bryglen\apnsgcm\Apns::ENVIRONMENT_SANDBOX,
            //'pemFile' => '@cabinet/productionPushCertificate.pem',
            'pemFile' => dirname(dirname(__DIR__)) . '/cabinet/developmentPushCertificate.pem',
            // 'retryTimes' => 3,
            'options' => [
                'sendRetryTimes' => 5
            ]
        ],
        'gcm' => [
            'class' => 'bryglen\apnsgcm\Gcm',
            'apiKey' => 'AIzaSyB6sIqo9tYqZK8NSALn0WqmsYMURFwCfVI',
        ],
        // using both gcm and apns, make sure you have 'gcm' and 'apns' in your component
        'apnsGcm' => [
            'class' => 'bryglen\apnsgcm\ApnsGcm',
            // custom name for the component, by default we will use 'gcm' and 'apns'
            //'gcm' => 'gcm',
            //'apns' => 'apns',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'admin@dty.su',
                'password' => 'golem130',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
    ],
    'params' => $params,
];
