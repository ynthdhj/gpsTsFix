<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataUtil
 *
 * @author Administrator
 */
class DataUtil {
    
    /**
     * �������ڣ�ȷ�������ڵ��ļ��Ƿ���Ҫ����,����Ҫ��������0 ,��Ҫ���������������ʱ��stamp
     * @param type $timestamp
     */
    public function isFix($timestamp){
        $isFix=0;
  
      // echo date("Y-m-d",$timestamp)." ".$timestamp."\r\n";
       $updatestamp=$timestamp+1024*7*24*60*60;  // GPSʱ������1024�ܡ�
       $start=  strtotime("1998-11-29"); //�������GPS���������1998-11-30 ,����һ���Ա��������
       $end=  time(); //�Ϻ�ʱ��
       
       if($timestamp>$start&&$updatestamp<$end){
            // echo "---------> ".date("Y-m-d",$updatestamp)." ".$updatestamp."\r\n";
             $isFix= $updatestamp;
       }
       return  $isFix;
    }
}
