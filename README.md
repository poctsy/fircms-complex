fircms 
======

FIRCMS基于yiiframework框架开发，采用apache2.0开源协议。。。


### 部署说明： ###

#### 需要建立文件夹 ，与导入数据表 ####

#####建立文件夹
- 打开http://域名/install.php  点击初始化文件夹
 

#####导入数据表

>数据表文件位置：protected/data/fircms.xxxx.sql

>数据库配置文件位置：protected/config/database.php

- 数据库名dbname  
- 数据库帐号username 
- 数据库密码password

<pre>
暂时取消sqlite版本。
</pre>

 
### 使用说明： ###
程序里已提供2个帐号

*参数配置文件params.php 可更改创始人*

1. 创始人
 
>>帐号/密码:fircms/fircms


1. 超级管理员

>>帐号/密码:admin/admin





### 架构说明： ###

*程序以功能模块为核心思路*
<pre>
attachment/                              ------文件上传位置
protected/
      /config/                           ------配置目录
             /application                ------应用配置目录
             /baseconfig.php             ------基础配置文件
             /custom.php                 ------自定义配置
             /database.php               ------数据库配置
             /params.php                 ------自定义参数
     /extensions                         ------外部扩展库
     /messages                           ------I18N
     /models                             ------共用模型
     /modules/                           ------功能模块目录
             admin/                      ------后台控制器
             config/Manifest.php         ------模块配置文件
             controllers/                ------后台控制器
             models/                     ------模块模型
             views/                      ------前台视图目录
                 /index_index.php        ------前台视图文件
                 admin/                  ------后台视图目录
                     /manage_index.php   ------后台视图文件
themes/
    admin/                               ------默认的后台主题
    default/                             ------默认的前台主题

</pre>




### 开发规范: ###


1. 函数与对象方法.对象属性   使用小驼峰式
1. 视图                      使用全小写带下划线写法
1. 视图目录(区分于框架官方的层次目录，采用单目录存放)
1. 数据字段                  使用全小写带下划线
1. 控制器名/模型名/模块名    采用大驼峰式
