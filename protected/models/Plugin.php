<?php
/**
 * @version   Plugin.php  23:41 2013年09月17日
 * @author    poctsy <poctsy@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 */




/**
 * This is the model class for table "{{plugin}}".
 *
 * The followings are the available columns in table '{{plugin}}':
 * @property integer $id
 * @property integer $name
 * @property string $second_prefix
 * @property string $path
 */
class Plugin extends CActiveRecord
{
    const LIST_MOULD = 1;
    const COVER_MOULD = 2;
    const SINGLEPAGE_MOULD = 3;
    const OTHER_MOULD = 4;
    const LINK_MOULD = 5;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{plugin}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('en_name', 'unique'),
            array('type', 'numerical', 'integerOnly'=>true),
            array('name,en_name,first_prefix,second_prefix, path', 'filter', 'filter' => array($this, 'contentPurify')),
            array('name,en_name,type, path', 'required'),
            array('first_prefix,second_prefix,name,en_name, path', 'length', 'max'=>30),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name,en_name, first_prefix,second_prefix, path', 'safe', 'on'=>'search'),
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
            'catalogs'=>array(self::HAS_MANY,'Catalog','plugin_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => '模块名称',
            'en_name' => '控制器名称',
            'type'=>'模块类型',
            'first_prefix' => '栏目页模板前缀',
            'second_prefix' => '内容页模板前缀',
            'path' => '模块路径',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name);
        $criteria->compare('en_name',$this->en_name);
        $criteria->compare('second_prefix',$this->second_prefix,true);
        $criteria->compare('path',$this->path,true);

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
     * @return Plugin the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function contentPurify($value) {
        $p = new CHtmlPurifier();
        $p->options = array('HTML.Allowed' => 'b,p,br');
        $cleanHtml = $p->purify($value);
        return $cleanHtml;
    }

    public static function nameGetId($name){
        $plugin = Plugin::model()->find(array(
                'condition' => 'en_name=:plugin',
                'params' => array('plugin' => $name))
        );
        return $plugin->id;
    }


    public function sortView($type,$sort){
        $view=array();
        $model=Plugin::model()->findAll("type=?",array($type));
        foreach($model as $k){
            if($sort == 'first' && $k->path != '' && $k->first_prefix != '')
             $view[$k->en_name]=Fircms::getView($k->path,$k->first_prefix);
            if($sort == 'second'&& $k->path != '' && $k->second_prefix != '')
            $view[$k->en_name]=Fircms::getView($k->path,$k->second_prefix);
         }
         return array_filter($view);
    }

    public function first_view(){
        $list_first_view=Plugin::sortView(Plugin::LIST_MOULD,'first');
        $cover_first_view=Plugin::sortView(Plugin::COVER_MOULD,'first');
        $singlepage_first_view=Plugin::sortView(Plugin::SINGLEPAGE_MOULD,'first');
        $first_view=array_merge($list_first_view,$cover_first_view,$singlepage_first_view);
        return $first_view;
    }

    public function second_view(){
        $list_second_view=Plugin::sortView(Plugin::LIST_MOULD,'second');
        $cover_second_view=Plugin::sortView(Plugin::COVER_MOULD,'second');
        $singlepage_second_view=Plugin::sortView(Plugin::SINGLEPAGE_MOULD,'second');
        $second_view=array_merge($list_second_view,$cover_second_view,$singlepage_second_view);
        return $second_view;
    }

    public function pluginData($type){
        $data=array();
        $model=Plugin::model()->findAll("type=?",array($type));
        if($type == 1)$type='列表';
        if($type == 2)$type='封面';
        if($type == 3)$type='单页';
        if($type == 4)$type='其他';
        if($type == 5)$type='链接';
        foreach($model as $k){
            $ds[$type][$k->id]=$k->name;
        }

        return $ds;
    }

    public function everyPluginData(){
        $plugin_list=Plugin::pluginData(Plugin::LIST_MOULD);
        $plugin_cover=Plugin::pluginData(Plugin::COVER_MOULD);
        $plugin_singlepage=Plugin::pluginData(Plugin::SINGLEPAGE_MOULD);
        $plugin_other=Plugin::pluginData(Plugin::OTHER_MOULD);
        $plugin_id=array_merge($plugin_list,$plugin_cover,$plugin_singlepage,$plugin_other);
        return $plugin_id;
    }

    public function everyPlugin(){

        $plugin=array(Plugin::LIST_MOULD=>"列表模块",
            Plugin::COVER_MOULD=>'封面模块',
            Plugin::SINGLEPAGE_MOULD=>'单页模块',
            Plugin::OTHER_MOULD=>'其他模块');
        return $plugin;
    }

}

