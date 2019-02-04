<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2019/2/2
 * Time: 16:20
 */

namespace SE\SEQuery\SEData;


class SEDataEssay implements ISEData {
    
    /**
     * @var int $index 索引
     */
    public $index;
    
    /**
     * @var string $title 文章标题
     */
    public $title;
    
    /**
     * @var string $main 文章正文
     */
    public $main;
}