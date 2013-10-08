<?php

/**
* @version   CatalogController.php  16:58 2013年09月13日
* @author    poctsy <poctsy@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
* @link      http://www.fircms.com
*/
class CatalogController extends FController {

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
    public function actionAdmin() {


        $this->render('catalog_admin', array(
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Catalog the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Catalog::model()->findByPk($id);
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
        $rootNodeModel = Catalog::findRoot();
        if ($rootNodeModel == NUll) {
            $rootNodeModel = new Node;
            $rootNodeModel->type = Node::NODE_CATALOG;
            $rootNodeModel->saveNode();
            $rootModel = new Catalog;
            $rootModel->node_id = $rootNodeModel->id;
            $rootModel->name = "顶级分类";
            $rootModel->save();
        }elseif($this->loadModel($rootNodeModel->id)== NUll){
            $rootModel = new Catalog();
            $rootModel->node_id = $rootNodeModel->id;
            $rootModel->name = "顶级分类";
            $rootModel->save();
        }

        $model = new Catalog;
        $model->scenario='update';

        $nodeModel = new Node;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Catalog'])) {
            $model->attributes = $_POST['Catalog'];

            $parentModel = $this->loadNodeModel($model->parent);
            if ($nodeModel->appendTo($parentModel)) {
                //获取插入的树id,插入到分类表
                $model->node_id = $nodeModel->id;
                //判断添加数据成功 才跳转到管理页，  创建不成功，停在本页  示错误信息
                if($model->save() && $this->addordermoduld($model->type,$model->plugin_id,$model->node_id))
                    $this->redirect(array('admin'));
            }



             
        }


        $this->render('catalog_create', array(
            'model' => $model ,
        ));
    }

    private function addordermoduld($type,$plugin_id,$catalog_id){
       if($type==Catalog::CATALOG_SINGLEPAGE_MOULD){
           $plugin=Plugin::model()->findByPk($plugin_id);
           if($plugin->en_name=='page'){
               $model = new Page;
               $model->catalog_id=$catalog_id;
               if($model->save())
                  return true;
           }
       }else{
           return true;
       }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {


        //获取原node
        $nodeModel = $this->loadNodeModel($id);
        //获取catalog表单
        $model = $this->loadModel($id);
        $model->scenario='update';
        $beforeNodeModel = $nodeModel;
        $beforeParent = NULL;
        $beforeParent = $nodeModel->getParent()->id;
        $model->parent = $beforeParent;


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Catalog']) ) {
            $model->attributes = $_POST['Catalog'];


            //  不等于自身id                 不等于当前父节点                 
            if ($model->parent != $nodeModel->id && $model->parent != $beforeParent) {

                //不允许是自身的子节点
                if (!$this->loadNodeModel($model->parent)->isDescendantOf($beforeNodeModel)) {

                    @$nodeModel->moveAsLast($this->loadNodeModel($model->parent));
                }
            }
            if($model->save() &&$nodeModel->saveNode())
             $this->redirect(array('admin'));
        }

        $this->render('catalog_update', array(
            'model' => $model
        ));
    }

    public function actionPrevUp($id) {
        $id = (int) $id;
        $model = $this->loadNodeModel($id);
        $prevSibling = $model->prevSibling;
        if (is_object($prevSibling))
            $model->moveBefore($prevSibling);
        $this->redirect(array('admin'));
    }

    public function actionNextUp($id) {
        $id = (int) $id;
        $model = $this->loadNodeModel($id);
        $nextSibling = $model->nextSibling;
        if (is_object($nextSibling))
            $model->moveAfter($nextSibling);
        $this->redirect(array('admin'));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
       if (Yii::app()->request->isPostRequest) {
            $count=Node::model()->findByPk($id)->descendants()->count();

            if($count>0){
                $this->redirect(array('/node/adminnavigation/admin'));
            }else{

                if($model = @Catalog::model()->findByPk($id))
                    $model->delete();
                if($nodeModel = @$this->loadNodeModel($id))
                   $nodeModel->deleteNode();
            }


      }
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'catalog-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}