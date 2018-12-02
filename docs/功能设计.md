# 搜索引擎模块设计

> 基于 Elasticsearch 的搜索引擎管理和使用

[UML类图](./ModuleStructure.puml)

## SECore

> 搜索引擎核心模块  
> 用来和搜索引擎进行连接  
> 单例模式，所有模块仅使用同一个对象

## SEMonitor

> 监测模块
> 使用核心模块  
> 监测集群状态 节点数量

## SEQuery

> 查询模块
> 构建查询语句  
> 提供多种查询模式