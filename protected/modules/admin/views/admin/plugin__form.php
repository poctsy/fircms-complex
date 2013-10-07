<?php
/* @var $this PluginController */
/* @var $model Plugin */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'plugin-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>



	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    <?php echo $form->labelEx($model, 'type'); ?>
    <?php echo $form->dropDownList($model, 'type',
        array(Catalog::CATALOG_LIST_MOULD=>"列表模块",Catalog::CATALOG_COVER_MOULD=>'封面模块',Catalog::CATALOG_SINGLEPAGE_MOULD=>'单页模块',Catalog::CATALOG_MULTIPLE_MOULD=>'多页模块')
    ); ?>
    <?php echo $form->error($model, 'type'); ?>
        <div class="row">
		<?php echo $form->labelEx($model,'en_name'); ?>
		<?php echo $form->textField($model,'en_name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'en_name'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'listprefix'); ?>
		<?php echo $form->textField($model,'listprefix',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'listprefix'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'prefix'); ?>
		<?php echo $form->textField($model,'prefix',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'prefix'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'path'); ?>
		<?php echo $form->textField($model,'path',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'path'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->