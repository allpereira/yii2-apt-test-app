<?php

$config = [
    'components' => [
        'request' => [
            'cookieValidationKey' => 'yii2apttesteappCKSx9GlHHNaHGTQWDlBy5i1sHhjDg',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info' /*,'trace', 'profile' */ ],
                    'logFile' => '@runtime/logs/app.log',
                ],
            ],
        ],
    ],
    
];

if (!YII_ENV_TEST) {

    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [ 'class' => 'yii\debug\Module' ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [ 
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],  
        // 'on beforeAction' => function ($event) {
        //     $password = 'WeHaveAPassword'; 
        //     $enteredPassword = Yii::$app->request->post('gii-password');

        //     if (Yii::$app->user->isGuest && $enteredPassword !== $password) {
        //         Yii::$app->user->loginRequired();
        //     }
        // },
    ];
}

return $config;
