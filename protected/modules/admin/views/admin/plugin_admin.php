<?php
/* @var $this PluginController */
/* @var $model Plugin */

$this->breadcrumbs=array(
	'Plugin',
);

$this->menu=array(
        array('label'=>Yii::t('core', 'Create Plugin'), 'url'=>array('create')),
        array('label'=>Yii::t('core', 'Plugin Plugin'), 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#plugin-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
 


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'plugin-grid',
	'dataProvider'=>$model->search(),
    'cssFile'=>Yii::app()->theme->baseUrl."/css/grid.css",
    'summaryText'=>false,
	'columns'=>array(
		'id',
		'name',
               'en_name',
              'listprefix',
		'prefix',
		'path',
		              array(
            'class' => 'CButtonColumn',
            'template' => '{update},{delete}',
            'updateButtonImageUrl' => false,
            'deleteButtonImageUrl' => false,
        ),
	),
)); ?>
<p>(*不要修改模型配置，除非你知道流程。)</p>