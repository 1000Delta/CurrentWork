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

$router->get('/', function () use ($router) {
    
    return $router->app->version();
});

/**
 * 搜索API，提供分页搜索功能
 * @api /search
 * path /api/search/
 */
$router->get('/search/{key}[/{page}]', 'SearchController@search');

/**
 * 更新API，对接爬虫进行数据更新
 * @api /update
 */
$router->post('/update', 'UpdateController@update');

