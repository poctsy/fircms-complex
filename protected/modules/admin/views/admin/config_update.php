<?php
/* @var $this ConfigController */
/* @var $model Config */

$this->breadcrumbs=array(
	'Configs'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Config', 'url'=>array('create')),
	array('label'=>'Manage Config', 'url'=>array('admin')),
);
?>

<h1>Update Config <?php echo $model->key; ?></h1>

<?php $this->renderPartial('config__form', array('model'=>$model)); ?>