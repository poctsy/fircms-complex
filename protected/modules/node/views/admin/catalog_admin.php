<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->breadcrumbs = array(
    'Admin',
);

$this->menu = array(
    array('label' => Yii::t('core', 'Create Catalog'), 'url' => array('/node/catalog/create')),
    array('label'=>Yii::t('core', 'Create ArticleCatalog'), 'url'=>array('/quick/articlecatalog/create')),
    array('label'=>Yii::t('core', 'Create FileCatalog'), 'url'=>array('/quick/filecatalog/create')),
    array('label'=>Yii::t('core', 'Create ImagesCatalog'), 'url'=>array('/quick/imagescatalog/create')),
    array('label'=>Yii::t('core', 'Create PictureCatalog'), 'url'=>array('/quick/picturecatalog/create')),
    array('label'=>Yii::t('core', 'Manage Catalog'), 'url'=>array('/node/catalog/admin')),

);
$cs1 = Yii::app()->getClientScript();
$cs1->registerCoreScript('jquery');
$cs1->registerScriptFile(Yii::app()->theme->baseUrl . '/js/lib/jquery.treeview/jquery.treeview.js');
$cs1->registerScriptFile(Yii::app()->theme->baseUrl . '/js/lib/jquery.cookie.js');

$cs1->registerCssFile(Yii::app()->theme->baseUrl . '/js/lib/jquery.treeview/jquery.treeview.css' );

$csrfTokenName = Yii::app()->request->csrfTokenName;
$csrfToken = Yii::app()->request->csrfToken;

Yii::app()->clientScript->registerScript('admin', "


$('#catalogtree').treeview({
		animated: 'fast',
		collapsed: true,
		unique: true,
		persist: 'cookie',
		toggle: function() {
			window.console && console.log('%o was toggled', this);
		}
});

jQuery(document).on('click','#catalogtree a.delete',function() {
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
?>


<div id="catalogtree">
    <div><?php Catalog::printULTree(); ?></div>
</div>

