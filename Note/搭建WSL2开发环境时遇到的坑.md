# 搭建WSL2开发环境时遇到的坑
## WSL2与其余虚拟机软件的兼容性  
+ 要同时使用WSL2与第三方虚拟机程序，必须升级到[VMware 15.5.5](https://blogs.vmware.com/workstation/2020/05/vmware-workstation-now-supports-hyper-v-mode.html)和[VirtualBox 6](https://www.virtualbox.org/wiki/Changelog-6.0) 及以上版本  
  
WSL2使用Hyper-V体系架构来实现虚拟化，这就需要我们安装Hyper-V组件。  
但在安装Hyper-V组件后Windows就将启用“[基于虚拟化的安全（VBS）](https://learn.microsoft.com/zh-cn/windows-hardware/design/device-experiences/oem-vbs)”功能，使操作系统运行于虚拟环境下。但这与不支持嵌套虚拟化的第三方虚拟机程序存在兼容性问题，使第三方程序无法工作。  
为解决这一问题，第三方虚拟机厂商使用微软提供的[WHP API](https://learn.microsoft.com/en-us/virtualization/api/)进行了重新设计，程序将运行在用户级别而不是在特权模式，并不直接操作底层硬件。  
这使得微软在文档中标注无论WSL还是WSL2都“ 可以与当前版本的 VMware 和 VirtualBox 一起运行 ”，但在实际运行中还能体验到一定的性能下降。
  
### 参考
+ [有关适用于 Linux 的 Windows 子系统的常见问题解答](https://learn.microsoft.com/zh-cn/windows/wsl/faq)
+ [VMware Workstation 15.5 Now Supports Host Hyper-V Mode](https://blogs.vmware.com/workstation/2020/05/vmware-workstation-now-supports-hyper-v-mode.html)
+ [hyper-v 和 vmware 不兼容，是技术的原因？还是商业原因？](https://www.zhihu.com/question/21260608)
  
## WSL2镜像迁移后默认账户设置
+ 迁移后默认登陆账户总是为根账户  
  
未迁移的WSL可以使用命令```ubuntu config --default-user```（以ubuntu发行版为例）修改默认账户，但迁移或导入的WSL会因找不到路径无效。   
解决方案：  
1. 子系统添加默认账户配置  
```
# /etc/wsl.conf 
# Set the user when launching a distribution with WSL.
[user]
default = DemoUser
```
2. 启动子系统时指定登陆账户  
```
wsl --distribution <Distribution Name> --user <User Name>
```
### 参考
+ [WSL设置Ubuntu默认登陆用户](https://www.jianshu.com/p/aeef20207355)
+ [示例 wsl.conf 文件](https://learn.microsoft.com/zh-cn/windows/wsl/wsl-config#example-wslconf-file)
+ [如何备份我的 WSL 发行版，或者如何将它们从一个驱动器移到另一个驱动器？](https://learn.microsoft.com/zh-cn/windows/wsl/faq#-------wsl---------------------------)
  
## WSL2设置固定IP  
+ 默认情况下，WSL2将在每一次启动时重新分配虚拟机的IP  
  
解决方案：
+ Windows 11 22H2及以上版本  
  
Windows 11 22H2及以上版本允许用户指定WSL2子系统的网卡  
1. 在```Microsoft Store```中下载最新版本的```Windows Subsystem for Linux```或[Github](https://github.com/microsoft/WSL/releases)
2. 于用户目录```%USERPROFILE%```下创建配置文件```.wslconfig```  
```
[wsl2]
networkingMode=bridged # 桥接模式
vmSwitch=my-switch # 你想使用的网卡
ipv6=true # 启用 IPv6
```
3. 重启WSL2
```
wsl --shutdown && wsl 
```
+ Windows 10  
  
咖喱味的微软至今未对运行于Windows 10的WSL2提供静态IP的官方解决方案  
  
禁止WSL2自动配置网关  
1. 新建配置文件```vim /etc/wsl.conf```
    ```
    [network]
    generateResolvConf = false
    ```  
2. 删除自动生成的网关配置文件
  
    ```
    rm /etc/resolv.conf
    ```
使用批处理脚本配置静态IP  
```
@echo off
rem 以管理员身份运行
%1 mshta vbscript:CreateObject("Shell.Application").ShellExecute("cmd.exe","/c %~s0 ::","","runas",1)(window.close)&&exit

rem 需要设置的子系统名称
set linux=CentOS7
rem 设置网段
set localnet=192.168.86
rem 设置子系统的ip
set ip=%localnet%.2

wsl -d %linux% -u root ip addr del $(ip addr show eth0 ^| grep 'inet\b' ^| awk '{print $2}' ^| head -n 1) dev eth0
wsl -d %linux% -u root ip addr add %ip%/24 broadcast %localnet%.255 dev eth0
wsl -d %linux% -u root ip route add 0.0.0.0/0 via %localnet%.1 dev eth0
wsl -d CentOS7 -u root echo "nameserver %localnet%.1" ^> /etc/resolv.conf

powershell -c "Get-NetAdapter -IncludeHidden -Name 'vEthernet (WSL)' | Get-NetIPAddress | Remove-NetIPAddress -Confirm:$False; New-NetIPAddress -IPAddress  %localnet%.1 -PrefixLength 24 -InterfaceAlias 'vEthernet (WSL)'; Get-NetNat | ? Name -Eq WSLNat | Remove-NetNat -Confirm:$False; New-NetNat -Name WSLNat -InternalIPInterfaceAddressPrefix %localnet%.0/24"
exit
```
  
在子系统中配置批处理自动运行  
```
# ~/.bashrc
if [ `hostname -I` != 192.168.1.1 ]; then
     cmd.exe /c "D:\set_static_ip.bat" 1>nul
fi
```
### 参考
+ [networkingMode=bridged.md](https://github.com/luxzg/WSL2-fixes/blob/master/networkingMode%3Dbridged.md)
+ [WSL2 网络的最终解决方案](https://zhuanlan.zhihu.com/p/593263088?)
+ [WSL2-CentOS7固定IP](https://www.cnblogs.com/yuque/p/16283730.html)
  
## WSL2崩溃导致蓝屏  
+ 命令输入错误后虚拟机卡死，操作系统崩溃蓝屏，自动重启后M2掉盘    
  
没有复现，也不敢复现，硬重启后硬盘找回。推测为WSL2崩溃导致Hyper-V崩溃，而物理操作系统也运行于Hyper-V提供的管理层之上，致使灾难性的系统崩溃。事件管理器没有记录下导致崩溃的事件，具体原因待查。    
