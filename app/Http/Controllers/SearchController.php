<?php

namespace App\Http\Controllers;

use SE\SEQuery\SEQuery;

/**
 * Class SearchController
 * 搜索控制器，负责处理搜索行为
 * @package App\Http\Controllers
 */
class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    /**
     * @param string $key 搜索关键字
     * @param int $page 搜索页码，从0开始
     * @return array 返回查询数据
     */
    public function search($key, $page = 0) {
    
        // 解码关键字
        $key = urldecode($key);
        // 防止错误页码
        $query = new SEQuery('link', 'webPage');
        if ($page < 0) {

            $page = 0;
        }
        return [
            'code' => 0,
            'msg' => '查询成功',
            'key' => $key,
            'data' => $query->pageSearch($page*env('ES_PAGE_SIZE'), env('ES_PAGE_SIZE'), $key)
        ];
    }
}
