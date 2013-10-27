<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
header('Content-Type: text/html; charset=utf-8');
?>
<h1>The new module default page (<?php echo $this->uniqueId . '/' . $this->action->id; ?>)</h1>

<p>
This is the view content for action "<?php echo $this->action->id; ?>".
The action belongs to the controller "<?php echo get_class($this); ?>"
in the "<?php echo $this->module->id; ?>" module.
</p>
<p>
You may customize this page by editing <tt><?php echo __FILE__; ?></tt>
</p>

<h1>安装模块，，编写中~~</h1>