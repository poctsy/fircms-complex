<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Manage',
);

$this->menu=array(

	array('label'=>Yii::t('core', 'Create Article'), 'url'=>array('create')),
        array('label'=>Yii::t('core', 'Manage Article'), 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
 
$('.search-form form').submit(function(){
	$('#article-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});


$('#Article_catalog_name').attr('value','').hide()
$('#Article_content').attr('value','').hide()

$('#searchDrownList').change(function(){
 val=$(this).children('option:selected').val()
 
$('#Article_catalog_name').hide()
$('#Article_title').attr('value','').hide()
$('#Article_content').attr('value','').hide()

if(val==0){ 
$('#Article_catalog_name').show()
}
if(val==1){ 
$('#Article_title').show()
}
if(val==2){ 
$('#Article_content').show()
}

});




");


?>

 
<div class="search-form">
<?php $this->renderPartial('article__search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'article-grid',

	'dataProvider'=>$model->search(),
    'cssFile'=>Yii::app()->theme->baseUrl."/css/grid.css",
    'summaryText'=>false,
	'columns'=>array(
		'id',
        'catalog_name',
                'title',
              array(
            'class' => 'CButtonColumn',
            'template' => '{update},{delete}',
            'updateButtonImageUrl' => false,
            'deleteButtonImageUrl' => false,
        ),
	),

));


?>
