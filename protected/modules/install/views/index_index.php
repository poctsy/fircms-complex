<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
header('Content-Type: text/html; charset=utf-8');
?>


<h1>安装模块，编写中~~</h1>

<?php echo CHtml::link('初始化文件夹',array('index/createdirectory')); ?>