<?php
//应用默认配置。一般不变动 ，请到custom,php 调整自定义参数
$basePath = dirname(dirname(dirname(__FILE__)));
require ($basePath . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'Fircms.php');
$main = array(
    'defaultController' => 'site/index',
    'theme' => 'default',
    'components' => array(
       /* 'request'=>array(
            'enableCsrfValidation'=>true,
        ),*/
        'user' => array(
           'loginUrl' => 'index.php?r=u/login/login',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
           'errorAction' => 'u/login/error',
        ),
    ),
);

return Fircms::Preapp($basePath,$main,'fircms');