<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/typo.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fircms-admin-login.css" />


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="page"  class="typo">
<div id ="header"></div>
 
<div id="content" >
	<?php echo $content; ?>
</div>

	<div class="clear"></div>


<div style="font-size: 3px;color: whitesmoke">
        Copyright &copy; <?php echo date('Y'); ?> by <a href="http://www.fircms.com"><span style="color:#fff;">fircms</span></a>
    </div>
</div><!-- page -->

</body>
</html>
