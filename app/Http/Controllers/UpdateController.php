<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SE\SEQuery\SEData\SEDataLink;
use SE\SEQuery\SEQuery;

class UpdateController extends Controller
{

    public function update(Request $request) {
    
        if ($request->has('data')) {
            
            return [
                'code' => 1,
                'msg' => '字段缺失'
            ];
        }
        
        // 创建数据写入器
        $query = new SEQuery('link', 'webPage');
        $data = $request->get('data');
        
        // 数据类型匹配
        if (!SEDataLink::isMatch($data)) {
        
            return [
                'code' => 1,
                'msg' => '数据项有误'
            ];
        }
        $query->add($data);
        
        return [
            "code" => 0
        ];
    }
    
    public function test(Request $request) {
    
        return $request;
    }
}
