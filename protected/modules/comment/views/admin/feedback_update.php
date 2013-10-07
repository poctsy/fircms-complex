<?php
/* @var $this FeedbackController */
/* @var $model Feedback */

$this->breadcrumbs=array(
	'Feedbacks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage Feedback', 'url'=>array('admin')),
);
?>

<h1>Update Feedback <?php echo $model->id; ?></h1>

<?php $this->renderPartial('feedback__form', array('model'=>$model)); ?>