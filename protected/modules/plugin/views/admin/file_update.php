<?php
/* @var $this FileController */
/* @var $model File */

$this->breadcrumbs=array(
	'Plugin Files'=>array('admin'),
	'Update',
);

$this->menu=array(
        array('label'=>Yii::t('core', 'Create File'), 'url'=>array('create')),
        array('label'=>Yii::t('core', 'Manage File'), 'url'=>array('admin')),
);
?>
 

<?php $this->renderPartial('file__form', array('model'=>$model)); ?>