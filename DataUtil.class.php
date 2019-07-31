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
     * 传入日期，确定此日期的文件是否需要修正,不需要修正反回0 ,需要修正反回修正后的时间stamp
     * @param type $timestamp
     */
    public function isFix($timestamp){
        $isFix=0;
  
      // echo date("Y-m-d",$timestamp)." ".$timestamp."\r\n";
       $updatestamp=$timestamp+1024*7*24*60*60;  // GPS时间少了1024周。
       $start=  strtotime("1998-11-29"); //最早出现GPS出错的日期1998-11-30 ,减掉一天以便包含当天
       $end=  time(); //上海时区
       
       if($timestamp>$start&&$updatestamp<$end){
            // echo "---------> ".date("Y-m-d",$updatestamp)." ".$updatestamp."\r\n";
             $isFix= $updatestamp;
       }
       return  $isFix;
    }
}
