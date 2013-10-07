<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/typo.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fircms-admin.css" />


    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<?php
if(YII_DEBUG==false){
$cs=Yii::app()->getClientScript();
$cs->registerCoreScript("jquery");
$cs->registerScript("main_t", "
$('body a').bind('contextmenu',function(e){return false; });
");
}
?>
<body>

<div class="typo" id="page">





    <?php echo $content; ?>

    <div class="clear"></div>

    <div style="padding: 10px;   margin: 10px 20px;   font-size: 0.8em;  text-align: center;  border-top: 1px solid #C9E0ED;color: #B1B4B6;">
        Copyright &copy; <?php echo date('Y'); ?> by poctsy. All Rights Reserved. Powered by fircms.com
    </div>

</div><!-- page -->

</body>
</html>
