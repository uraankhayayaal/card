<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
<<<<<<< HEAD
            'dsn' => 'mysql:host=localhost;dbname=u0195776_card',
            'username' => 'u0195776_card',
            'password' => 'd0]A~&Din+ln',
=======
            'dsn' => 'mysql:host=localhost;dbname=card',
            'username' => 'card.dty.su',
            'password' => 'card.dty.su',
>>>>>>> 8a12694bf0c3518ad9ca8d943b83f2dc6229d01b
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
