<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EvtFix
 *
 * @author Administrator
 */
class EvtFix {

//put your code here
    private $path;
    private $runPath;

    public function execute() {
        $this->cleanLastLog("Starting ..........................");

        $fixDates = $this->listPath($this->path); //列出需要修改的 EVT 的时间
        for ($i = 0; $i < count($fixDates, 0); $i++) {
            //echo $i."       ".date("Y-m-d",$fixDates[$i][0])."        ".date("Y-m-d",$fixDates[$i][1])."\r\n";
            $this->lastLog($i . "       " . date("Y-m-d", $fixDates[$i][0]) . "        " . date("Y-m-d", $fixDates[$i][1]) . "\r\n");
            $this->fixIt($fixDates[$i][0], $fixDates[$i][1]);
        }
    }

// EVT上第一层目录
    private function listPath($path) {
        $fixDates = array();
        $filePaths = scandir($path);
        $dataUtil = new DataUtil();
        $j = 0;
        for ($i = 2; $i < count($filePaths); $i++) {
            $path = $filePaths[$i];
            $timestamp = strtotime($path);  //目录日期
            $isFix = $dataUtil->isFix($timestamp);
            //分析是否需要修正日期
            if ($isFix != 0) {
                $fixDates[$j][0] = $timestamp;   //需要修正的日期
                $fixDates[$j][1] = $isFix;       //修正后的日期
                $j++;
            }
        }
        return $fixDates;
    }

// 
    /**
     *  修复目录和文件名与EVT文件时间
     * @param type $time  修复前的时间
     * @param type $uptime 修复后的时间
     */
    private function fixIt($time, $uptime) {
        $log = date("Y-m-d", $time) . "   --->    " . date("Y-m-d", $uptime);
        $this->lastLog($log);
        $this->fixDir($time, $uptime);
        $this->fixFileName($time, $uptime);
    }

    //修复目录
    private function fixDir($time, $uptime) {
        $oldPath = $this->path . DIRECTORY_SEPARATOR . date("Ymd", $time);
        $newPath = $this->path . DIRECTORY_SEPARATOR . date("Ymd", $uptime);
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755, true);
            $log = "Success mkdir Path:  $newPath (<---  $oldPath )";
            $this->evtLog($log);
            $this->lastLog($log);
        }
    }

    //修复文件名
    private function fixFileName($time, $uptime) {
        $oldPath = $this->path . DIRECTORY_SEPARATOR . date("Ymd", $time);
        $newPath = $this->path . DIRECTORY_SEPARATOR . date("Ymd", $uptime);

        $listFiles = scandir($oldPath);
        for ($i = 2; $i < count($listFiles); $i++) {
            $oldFile = $listFiles[$i];
            $newFile = str_replace(date("Ymd", $time), date("Ymd", $uptime), $oldFile);
            if ($oldFile != $newFile) {
                $evtFile = $oldPath . DIRECTORY_SEPARATOR . $oldFile;
                $newEvtFile = $newPath . DIRECTORY_SEPARATOR . $newFile;
                $this->fixFileEvt($evtFile);
                $is = rename($evtFile, $newEvtFile);
                if ($is) {
                    $success = "   Seccuss rename  : $evtFile --> $newEvtFile  ";
                    $this->evtLog($success);
                    $this->lastLog($success);
                } else {
                    $error = "   Error rename  : $evtFile --> $newEvtFile  ";
                    $this->evtLog($error);
                    $this->lastLog($error);
                }
            }
        }
    }

    //修复Evt文件内容
    private function fixFileEvt($evtFile) {
        $path = $this->runPath;
        $log = system("java -jar " . $path . DIRECTORY_SEPARATOR . "EvtTsFix.jar $evtFile");
        $this->evtLog("   fix Evt  file  :  $log ");
        $this->lastLog("   fix Evt  file  :  $log ");
    }

    //写日志文件
    private function evtLog($text) {
        $path = $this->runPath;
        $myfile = fopen($path . DIRECTORY_SEPARATOR . "evtLog.txt", "a+");
        $txt = date('Y-m-d H:i:s') . "   " . $text . "\r\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }

    private function lastLog($text) {
        $path = $this->runPath;
        $myfile = fopen($path . DIRECTORY_SEPARATOR . "lastLog.txt", "a+");
        $txt = date('Y-m-d H:i:s') . "   " . $text . "\r\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }

    private function cleanLastLog($text) {
        $path = $this->runPath;
        $myfile = fopen($path . DIRECTORY_SEPARATOR . "lastLog.txt", "w");
        $txt = date('Y-m-d H:i:s') . "   " . $text . "\r\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }

//
    public function setPath($path) {
        $this->path = $path;
    }

    public function setRunPath($runPath) {
        $this->runPath = $runPath;
    }

}
