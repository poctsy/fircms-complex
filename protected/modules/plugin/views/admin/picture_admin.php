<?php
/* @var $this PictureController */
/* @var $model Picture */

$this->breadcrumbs=array(
	'Manage',
);

$this->menu=array(
       array('label'=>Yii::t('core', 'Create Picture'), 'url'=>array('create')),
        array('label'=>Yii::t('core', 'Manage Picture'), 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
 
$('.search-form form').submit(function(){
	$('#picture-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});

$('#Picture_base_catalog_name').attr('value','').hide()
$('#Picture_content').attr('value','').hide()

$('#searchDrownList').change(function(){
 val=$(this).children('option:selected').val()

$('#Picture_base_catalog_name').attr('value','').hide()
$('#Picture_base_title').attr('value','').hide()
$('#Picture_content').attr('value','').hide()

if(val==0){ 
$('#Picture_base_catalog_name').show()
}
if(val==1){ 
$('#Picture_base_title').show()
}
if(val==2){ 
$('#Picture_content').show()
}

});

");
?>

 
<div class="search-form"  >
<?php $this->renderPartial('picture__search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'picture-grid',
    'cssFile'=>Yii::app()->theme->baseUrl."/css/grid.css",
    'summaryText'=>false,
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
        array('name'=>'base_catalog_name','value'=>'$data->base_catalog_name'),
                'base.title',
              array(
            'class' => 'CButtonColumn',
            'template' => '{update},{delete}',
            'updateButtonImageUrl' => false,
            'deleteButtonImageUrl' => false,
        ),
	),
)); ?>
