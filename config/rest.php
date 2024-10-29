<?php

return [

    /*
    |--------------------------------------------------------------------------
    | REST API Endpoint
    |--------------------------------------------------------------------------
    |
    | The first URL segment after core prefix. Should be unique to your
    | package/plugin.
    |
    */

    'endpoint' => 'thelostasura/api',

    /*
    |--------------------------------------------------------------------------
    | REST API version
    |--------------------------------------------------------------------------
    |
    | Represents the first version of the API.
    |
    */

    'version' => 'v1',

    /*
    |--------------------------------------------------------------------------
    | REST API routes
    |--------------------------------------------------------------------------
    |
    | API routes definitions.
    |
    */

    'routes' => [
        'licenses'      => [
            'type'      => 'group',
            'prefix'    => 'licenses',
            'as'        => 'licenses',
            'namespace' => 'Licenses',
            'routes'    => [
                'index'   => [
                    'type'   => 'route',
                    'as'     => 'index',
                    'uri'    => '/',
                    'method' => [ 'GET', 'HEAD' ],
                    'action' => 'LicenseController@index',
                ],
                'store'   => [
                    'type'   => 'route',
                    'as'     => 'store',
                    'uri'    => '/',
                    'method' => [ 'POST' ],
                    'action' => 'LicenseController@store',
                ],
                'domains' => [
                    'type'   => 'group',
                    'as'     => 'domains',
                    'routes' => [
                        'register'   => [
                            'type'   => 'route',
                            'as'     => 'register',
                            'uri'    => 'domains/register',
                            'method' => [ 'POST' ],
                            'action' => 'DomainController@register',
                        ],
                        'deregister' => [
                            'type'   => 'route',
                            'as'     => 'deregister',
                            'uri'    => 'domains/deregister',
                            'method' => [ 'POST' ],
                            'action' => 'DomainController@deregister',
                        ],
                        'update'     => [
                            'type'   => 'route',
                            'as'     => 'update',
                            'uri'    => 'domains/{license}',
                            'method' => [ 'PUT' ],
                            'action' => 'DomainController@update',
                        ],
                    ],
                ],
                'terms'   => [
                    'type'   => 'group',
                    'prefix' => 'terms',
                    'as'     => 'terms',
                    'routes' => [
                        'index' => [
                            'type'   => 'route',
                            'as'     => 'index',
                            'uri'    => '/',
                            'method' => [ 'GET', 'HEAD' ],
                            'action' => 'TermController@index',
                        ],
                    ],
                ],
                'show'    => [
                    'type'   => 'route',
                    'as'     => 'show',
                    'uri'    => '{license}',
                    'method' => [ 'GET' ],
                    'action' => 'LicenseController@show',
                ],
                'update'  => [
                    'type'   => 'route',
                    'as'     => 'update',
                    'uri'    => '{license}',
                    'method' => [ 'PUT' ],
                    'action' => 'LicenseController@update',
                ],
                'destroy' => [
                    'type'   => 'route',
                    'as'     => 'destroy',
                    'uri'    => '{license}',
                    'method' => [ 'DELETE' ],
                    'action' => 'LicenseController@destroy',
                ],
                'status'  => [
                    'type'   => 'route',
                    'as'     => 'status',
                    'uri'    => '{license}/status',
                    'method' => [ 'PATCH' ],
                    'action' => 'LicenseController@status',
                ],
            ],
        ],
        'generators'    => [
            'type'      => 'group',
            'prefix'    => 'generators',
            'as'        => 'generators',
            'namespace' => 'Generators',
            'routes'    => [
                'terms'    => [
                    'type'   => 'group',
                    'prefix' => '{key}/terms',
                    'as'     => 'terms',
                    'routes' => [
                        'index' => [
                            'type'   => 'route',
                            'as'     => 'index',
                            'uri'    => '/',
                            'method' => [ 'GET', 'HEAD' ],
                            'action' => 'TermController@index',
                        ],
                    ],
                ],
            ],
        ],
        'users'         => [
            'type'      => 'group',
            'prefix'    => 'users',
            'as'        => 'users',
            'namespace' => 'Users',
            'routes'    => [
                'index' => [
                    'type'   => 'route',
                    'as'     => 'index',
                    'uri'    => '/',
                    'method' => [ 'GET', 'HEAD' ],
                    'action' => 'UserController@index',
                ],
                'store' => [
                    'type'   => 'route',
                    'as'     => 'store',
                    'uri'    => '/',
                    'method' => [ 'POST' ],
                    'action' => 'UserController@store',
                ],
                'find'  => [
                    'type'   => 'route',
                    'as'     => 'find',
                    'uri'    => 'find',
                    'method' => [ 'GET', 'HEAD' ],
                    'action' => 'UserController@find',
                ],
                'show'  => [
                    'type'   => 'route',
                    'as'     => 'show',
                    'uri'    => '{user}',
                    'method' => [ 'GET', 'HEAD' ],
                    'action' => 'UserController@show',
                ],
            ],
        ],
        'oxygenbuilder' => [
            'type'      => 'group',
            'prefix'    => 'oxygenbuilder',
            'as'        => 'oxygenbuilder',
            'namespace' => 'OxygenBuilder',
            'routes'    => [
                'items'            => [
                    'type'   => 'route',
                    'as'     => 'items',
                    'uri'    => 'items',
                    'method' => [ 'GET', 'HEAD' ],
                    'action' => 'OxygenBuilderController@items',
                ],
                'componentclasses' => [
                    'type'   => 'route',
                    'as'     => 'componentclasses',
                    'uri'    => 'componentclasses',
                    'method' => [ 'GET', 'HEAD' ],
                    'action' => 'OxygenBuilderController@componentClasses',
                ],
                'pageclasses'      => [
                    'type'   => 'route',
                    'as'     => 'pageclasses',
                    'uri'    => 'pageclasses',
                    'method' => [ 'GET', 'HEAD' ],
                    'action' => 'OxygenBuilderController@pageClasses',
                ],
            ],
        ],
    ],

];
