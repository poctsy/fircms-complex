<?php
class PictureKEditor extends CWidget{
	/*
	 * TEXTAREA输入框的属性，保证js调用KE失败时，文本框的样式。
	 */
	public $textfieldOptions=array();
	/*
	 * 编辑器属性集。
	 */
	public $properties=array();
	/*
	 * TEXTAREA输入框的name，必须设置。
	 * 数据类型：String
	 */
	public $name;
	/*
	 * TEXTAREA的id，可为空
	 */
	public $id;
	
	public $model;
        
	public $allowFileManager;
        
        public $baseUrl;
	
	public static function getUploadPath(){
		$dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'keSource';
		if(isset(Yii::app()->params->uploadPath)){
			return Yii::getPathOfAlias('webroot').str_replace(
								'/',DIRECTORY_SEPARATOR,
								Yii::app()->params->
								uploadPath);
		}
		return Yii::app()->getAssetmanager()
				->getPublishedPath($dir).DIRECTORY_SEPARATOR.'upload';
	}
	
	public static function getUploadUrl(){
		$dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'keSource';
		if(isset(Yii::app()->params->uploadPath)){
			return Yii::app()->baseUrl.Yii::app()->params->uploadPath;
		}
		return Yii::app()->getAssetManager()->publish($dir).'/upload';
	}
	
	public function init(){
       
		if($this->name===null)
			throw new CException(Yii::t('zii','The id property cannot be empty.'));
			
		$dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'keSource';
		
		$this->baseUrl=Yii::app()->getAssetManager()->publish($dir);
		$cs=Yii::app()->getClientScript();
		$cs->registerCssFile($this->baseUrl.'/themes/default/default.css');
		if(YII_DEBUG) $cs->registerScriptFile($this->baseUrl.'/kindeditor.js');
		else $cs->registerScriptFile($this->baseUrl.'/kindeditor-min.js');
                $cs->registerScriptFile($this->baseUrl.'/lang/'.Yii::app()->language.'.js');
	}
	
	public function run(){
		$cs=Yii::app()->getClientScript();
		$textFieldOptions=$this->gettextfieldOptions();
		$textFieldOptions['name']=CHtml::resolveName($this->model,$this->name);
		$this->id=$textFieldOptions['id']=CHtml::getIdByName($textFieldOptions['name']);
                //模型的id
		$activeId=CHtml::activeId($this->model,$this->name);
                //widget的id 避免冲突加类名字
                $activeclass=$activeId.'_'.get_class($this);
                echo CHtml::activeTextField($this->model,$this->name,$textFieldOptions); 
                echo CHtml::button('图片上传', array('id' => $activeclass."_button")); 

                if(@$this->properties['allowFileManager'])
                echo CHtml::button("浏览服务器", array('id' =>$activeclass. '_filemanager'));
 
                echo CHtml::openTag("div",array('id'=>$activeclass."nowimg",'style'=>'width: 800px;height:400px; border:1px dashed slategray;overflow-y:scroll;','onload'=>$activeclass."startimagesnow"));
                echo CHtml::closeTag("div");
       
              
                
		$properties_string = CJavaScript::encode($this->getKeProperties());

		$js=<<<EOF
                        

KindEditor.ready(function(K) {

     var nowimg = K('#{$activeclass}nowimg');
    
    nowimg.html('<img src=\"' + K('#{$activeId}').val() + '\">');
     var editor_$this->id = K.editor(
        $properties_string
    );
    K('#{$activeclass}_button').click(function() {
        editor_$this->id.loadPlugin('image', function() {
            editor_$this->id.plugin.imageDialog({
                showRemote: false,
                clickFn: function(url, title, width, height, border, align) {
                    url = K.formatUrl(url, 'relative');
                    K('#$this->id').val(url);
                    nowimg.html('<img src=\"' + url + '\">');
                    editor_$this->id.hideDialog();
                }
            });
        });
    });
    K('#{$activeclass}_filemanager').click(function() {
        editor_$this->id.loadPlugin('filemanager', function() {
            editor_$this->id.plugin.filemanagerDialog({
                viewType: 'VIEW',
                dirName: 'image',
                clickFn: function(url, title) {
                    url = K.formatUrl(url, 'relative');
                    K('#$this->id').val(url);
                    nowimg.html('<img src=\"' + url + '\">');
                    editor_$this->id.hideDialog();
                }
            });
        });
    });
 

});
EOF;
		$cs->registerScript('KE'.$this->name,$js,CClientScript::POS_HEAD);
	}
	
	public function gettextfieldOptions(){
		//允许获取的属性
		$allowParams=array('size','class','style');
		//准备返回的属性数组
		$params=array();
		foreach($allowParams as $key){
			if(isset($this->textfieldOptions[$key]))
				$params[$key]=$this->textfieldOptions[$key];
		}
		$params['name']=$params['id']=$this->name;
		return $params;
	}
	
	public function getKeProperties(){
		$properties_key=array(
                       'fileManagerJson',
                        'allowFileManager',
			'uploadJson',
			'extraFileUploadParams',
		);
		
		//准备返回的属性数组
		$params=array();
		foreach($properties_key as $key){
			if(isset($this->properties[$key]))
				$params[$key]=$this->properties[$key];
		}
		return $params;
	}
}