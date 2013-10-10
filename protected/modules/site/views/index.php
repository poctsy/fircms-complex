

<div>
<?php $this->items=array(
    array('label'=>Yii::t('core', 'Home'), 'url'=>array('/site/index/index')),
);
?>

    <h3>前台施工与后台代码 数据表重构中</h3>
    <h1><?php echo CHtml::link('进入后台', Yii::app()->baseUrl.'/admin.php'); ?></h1>




    widget调试
<?php
$this->widget('TopNav',array(
    'name'=>'top_1','rootUlCss'=>'root','childULCss'=>'child'));
?>


</div>

</p>