<?php
class FMiNiKe extends CWidget
{

    public $model;
    public function init()
    {
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/minike.js');
    }

    public function run()
    {
      echo CHtml::activeTextarea($this->model, 'content', array(
    'id' => 'contentqq',
    'style' => 'width:100%;height:300px;visibility:hidden;'
));


}



}