<?php

/**
 * @version   Article.php  17:53 2013年09月11日
 * @author    poctsy <poctsy@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 */


/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property integer $id
 * @property integer $catalog_id
 * @property string $title
 * @property string $keyword
 * @property string $thumb
 * @property string $description
 * @property integer $user_id
 * @property integer $view_count
 * @property string $create_time
 * @property string $content
 * @property string $images
 * @property string $picture
 * @property string $file
 *
 */
class Post extends FActiveRecord {

    /**
     * @return string the associated database table name
     */


    public $catalog_id;
    public $catalog_name;

    public function tableName() {
        return '{{post}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(

            array('catalog_id,content,images,picture,file,catalog_name','safe'),
            array('title,catalog_id', 'required'),
            array('user_id, view_count,catalog_id', 'numerical', 'integerOnly'=>true),

            array('title, thumb', 'length', 'max'=>100),
            array('keyword, description', 'length', 'max'=>30),

            array('title,thumb,keyword,description,catalog_name', 'filter', 'filter' => array($this, 'Purify')),
            array('content,images,picture,file', 'filter', 'filter' => array($this, 'contentPurify')),

            // @todo Please remove those attributes that should not be searched.
            array('id,title, content,images,picture,file,catalog_name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'catalog'=>array(self::BELONGS_TO, 'Catalog', 'catalog_id'),

        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'catalog_name'=>'栏目名称',
            'catalog_id' => '所属栏目',
            'title' => '标题',
            'keyword' => '网页关键字(SEO)',
            'thumb' => '缩略图',
            'description' => '网页描述(SEO)',
            'content' => '内容',
            'picture' => '图片地址',
            'images' => '图集',
            'file' => '文件地址',

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
        $criteria->with= array('catalog');
        $criteria->compare('catalog.name', $this->catalog_name, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('id', $this->id);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('images', $this->images, true);
        $criteria->compare('picture', $this->picture, true);
        $criteria->compare('file', $this->file, true);

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
     * @return Article the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    public function afterFind(){
        if(!$this->isNewRecord){
            $this->catalog_name=$this->catalog->name;
        }
    }


    public function beforeSave(){
        if($this->user_id==NULL){
            $this->user_id="";
        }

        return true;
    }

    public function list_view($name){
        $catalog=Catalog::nameGet($name);
        return $catalog->list_view;
    }

    public function content_view($id){
        $model=Post::model()->findByPk($id);
        return $model->catalog->content_view;
    }

}
