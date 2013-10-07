<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

	<div id="content">
        <?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
        <?php endif?>

        <?php $this->renderPartial('//layouts/_flash'); ?>

        <div class="operations">
        <?php
        $this->widget('zii.widgets.CMenu', array(
            'items'=>$this->menu,

        ));
        ?>
        </div>
         <div style="clear: both"></div>
		<?php echo $content; ?>
	</div><!-- content -->




<?php $this->endContent(); ?>