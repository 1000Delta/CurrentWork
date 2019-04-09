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
 * @var \Laravel\Lumen\Routing\Router $router
 */

$router->get('/', function () use ($router) {
    
    return $router->app->version();
});

/**
 * @SWG\Swagger(
 *     swagger="2.0"
 *     schemes={"https"},
 *     host="localhost",
 *     basePath="/"
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="湘大文库API",
 *         description="描述和测试湘大文库API"
 *     )
 * )
 */

/**
 *
 */
$router->get('/search/{key}[/{page}]', 'SearchController@search');

$router->post('/update', 'UpdateController@update');

$router->group(['middleware' => 'CorsMiddleware'], function () use ($router) {
    
    $router->get('/test', 'UpdateController@test');
});

/**
 * 返回代码 return code
 *
 */