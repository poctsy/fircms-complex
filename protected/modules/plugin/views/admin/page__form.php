<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>



	<?php echo $form->errorSummary($model); ?>



    <div class="row">
        <?php echo $form->labelEx($model, 'catalog_thumb'); ?>
        <?php
        $this->widget('ext.KEditor.ThumbKEditor', array(
            'model' => $model, //传入form model
            'name' => 'catalog_thumb', //设置name
            'properties' => array(
                'extraFileUploadParams' => array(Yii::app()->request->csrfTokenName=>Yii::app()->request->getCsrfToken()),
                'uploadJson' => Yii::app()->createUrl('attachment/upload/kupload'),
            ),
            'textfieldOptions' => array(
                'size' => '30',
            )
        ));
        ?>

        <?php echo $form->error($model, 'catalog_thumb'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'catalog_title'); ?>
        <?php echo $form->textField($model, 'catalog_title', array('size' => 30, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'catalog_title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'catalog_keyword'); ?>
        <?php echo $form->textField($model, 'catalog_keyword', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'catalog_keyword'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'catalog_description'); ?>
        <?php echo $form->textField($model, 'catalog_description', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'catalog_description'); ?>
    </div>






    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php
        $this->widget('ext.KEditor.KEditor', array(
            'model' => $model, //传入form model
            'name' => 'content', //设置name
            'properties' => array(
                //设置接收文件上传的action
                'uploadJson' => Yii::app()->createUrl('attachment/upload/kupload'),
                'newlineTag' => 'br',
                'themeType' => 'simple',
                //传值前加js:来标记这些是js代码
                'afterCreate' => "js:function() {

						K('#ChapterForm_all_len').val(this.count());
						K('#ChapterForm_word_len').val(this.count('text'));

					}",
                'afterChange' => "js:function() {



    K('#ChapterForm_all_len').val(this.count());
    K('#ChapterForm_word_len').val(this.count('text'));
}",
            ),
            'textareaOptions' => array(
                'style' => 'width:98%;height:200px;',
            )
        ));
        ?>

        <?php echo $form->error($model, 'content'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->