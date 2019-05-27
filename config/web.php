<?php

use yii\rest\UrlRule;
use yii\web\JsonParser;
use yii\web\JsonResponseFormatter;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'defaultRoute' => 'site/index',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'api' => [
            'class' => 'app\modules\api\Api',
//            'layout' => 'api',
            'defaultRoute' => 'login/index',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'xRrM1Zsont3BOoJnkmb3fQL1gph2AXyW',
            'parsers' => [
                'application/json' => JsonParser::class
            ],
        ],

        'response' => [
            'formatters' => [
                'json' => [
                    'class' => JsonResponseFormatter::class,
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
                ]
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => false,
            'enableSession' => false
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'auth' => 'api/login/login',
                'register' => 'api/login/register',
                'logout' => 'api/login/logout',
                '/api' => 'api/login/index',

                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/garage', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/vehicle', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/transmission', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/motor', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/car-model', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/car-brand', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/car-equip', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/car-gen', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/car-type', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/vip-card', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/bonus', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/service-type', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/work-type', 'pluralize' => false],

                '<_c:[\w-]+>' => '<_c>/index',
                '<_c:[\w-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w-]+>/<id:\d+>/<_a:[\w-]+>' => '<_c>/<_a>',

            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*', '::1'],
    ];
}

return $config;
