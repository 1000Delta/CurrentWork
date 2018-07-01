# 一步步实现cms

## 构想

1. 通过面向过程编程实现基本功能
2. 将功能模块进行良好划分
3. 用面向对象编程方式重构代码

## 功能划分

分层模型（流程图）

```flow
st=>start: Start
uid=>condition: uid
passwd=>condition: passwd
mp=>operation: 主页面
em=>operation: 文章管理
logout=>condition: 退出?
end=>end: End

st->uid
uid(no)->uid
uid(yes)->passwd
passwd(no)->uid
passwd(yes)->mp
mp->em->logout
logout(yes)->end
logout(no)->mp
```

