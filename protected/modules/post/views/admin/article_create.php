<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Plugin Article'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t('core', 'Create Article'), 'url'=>array('create')),
        array('label'=>Yii::t('core', 'Manage Article'), 'url'=>array('admin')),
);
?>

 
<?php $this->renderPartial('article__form', array('model'=>$model)); ?>