<?php
class FPicture extends CWidget
{

   public $model;

    public function run()
    {
        $this->widget('ext.KEditor.PictureKEditor', array(
            'model' => $this->model, //传入form model
            'name' => 'picture', //设置name
            'properties' => array(
                'extraFileUploadParams' => array(Yii::app()->request->csrfTokenName=>Yii::app()->request->getCsrfToken()),
                'uploadJson' => Yii::app()->createUrl('attachment/upload/kupload'),
                'allowFileManager'=>true,
                'fileManagerJson' => Yii::app()->createUrl('attachment/upload/kmanageJson'),
            ),
            'textfieldOptions' => array(
                'size' => '30',
            )
        ));


    }



}