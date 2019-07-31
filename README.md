全自动修改EVT的GPS时间出错。


安装调试完成后全自动运行，再也不需要人工处理。

在LINUX上运行，需要安装 j2sdk 和PHP
---------------------------------------

收到的EVT文件日期减小了1024个星期，时间不变。

调用 EvtTsFix.jar 进行修改，如果多次改，日期不会累加，依然正确。正确的EVT修改后仍然正确。



本程序功能：调用 EvtTsFix.jar 成批修改 EVT文件，修改EVT文件名，修改保存EVT的目录名



---------



在 config.php 中修改EVT文件保存的目录。

使用定时执行 每分钟执行一次。




--- 上一次没有执行完成，用文件锁，让下一次不启动

使用linux flock 文件锁实现任务锁定，解决冲突

格式：


flock [-sxon][-w #] file [-c] command

选项

-s, --shared:    获得一个共享锁
-x, --exclusive: 获得一个独占锁
-u, --unlock:    移除一个锁，通常是不需要的，脚本执行完会自动丢弃锁
-n, --nonblock:  如果没有立即获得锁，直接失败而不是等待
-w, --timeout:   如果没有立即获得锁，等待指定时间
-o, --close:     在运行命令前关闭文件的描述符号。用于如果命令产生子进程时会不受锁的管控
-c, --command:   在shell中运行一个单独的命令
-h, --help       显示帮助
-V, --version:   显示版本

文件锁使用独占锁，如果锁定则失败不等待。参数为-xn

crontab -e : 修改 crontab 文件. 如果文件不存在会自动创建。 
crontab -l : 显示 crontab 文件。 
crontab -r : 删除 crontab 文件。




crontab -e

* * * * * flock -xn /tmp/gpsTsFix.lock -c 'php /home/webapps/gpsTsFix/main.php > /dev/null'
