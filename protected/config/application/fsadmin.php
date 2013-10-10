<?php
//应用默认配置。一般不变动 ，请到custom,php 调整自定义参数
$basePath = dirname(dirname(dirname(__FILE__)));
require ($basePath . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'Fircms.php');
$main = array(
    'import' => array(
        'application.widget.fsadmin.*'
    ),
    'defaultController' => 'admin/index/index',
   'theme' => 'admin',
    'components' => array(
         'request'=>array(
            'enableCsrfValidation'=>true,
        ),
        'user' => array(
            'loginUrl' => 'admin.php?r=admin/user/login',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'admin/error/index',
        ),
    ),
);

return Fircms::Preapp($basePath, $main, 'fsadmin');