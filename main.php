<?php
require 'config.php';
require 'EvtFix.class.php';
require 'DataUtil.class.php';
/* 
�޸�EVT��GPS�ļ�ʱ�����. Ҫ���� 1024�� = 1024*7 = 7168 ��
�κ��  2019.4.10
 */
set_time_limit(10*60); //10���Ӻ�����Զ��˳�,��ֹ����
date_default_timezone_set('Asia/Shanghai');

////  �޸�EVT�ļ�ʱ�����
$evtFix=new EvtFix();
$evtFix->setPath($EVT_DATAPATH);
$evtFix->setRunPath($RUN_PATH);
$evtFix->execute();

////
// �޸������ļ�ʱ�����
//
?>
