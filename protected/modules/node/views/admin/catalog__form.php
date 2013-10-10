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



if(val==" . Plugin::LINK_MOULD . "){

  $('#Catalog_title').attr('disabled',true)
    $('#Catalog_keyword').attr('disabled',true)
      $('#Catalog_description').attr('disabled',true)
        $('#Catalog_first_view').attr('disabled',true)
          $('#Catalog_second_view').attr('disabled',true)


   }

}






");
    ?>






    <div class="row">
        <?php echo $form->labelEx($model, 'parent'); ?>
        <?php


        echo $form->dropDownList($model, 'parent',
            Catalog::makeSelectTree(Catalog::model()->findAll(array('order'=>'lft'))), array('class' => 'span4', 'encode' => false, 'style' => 'width:130px;')
        ); ?>
        <?php echo $form->error($model, 'parent'); ?>
    </div>
    <div class="row">
        <?php
        $plugin_list=Plugin::pluginData(Plugin::LIST_MOULD);
        $plugin_cover=Plugin::pluginData(Plugin::COVER_MOULD);
        $plugin_singlepage=Plugin::pluginData(Plugin::SINGLEPAGE_MOULD);
        $plugin_other=Plugin::pluginData(Plugin::OTHER_MOULD);
        $plugin_id=array_merge($plugin_list,$plugin_cover,$plugin_singlepage,$plugin_other);
        ?>
        <?php echo $form->labelEx($model, 'plugin_id'); ?>
        <?php echo $form->dropDownList($model, 'plugin_id', $plugin_id, array('style' => 'width:130px;')); ?>
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
        <?php

        $list_first_view=Plugin::sortView(Plugin::LIST_MOULD,'first');
        $cover_first_view=Plugin::sortView(Plugin::COVER_MOULD,'first');
        $singlepage_first_view=Plugin::sortView(Plugin::SINGLEPAGE_MOULD,'first');
        $first_view=array_merge($list_first_view,$cover_first_view,$singlepage_first_view);
        ?>

        <?php echo $form->labelEx($model, 'first_view'); ?>
        <?php echo $form->dropDownList($model, 'first_view', $first_view, array('style' => 'width:200px')); ?>
        <?php echo $form->error($model, 'first_view'); ?>


    </div>

    <div class="row">


        <?php
        $list_second_view=Plugin::sortView(Plugin::LIST_MOULD,'second');
        $cover_second_view=Plugin::sortView(Plugin::COVER_MOULD,'second');
        $singlepage_second_view=Plugin::sortView(Plugin::SINGLEPAGE_MOULD,'second');
        $second_view=array_merge($list_second_view,$cover_second_view,$singlepage_second_view);
        ?>

        <?php echo $form->labelEx($model, 'second_view'); ?>
        <?php echo $form->dropDownList($model, 'second_view', $second_view, array('style' => 'width:200px')); ?>
        <?php echo $form->error($model, 'second_view'); ?>


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