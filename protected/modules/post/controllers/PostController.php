<?php
/**
 * @author   poctsy  <poctsy@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 * @version   PostController.php  17:08 2013年10月09日
 */
class PostController extends FController
{

    public $layout='//layouts/column2';

    public function filters()
    {
        return array(
            'rights',
        );
    }




    public function actionIndex($catalog)
    {

        $catalogModel=Catalog::nameGet($catalog);
        if(!is_object($catalogModel))
           throw new CHttpException(404,'The requested page does not exist.');
        $criteria=new CDbCriteria();
        $criteria->order='create_time DESC';

        if($catalogModel){
            $criteria->condition='catalog_id=:id';
            $criteria->params=array(':id'=>$catalogModel->id);
        }
        $dataProvider=new CActiveDataProvider('Post',array('criteria'=>$criteria));

        $this->render($catalogModel->first_view,array(
            'dataProvider'=>$dataProvider,
        ));
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render(Post::second_view($id),array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Post the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Post::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }


}
