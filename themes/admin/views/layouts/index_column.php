
<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/index_main'); ?>
<div id="sidebar" class="border">
    <div style="   border-bottom: #dedede solid 1px; ">
    <a style="display: inline" href="<?php echo Yii::app()->baseUrl;?>/index.php">网站首页</a>
    <span class="border"></span>
     <a style="display: inline; margin-left:5px;"  href="<?php echo Yii::app()->baseUrl;?>/admin.php">后台首页</a>
    </div>
    <div id="nav_select">
    <div id="nav_system_bar" > <ul>
            <li><a href="<?php echo Yii::app()->createUrl('/admin/system/system'); ?>" target="main" ><span>系统信息</span></a></li>
            <li><a href="<?php echo Yii::app()->createUrl('/admin/config/admin'); ?>" target="main" ><span>基本配置</span></a></li>
            <li><a href="<?php echo Yii::app()->createUrl('/attachment/manage/admin'); ?>" target="main" ><span>上传文件管理</span></a></li>

        </ul>
    </div>
    <div id="nav_theme_bar"  style="display: none">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('/admin/system/system'); ?>" target="main" ><span>暂未开发</span></a></li>

        </ul>
    </div>
    <div id="nav_catalog_bar"  style="display: none">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('/node/catalog/admin'); ?>" target="main" ><span>栏目配置</span></a></li>
            <li><a href="<?php echo Yii::app()->createUrl('/node/navigation/admin'); ?>" target="main"  ><span>导航配置</span></a></li>
     </ul>
    </div>
    <div id="nav_spread_bar"  style="display: none">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('/admin/system/system'); ?>" target="main" ><span>暂未开发</span></a></li>

        </ul>
    </div>
    <div id="nav_pugin_bar"  style="display: none">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('/admin/plugin/view/'); ?>" target="main" ><span>内容管理</span></a></li>
            <li><a href="<?php echo Yii::app()->createUrl('/plugin/images/admin'); ?>" target="main" ><span>图集管理</span></a></li>
            <li><a href="<?php echo Yii::app()->createUrl('/admin/plugin/admin'); ?>" target="main" ><span>模块管理</span></a></li>



        </ul>
    </div>
    <div id="nav_user_bar"  style="display: none">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('/u/manage/admin'); ?>" target="main" ><span>用户管理</span></a></li>
            <li><a href="<?php echo Yii::app()->createUrl('/rights'); ?>" target="main" ><span>权限管理</span></a></li>
            <li><a href="<?php echo Yii::app()->createUrl('/rights/authItem/generate',array('id'=>1)); ?>" target="main" ><span>前台权限</span></a></li>
            <li><a href="<?php echo Yii::app()->createUrl('/rights/authItem/generate',array('id'=>2)); ?>" target="main" ><span>后台权限</span></a></li>
        </ul>
    </div>
        </div>
        <div style="   border-top: #dedede solid 1px;">
            感谢使用Fircms
        </div>
</div><!-- sidebar -->
<div id="content">
    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php $this->renderPartial('//layouts/_flash'); ?>
    <?php echo $content; ?>
</div><!-- content -->




<?php $this->endContent(); ?>