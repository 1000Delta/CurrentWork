<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SE\SEQuery\SEData\SEDataLink;
use SE\SEQuery\SEQuery;

class UpdateController extends Controller
{

    public function update(Request $request) {
    
        $data = json_decode($request->getContent(), true);
        if ($data === '') {
            
            return [
                'code' => 1,
                'msg' => '字段缺失'
            ];
        }
        
        // 创建数据写入器
        $query = new SEQuery('link', 'webPage');
        
        // 数据类型匹配
        if (!SEDataLink::isMatch($data)) {
        
            return [
                'code' => 1,
                'msg' => '数据项有误',
                'data' => $data,
                'StdData' => SEDataLink::getKeyMap()
            ];
        }
        $query->add($data);
        
        return [
            'code' => 0,
            'msg' => '数据更新成功'
        ];
    }
    
    public function test(Request $request) {
    
        return $request;
    }
}
