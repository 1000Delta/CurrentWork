<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2019/2/2
 * Time: 16:20
 */

namespace SE\SEQuery\SEData;


class SEDataLink implements ISEData {

    public static function getMap($key) {

        return [
            'keyword' => $key,
            'title' => $key,
            'url' => $key,
            'intro' => $key,
            'content' => $key,
            'tags' => $key,
            'note' => $key
        ];
    }
}