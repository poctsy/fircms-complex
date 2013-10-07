<?php
/* @var $this ConfigController */
/* @var $model Config */

$this->breadcrumbs=array(
	'Configs'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Config', 'url'=>array('admin')),
);
?>

<h1>Create Config</h1>

<?php $this->renderPartial('config__form', array('model'=>$model)); ?>