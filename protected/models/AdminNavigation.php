<?php
/**
 * @version   AdminNavigation.php  10:45 2013年09月28日
 * @author    poctsy <poctsy@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
*/



/**
 * This is the model class for table "{{adminnavigation}}".
 *
 * The followings are the available columns in table '{{adminnavigation}}':
 * @property integer $id
 * @property string $node_id
 * @property string $type
 * @property string $url
 */
class AdminNavigation extends FActiveRecord
{

         const LEVEL = "…";
         public $parent;
         public $root=1;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{adminnavigation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('root','required','on'=>'parent'),
            array('parent,url','required','on'=>'child'),
            array('node_id,name','required'),
            array('node_id,type', 'unique'),
            array('thumb','safe'),
            array('parent,node_id,root', 'numerical', 'integerOnly' => true),
			array('node_id', 'length', 'max'=>11),
			array('type', 'length', 'max'=>20),
			array('url', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('node_id, type,url', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                      'node' => array(self::BELONGS_TO, 'Node', 'node_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'name'=>'名称',
            'type' => '导航条调用参数',
            'thumb' => '缩略图',
            'url' => '链接',
            'parent'=>'导航条',
         
		);
	}

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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('node_id',$this->node_id,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>20,
            )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdminNavigation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);

	}



    //兼容sqlite数据库的处理.mysql下可删除
    public function beforeSave(){

        if($this->url==NULL){
            $this->url="";
        }
        if($this->type==NULL){
            $this->type="";
        }

        return true;
    }


    public static function printULTree() {

            $type = Node::NODE_ADMINNAVIGATION;
            $actionname = 'adminnavigation';

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

            echo CHtml::openTag('li', array('id' => 'node_' . $node->id, 'rel' => $node->adminnavigation_name));
            echo CHtml::openTag('span');
            echo CHtml::encode($node->adminnavigation_name);
            echo CHtml::decode('&nbsp;&nbsp;&nbsp;');
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
            echo CHtml::encode($node->adminnavigation_name);
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
        $typename = Node::NODE_ADMINNAVIGATION;
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
      $type = Node::NODE_ADMINNAVIGATION;

        $rootnode = Node::model()->find(array('condition' => 'type=:type', 'params' => array(':type' => $type)));
        return $rootnode;
    }

    public static function findAllTree() {
        $typename = Node::NODE_ADMINNAVIGATION;
        $rootnode = self::findRoot($typename);
        if ($rootnode == NULL)
            return;

        $criteria = new CDbCriteria;
        $criteria->compare('root', $rootnode->id);
        $criteria->order = "root,lft";
        $nodes = Node::model()->findAll($criteria);

        return $nodes;
    }
    public static function findAllTree_noRoot() {
        $typename = Node::NODE_ADMINNAVIGATION;
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
            $treeSelect[$node->id] = self::getOptionlevel($node->level) . $node->adminnavigation_name;
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
            $treeSelect[$node->id] = self::getOptionlevel($node->level-1) . $node->adminnavigation_name;
        }
        return $treeSelect;
    }





}

