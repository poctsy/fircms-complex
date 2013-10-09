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
 * @property string $prefix
 * @property string $path
 */
class Plugin extends CActiveRecord
{
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
                        array('name,en_name,listprefix,prefix, path', 'filter', 'filter' => array($this, 'contentPurify')),
			array('name,en_name, path', 'required'),
			array('listprefix,prefix,name,en_name, path', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name,en_name, listprefix,prefix, path', 'safe', 'on'=>'search'),
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
                        'en_name' => '英文名称',
                        'listprefix' => '列表页模板前缀',
			'prefix' => '内容页模板前缀',
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
		$criteria->compare('prefix',$this->prefix,true);
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
}

