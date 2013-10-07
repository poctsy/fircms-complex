<?php
/* @var $this AdminNavigationController */
/* @var $model AdminNavigation */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'adminnavigation-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>






    <div class="row">
        <?php echo $form->labelEx($model, 'parent'); ?>
        <?php
        echo $form->dropDownList($model, 'parent', AdminNavigation::selectChildTreeData(AdminNavigation::findAllTree_noRoot() ), array('class' => 'span4', 'encode' => false, 'style' => 'width:130px;')
        );
        ?>
        <?php echo $form->error($model, 'parent'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>


        <div class="row">
            <?php echo $form->labelEx($model, 'url'); ?>
            <?php echo $form->textField($model, 'url', array('size' => 30, 'maxlength' =>50)); ?>
            <?php echo $form->error($model, 'url'); ?>
        </div>



    <div class="row">
        <?php echo $form->labelEx($model, 'thumb'); ?>
        <?php
        $this->widget('ext.KEditor.ThumbKEditor', array(
            'model' => $model, //传入form model
            'name' => 'thumb', //设置name
            'properties' => array(
                'extraFileUploadParams' => array(Yii::app()->request->csrfTokenName=>Yii::app()->request->getCsrfToken()),
                'uploadJson' => Yii::app()->createUrl('attachment/upload/kupload'),
            ),
            'textfieldOptions' => array(
                'size' => '30',
            )
        ));
        ?>

        <?php echo $form->error($model, 'thumb'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->