<?php
/**
 * @author   poctsy  <poctsy@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 * @version   Page.php  16:21 2013年10月03日
 */



/**
 * This is the model class for table "{{page}}".
 *
 * The followings are the available columns in table '{{page}}':
 * @property integer $id
 * @property integer $catalog_id
 * @property string $content
 */
class Page extends FActiveRecord
{


    public $catalog_name;
    public $catalog_thumb;
    public $catalog_title;
    public $catalog_keyword;
    public $catalog_description;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{page}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('content,catalog_name,catalog_thumb,catalog_title,catalog_keyword,catalog_description','safe'),
            array('catalog_id', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, catalog_name,content', 'safe', 'on'=>'search'),

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
            'catalog'=>array(self::BELONGS_TO, 'Catalog', 'catalog_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'catalog_id' => 'Base',
            'content' => 'Content',
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
        $criteria->compare('content',$this->content,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Page the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function afterFind(){

        if($catalogModel=Catalog::model()->findByPk($this->catalog_id))
        {

            $this->catalog_name=$catalogModel->name;
            $this->catalog_thumb=$catalogModel->thumb;
            $this->catalog_title=$catalogModel->title;
            $this->catalog_keyword=$catalogModel->keyword;
            $this->catalog_description=$catalogModel->description;
        }
    }


}
