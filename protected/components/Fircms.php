<?php

/**
 * @version   Fircms.php
 * @author   poctsy  <pocmail@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 */
class Fircms {

    static public $baseConfigPath;
    static public $basePath;
    static public $app;
    static public $adminapp = 'fsadmin';
    static public $params = array();

    static public function getView($modules,$select='all') {
        $DirViewNew = array();
        $DirView2New = array();
        $DirView3New = array();
        $DirView = array_diff(scandir(self::$basePath . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $modules . DIRECTORY_SEPARATOR . "views"), array('..', '.', 'admin'));
       
        foreach ($DirView as $value) {
            $value = substr($value, 0, -4); 
             $DirViewNew[$value]=$value;  
        }
   
        $dirPath2 = self::$basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $modules;
        if (file_exists($dirPath2)) {
            $DirView2 = array_diff(scandir($dirPath2), array('..', '.', 'admin'));
            foreach ($DirView2 as $value) {
              $value = substr($value, 0, -4); 
             $DirView2New[$value]="default/".$value;   
        }
        }

        $apptheme = (self::getParams('fircmsTheme'));
        if (!empty($apptheme)) {
            $dirPath3 = self::$basePath . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . $apptheme . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $modules;
            if (file_exists($dirPath3)) {
                $DirView3 = array_diff(scandir($dirPath3), array('..', '.', 'admin'));
              foreach ($DirView3 as $value) {
                  $value = substr($value, 0, -4); 
             $DirView3New[$value]=$apptheme."/".$value;   
        }
            }
        }
        $newarray=array_merge($DirViewNew, $DirView2New, $DirView3New);
        if($select!='all'){
           $n=new FArrayfiter($newarray,$select);
           $newarray=$n->array_filter();
        }
        return $newarray;
    }
    

    static public function setParams() {
        $params = array();
        $params = require(Fircms::$baseConfigPath . DIRECTORY_SEPARATOR . 'params.php');
        self::$params = $params;
    }

    static public function getParams($a = "all") {
        $params = self::$params;
        if ($a != "all") {
            if (!empty($params[$a])) {
                $params = $params[$a];
            }
        }

        return $params;
    }

    static public function getConfig($basePath, $param) {
        $DirPath = array_diff(scandir($basePath . DIRECTORY_SEPARATOR . $param), array('..', '.'));

        $config = new CMap();
        foreach ($DirPath as $Path) {
            $Path = $basePath . DIRECTORY_SEPARATOR . $param . DIRECTORY_SEPARATOR . $Path . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'Manifest.php';
            if (file_exists($Path)) {
                $modulesconfig = require($Path);
                if (is_array($modulesconfig))
                    $config->mergeWith($modulesconfig);
            };
        }
        return $config->toArray();
    }

    static public function getAllModules($basePath) {
        // return array_merge(self::getConfig($basePath, 'modules'), self::getConfig($basePath, 'extensions'));
        return array_merge(self::getConfig($basePath, 'modules'));
    }

    static public function Preapp($basePath, $config, $app) {
        $baseConfigPath = $basePath . DIRECTORY_SEPARATOR . 'config';
        self::$basePath = $basePath;
        self::$baseConfigPath = $baseConfigPath;
        self::$app = $app;
        self::setParams();
        //Yii::app()->setBasePath($basePath);
        //Yii::app()->setParams(array('application' => basename(__FILE__, '.php')));

        $custom = array();
        $baseConfig = array();
        $AllModules = array();

        $apptheme = (self::getParams($app . 'Theme'));
        if (!empty($apptheme) && file_exists($basePath . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . $apptheme)) {
            $config['theme'] = $apptheme;
        }
        $baseConfig = require($baseConfigPath . DIRECTORY_SEPARATOR . 'baseconfig.php');
        $custom = require($baseConfigPath . DIRECTORY_SEPARATOR . 'custom.php');
        $AllModules = Fircms::getAllModules($basePath);
        $config = new CMap($config);
        $config->mergeWith($baseConfig);

        $config->mergeWith($AllModules[$app]);
        $config->mergeWith($custom[$app]);
        return $config->toArray();
    }
    

}


class FArrayfiter{
    public function __construct($newarray,$select) {
        $this->newarray=$newarray;
        $this->select=$select;
    }
    private function arrayFilter($var){
        return(strstr($var,$this->select) != FALSE);
    }
    function array_filter(){
        return array_filter($this->newarray,array($this,'arrayFilter'));
    }
  
}










 

 