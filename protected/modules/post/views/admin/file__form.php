<?php
/* @var $this ImagesController */
/* @var $model Images */
/* @var $form CActiveForm */
?>

<div class="form">



    <?php
    $dir = Yii::app()->basePath . '/extensions/KEditor/keSource';
    $baseUrl = Yii::app()->getAssetManager()->publish($dir);
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl . '/themes/default/default.css');
    $cs->registerCoreScript('jquery.ui');
    
    if (YII_DEBUG)
        $cs->registerScriptFile($baseUrl . '/kindeditor.js');
    else
        $cs->registerScriptFile($baseUrl . '/kindeditor-min.js');
      $cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/minike.js');
    $cs->registerScriptFile("js/zh_CN.js");
    
    $csrfTokenName=Yii::app()->request->csrfTokenName;
    $csrfToken=Yii::app()->request->getCsrfToken();
    $cs->registerScript("file","
        

KindEditor.ready(function(K) {

    var editor = K.editor({
        'fileManagerJson': './admin.php?r=attachment/upload/kmanageJson',
        'uploadJson': './admin.php?r=attachment/upload/kupload',
        'allowFileManager': true,
        'extraFileUploadParams':{'$csrfTokenName':'$csrfToken'},
    });

    K('#File_select_file').click(function() {
        editor.loadPlugin('insertfile', function() {

            editor.plugin.fileDialog(
                    {
                        fileUrl: K('#File_file').val(),
                        clickFn: function(url, title) {
                            url = K.formatUrl(url, 'relative');
                            K('#File_file').val(url);

                            editor.hideDialog();

                        }
                    }

            );
  K('#keTitle').hide();
  K('#keTitle').prev().hide()
  
        });


    });
    K('#filemanager').click(function() {
        editor.loadPlugin('filemanager', function() {
            editor.plugin.filemanagerDialog({
                viewType: 'VIEW',
                dirName: 'file',
                clickFn: function(url, title) {
                    url = K.formatUrl(url, 'relative');
                    K('#File_file').val(url);
                    editor.hideDialog();
                }
            });
        });
    });

    
});






");
    ?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'file-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>



    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'catalog_id'); ?>
         <?php 
        echo $form->dropDownList($model, 'catalog_id',$this->catalogList("file"));
        ?>

        <?php echo $form->error($model, 'catalog_id'); ?>
    </div>



    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'title'); ?>
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

    <div class="row">
        <?php echo $form->labelEx($model, 'keyword'); ?>
        <?php echo $form->textField($model, 'keyword', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'keyword'); ?>
    </div>



    <?php //echo $form->hiddenField($model, 'images', array('size' => 30, 'maxlength' => 30));   ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textField($model, 'description', array('size' => 30, 'maxlength' => 30)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>


    <div class="row">

        <?php echo $form->labelEx($model, 'file'); ?>
        <?php echo $form->textField($model, 'file', array('size' => 30)); ?>
        <?php echo CHtml::button("文件上传", array('id' => 'File_select_file')); ?>


        
        <?php echo $form->error($model, 'file'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php echo $form->textarea($model, 'content', array('id' => 'contentqq', 'style' => 'width:100%;height:300px;visibility:hidden;')); ?>


        <?php echo $form->error($model, 'content'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->