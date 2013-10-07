 <div class="flashes">

	<?php if( Yii::app()->user->hasFlash($this->module->flashSuccessKey)===true ):?>

	    <div class="flash success">

	        <?php echo Yii::app()->user->getFlash($this->module->flashSuccessKey); ?>

	    </div>

	<?php endif; ?>

	<?php if( Yii::app()->user->hasFlash($this->module->flashErrorKey)===true ):?>

	    <div class="flash error">

	        <?php echo Yii::app()->user->getFlash($this->module->flashErrorKey); ?>

	    </div>

	<?php endif; ?>

 </div>