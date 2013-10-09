<?php
/* @var $this PictureController */
/* @var $model Picture */

$this->breadcrumbs=array(
	'Plugin Pictures'=>array('admin'),
	'Update',
);

$this->menu=array(
      array('label'=>Yii::t('core', 'Create Picture'), 'url'=>array('create')),
        array('label'=>Yii::t('core', 'Manage Picture'), 'url'=>array('admin')),
);
?>

 

<?php $this->renderPartial('picture__form', array('model'=>$model )); ?>