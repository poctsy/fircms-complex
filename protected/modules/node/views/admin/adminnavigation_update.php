<?php
/* @var $this AdminNavigationController */
/* @var $model AdminNavigation */

$this->breadcrumbs=array(
	'AdminNavigations'=>array('admin'),
	'Update',
);

$this->menu = array(
    array('label' =>"创建导航条", 'url' => array('create')),
    array('label' =>"添加链接到导航条", 'url' => array('childcreate')),
    array('label' =>"管理导航条", 'url' => array('admin')),
);
?>



<?php $this->renderPartial('adminnavigation__form', array('model'=>$model)); ?>