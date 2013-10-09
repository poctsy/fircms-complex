<?php

/**
 * @author   poctsy  <poctsy@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 * @version   PictureController.php  0:00 2013年09月18日  
 */
class PictureController extends FController {

    public $layout = '//layouts/column2';
    

    public function filters() {
        return array(
            'rights',
        );
    }


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Picture;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Picture']) ) {
            $model->attributes = $_POST['Picture'];
            //$model->picture=Helper::makeSerialize($model->picture);

                if ($model->save())
                    $this->redirect(array('admin'));

        }
        $this->render('picture_create', array(
            'model' => $model
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Picture'])  ) {

            $model->attributes = $_POST['Picture'];

            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('picture_update', array(
            'model' => $model
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Picture('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Picture']))
            $model->attributes = $_GET['Picture'];

        $this->render('picture_admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Picture the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Picture::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }


    /**
     * Performs the AJAX validation.
     * @param Picture $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'picture-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function findFiles() {
        return array_diff(scandir(Yii::app()->params['uploadDir']), array('.', '..'));
    }

}
