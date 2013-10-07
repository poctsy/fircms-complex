<?php
/* @var $this FileCatalogController */
/* @var $model FileCatalog */

$this->breadcrumbs=array(
	'FileCatalogs'=>array('admin'),
	'Update',
);

$this->menu = array(
    array('label' => Yii::t('core', 'Create Catalog'), 'url' => array('/node/catalog/create')),
    array('label'=>Yii::t('core', 'Create ArticleCatalog'), 'url'=>array('/quick/articlecatalog/create')),
    array('label'=>Yii::t('core', 'Create FileCatalog'), 'url'=>array('/quick/filecatalog/create')),
    array('label'=>Yii::t('core', 'Create ImagesCatalog'), 'url'=>array('/quick/imagescatalog/create')),
    array('label'=>Yii::t('core', 'Create PictureCatalog'), 'url'=>array('/quick/picturecatalog/create')),
    array('label'=>Yii::t('core', 'Manage Catalog'), 'url'=>array('/node/catalog/admin')),

);
?>



<?php $this->renderPartial('filecatalog__form', array('model'=>$model )); ?>