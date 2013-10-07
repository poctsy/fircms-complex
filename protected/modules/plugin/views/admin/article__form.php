<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */
?>

<div class="form">



  



    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'article-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>



<?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'base_catalog_id'); ?>
        <?php 
        echo $form->dropDownList($model, 'base_catalog_id',Yii::app()->params['articleCatalogList'] );
        ?>

<?php echo $form->error($model, 'base_catalog_id'); ?>
    </div>


    <div class="row">
   <?php echo $form->labelEx($model, 'base_title'); ?>
<?php echo $form->textField($model, 'base_title', array('size' => 60, 'maxlength' => 100)); ?>
<?php echo $form->error($model, 'base_title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'base_thumb'); ?>
        <?php
        $this->widget('ext.KEditor.ThumbKEditor', array(
            'model' => $model, //传入form model
            'name' => 'base_thumb', //设置name
            'properties' => array(
                'extraFileUploadParams' => array(Yii::app()->request->csrfTokenName=>Yii::app()->request->getCsrfToken()),
                'uploadJson' => Yii::app()->createUrl('attachment/upload/kupload'),
               ),
            'textfieldOptions' => array(
                'size' => '30',
            )
        ));
        ?>
  
<?php echo $form->error($model, 'base_thumb'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'base_keyword'); ?>
<?php echo $form->textField($model, 'base_keyword', array('size' => 30, 'maxlength' => 30)); ?>
<?php echo $form->error($model, 'base_keyword'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'base_description'); ?>
<?php echo $form->textField($model, 'base_description', array('size' => 30, 'maxlength' => 30)); ?>
<?php echo $form->error($model, 'base_description'); ?>
    </div>

    <div class="row">


        
        
        <?php
        $this->widget('ext.KEditor.KEditor', array(
            'model' => $model, //传入form model
            'name' => 'content', //设置name
         
            'properties' => array(
                //设置接收文件上传的action
                'extraFileUploadParams' => array(Yii::app()->request->csrfTokenName=>Yii::app()->request->getCsrfToken()),
                'uploadJson' => Yii::app()->createUrl('attachment/upload/kupload'),
                //设置浏览服务器文件的action，这两个就是上面配置在/admin/default的
               // 'fileManagerJson' => Yii::app()->createUrl('attachment/upload/kmanageJson'),
                'newlineTag' => 'br',
                'urlType'=>'relative',
                //传值前加js:来标记这些是js代码
                'afterCreate' => "js:function() {
						K('#ChapterForm_all_len').val(this.count());
						K('#ChapterForm_word_len').val(this.count('text'));
					}",
                'afterChange' => "js:function() {
						K('#ChapterForm_all_len').val(this.count());
						K('#ChapterForm_word_len').val(this.count('text'));
					}",
            ),
            'textareaOptions' => array(
                'style' => 'width:98%;height:400px;',
            )
        ));
        ?>

        <?php echo $form->error($model, 'content'); ?>
    </div>

    <div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->