<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

    <div id="header">
        <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
    </div><!-- header -->

    <div id="mainmenu">
        <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>Yii::t('core', 'Home'), 'url'=>array('/admin/index/index'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('core', 'Article'), 'url'=>array('/post/article/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('core', 'Picture'), 'url'=>array('/post/picture/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('core', 'Images'), 'url'=>array('/post/images/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('core', 'Page'), 'url'=>array('/post/page/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('core', 'File'), 'url'=>array('/post/file/admin'), 'visible'=>!Yii::app()->user->isGuest),
         array('label'=>Yii::t('core', 'Attachment'), 'url'=>array('/attachment/manage/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>"查看留言", 'url'=>array('/comment/message/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>"查看反馈", 'url'=>array('/comment/feedback/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('core', 'Catalog'), 'url'=>array('/node/catalog/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>"导航条", 'url'=>array('/node/navigation/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('core', 'Plugin'), 'url'=>array('/admin/plugin/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'用户管理', 'url'=>array('/u/manage/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('core', 'Right'), 'url'=>array('/rights'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>"网站配置", 'url'=>array('/admin/config/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>"后台导航", 'url'=>array('/node/adminnavigation/admin'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('core', 'Login'), 'url'=>array('/admin/user/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>Yii::t('core', 'Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/admin/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
            ),
        )); ?>
    </div><!-- mainmenu -->
    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php echo $content; ?>

    <div class="clear"></div>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by poctsy.<br/>
        All Rights Reserved.<br/>
        Powered by fircms.com
    </div><!-- footer -->

</div><!-- page -->

</body>
</html>
