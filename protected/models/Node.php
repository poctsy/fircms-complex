<?php
/**
 * @version   Node.php  13:08 2013年09月26日
 * @author    poctsy <pocmail@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 */

/**
 * This is the model class for table "{{node}}".
 *
 * The followings are the available columns in table '{{node}}':
 * @property integer $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level

 */
class Node extends FActiveRecord {

    const NODE_CATALOG = 1;
    const NODE_NAVIGATION = 2;
    const NODE_ADMINNAVIGATION = 3;
    const NODE_ROOT = 0;


    public $catalog_name;
    public $navigation_name;
    public $adminnavigation_name;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{node}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('catalog_name,navigation_name,adminnavigation_name','safe'),
            array('type', 'unique'),
            array('level', 'numerical', 'integerOnly' => true),
            array('root, lft', 'length', 'max' => 11),
            array('rgt', 'length', 'max' => 10),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.

            array('id, root, lft, rgt, level', 'safe', 'on' => 'search'),
        );
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
                'hasManyRoots' => true
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'catalog' => array(self::HAS_ONE, 'Catalog', 'node_id'),
            'base' => array(self::HAS_ONE, 'Base', 'base_id'),
            'navigation' => array(self::HAS_ONE, 'Navigation', 'node_id'),
            'adminnavigation' => array(self::HAS_ONE, 'AdminNavigation', 'node_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'thumb'=>'缩略图',
            'title' => '网页标题',
            'keyword' => '网页关键字(SEO)',
            'description' => '网页描述(SEO)',
            'type' => '栏目模式',
            'url' => '栏目网址',
            'plugin_id' => '文章类型',
            'list_view' => '栏目页模板',
            'content_view' => '内容页模板',
            'content' => '单页内容',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('root', $this->root, true);
        $criteria->compare('lft', $this->lft, true);
        $criteria->compare('rgt', $this->rgt, true);
        $criteria->compare('level', $this->level);


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
     * @return Node the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave(){

        if($this->root==NULL){
            $this->root="";
        }
        return true;
    }

    public function  afterFind(){
        if($this->catalog !=NULL){
        $this->catalog_name=$this->catalog->name;
        }
        if($this->adminnavigation !=NUll){
            $this->adminnavigation_name=$this->adminnavigation->name;
        }
        if($this->navigation !=NUll){
            $this->navigation_name=$this->navigation->name;
        }
    }

}
