# Docker部署方案

## ES 集群 && Kibana

### 编写Dockfile

```dockerfile
FROM elasticsearch:6.4.2

RUN echo y | ./bin/elasticsearch-plugin install https://github.com/medcl/elasticsearch-analysis-ik/releases/download/v6.4.2/elasticsearch-analysis-ik-6.4.2.zip
```

### 创建镜像

进入镜像上下文

```
docker build -t elasticsearch:6.4.2-ik .
```

### 生成容器

```shell
docker run \
-itd \
-p 9200:9200 \
-v "D:\\tmp\ES\node1\elasticsearch.yml":/usr/share/elasticsearch/config/elasticsearch.yml \
-v "D:\\tmp\ES\node1\data":/usr/share/elasticsearch/data \
--network XTUSearch \
--name search-es-node-1 \
elasticsearch:6.4.2-ik

docker run \
-itd \
-v "D:\\tmp\ES\node2\elasticsearch.yml":/usr/share/elasticsearch/config/elasticsearch.yml \
-v "D:\\tmp\ES\node2\data":/usr/share/elasticsearch/data \
--network XTUSearch \
--name search-es-node-2 \
elasticsearch:6.4.2-ik

docker run \
-itd \
-p 5601:5601 \
-e ELASTICSEARCH_URL=http://search-es-node-1:9200 \
--network XTUSearch \
--name kibana \
kibana:6.4.2

```

## Web服务器

```
docker run \
-itd \
-v D://DeltaX/Documents/Codes/Projects/XTUSearch:/www \
--network XTUSearch \
--name search-php php:7.2-fpm

docker run \
-itd \
-p 80:80 \
-v D://tmp/nginx/conf.d:/etc/nginx/conf.d \
-v D://DeltaX/Documents/Codes/Projects/XTUSearch:/www \
--network XTUSearch \
--name search-nginx nginx:1.15.8

```