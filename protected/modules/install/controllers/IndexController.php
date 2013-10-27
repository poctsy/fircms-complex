<?php
/**
* @version   IndexController.php  12:06 2013年10月27日* @author   poctsy  <poctsy@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
* @link      http://www.fircms.com
*/
class IndexController extends FController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';
 


     public function actionIndex(){
	$this->render('index_index');
     }




}