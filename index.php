<?php
//error_reporting(NULL);
// change the following paths if necessary
$yii=dirname(__FILE__).'/protected/framework/yii.php';
//$yii=dirname(__FILE__).'/../yii-1.1.14.f0fee9/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/application/fircms.php';

// remove the following line when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();