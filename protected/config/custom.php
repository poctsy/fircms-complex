<?php
//自定义参数
return array(
    'fircms' => array(
        'name' => '前台',
        'language' => 'zh_cn',
       //  'theme' => 'default',
        'runtimePath' => Fircms::$basePath . DIRECTORY_SEPARATOR . 'runtime',
    ),
    'fsadmin' => array(
        'name' => '后台',
        'language' => 'zh_cn',
      //  'theme' => 'admin',
        'runtimePath' => Fircms::$basePath . DIRECTORY_SEPARATOR .'runtime'. DIRECTORY_SEPARATOR .'admin',
    ),
);
?>
