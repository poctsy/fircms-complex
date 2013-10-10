<?php
/* @var $this PluginController */
/* @var $model Plugin */

$this->breadcrumbs=array(
	'Plugins'=>array('admin'),
	'Create',
);

$this->menu=array(
        array('label'=>Yii::t('core', 'Create Plugin'), 'url'=>array('create')),
        array('label'=>Yii::t('core', 'Manage Plugin'), 'url'=>array('admin')),
);
?>
 

<?php $this->renderPartial('plugin__form', array('model'=>$model)); ?>