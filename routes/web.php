<?php

use TheLostAsura\Skynet\MultiSite;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

function registerAsuraEndpointRoutes($router, $endpoints)
{
    foreach ($endpoints as $key => $endpoint) {
        if (is_array($endpoint)) {
            if ($endpoint['type'] == 'group') {
                $router->group([
                    'type' => $endpoint['type'],
                    'prefix' => $endpoint['prefix'] ?? null,
                    'as' => $endpoint['as'] ?? null,
                    'namespace' => $endpoint['namespace'] ?? null,
                ], function () use ($router, $endpoint) {
                    registerAsuraEndpointRoutes($router, $endpoint['routes']);
                });
            } else {
                call_user_func([$router, strtolower($endpoint['method'][0])], $endpoint['uri'], [
                    'as' => $endpoint['as'],
                    'uses' => $endpoint['action']
                ]);
            }
        }
    }
}

$router->group([
    'prefix' => (function_exists('is_multisite') && MultiSite::isMultiSite() ? ltrim(MultiSite::blog()->path, '/') : '') . 'thelostasura'
], function () use ($router) {

    /** REST route */
    $router->group([
        'prefix' => 'api/'.config('rest.version'),
        'namespace' => 'Api',
        'middleware' => 'thelostasura.rest',
        'as' => 'api'
    ], function () use ($router) {
        registerAsuraEndpointRoutes($router, config('rest.routes'));
    });

    /** Admin route */
    $router->group([
        'prefix' => 'admin',
        'middleware' => 'wordpress.admin',
        'as' => 'admin'
    ], function () use ($router) {

        /** Blade route */
        $router->group([
            'namespace' => 'Admin',
        ], function () use ($router) {

            $router->group([
                'prefix' => 'apis',
                'as' => 'apis',
            ], function () use ($router) {
                $router->get('/', [ 'as' => 'index', 'uses' => ApiController::class ]);
            });

            $router->group([
                'prefix' => 'licenses',
                'as' => 'licenses',
            ], function () use ($router) {
                $router->get('/', [ 'as' => 'index', 'uses' => LicenseController::class ]);
            });
        });

        /** API route */
        $router->group([
            'prefix' => 'api',
            'as' => 'api',
            'namespace' => 'Api',
        ], function () use ($router) {

            $router->group([
                'prefix' => 'licenses',
                'namespace' => 'Licenses',
                'as' => 'licenses',
            ], function () use ($router) {
                $router->get('/', ['as' => 'index', 'uses' => 'LicenseController@index']);
                $router->post('/', ['as' => 'store', 'uses' => 'LicenseController@store']);
                $router->put('{license}', ['as' => 'update', 'uses' => 'LicenseController@update']);
                $router->patch('{license}/status', ['as' => 'status', 'uses' => 'LicenseController@status']);
                $router->delete('{license}', ['as' => 'destroy', 'uses' => 'LicenseController@destroy']);
                // $router->patch('{license}/reset', ['as' => 'reset', 'uses' => 'LicenseController@reset']);

                $router->group([
                    'prefix' => '{license}/domains',
                    'as' => 'domains',
                ], function () use ($router) {
                    $router->put('/', ['as' => 'update', 'uses' => 'DomainController@update']);
                });

            });

            $router->group([
                'prefix' => 'apis',
                'namespace' => 'Apis',
                'as' => 'apis',
            ], function () use ($router) {
                $router->get('/', ['as' => 'index', 'uses' => 'ApiController@index']);
                $router->post('/', ['as' => 'store', 'uses' => 'ApiController@store']);
                $router->put('{api}', ['as' => 'update', 'uses' => 'ApiController@update']);
                $router->patch('{api}/reset', ['as' => 'reset', 'uses' => 'ApiController@reset']);
                $router->patch('{api}/status', ['as' => 'status', 'uses' => 'ApiController@status']);
                $router->delete('{api}', ['as' => 'destroy', 'uses' => 'ApiController@destroy']);

                $router->group([
                    'prefix' => 'routes',
                    'as' => 'routes',
                ], function () use ($router) {
                    $router->get('/', ['as' => 'index', 'uses' => 'RouteController@index']);
                });

            });

            $router->group([
                'prefix' => 'generators',
                'namespace' => 'Generators',
                'as' => 'generators'
            ], function () use ($router) {

                $router->group([
                    'prefix' => 'terms',
                    'as' => 'terms'
                ], function() use ($router) {
                    $router->get('/', ['as' => 'index', 'uses' => 'TermController@index']);
                });
            });

            $router->group([
                'prefix' => 'users',
                'namespace' => 'Users',
                'as' => 'users',
            ], function () use ($router) {
                $router->get('/', ['as' => 'index', 'uses' => 'UserController@index']);
                $router->post('/', ['as' => 'store', 'uses' => 'UserController@store']);
                $router->get('find', ['as' => 'find', 'uses' => 'UserController@find']);
                $router->get('{user}', ['as' => 'show', 'uses' => 'UserController@show']);

            });
        });

    });

});
