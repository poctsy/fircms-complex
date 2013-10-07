<?php
/**
* @version   UploadController.php  11:34 2013年09月12日
* @author    poctsy <pocmail@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
* @link      http://www.fircms.com
*/
class UploadController extends FController
{

    
	public $layout='//layouts/column2';

        public function filters()
        {
            return array(
                    'rights',
                );
        }
          
       
        public function actions()
{
	return array(
		//在actions下的return array添加下面两句，没有actions的话自己添加
		'kupload'=>array('class'=>'application.extensions.KEditor.KEditorUpload'),
		'kmanageJson'=>array('class'=>'application.extensions.KEditor.KEditorManage'),
	);
}  



    protected function beforeAction($action) {
        ob_clean(); // clear output buffer to avoid rendering anything else
        foreach (Yii::app()->log->routes as $route) {
            
        if($route instanceof XWebDebugRouter) {
            $route->enabled = false; // disable any weblogroutes 
        }
      }
        header('Content-type: application/json'); // set content type header as json
        return parent::beforeAction($action);
    }

}
