<?php
/* @var $this ManageController */
/* @var $model Upload */

$this->breadcrumbs=array(
	'Uploads'=>array('admin'),
	'Update',
);

$this->menu=array(
         array('label'=>Yii::t('core', 'Manage Upload'), 'url'=>array('admin')),
);
?>



<?php $this->renderPartial('manage__form', array('model'=>$model)); ?>