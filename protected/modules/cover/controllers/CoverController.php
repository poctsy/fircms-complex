<?php
/**
* @author   poctsy  <poctsy@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
* @link      http://www.fircms.com
* @version   CoverController.php  15:34 2013年10月10日
*/
class CoverController extends FController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';
 
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights',
        );
    }
/*
    public function actions()
    {
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
    }
  */

    public function actionIndex($cover)
    {

        $catalogModel=Catalog::nameGet($cover);
        if(!is_object($catalogModel))
            throw new CHttpException(404,'The requested page does not exist.');

        $this->render($catalogModel->first_view);
    }



}