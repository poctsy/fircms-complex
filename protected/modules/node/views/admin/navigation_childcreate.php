<?php

/* @var $this NavigationController */
/* @var $model Navigation */

$this->breadcrumbs = array(
    'Navigations' => array('admin'),
    'Update',
);

$this->menu = array(
    array('label' =>"创建导航条", 'url' => array('create')),
    array('label' =>"绑定内容栏目到导航条", 'url' => array('childcreate')),
    array('label' =>"管理导航条", 'url' => array('admin')),
);
?>



(*导航条为自定义URL模式时，链接才会生效)
<?php $this->renderPartial('navigation__childform', array('model' => $model)); ?>