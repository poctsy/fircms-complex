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
 * @property integer $node_id
 * @property string $title
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
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(' plugin_id,type,parent,plugin_id_list,plugin_id_cover,plugin_id_singlepage,plugin_id_multiple', 'numerical', 'integerOnly' => true),
            array('parent,name,thumb,plugin_id_list,plugin_id_cover,plugin_id_singlepage,plugin_id_multiple', 'safe',),

            array('type,url,parent,name', 'required', 'on' => 'catalogupdate'),
            array('name', 'required'),
            array('node_id', 'unique'),

            array(' keyword, description, url', 'length', 'max' => 30),

            array('title', 'length', 'max' => 50),
            array('list_view', 'length', 'max' => 55),
            array('content_view', 'length', 'max' => 55),
            array('content', 'filter', 'filter' => array($this, 'contentPurify')),
            array('name,title, keyword, description,content, content_view,list_view', 'filter', 'filter' => array($this, 'Purify')),
            array('name,title, keyword, description, type, plugin_id, url, content, content_view', 'safe', 'on' => 'search'),

        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'plugin'=>array(self::BELONGS_TO,'Plugin','plugin_id'),
            'node'=>array(self::BELONGS_TO,'Node','node_id') ,
            'base'=>array(self::HAS_MANY, 'Base', 'catalog_id'),
            'page'=>array(self::HAS_ONE,'Page','node_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'parent' => '栏目分类',
            'name'=>'栏目名称',
            'thumb' => '缩略图',
            'title' => '网页标题',
            'keyword' => '网页关键字(SEO)',
            'description' => '网页描述(SEO)',
            'type' => '栏目模式',
            'url' => '栏目网址',
            'plugin_id' => '选择模型',
            'list_view' => '栏目页模板',
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
        if($this->plugin_id_list>0)
            $this->plugin_id=$this->plugin_id_list;
        if($this->plugin_id_list)
            $this->plugin_id=$this->plugin_id_list;
        if($this->plugin_id_cover)
            $this->plugin_id=$this->plugin_id_list;
        if($this->plugin_id_singlepage)
            $this->plugin_id=$this->plugin_id_list;
        if($this->plugin_id_multiple)
            $this->plugin_id=$this->plugin_id_list;
        if($this->plugin_id==NULL){
            $this->plugin_id=1;
        }
        return true;
    }






    public static function printULTree() {

            $type = Node::NODE_CATALOG;
            $actionname = 'catalog';

        $rootnode = Node::model()->find(array('condition' => 'type=:type', 'params' => array(':type' => $type)));
        if ($rootnode == NULL)
            return;

        $criteria = new CDbCriteria;
        $criteria->addNotInCondition('id', array($rootnode->id));
        $criteria->compare('root', $rootnode->id);
        $criteria->order = "root,lft";
        $nodes = Node::model()->findAll($criteria);
        $level = 0;

        foreach ($nodes as $n => $node) {

            if ($node->level == $level)
                echo CHtml::closeTag('li') . "\n";
            else if ($node->level > $level)
                echo CHtml::openTag('ul') . "\n";
            else {
                echo CHtml::closeTag('li') . "\n";

                for ($i = $level - $node->level; $i; $i--) {
                    echo CHtml::closeTag('ul') . "\n";
                    echo CHtml::closeTag('li') . "\n";
                }
            }

            echo CHtml::openTag('li', array('id' => 'node_' . $node->id, 'rel' => $node->catalog_name));
            echo CHtml::openTag('span');
            echo CHtml::encode($node->catalog_name);
            echo CHtml::decode('&nbsp;&nbsp;&nbsp;') . CHtml::encode('[ID:' . $node->id . ']');
            echo CHtml::closeTag('span');
            echo CHtml::openTag('span', array('class' => 'cudlink'));
            echo CHtml::Link('(上移', Yii::app()->createUrl("node/" . $actionname . "/prevup", array("id" => $node->id)));
            echo CHtml::Link('下移)', Yii::app()->createUrl("node/" . $actionname ."/nextup", array("id" => $node->id)));
            echo CHtml::openTag('a', array('href' => Yii::app()->createUrl("node/" . $actionname . "/update", array("id" => $node->id))));
            echo CHtml::encode("更新");
            echo CHtml::closeTag('a');
            echo CHtml::openTag('a', array("class" => "delete", 'href' => Yii::app()->createUrl("node/" . $actionname . "/delete", array("id" => $node->id))));
            echo CHtml::encode("删除");
            echo CHtml::closeTag('a');
            echo CHtml::closeTag('span');




            $level = $node->level;
        }

        for ($i = $level; $i; $i--) {
            echo CHtml::closeTag('li') . "\n";
            echo CHtml::closeTag('ul') . "\n";
        }
    }

    public static function printULTree_noAnchors() {
        $nodes = Node::model()->findAll(array('order' => 'lft'));
        $level = 0;

        foreach ($nodes as $n => $node) {
            if ($node->level == $level)
                echo CHtml::closeTag('li') . "\n";
            else if ($node->level > $level)
                echo CHtml::openTag('ul') . "\n";
            else {         //if $node->level<$level
                echo CHtml::closeTag('li') . "\n";

                for ($i = $level - $node->level; $i; $i--) {
                    echo CHtml::closeTag('ul') . "\n";
                    echo CHtml::closeTag('li') . "\n";
                }
            }

            echo CHtml::openTag('li');
            echo CHtml::encode($node->catalog_name);
            $level = $node->level;
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
    public static function findAllPluginTree($plugin_id) {
        $typename = Node::NODE_CATALOG;
        $rootnode = self::findRoot($typename);
        if ($rootnode == NULL)
            return;

        $criteria = new CDbCriteria;
        $criteria->with='catalog';
        $criteria->compare('root', $rootnode->id);
        $criteria->compare('catalog.plugin_id', $plugin_id);
        $nodes = Node::model()->findAll($criteria);

        return $nodes;
    }



    public static function findRoot() {
        $type = Node::NODE_CATALOG;
        $rootnode = Node::model()->find(array('condition' => 'type=:type', 'params' => array(':type' => $type)));
        return $rootnode;
    }

    public static function findAllTree() {
        $typename = Node::NODE_CATALOG;
        $rootnode = self::findRoot($typename);
        if ($rootnode == NULL)
            return;

        $criteria = new CDbCriteria;
        $criteria->with='catalog';
        $criteria->compare('root', $rootnode->id);
        $criteria->order = "root,lft";
        $nodes = Node::model()->findAll($criteria);

        return $nodes;
    }
    public static function findAllTree_noRoot() {
        $criteria->with='catalog';
        $typename = Node::NODE_CATALOG;
        $rootnode = self::findRoot($typename);
        if ($rootnode == NULL)
            return;

        $criteria = new CDbCriteria;
        $criteria->addNotInCondition('id', array($rootnode->id));
        $criteria->compare('root', $rootnode->id);
        $criteria->order = "root,lft";
        $nodes = Node::model()->findAll($criteria);

        return $nodes;
    }

    public static function selectTreeData($nodes) {

        $treeSelect = array();
        $level = 0;
        //如果nodes为NULL， 则默认他为数组 不报错
        if ($nodes == NULL)
            $nodes = array();

        foreach ($nodes as $node) {
            $treeSelect[$node->id] = self::getOptionlevel($node->level) . $node->catalog_name;
        }
        return $treeSelect;
    }

    public static function selectChildTreeData($nodes) {

        $treeSelect = array();
        $level = 0;
        //如果nodes为NULL， 则默认他为数组 不报错
        if ($nodes == NULL)
            $nodes = array();

        foreach ($nodes as $node) {
            $treeSelect[$node->id] = self::getOptionlevel($node->level-1) . $node->catalog_name;
        }
        return $treeSelect;
    }



}