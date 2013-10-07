<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage Message', 'url'=>array('admin')),
);
?>

<h1>Update Message <?php echo $model->id; ?></h1>

<?php $this->renderPartial('message__form', array('model'=>$model)); ?>