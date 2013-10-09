<?php
/* @var $this ImagesController */
/* @var $model Images */

$this->breadcrumbs=array(
	'Plugin Images'=>array('admin'),
	'Update',
);

$this->menu=array(
    	array('label'=>Yii::t('core', 'Create Images'), 'url'=>array('create')),
        array('label'=>Yii::t('core', 'Manage Images'), 'url'=>array('admin')),
);
?>

 


<?php $this->renderPartial('images__form', array('model'=>$model)); ?>