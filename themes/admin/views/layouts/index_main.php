<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/typo.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fircms-admin.css" />


    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?php
$cs=Yii::app()->getClientScript();
$cs->registerCoreScript("jquery");
$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/lib/jquery.iframe.js');
$cs->registerScript("index_main", "$('#main').iframeAutoHeight();
$('#adminnav li').click(function(){
    $('#nav_select div').hide();
li_id=$(this).attr('id');

    if(li_id == 'nav_system'){
        $('#nav_system_bar').show();
    }
    if(li_id == 'nav_theme'){
        $('#nav_theme_bar').show();
    }
    if(li_id == 'nav_catalog'){
        $('#nav_catalog_bar').show();
    }
    if(li_id == 'nav_spread'){
        $('#nav_spread_bar').show();
    }
    if(li_id == 'nav_pugin'){
        $('#nav_pugin_bar').show();
    }
    if(li_id == 'nav_user'){
        $('#nav_user_bar').show();
    }
});");

if(YII_DEBUG==false){
$cs->registerScript("index_main_t", "
$('body a').bind('contextmenu',function(e){return false; });

");
}
?>
<div class="typo" id="page">

    <div id="header">

        <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
        <div id="adminnav">
            <ul>
                <li id="nav_system"><a href="<?php echo Yii::app()->createUrl('/admin/system/system'); ?>" target="main" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/1.gif"><span>系统设置</span></a></li>
                <li id="nav_theme"><a href="<?php echo Yii::app()->createUrl('/admin/system/system'); ?>" target="main"  ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/2.gif"><span>界面主题</span></a></li>
                <li id="nav_catalog"><a href="<?php echo Yii::app()->createUrl('/node/catalog/admin'); ?>" target="main" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/3.gif"><span>栏目配置</span></a></li>
                <li id="nav_pugin"><a href="<?php echo Yii::app()->createUrl('/admin/plugin/view/'); ?>" target="main" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/4.gif"><span>内容管理</span></a></li>
                <li id="nav_spread"><a href="<?php echo Yii::app()->createUrl('/admin/system/system'); ?>" target="main"  ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/5.gif" ><span>优化推广</span></a></li>
                <li id="nav_user"><a href="<?php echo Yii::app()->createUrl('/u/manage/admin'); ?>"  target="main" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/6.gif"><span>用户管理</span></a></li>
            </ul>
        </div>
        <div id="logout">您好,<?php echo Yii::app()->user->name;?><a href="<?php echo Yii::app()->createUrl('/admin/user/logout')?>">退出</a></div>
    </div><!-- header -->


    <?php echo $content; ?>

    <div class="clear"></div>



</body>
</html>
