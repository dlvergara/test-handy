<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            App\Action\PingAction::class => App\Action\PingAction::class,
        ],
        'factories' => [
            App\Action\HomePageAction::class => App\Action\HomePageFactory::class,
            App\Action\ClienteAction::class => App\Action\ClienteFactory::class,
            App\Action\RegClienteAction::class => App\Action\RegClienteFactory::class,
            App\Action\RegVisitaAction::class => App\Action\RegVisitaFactory::class,
            App\Action\GetEstadosAction::class => App\Action\GetEstadosFactory::class,
            App\Action\GetCiudadesAction::class => App\Action\GetCiudadesFactory::class,
            App\Action\SaveClienteAction::class => App\Action\SaveClienteFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => App\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.create.cliente',
            'path' => '/api/cliente',
            'middleware' => App\Action\ClienteAction::class,
            'allowed_methods' => ['POST'],
        ],
        [
            'name' => 'registrar-cliente',
            'path' => '/registrar-cliente',
            'middleware' => App\Action\RegClienteAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.get.estados',
            'path' => '/api/get-estados',
            'middleware' => App\Action\GetEstadosAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.get.ciudades',
            'path' => '/api/get-ciudades',
            'middleware' => App\Action\GetCiudadesAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'registrar-visita',
            'path' => '/registrar-visita',
            'middleware' => App\Action\RegVisitaAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
