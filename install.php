<?php
//error_reporting(NULL);
// change the following paths if necessary
$yii=dirname(__FILE__).'/protected/framework/yii.php';
//$yii=dirname(__FILE__).'/../yii-1.1.14.f0fee9/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/application/install.php';

// remove the following line when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
if (!file_exists(dirname(__FILE__).'/assets'))mkdir(dirname(__FILE__).'/assets');
if (!file_exists(dirname(__FILE__).'/protected/runtime'))mkdir(dirname(__FILE__).'/protected/runtime');
require_once($yii);
Yii::createWebApplication($config)->run();