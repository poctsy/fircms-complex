<?php
/**
* @version   PluginController.php  23:42 2013年09月17日
* @author    poctsy <poctsy@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
* @link      http://www.fircms.com
*/
class PluginController extends FController
{

	public $layout='//layouts/column2';

        public function filters()
        {
            return array(
                    'rights',
                );
        }
          
       
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Plugin;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Plugin']))
		{

			$model->attributes=$_POST['Plugin'];
			if($model->save())
				$this->redirect(array('admin'));
                 }
		$this->render('plugin_create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Plugin']))
		{
			$model->attributes=$_POST['Plugin'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('plugin_update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}



	/**
	 * Plugins all models.
	 */
	public function actionAdmin()
	{
		$model=new Plugin('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Plugin']))
			$model->attributes=$_GET['Plugin'];

		$this->render('plugin_admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Plugin the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{

		$model=Plugin::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Plugin $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='plugin-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


    public function actionView()
    {

        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('plugin_view');
    }

}
