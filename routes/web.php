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

use OpenApi\Annotations as OA;

/**
 * @var Laravel\Lumen\Routing\Router $router
 */

$router->get('/', function () use ($router) {
    
    return $router->app->version();
});

/**
 * API文档标题
 * @OA\OpenApi(
 *     openapi="3.0.0",
 *     @OA\Server(
 *         url="http://localhost",
 *         description="API 服务器"
 *     ),
 *     @OA\Info(
 *         version="1.0.0",
 *         title="湘大文库API",
 *         description="描述和测试湘大文库API"
 *     )
 * )
 *
 */

/**
 * API标签分类
 * @OA\Tag(
 *     name="search",
 *     description="搜索相关"
 * )
 *
 * @OA\Tag(
 *     name="update",
 *     description="更新数据相关"
 * )
 *
 * @OA\Tag(
 *     name="external",
 *     description="额外接口"
 * )
 */

/**
 * @OA\Get(
 *     path="/search/{key}",
 *     tags={"search"},
 *     summary="分页搜索",
 *     description="返回查询到的页面列表",
 *     operationId="searchWebPage",
 *     @OA\Parameter(
 *         name="key",
 *         in="path",
 *         description="要搜索的关键词/句",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             default="关键字"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="查询成功",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 ref="#"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="查询失败"
 *     )
 * )
 */
$router->get('/search/{key}[/{page}]', 'SearchController@search');


/**
 * @OA\Post(
 *     path="/update",
 *     tags={"update"},
 *     summary="更新页面",
 *     description="更新页面存储",
 *     operationId="update",
 *     @OA\Parameter(
 *         name="data",
 *         in="query",
 *         description="要更新的数据条目",
 *         required=true,
 *         @OA\Schema(
 *             type="json",

 *             default="{'text': '','keyword':{},'note': '','picurl': '','tags': {},'title': {},'url': {}}",
 *             description="数据项json字符串",
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="查询成功",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 ref="#"
 *             )
 *         )
 *     )
 * )
 */
$router->post('/update', 'UpdateController@update');

$router->group(['middleware' => 'CorsMiddleware'], function () use ($router) {
    
    $router->get('/test', 'UpdateController@test');
});

$router->get('/doc', 'SwaggerController@doc');
