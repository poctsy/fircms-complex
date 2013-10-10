<?php
//数据库配置
return array (

    /*
                'connectionString' => 'mysql:host=localhost;dbname=fircms',
                'emulatePrepare' => true,
                'enableProfiling' => true,
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'tablePrefix' => 'fircms_',

    */
                         'connectionString' => 'sqlite:protected/data/sqlite/fircms0.3.3.2.db',
                           'emulatePrepare' => true,
                            'enableProfiling' => true,
                            'tablePrefix' => 'fircms_',
                                'charset' => 'utf8',


);