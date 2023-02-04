# 基于WSL2的开发环境搭建    
## 一、WSL2安装与配置
1. 获取WSL2  
在Microsoft store中搜索```Windows Subsystem for Linux```获取微软分发的WSL  
或在```POWERSHELL```中使用```wsl --install```命令进行完全安装（默认安装Ubuntu发行版）  
2. 迁移WSL2      
WSL的虚拟磁盘默认存放于系统分区，可根据自身需求通过镜像的导出/装载来实现存放目录的迁移  
+ 关闭所有虚拟机  
    `wsl --shutdown`
+ 查看虚拟机工作状态  
    `wsl -l -v`
+ 导出目标虚拟机  (导出```Ubuntu```到```E:\WSL\Ubuntu.tar```)  
    `wsl --export Ubuntu E:\WSL\Ubuntu.tar`  
+ 注销原有的虚拟机  
    ```wsl --unresgister Ubuntu```  
+ 装载虚拟机到指定目录  
    ```wsl --import Ubuntu E:\WSL\ E:\WSL\Ubuntu.tar --version 2```
3. 开始使用
+ 启动默认发行版  
    ``` wsl ```
+ 使用指定版本与用户启动  
    ``` wsl --distribution <Distribution Name> --user <User Name> ```
### 二、开发环境搭建  
1. 基础web环境
+ 安装apache2  
``` sudo apt-get install apache2 ```  
+ 安装PHP  
``` sudo apt-get install php ```  
+ 安装Mysql  
``` sudo apt-get install mysql-server ```
+ 安装git  
``` sudo apt-get install git ```    
### 三、使用Vscode作为WSL2开发工具    
    在工作目录下执行``` code . ```WSL将自动安装插件并唤起Vscode  
## 开发环境配置踩坑与填坑  
1. WSL迁移
2. WSL设置默认账户
3. WSL设置默认网卡
4. MYSQL版本不同的连接问题
## 文档：
+ 适用于 Linux 的 Windows 子系统文档（WSL）：https://learn.microsoft.com/zh-cn/windows/wsl/  
+ 设置Git：https://docs.github.com/zh/get-started/quickstart/set-up-git
+ 通过 SSH 连接到 GitHub：https://docs.github.com/zh/authentication/connecting-to-github-with-ssh

## 参考：
+ ERROR 1449 (HY000): The user specified as a definer ('mysql.infoschema'@'localhost') does not exist：https://stackoverflow.com/questions/62127983/error-1449-hy000-the-user-specified-as-a-definer-mysql-infoschemalocalho
+ WSL2 网络的最终解决方案：https://zhuanlan.zhihu.com/p/593263088?  
