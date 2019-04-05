<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-11-22
 * Time: 上午12:24
 */

namespace SE\SEMonitor;


use \GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use SE\SECore\SECore;

class SEMonitor extends ASEMonitor {

    public function refresh() {
        // 需要单例SECore
        $client = SECore::get()->getLink();
        try {

            $responseHealth = $client->request('GET', '/_cluster/health');
            $responseNode = $client->request('GET','/_nodes');

            // 查询集群健康
            if ($responseHealth->getStatusCode() == 200) {

                $data = json_decode($responseHealth->getBody()->getContents(), true);
                $this->clusterName = $data['cluster_name'];
                $this->status = $data['status'];
            } else {

                $this->clusterName = null;
                $this->status = null;
            }
            // 查询节点信息
            if ($responseNode->getStatusCode() == 200) {

                $data = json_decode($responseNode->getBody()->getContents(), true);
                $this->nodeNum = $data['_nodes']['total'];
                // 将节点的所有属性存入其中
                $this->nodeList = $data['nodes'];
            } else {

                $this->nodeNum = null;
                $this->nodeList = null;
            }
            // 刷新成功后保存刷新时间
            $this->recentTime = time();
        } catch (GuzzleException $e) {

            $this->status = null;
            $this->clusterName = null;
            $this->nodeNum = null;
            $this->nodeList = null;
            // 输出错误信息到日志
            Log::alert(
                "Refresh elasticsearch information failed.\n".
                $e->getMessage()
            );
        }

        return $this;
    }
}