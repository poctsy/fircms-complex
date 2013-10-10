<?php
/* @var $this CatalogController */
/* @var $model Catalog */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php

    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'catalog-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));

    ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'parent'); ?>
        <?php


        echo $form->dropDownList($model, 'parent',Catalog::selectTree(),
            array('class' => 'span4', 'encode' => false, 'style' => 'width:200px;')
        ); ?>
        <?php echo $form->error($model, 'parent'); ?>
    </div>
    <div class="row">

        <?php echo $form->labelEx($model, 'plugin_id'); ?>
        <?php echo $form->dropDownList($model, 'plugin_id', Plugin::everyPluginData(), array('style' => 'width:200px;')); ?>
        <?php echo $form->error($model, 'plugin_id'); ?>





    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'url'); ?>
        <?php echo $form->textField($model, 'url', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'url'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'thumb'); ?>
        <?php $this->widget('FThumb',array('model'=>$model))?>
        <?php echo $form->error($model, 'thumb'); ?>
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


        <?php echo $form->labelEx($model, 'first_view'); ?>
        <?php echo $form->dropDownList($model, 'first_view', Plugin::first_view(), array('style' => 'width:200px')); ?>
        <?php echo $form->error($model, 'first_view'); ?>


    </div>

    <div class="row">




        <?php echo $form->labelEx($model, 'second_view'); ?>
        <?php echo $form->dropDownList($model, 'second_view',Plugin::second_view(), array('style' => 'width:200px')); ?>
        <?php echo $form->error($model, 'second_view'); ?>


    </div>




    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php  $this->widget('FMiNiKe', array('model'=>$model));?>
        <?php echo $form->error($model, 'content'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->