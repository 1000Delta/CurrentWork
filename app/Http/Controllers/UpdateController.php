<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SE\SEQuery\SEData\SEDataLink;
use SE\SEQuery\SEDataWriter;
use SE\SEQuery\SEQuery;

class UpdateController extends Controller
{
    /**
     * @var SEDataWriter $query 数据写入器
     */
    private $query;

    public function update(Request $request) {
    
        if ($request->has('data')) {
    
            /**
             * @var SEDataWriter $query 数据写入器
             */
            $query = new SEQuery('link', 'webPage');
            // TODO 写入数据通过SEDataLink的验证后可以使用
            $data = $request->get('data');
            if (!SEDataLink::isMatch($data)) {
                
                return [
                    'code' => 1,
                    'msg' => '数据项有误'
                ];
            }
            
            $query->add($data);
        }
    }
    
    public function test(Request $request) {
    
        return $request;
    }
}
