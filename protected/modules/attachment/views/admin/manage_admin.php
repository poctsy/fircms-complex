<?php
/* @var $this ManageController */
/* @var $model Upload */

$this->breadcrumbs=array(
	'Uploads'=>array('admin'),
	'Manage',
);

$this->menu=array(
         array('label'=>Yii::t('core', 'Manage Upload'), 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#upload-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>





<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'upload-grid',
    'cssFile'=>Yii::app()->theme->baseUrl."/css/grid.css",
    'summaryText'=>false,
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'type',
		'name',
		'path',
				              array(
            'class' => 'CButtonColumn',
            'template' =>'{delete}',
            'deleteButtonImageUrl' => false,
        ),
	),
)); ?>
<p>(*删除操作将删除服务上的实体文件)</p>