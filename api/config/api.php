<?php

$db     = require(__DIR__ . '/../../config/db.php');
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Supergood',
    // Need to get one level up:
    'basePath' => dirname(__DIR__).'/..',
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // Enable JSON Input:s            
            // 'baseUrl' => 'api',
        	'enableCsrfValidation'=>false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
       'response' => [
            'class' => 'yii\web\Response',
            'format' => 'json',            
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                     // Create API log in the standard log dir
                     // But in file 'api.log':
                    'logFile' => '@app/runtime/logs/api.log',
                ],
            ],
        ],
        
        'urlManager' => [
          'enablePrettyUrl' => true,
          'enableStrictParsing' => true,
          'showScriptName' => false,
          'rules' => [
                [
                    'prefix' => 'api',
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => ['v1/books'],                    
                    'tokens' => [
                        '{id}' => '<id:\\w+>',
                        '{list}' => 'list'
                    ],
                    'pluralize' => false,                    
                ],      
            ],
        ], 
        'db' => $db,
    ],
    'modules' => [
        'v1' => [
            'class' => 'app\api\modules\v1\Module',
        ],
    ],
    'params' => $params,
];

return $config;