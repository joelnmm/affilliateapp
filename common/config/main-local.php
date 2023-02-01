<?php


return [
    'components' => [
        // localhost side
        // 'db' => [
        //     'class' => \yii\db\Connection::class,
        //     'dsn' => 'mysql:host=127.0.0.1;dbname=affilliateappdb',
        //     'username' => 'root',
        //     'password' => 'Galaxycuatro12345',
        //     'charset' => 'utf8',
        // ],

        // Server side
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=127.0.0.1;dbname=affilliateappdb',
            'username' => 'root',
            'password' => 'affiliatepass123',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
            // You have to set
            //
            // 'useFileTransport' => false,
            //
            // and configure a transport for the mailer to send real emails.
            //
            // SMTP server example:
            //    'transport' => [
            //        'scheme' => 'smtps',
            //        'host' => '',
            //        'username' => '',
            //        'password' => '',
            //        'port' => 465,
            //        'dsn' => 'native://default',
            //    ],
            //
            // DSN example:
            //    'transport' => [
            //        'dsn' => 'smtp://user:pass@smtp.example.com:25',
            //    ],
            //
            // See: https://symfony.com/doc/current/mailer.html#using-built-in-transports
            // Or if you use a 3rd party service, see:
            // https://symfony.com/doc/current/mailer.html#using-a-3rd-party-transport
        ],
        'urlManager' => [
            // Disable r = routes
            'enablePrettyUrl' => true,
            // Disable index.php
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                // '' => 'site/productos',
                //'admin' => 'backend/web/site/login',
                // '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
                //'<controller:\w+>/<action:\w+>' => '<controller>/<action>',

                // '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
];
