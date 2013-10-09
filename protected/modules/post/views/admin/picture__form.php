<?php
/* @var $this ImagesController */
/* @var $model Images */
/* @var $form CActiveForm */
?>

<div class="form">



 
   <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'picture-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>



    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'catalog_id'); ?>
         <?php 
        echo $form->dropDownList($model, 'catalog_id',$this->catalogList("picture"));
        ?>

        <?php echo $form->error($model, 'catalog_id'); ?>
    </div>



    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'thumb'); ?>
        <?php
        $this->widget('ext.KEditor.ThumbKEditor', array(
            'model' => $model, //传入form model
            'name' => 'thumb', //设置name
            'properties' => array(
                'extraFileUploadParams' => array(Yii::app()->request->csrfTokenName=>Yii::app()->request->getCsrfToken()),
                'uploadJson' => Yii::app()->createUrl('attachment/upload/kupload'),
            ),
            'textfieldOptions' => array(
                'size' => '30',
            )
        ));
        ?>

        <?php echo $form->error($model, 'thumb'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'keyword'); ?>
        <?php echo $form->textField($model, 'keyword', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'keyword'); ?>
    </div>



    <?php //echo $form->hiddenField($model, 'images', array('size' => 30, 'maxlength' => 30));   ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textField($model, 'description', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>


    <div class="row">
      <?php echo $form->labelEx($model, 'picture'); ?>
      <?php
        $this->widget('ext.KEditor.PictureKEditor', array(
            'model' => $model, //传入form model
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
        ?>
 
        <?php echo $form->error($model, 'picture'); ?>
    </div> 

     
    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php  Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/minike.js');?>
        <?php echo $form->textarea($model, 'content', array('id' => 'contentqq', 'style' => 'width:100%;height:300px;visibility:hidden;')); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>
 
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->