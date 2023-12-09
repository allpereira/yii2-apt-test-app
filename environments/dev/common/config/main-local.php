<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=yii2-apt-test-app-db',
            'username' => 'usuario',
            'password' => 'usuario',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'sandbox.smtp.mailtrap.io',
                'username' => 'be56fb8ec67069',
                'password' => 'b0a6ddf8fdbcba',
                'port' => '2525', 
                'encryption' => 'tls',
            ],
        ],

    ],
];
