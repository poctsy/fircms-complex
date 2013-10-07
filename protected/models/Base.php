<?php
/**
* @version   Base.php  23:00 2013年09月10日
* @author    poctsy <pocmail@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
* @link      http://www.fircms.com
*/



/**
 * This is the model class for table "{{base}}".
 *
 * The followings are the available columns in table '{{base}}':
 * @property integer $id
 * @property integer $catalog_id
 * @property integer $type
 * @property string $title
 * @property string $keyword
 * @property string $thumb
 * @property string $description
 * @property integer $user_id
 * @property integer $view_count
 * @property string $create_time
 */
class Base extends FActiveRecord
{



	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{base}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                       
            array('title, keyword,thumb, description', 'filter', 'filter' => array($this, 'Purify')),
			array('catalog_id, type, title,', 'required'),
			array('catalog_id, type, user_id, view_count', 'numerical', 'integerOnly'=>true),
			array('title, thumb', 'length', 'max'=>100),
			array('keyword, description', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, catalog_id, type, title, keyword, thumb, description, user_id, view_count, create_time', 'safe', 'on'=>'search'),
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
             'images'=>array(self::HAS_ONE, 'Images', 'base_id'),
             'catalog'=>array(self::BELONGS_TO, 'Catalog', 'catalog_id' ,'with'=>'node'),


		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'catalog_id' => '所属栏目',
			'title' => '标题',
			'keyword' => '网页关键字(SEO)',
			'thumb' => '缩略图',
			'description' => '网页描述(SEO)',
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
		$criteria->compare('catalog_id',$this->catalog_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('keyword',$this->keyword,true);
		$criteria->compare('thumb',$this->thumb,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('view_count',$this->view_count);
		$criteria->compare('create_time',$this->create_time,true);

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
	 * @return Base the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    //兼容sqlite数据库的处理.mysql下可删除     。会员发布善为开发，预留user_id字段
    public function beforeSave(){
        if($this->user_id==NULL){
            $this->user_id="";
        }

        return true;
    }
}
