<?php
/* @var $this FileController */
/* @var $model File */
/* @var $form CActiveForm */
?>

<div class="narrow form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

             <div class="row searchtext">         
                <?php echo $form->textField($model,'catalog_name',array('placeholder'=>"输入搜索内容") ); ?>
                <?php echo $form->textField($model,'title',array('placeholder'=>"输入搜索内容") ); ?>
                <?php echo $form->textField($model,'file',array('placeholder'=>"输入搜索内容") ); ?>
                <?php echo $form->textField($model,'content' ,array('placeholder'=>"输入搜索内容")); ?>
  
         </div>

    <div class="row select">
        <?php echo CHtml::dropDownList('searchDrownList', '1', array('0'=>$model->getAttributeLabel('catalog_name'),'1'=>$model->getAttributeLabel('title'),'2'=>$model->getAttributeLabel('file'),'3'=>$model->getAttributeLabel('content'))); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->