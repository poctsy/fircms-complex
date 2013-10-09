<?php
/**
 * @version   Catalog.php  17:17 2013年09月13日
 * @author    poctsy <poctsy@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 */

/**
 * This is the model class for table "{{catalog}}".
 *
 * The followings are the available columns in table '{{catalog}}':
 * @property integer $id
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $name
 * @property string $keyword
 * @property string $description
 * @property string $type
 * @property integer $plugin_id
 * @property string $url
 * @property text $content
 * @property string $view
 */



class Catalog extends FActiveRecord {
    /**
     * @return string the associated database table name
     */

    const LEVEL = "…";
    public $_rootName="顶级分类";

    const CATALOG_LIST_MOULD = 1;
    const CATALOG_COVER_MOULD = 2;
    const CATALOG_SINGLEPAGE_MOULD = 3;
    const CATALOG_MULTIPLE_MOULD = 4;
    const CATALOG_LINK = 5;
    public $type=self::CATALOG_LIST_MOULD;

    public $parent;
    public $plugin_id_list;
    public $plugin_id_cover;
    public $plugin_id_singlepage;
    public $plugin_id_multiple;


    public function tableName() {
        return '{{catalog}}';
    }


    /**
     * Id of the div in which the tree will berendered.
     */
    public function behaviors() {
        return array(
            'NestedSetBehavior' => array(
                'class' => 'ext.nestedBehavior.NestedSetBehavior',
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'levelAttribute' => 'level',
                'hasManyRoots' => false
            ),
        );
    }



    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent,name,thumb,plugin_id_list,plugin_id_cover,plugin_id_singlepage,plugin_id_multiple', 'safe',),

            array('type,parent', 'required', 'on' => 'catalogupdate'),
            array('name,url', 'required'),


            array('plugin_id,type,parent,plugin_id_list,plugin_id_cover,plugin_id_singlepage,plugin_id_multiple', 'numerical', 'integerOnly' => true),
            array(' keyword, description, url', 'length', 'max' => 30),
            array('title', 'length', 'max' => 50),
            array('list_view', 'length', 'max' => 55),
            array('content_view', 'length', 'max' => 55),

            array('content', 'filter', 'filter' => array($this, 'contentPurify')),
            array('name,title, keyword, description,content, content_view,list_view', 'filter', 'filter' => array($this, 'Purify')),

            array('id,lft, rgt, level,name,title, keyword, description, type, plugin_id, url, content, content_view', 'safe', 'on' => 'search'),

        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'navigations'=>array(self::HAS_MANY,'Navigation','catalog_id'),
            'plugin'=>array(self::BELONGS_TO,'Plugin','plugin_id'),
            'page'=>array(self::HAS_ONE,'Page','id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'parent' => '栏目分类',
            'name'=>'栏目名称',
            'url' => '目录网址',
            'thumb' => '缩略图',
            'title' => '网页标题',
            'keyword' => '网页关键字(SEO)',
            'description' => '网页描述(SEO)',
            'type' => '栏目模式',
            'plugin_id' => '选择模型',
            'list_view' => '列表页模板',
            'content_view' => '内容页模板',
            'content' => '栏目简介',
        );
    }



    /**
     * @return array validation rules for model attributes.
     */

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('title', $this->title, true);
        $criteria->compare('keyword', $this->keyword, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('plugin_id', $this->plugin_id);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('view', $this->content_view, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>20,
            )
        ));
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Catalog the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);

    }





    public function beforeSave(){
        if($this->type == Catalog::CATALOG_LIST_MOULD)
            $this->plugin_id=$this->plugin_id_list;
        if($this->type == Catalog::CATALOG_COVER_MOULD)
            $this->plugin_id=$this->plugin_id_cover;
        if($this->type == Catalog::CATALOG_SINGLEPAGE_MOULD)
            $this->plugin_id=$this->plugin_id_singlepage;
        if($this->type == Catalog::CATALOG_MULTIPLE_MOULD)
            $this->plugin_id=$this->plugin_id_multiple;
        if($this->plugin_id==NULL){
            $this->plugin_id=1;
        }
        return true;
    }


    public function afterSave(){
        $this->createPage($this->type,$this->plugin_id,$this->id);
        return true;

    }

    public  function createPage($type,$plugin_id,$id){

        if($type==Catalog::CATALOG_SINGLEPAGE_MOULD){
            $plugin=Plugin::model()->findByPk($plugin_id);
            if($plugin->en_name=='page'){
                $model = new Page;
                $model->catalog_id=$id;
                $model->save();
                var_dump($type.$plugin_id.$id);

            }
        }
    }

    public static function printTree() {
        if(Catalog::model()->count() <2)
            return;
        $rootId=Catalog::model()->roots()->find()->id;

        $criteria = new CDbCriteria;
        $criteria->addNotInCondition('id', array($rootId));
        $criteria->order = "lft";
        $catalogs= Catalog::model()->findAll($criteria);


        $level = 0;

        foreach ($catalogs as $n => $catalog) {

            if ($catalog->level == $level)
                echo CHtml::closeTag('li') . "\n";
            else if ($catalog->level > $level)
                echo CHtml::openTag('ul') . "\n";
            else {
                echo CHtml::closeTag('li') . "\n";

                for ($i = $level - $catalog->level; $i; $i--) {
                    echo CHtml::closeTag('ul') . "\n";
                    echo CHtml::closeTag('li') . "\n";
                }
            }

            echo CHtml::openTag('li', array('id' => 'catalog_' . $catalog->id, 'rel' => $catalog->name));
            echo CHtml::openTag('span');
            echo CHtml::encode($catalog->name);
            echo CHtml::decode('&nbsp;&nbsp;&nbsp;') . CHtml::encode('[ID:' . $catalog->id . ']');
            echo CHtml::closeTag('span');
            echo CHtml::openTag('span', array('class' => 'cudlink'));
            echo CHtml::Link('(上移', Yii::app()->createUrl("node/catalog/prevup", array("id" => $catalog->id)));
            echo CHtml::Link('下移)', Yii::app()->createUrl("node/catalog/nextup", array("id" => $catalog->id)));
            echo CHtml::openTag('a', array('href' => Yii::app()->createUrl("node/catalog/update", array("id" => $catalog->id))));
            echo CHtml::encode("更新");
            echo CHtml::closeTag('a');
            echo CHtml::openTag('a', array("class" => "delete", 'href' => Yii::app()->createUrl("node/catalog/delete", array("id" => $catalog->id))));
            echo CHtml::encode("删除");
            echo CHtml::closeTag('a');
            echo CHtml::closeTag('span');




            $level = $catalog->level;
        }

        for ($i = $level; $i; $i--) {
            echo CHtml::closeTag('li') . "\n";
            echo CHtml::closeTag('ul') . "\n";
        }
    }

    public static function printTree_noAnchors() {
        $catalogs = Catalog::model()->findAll(array('order' => 'lft'));
        $level = 0;

        foreach ($catalogs as $n => $catalog) {
            if ($catalog->level == $level)
                echo CHtml::closeTag('li') . "\n";
            else if ($catalog->level > $level)
                echo CHtml::openTag('ul') . "\n";
            else {         //if $catalog->level<$level
                echo CHtml::closeTag('li') . "\n";

                for ($i = $level - $catalog->level; $i; $i--) {
                    echo CHtml::closeTag('ul') . "\n";
                    echo CHtml::closeTag('li') . "\n";
                }
            }

            echo CHtml::openTag('li');
            echo CHtml::encode($catalog->name);
            $level = $catalog->level;
        }

        for ($i = $level; $i; $i--) {
            echo CHtml::closeTag('li') . "\n";
            echo CHtml::closeTag('ul') . "\n";
        }
    }

    public static function getOptionlevel($level) {
        return str_repeat(self::LEVEL, $level - 1);
    }

    //为单一模型 查找分类
    public static function findPluginTree($id) {

        $criteria = new CDbCriteria;
        $criteria->compare('plugin_id', $id);
        $catalogs = Catalog::model()->findAll($criteria);

        return $catalogs;
    }




    public static function findAllTree_noRoot() {

        $rootId=Catalog::model()->roots()->find()->id;

        $criteria = new CDbCriteria;
        $criteria->addNotInCondition('id', array($rootId));
        $criteria->order = "lft";
        $catalogs= Catalog::model()->findAll($criteria);

        return $catalogs;
    }

    public static function makeSelectTree($catalogs) {

        $treeSelect = array();
        $level = 0;
        //如果nodes为NULL， 则默认他为数组 不报错
        if ($catalogs == NULL)
            $catalogs = array();

        foreach ($catalogs as $catalog) {
            $treeSelect[$catalog->id] = self::getOptionlevel($catalog->level) . $catalog->name;
        }
        return $treeSelect;
    }

    public static function makeSelectTreeChild($catalogs) {

        $treeSelect = array();
        $level = 0;
        //如果nodes为NULL， 则默认他为数组 不报错
        if ($catalogs == NULL)
            $catalogs = array();

        foreach ($catalogs as $catalog) {
            $treeSelect[$catalog->id] = self::getOptionlevel($catalog->level-1) . $catalog->name;
        }
        return $treeSelect;
    }

    public function createRoot(){
        if(Catalog::model()->roots()->count()<1){
            $root=new Catalog();
            $root->name=$root->_rootName;
            $root->saveNode();
        }
    }

    public function deleteNavigation(){
        if($navigations=$this->navigations){
            foreach($navigations as $navigation){
                $navigationId=$navigation->id;
            }
            Navigation::model()->findByPk($navigationId)->deleteNode();

        }
    }

    public function nameGet($name){
        $catalg=Catalog::model()->find('url=?',array($name));
        return $catalg;
    }


}