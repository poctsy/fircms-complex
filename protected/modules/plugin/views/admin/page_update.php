<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

<h1>Update Page <?php echo $model->id; ?></h1>

<?php $this->renderPartial('page__form', array('model'=>$model)); ?>