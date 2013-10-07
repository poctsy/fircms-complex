<?php
/* @var $this ArticleCatalogController */
/* @var $model ArticleCatalog */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'articlecatalog-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>
   
 
 


    <?php echo $form->errorSummary($model); ?>
 

    <?php echo $form->hiddenField($model, 'type', array('value' =>Catalog::CATALOG_LIST_MOULD)); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'parent'); ?>
        <?php 
        echo $form->dropDownList($model, 'parent', 
 Catalog::selectTreeData(Catalog::findAllTree()), array('class' => 'span4', 'encode' => false, 'style' => 'width:130px;')
                ); ?>
        <?php echo $form->error($model, 'parent'); ?>
    </div>
    <?php echo $form->hiddenField($model, 'plugin_id', array('value' =>Plugin::model()->find(array("condition"=>"en_name='article'"))->id)); ?>
 
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'name'); ?>
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
        <?php echo $form->labelEx($model, 'url'); ?>
        <?php echo $form->textField($model, 'url', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'url'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 30, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'keyword'); ?>
        <?php echo $form->textField($model, 'keyword', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'keyword'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textField($model, 'description', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
 

 
    <div class="row">
        <?php echo $form->labelEx($model, 'list_view'); ?>

        <?php echo $form->dropDownList($model, 'list_view', Fircms::getView("node",Yii::app()->params['articlequick']->listprefix), array('style' => 'width:200px')); ?>
        <?php echo $form->error($model, 'list_view'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'content_view'); ?>
        
        <?php echo $form->dropDownList($model, 'content_view', Fircms::getView("plugin",Yii::app()->params['articlequick']->prefix), array('style' => 'width:200px')); ?>
        <?php echo $form->error($model, 'content_view'); ?>
    </div>
 
    
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>

    
    <?php $this->endWidget(); ?>

</div><!-- form -->