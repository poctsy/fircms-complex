<?php

/* @var $this AdminNavigationController */
/* @var $model AdminNavigation */

$this->breadcrumbs = array(
        'Admin',
);

$this->menu = array(
    array('label' => "创建导航条", 'url' => array('create')),
    array('label' => "添加链接到导航条", 'url' => array('childcreate')),
    array('label' => "管理导航条", 'url' => array('admin')),
);
$cs1 = Yii::app()->getClientScript();
$cs1->registerCoreScript('jquery');
$cs1->registerScriptFile(Yii::app()->theme->baseUrl . '/js/lib/jquery.treeview/jquery.treeview.js');
$cs1->registerScriptFile(Yii::app()->theme->baseUrl . '/js/lib/jquery.cookie.js');
$cs1->registerCssFile(Yii::app()->theme->baseUrl . '/js/lib/jquery.treeview/jquery.treeview.css');

$csrfTokenName = Yii::app()->request->csrfTokenName;
$csrfToken = Yii::app()->request->csrfToken;

Yii::app()->clientScript->registerScript('admin', "
    
$('#adminnavigationtree').treeview({
		animated: 'fast',
		collapsed: true,
		unique: true,
		persist: 'cookie',
		toggle: function() {
			window.console && console.log('%o was toggled', this);
		}
});

jQuery(document).on('click','#adminnavigationtree a.delete',function() {
	if(!confirm('确定要删除这条数据吗?')) return false;
	var th = this,
		afterDelete = function(){};
	        $.ajax({
	        type: 'POST',
		url: jQuery(this).attr('href'),
                data:{ '$csrfTokenName':'$csrfToken' },
		error: function() {
			location.reload();
		},
                success:function(){
                location.reload();
                 }
	});
	return false;
});
");



//$a=AdminNavigation::model()->findByPk(172);
//$b=AdminNavigation::model()->findByPk(173);
//$b->moveAsFirst($a);      
?>


<div id="adminnavigationtree" >
    <div><?php AdminNavigation::printULTree(); ?></div>
</div>

