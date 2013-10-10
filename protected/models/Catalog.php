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



    public $parent;


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
            array('parent,name,thumb,plugin_id', 'safe',),

            array('parent', 'required', 'on' => 'catalogupdate'),
            array('name,url,plugin_id', 'required'),


            array('plugin_id,parent,', 'numerical', 'integerOnly' => true),
            array(' keyword, description, url', 'length', 'max' => 30),
            array('title', 'length', 'max' => 50),
            array('first_view', 'length', 'max' => 55),
            array('second_view', 'length', 'max' => 55),

            array('content', 'filter', 'filter' => array($this, 'contentPurify')),
            array('name,title, keyword, description,content, second_view,first_view', 'filter', 'filter' => array($this, 'Purify')),

            array('id,lft, rgt, level,name,title, keyword, description, plugin_id, url, content, second_view', 'safe', 'on' => 'search'),

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
            'plugin_id' => '绑定模块',
            'first_view' => '栏目页视图模板',
            'second_view' => '内容页视图模板',
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
        $criteria->compare('plugin_id', $this->plugin_id);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('view', $this->second_view, true);

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








    public function afterSave(){
        $this->createPage($this->plugin_id,$this->id);
        return true;

    }

    public  function createPage($plugin_id,$id){


            $plugin=Plugin::model()->findByPk($plugin_id);
            if($plugin->en_name=='page'){
                $model = new Page;
                $model->catalog_id=$id;
                $model->save();


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

    public function selectTree_noRoot(){
     return Catalog::makeSelectTree(Catalog::findAllTree_noRoot());
    }

    public function selectTree(){
        return Catalog::makeSelectTree(Catalog::model()->findAll(array('order'=>'lft')));
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