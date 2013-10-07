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

    <?php
    Yii::app()->clientScript->registerScript('catalog_form', "

check($('#Catalog_type').find('input[checked=checked]').attr('value'));
$('.typeredio').click(function(){check(val=$(this).attr('value'))})
function check(val){
   $('#catalog-form').find('input').attr('disabled',false)
   $('#catalog-form').find('select').attr('disabled',false)

$('#Catalog_plugin_id_list').hide();
$('#Catalog_plugin_id_cover').hide();
$('#Catalog_plugin_id_singlepage').hide();
$('#Catalog_plugin_id_multiple').hide();
$('#Catalog_plugin_id_link').hide()
if(val==" .  Catalog::CATALOG_LIST_MOULD . "){
          $('#Catalog_plugin_id_list').show();

   }
if(val==" .  Catalog::CATALOG_COVER_MOULD . "){
         $('#Catalog_plugin_id_cover').show();
         $('#Catalog_list_view').attr('disabled',true)

   }
if(val==" . Catalog::CATALOG_SINGLEPAGE_MOULD . "){
          $('#Catalog_plugin_id_singlepage').show();
          $('#Catalog_list_view').attr('disabled',true)


    }
if(val==" . Catalog::CATALOG_MULTIPLE_MOULD . "){
          $('#Catalog_plugin_id_multiple').show();
          $('#Catalog_list_view').attr('disabled',true)


    }
if(val==" . Catalog::CATALOG_LINK . "){

  $('#Catalog_title').attr('disabled',true)
    $('#Catalog_keyword').attr('disabled',true)
      $('#Catalog_description').attr('disabled',true)
        $('#Catalog_list_view').attr('disabled',true)
          $('#Catalog_content_view').attr('disabled',true)
            $('#Catalog_plugin_id_link').show()
            $('#Catalog_plugin_id_link').attr('disabled',true)

   }

}






");
    ?>






    <div class="row">
        <?php echo $form->labelEx($model, 'type'); ?>
        <?php echo $form->radioButtonList($model, 'type', array(Catalog::CATALOG_LIST_MOULD => '列表',Catalog::CATALOG_COVER_MOULD => '封面', Catalog::CATALOG_SINGLEPAGE_MOULD => '单页' ,Catalog::CATALOG_MULTIPLE_MOULD => '多页', Catalog::CATALOG_LINK => '链接'), array('class' => 'typeredio', 'separator' => "")); ?>
        <?php echo $form->error($model, 'type'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'parent'); ?>
        <?php


        echo $form->dropDownList($model, 'parent',
            Catalog::selectTreeData(Catalog::findAllTree()), array('class' => 'span4', 'encode' => false, 'style' => 'width:130px;')
        ); ?>
        <?php echo $form->error($model, 'parent'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'plugin_id'); ?>
        <?php echo $form->dropDownList($model, 'plugin_id_list', CHtml::listData(Plugin::model()->findAll("type=?",array(Catalog::CATALOG_LIST_MOULD)), 'id', 'name'), array('style' => 'width:130px;')); ?>
        <?php echo $form->error($model, 'plugin_id_list'); ?>


        <?php echo $form->dropDownList($model, 'plugin_id_cover', CHtml::listData(Plugin::model()->findAll("type=?",array(Catalog::CATALOG_COVER_MOULD)), 'id', 'name'), array('style' => 'width:130px;')); ?>
        <?php echo $form->error($model, 'plugin_id_cover'); ?>


        <?php echo $form->dropDownList($model, 'plugin_id_singlepage', CHtml::listData(Plugin::model()->findAll("type=?",array(Catalog::CATALOG_SINGLEPAGE_MOULD)), 'id', 'name'), array('style' => 'width:130px;')); ?>
        <?php echo $form->error($model, 'plugin_id_singlepage'); ?>


        <?php echo $form->dropDownList($model, 'plugin_id_multiple', CHtml::listData(Plugin::model()->findAll("type=?",array(Catalog::CATALOG_MULTIPLE_MOULD)), 'id', 'name'), array('style' => 'width:130px;')); ?>
        <?php echo $form->error($model, 'plugin_id_multiple'); ?>

        <?php echo
        CHtml::dropDownList('Catalog_plugin_id_link',0,array(), array('style' => 'width:130px;')); ?>

    </div>

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
        <?php echo $form->dropDownList($model, 'list_view', Fircms::getView("node"), array('style' => 'width:200px')); ?>
        <?php echo $form->error($model, 'list_view'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'content_view'); ?>
        <?php echo $form->dropDownList($model, 'content_view', Fircms::getView("plugin"), array('style' => 'width:200px')); ?>
        <?php echo $form->error($model, 'content_view'); ?>
    </div>





    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php  Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/minike.js');?>
        <?php echo $form->textarea($model, 'content', array('id' => 'contentqq', 'style' => 'width:100%;height:200px;visibility:hidden;')); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->