# 配置Laravel开发环境 
## 前置环境：
+ Windows 10 22H2
+ Docker Desktop
+ WSL2
## 配置步骤及遇到的坑  
### 安装配置基于WSL2运行的Docker Desktop
1. 从[Docker官网](https://docker.com)下载Docker Desktop并安装
2. 勾选：“设置->常规->使用基于WSL2的引擎(Use the WSL2 based engine)”  
3. 在：“设置->资源->WSL集成”中启用目标WSL2发行版  
4. 启动WSL2，测试docker安装情况  
```
docker --version  
docker run hello-world
```

### 安装Laravel Docker示例容器  
1. 根据Laravel文档在WSL2终端中执行：  
```curl -s https://laravel.build/example-app | bash```  
如果提示:  
```Docker is not running```  
尝试：  
```sudo curl -s https://laravel.build/example-app | sudo bash``` 
2. 运行Laravel示例：
```
cd example-app  
./vendor/bin/sail up
```
如果报错端口占用，可能是Win端口排除的问题，运行命令将排除范围修改至不常用范围：  
```
# 修改端口排除范围至40000-60000
netsh int ipv4 set dynamicport tcp startport=40000 numberofports=20000
```
如果运行后打开Web页面报错：
```
The stream or file "/var/www/html/storage/logs/laravel.log" could not be opened in append mode: Failed to open stream: Permission denied The exception occurred while attempting to log: 
```
需要修改文件夹权限至775
```chmod -R 775 storage/```
## 参考：
+ [Laravel-Installation](https://laravel.com/docs/10.x#environment-based-configuration)
+ [WSL 2 上的 Docker 远程容器入门](https://learn.microsoft.com/zh-cn/windows/wsl/tutorials/wsl-containers)
+ [Docker - is not running](https://stackoverflow.com/questions/66530509/docker-is-not-running)
+ [wsl2, docker desktop, etc踩坑小记](https://note.bobo.moe/2020/02/wsl2-docker-desktop-etc.html)
+ [Windows 10 無法 LISTEN Port 4200 與 Port 3000 的靈異事件整理](https://blog.miniasp.com/post/2019/03/31/Ports-blocked-by-Windows-10-for-unknown-reason)
+ [Laravel-Docker Permission denied The exception occurred while attempting to log: The stream or file](https://stackoverflow.com/questions/72877284/laravel-docker-permission-denied-the-exception-occurred-while-attempting-to-log)