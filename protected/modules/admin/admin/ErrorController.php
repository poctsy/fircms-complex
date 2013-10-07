<?php
/**
* @version   IndexController.php
* @author    poctsy <pocmail@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
* @link      http://www.fircms.com
*/

class ErrorController extends FController
{
    
       public $layout='//layouts/error';
	/**
	 * Declares class-based actions.
	 */

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('error'),
                'users'=>array('*'),
            ),
        );
    }
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
    public function actionIndex()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error_index', $error);
        }
    }




}