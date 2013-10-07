<?php
/* @var $this ImagesController */
/* @var $model Images */

$this->breadcrumbs=array(
	'Manage',
);

$this->menu=array(
    	array('label'=>Yii::t('core', 'Create Images'), 'url'=>array('create')),
        array('label'=>Yii::t('core', 'Manage Images'), 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
 
$('.search-form form').submit(function(){
	$('#images-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});

$('#Images_base_catalog_name').attr('value','').hide()
$('#Images_content').attr('value','').hide()

$('#searchDrownList').change(function(){
 val=$(this).children('option:selected').val()

$('#Images_base_catalog_name').attr('value','').hide()
$('#Images_base_title').attr('value','').hide()
$('#Images_content').attr('value','').hide()

if(val==0){ 
$('#Images_base_catalog_name').show()
}
if(val==1){ 
$('#Images_base_title').show()
}
if(val==2){ 
$('#Images_content').show()
}

});



");
?>



<div class="search-form" >
<?php $this->renderPartial('images__search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'images-grid',
    'cssFile'=>Yii::app()->theme->baseUrl."/css/grid.css",
    'summaryText'=>false,
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
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
