<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->breadcrumbs=array(
	'Catalogs'=>array('admin'),
	'Update',
);

$this->menu = array(
    array('label' => Yii::t('core', 'Create Catalog'), 'url' => array('/node/catalog/create')),
    array('label'=>Yii::t('core', 'Manage Catalog'), 'url'=>array('/node/catalog/admin')),

);
?>



<?php $this->renderPartial('catalog__form', array('model' => $model)); ?>