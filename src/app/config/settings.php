<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'determineRouteBeforeAppMiddleware' => false,
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // // View settings
        // 'view' => [
        //     'template_path' => __DIR__ . '/templates',
        //     'twig' => [
        //         'cache' => __DIR__ . '/../cache/twig',
        //         'debug' => true,
        //         'auto_reload' => true,
        //     ],
        // ],
        // View settings
        'view' => [
            'type'=>"twig", #php 或者 twig
            'template_path' => __DIR__ . '/../views',
            //如果配置了twig需要配置下面选项
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
