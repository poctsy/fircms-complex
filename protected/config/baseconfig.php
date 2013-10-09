<?php
//应用基础配置
return array(
    'basePath' => Fircms::$basePath,
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'application.extensions.debugtoolbar.*',
        'application.widget.*'
    ),
    'timeZone' => 'Asia/Shanghai',
    'preload' => array('log'),
    'modules' => array(
        'rights' => array(
            'debug' => true,
            //'install'=>true,
            'enableBizRuleData' => true,
            'appLayout' => '//layouts/main',
        ),
 
    ),
    
    'components' => array(
        'phpThumb'=>array(
		'class'=>'ext.EPhpThumb.EPhpThumb',
		'options'=>array()
	),

        'user' => array(
            'class' => 'RWebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'themeManager' => array(
            'themeClass' => 'FTheme',
        ),
        'authManager' => array(
            'class' => 'RDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'fircms_authitem',
            'itemChildTable' => 'fircms_authitemchild',
            'assignmentTable' => 'fircms_authassignment',
            'rightsTable' => 'fircms_rights',
            'defaultRoles' => array('Guest'),
        ),
        'config' => array(
            'class' => 'application.extensions.EConfig',
            'autoCreateConfigTable' => false,
            'configTableName' => '{{config}}',
            'strictMode' => false,
        ),
        'db' => require(Fircms::$baseConfigPath . DIRECTORY_SEPARATOR . 'database.php'),
        'errorHandler' => array(
        ),
    
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'XWebDebugRouter',
                    'config' => 'alignLeft, opaque, runInDebug, fixedPos, collapsed',
                    'levels' => 'error, warning, trace, profile, info',
                    'allowedIPs' => array('127.0.0.1'),
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error',
                ),
                // uncomment the following to show log messages on web pages
            /*
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'error',

                ),
             */
            ),
        ),
     
        
    ),
    'params' => Fircms::getParams(),
);