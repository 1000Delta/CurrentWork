<?php

namespace App\Http\Controllers;

use SE\SEQuery\SEData\SEDataLink;
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
    
        // 创建搜索映射
        /**
         * @var array 网站搜索映射
         */
        $sMap = SEDataLink::getMap($key);
        $query = new SEQuery('my_index', 'my_type');
        if ($page < 1) {
            
            return $query->search(env('ES_PAGE_SIZE'), $sMap);
        } else {
            
            return $query->pageSearch($page*env('ES_PAGE_SIZE')-1, env('ES_PAGE_SIZE'), $sMap);
        }
    }
}
