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
    private $index;
    
    /**
     * @var string $title 文章标题
     */
    private $title;
    
    /**
     * @var string $main 文章正文
     */
    private $main;
    
    /**
     * @return int
     */
    public function getIndex(): int {
        
        return $this->index;
    }
    
    /**
     * @param int $index
     */
    public function setIndex(int $index): void {
        
        $this->index = $index;
    }
    
    /**
     * @return string
     */
    public function getTitle(): string {
        
        return $this->title;
    }
    
    /**
     * @param string $title
     */
    public function setTitle(string $title): void {
        
        $this->title = $title;
    }
    
    /**
     * @return string
     */
    public function getMain(): string {
        
        return $this->main;
    }
    
    /**
     * @param string $main
     */
    public function setMain(string $main): void {
        
        $this->main = $main;
    }
}