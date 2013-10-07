<?php
/**
* @author   poctsy  <pocmail@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
* @link      http://www.fircms.com
* @version   IndexController.php
*/
class IndexController extends FController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
   // public $layout='//layouts/column1';
 
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights',
        );
    }
   
    public function allowedActions() {
        return 'index';
    }

    

    public function actionIndex()
	{

		$this->render('index');
	}




}