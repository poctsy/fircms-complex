<?php
/**
* @version   SystemController.php
* @author    poctsy <poctsy@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
* @link      http://www.fircms.com
*/

class SystemController extends FController
{
    
       public $layout='//layouts/column2';
	/**
	 * Declares class-based actions.
	 */
 
       	public function filters()
	{
		return array(
		'rights',
		);
	}


    public function actionSystem()
    {

        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('system');
    }


}