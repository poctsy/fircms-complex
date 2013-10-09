<?php

/* @var $this NavigationController */
/* @var $model Navigation */

$this->breadcrumbs = array(
    'Navigations' => array('admin'),
    'Update',
);

$this->menu = array(
    array('label' =>"创建导航条", 'url' => array('create')),
    array('label' =>"绑定内容栏目到导航条", 'url' => array('createchild')),
    array('label' =>"管理导航条", 'url' => array('admin')),
);
?>

<?php 
Yii::app()->clientScript->registerCss('admin', "
 #Navigation_root input{
float:left; 
margin-bottom:3px;
}
 
");
?>

<?php $this->renderPartial('navigation__form', array('model' => $model)); ?>
(*侧重前台数据调用... 默认的顶部导航参数:top 底部导航bottom:侧边栏:side)