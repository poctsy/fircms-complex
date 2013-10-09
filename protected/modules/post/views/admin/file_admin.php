<?php
/* @var $this FileController */
/* @var $model File */

$this->breadcrumbs=array(
	'Manage',
);

$this->menu=array(

        array('label'=>Yii::t('core', 'Create File'), 'url'=>array('create')),
        array('label'=>Yii::t('core', 'Manage File'), 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "

$('.search-form form').submit(function(){
	$('#file-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});


$('#File_catalog_name').attr('value','').hide()
$('#File_file').attr('value','').hide()
$('#File_content').attr('value','').hide()

$('#searchDrownList').change(function(){
 val=$(this).children('option:selected').val()

$('#File_catalog_name').attr('value','').hide()
$('#File_title').attr('value','').hide()
$('#File_file').attr('value','').hide()
$('#File_content').attr('value','').hide()

if(val==0){
$('#File_catalog_name').show()
}
if(val==1){
$('#File_title').show()
}
if(val==2){
$('#File_file').show()
}
if(val==3){
$('#File_content').show()
}

});
");
?>

<div class="search-form" >
<?php $this->renderPartial('file__search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'file-grid',
	'dataProvider'=>$model->search(),
    'cssFile'=>Yii::app()->theme->baseUrl."/css/grid.css",
    'summaryText'=>false,
	'columns'=>array(
		'id',
        array('name'=>'catalog_name','value'=>'$data->catalog_name'),
                'title',
              array(
            'class' => 'CButtonColumn',
            'template' => '{update},{delete}',
            'updateButtonImageUrl' => false,
            'deleteButtonImageUrl' => false,
        ),
	),
)); ?>
