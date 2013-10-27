<?php
//应用默认配置。一般不变动 ，请到custom,php 调整自定义参数
$basePath = dirname(dirname(dirname(__FILE__)));
require ($basePath . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'Fircms.php');
$main = array(
    'import' => array(
        'application.widget.fircms.*'
    ),
    'defaultController' => 'install/index',
    'components' => array(
        'errorHandler' => array(
           'errorAction' => 'install/index/error',
        ),
    ),
);

return Fircms::Preapp($basePath,$main,'install');