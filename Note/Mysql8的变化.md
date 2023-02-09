# 使用Mysql 8时需要注意的变化 
阅读《PHP and MySQL Web Development》时发现书中的SQL语句在Mysql 8中已经无法使用，遂根据[MySQL 8.0 Release Notes](https://dev.mysql.com/doc/relnotes/mysql/8.0/en/)整理得出在使用Mysql 8时需要注意的变化
# Changes in MySQL 8.0 全文翻译
在升级到MySQL 8.0之前，请查看本节中描述的变化，以确保它们适用于你当前版本的MySQL和应用，并执行任何建议的操作。  
被标注为**不兼容**的变化对于更早版本的MySQL是不兼容的，这可能是你在*升级前*需要注意的。我们本意是想避免这类改变，但有时为了纠正一些比版本之间不兼容更糟糕的问题，它们是必要的。如果你升级后产生了不兼容问题，请遵循描述中给出的提示。  
+ 数据字典的变化
+ caching_sha2_password成为首选的身份验证插件  
+ 配置的变化
+ 服务的变化
+ InnoDB的变化
+ SQL语句的变化
+ 服务器默认值的变更
## 数据字典的变更（Data Dictionary Changes）  
MySQL Server 8.0 包含
## 参考 
+ [MySQL 8.0 Release Notes](https://dev.mysql.com/doc/relnotes/mysql/8.0/en/)