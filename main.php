<?php
require 'config.php';
require 'EvtFix.class.php';
require 'DataUtil.class.php';
/* 
修复EVT的GPS文件时间出错. 要加上 1024周 = 1024*7 = 7168 天
段洪杰  2019.4.10
 */
set_time_limit(10*60); //10分钟后程序自动退出,防止卡死
date_default_timezone_set('Asia/Shanghai');

////  修复EVT文件时间错误
$evtFix=new EvtFix();
$evtFix->setPath($EVT_DATAPATH);
$evtFix->setRunPath($RUN_PATH);
$evtFix->execute();

////
// 修复其它文件时间错误
//
?>
