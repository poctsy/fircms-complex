<?php
/**
 * @version   NavigationController.php  16:58 2013年09月13日
 * @author    poctsy <poctsy@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 */
class NavigationController extends FController {

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


        $this->render('navigation_admin', array(
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Navigation the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Navigation::model()->findByPk($id);
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
        $rootNodeModel =Navigation::findRoot();
        if ($rootNodeModel == NUll) {
            $rootNodeModel = new Node;
            $rootNodeModel->type = Node::NODE_NAVIGATION;
            $rootNodeModel->saveNode();
            $rootModel = new Navigation();
            $rootModel->node_id = $rootNodeModel->id;
            $rootModel->name = "顶级分类";
            $rootModel->save();
        }elseif($this->loadModel($rootNodeModel->id)== NUll){
            $rootModel = new Navigation();
            $rootModel->node_id = $rootNodeModel->id;
            $rootModel->name = "顶级分类";
            $rootModel->save();
        }
        $parentModel=$rootNodeModel;
        $model = new Navigation;
        $nodeModel = new Node;
        $model->scenario='parent';

        if (isset($_POST['Navigation'])) {

            $model->attributes = $_POST['Navigation'];

            if($model->validate($model->attributes)){
                if ($nodeModel->appendTo($parentModel)) {
                    //获取插入的树id,插入到导航表
                    $model->node_id = $nodeModel->id;
                    $model->root =0;
                    if($model->save()){
                        $this->redirect(array('admin'));

                    }
                }

            }




        }


        $this->render('navigation_create', array(
            'model' => $model
        ));
    }

//顶级nav不允许继承其他子节点，链接允许继承，所以做成2个控制器，来添加父导航，跟子链接
    public function actionChildCreate() {

        $model = new Navigation;

        $model->scenario='child';

        if (isset($_POST['Navigation'])) {
            $model->attributes = $_POST['Navigation'];
            if($model->parent == NULL){
                $this->redirect(array('create'));}

            elseif($model->catalog_id != NULL){
                $nodeModel = new Node;
                $parentModel = $this->loadNodeModel($model->parent);

                if ($nodeModel->appendTo($parentModel)) {
                    $model->node_id = $nodeModel->id;

                    if($model->save())
                        $this->redirect(array('admin'));
                }

            }


        }


        $this->render('navigation_childcreate', array(
            'model' => $model
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        //获取原node
        $nodeModel = $this->loadNodeModel($id);
        //获取原navigation表单
        $model = $this->loadModel($id);
        $beforeNodeModel = $nodeModel;
        $beforeParent = NULL;
        $beforeParent = $nodeModel->getParent()->id;
        //这里的parent是赋予表单显示的
        $model->parent = $beforeParent;


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Navigation']) ) {
            $model->attributes = $_POST['Navigation'];



            //  不等于自身id                 不等于当前父节点
            if ($model->parent != $nodeModel->id && $model->parent != $beforeParent) {

                //不允许是自身的子节点
                if (!$this->loadNodeModel($model->parent)->isDescendantOf($beforeNodeModel)) {

                    @$nodeModel->moveAsLast($this->loadNodeModel($model->parent));
                }
            }
            if($model->save()&&$nodeModel->saveNode())
                $this->redirect(array('admin'));
        }


        if($model->root == 0){
            $this->render('navigation_update', array(
                'model' => $model
            ));
        }else{
            $this->render('navigation_childupdate', array(
                'model' => $model
            ));
        }

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
                $this->redirect(array('admin'));
            }else{

                if($model = Navigation::model()->findByPk($id))
                    $model->delete();
                if($nodeModel = $this->loadNodeModel($id))
                    $nodeModel->deleteNode();
            }

        }
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'navigation-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}