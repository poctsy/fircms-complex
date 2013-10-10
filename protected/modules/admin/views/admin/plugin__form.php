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
    <?php echo $form->dropDownList($model, 'type',Plugin::everyPlugin()); ?>
    <?php echo $form->error($model, 'type'); ?>
        <div class="row">
		<?php echo $form->labelEx($model,'en_name'); ?>
		<?php echo $form->textField($model,'en_name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'en_name'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'first_prefix'); ?>
		<?php echo $form->textField($model,'first_prefix',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'first_prefix'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'second_prefix'); ?>
		<?php echo $form->textField($model,'second_prefix',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'second_prefix'); ?>
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