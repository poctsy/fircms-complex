<?php

/**
 * @author   poctsy  <pocmail@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 * @version   FileCatalogController.php  16:58 2013年09月13日
 */
class FileCatalogController extends FController {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'rights',
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return FileCatalog the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = FileCatalog::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    public function loadNodeModel($id) {
        $model = Node::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionCreate() {
        $nodeModel = Catalog::findRoot();
        if ($nodeModel == NUll) {
            $nodeModel = new Node;
            $nodeModel->type = Node::NODE_CATALOG;
            $nodeModel->saveNode();
            $model = new Catalog;
            $model->node_id = $nodeModel->id;
            $model->name = "顶级分类";
            $model->save();
        }
        $model = new FileCatalog;
        $this->setQuickPlugin('file');
     $nodeModel = new Node;
     // Uncomment the following line if AJAX validation is needed
     // $this->performAjaxValidation($model);

     if (isset($_POST['FileCatalog'])) {
         $model->attributes = $_POST['FileCatalog'];

         $parentModel = $this->loadNodeModel($model->parent);
         if ($nodeModel->appendTo($parentModel)) {
             $model->node_id = $nodeModel->id;
             //判断添加数据成功 才跳转到管理页，  创建不成功，停在本页  示错误信息
             if($model->save())
                    $this->redirect(array('/node/catalog/admin'));

            }



            $this->redirect(array('/plugin/file/admin'));
        }


        $this->render('filecatalog_create', array(
            'model' => $model
        ));
    }
     
 

}