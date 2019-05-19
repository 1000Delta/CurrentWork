<?php

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

/**
 * @var Laravel\Lumen\Routing\Router $router
 */

$router->get('/', function () use ($router) {
    
    return $router->app->version();
});

$router->get('/search/{key}[/{page}]', 'SearchController@search');

$router->post('/update', 'UpdateController@update');

$router->group(['middleware' => 'CorsMiddleware'], function () use ($router) {
    
    $router->get('/test', 'UpdateController@test');
});

$router->get('/doc', 'SwaggerController@doc');
