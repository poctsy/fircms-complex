<?php
//自定义参数
return array(
    'install' => array(
        'name' => 'FirCMS安装',
        'language' => 'zh_cn',
        'runtimePath' => Fircms::$basePath . DIRECTORY_SEPARATOR .'runtime',
    ),
    'fircms' => array(
        'name' => '前台',
        'language' => 'zh_cn',
       //  'theme' => 'default',
        'runtimePath' => Fircms::$basePath . DIRECTORY_SEPARATOR .'runtime'. DIRECTORY_SEPARATOR .'fircms',
    ),
    'fsadmin' => array(
        'name' => '后台',
        'language' => 'zh_cn',
      //  'theme' => 'admin',
        'runtimePath' => Fircms::$basePath . DIRECTORY_SEPARATOR .'runtime'. DIRECTORY_SEPARATOR .'admin',
    ),
);
?>
