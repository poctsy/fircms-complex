<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h1>Error <?php echo $code; ?></h1>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>