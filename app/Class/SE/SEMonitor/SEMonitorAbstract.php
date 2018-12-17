<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-11-22
 * Time: 上午12:25
 */

namespace SE\SEMonitor;


abstract class SEMonitorAbstract {

    /**
     * @var int $recentTime 最近刷新时间
     */
    protected $recentTime;

    /**
     * @var string $clusterName ES集群名称
     */
    protected $clusterName;

    /**
     * @var string $status ES集群状态
     * green|yellow|red
     */
    protected $status;

    /**
     * @var int $nodeNum 集群节点数
     */
    protected $nodeNum;

    /**
     * @var array $nodeList 节点地址列表
     */
    protected $nodeList;

    /**
     * SEMonitorAbstract constructor.
     * 获取集群状态数据
     */
    function __construct() {

        $this->refresh();
    }

    /**
     * 刷新集群信息
     * @return $this
     * 流接口模式便于进行连续操作
     */
    abstract function refresh();

    /**
     * @return int 最近刷新时间
     */
    public function getRecentTime(): int {

        return $this->recentTime;
    }

    /**
     * @return string 集群名称
     */
    public function getClusterName(): string {

        return $this->clusterName;
    }


    /**
     * @return array 集群节点列表
     */
    public function getNodeList(): array {

        return $this->nodeList;
    }

    /**
     * @return int 集群节点数
     */
    public function getNodeNum(): int {

        return $this->nodeNum;
    }

    /**
     * @return string 集群状态
     */
    public function getStatus(): string {

        return $this->status;
    }
}