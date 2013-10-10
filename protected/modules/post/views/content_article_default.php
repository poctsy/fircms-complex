<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
);
?>

<h1>View Post #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'catalog_id',
		'title',
		'keyword',
		'thumb',
		'description',
		'user_id',
		'view_count',
		'create_time',
		'content',
		'images',
		'picture',
		'file',
	),
)); ?>
