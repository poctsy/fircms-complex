<?php
/**
 * @version   PasswordVerify.php
 * @author    poctsy <poctsy@foxmail.com>
 * @link https://github.com/poctsy/PasswordVerify
 *
 * without encryption, simply confusion
 *不带加密，只是对密码进行简单的混淆
 *
 * transmission in the client server password to shake hands with the simple confusion,
 * prevention of scampish software "accidentally" collect account password.
 *if need to strengthen the defense, please use RSA or HTTPS
 *在客户端与服务端握手间传输的密码进行简单的混淆，预防流氓软件"无意间"收集帐号密码。
 *需要加强防御力，请使用rsa或https
 *
 * If you want to clean the residue pairing password files, please use this method
 * 如需清空残留的密码配对文件，请使用这个类方法
 * $protect=new PasswordVerify;
 * $protect->delectAllVerify()
 *
 *Use the steps
 * 使用步骤：
 *
 * 1.Add 'PasswordVerify' directory,move PasswordVerify.php and PVW.php in the directory
 *在extensions下新建PasswordVerify目录。将(PasswordVerify.php 跟 PVW.php)文件拉进去。。
 *
 * 2.Add import components
 * 添加import组件
 * 'import' => array(
 *      'application.extensions.PasswordVerify.*'
 *  ),
 *
 * 3.Add in the password encryption transmission need to load the view page
 * 在需要加载的密码加密传输的视图页面添加
 *
 * <?php $this->widget('PVW');?>
 *
 *4.Modifying the controller
 * 修改控制器
 *
 *  if(isset($_POST['LoginForm']))
 *  {
 *     $protect=new PasswordVerify;
 *     $protect->post=$_POST['LoginForm'];
 *     $protect->deVerify();
 *     $model->attributes= $protect->post;
 *                  ...............................
 *
 */


class PasswordVerify extends CComponent
{


    /**
     * @var string
     * 密码配对的暂存目录名
     */
    public  $verifyDirectoryName='verify';

    /**
     * @var string
     * 表单id
     */
    public  $formId = 'LoginForm';

    /**
     * @var string
     * 表单密码字段名
     */
    public  $passwordName='password';

    /**
     * @var int
     * 随机数长度
     */
    public  $length=20;

    /**
     * @var string
     */
    public $temb1_direction='L';

    /**
     * @var string
     */
    public $temb2_direction='L';

    /**
     * @var string
     */
    public $temb3_direction='R';

    /**
     * @var string
     */
    public $temb4_direction='L';

    /**
     * @var string
     */
    public $temb5_direction='R';

    /***下面的属性不改动**/
    /**
     * @var string
     * 密码配对的暂存目录路径
     */
    public  $verifyDirectoryPath;

    /**
     * @var string
     * 密码配对文件的路径
     *
     */
    public  $verifyPath;

    /**
     * @var array
     * 所有密码配对名
     *
     */
    public  $allVerifyName=array();

    /**
     * @var  string
     * 密码配对名
     */
    public  $verifyName;

    /**
     * @var  string
     * 密码配对值
     */
    public  $verifyValue;

    /**
     * @var string
     * 表单密码字段id
     */
    public  $passwordId;

    public $enPasswordValue;

    /**
     * @var  string
     * 表单密码字段的value
     */
    public  $passwordValue;

    /**
     * @var array
     * 表单post数据
     */
    public  $post=array();




    public $temb1_positional_length;

    public $temb2_positional_length;

    public $temb3_positional_length;

    public $temb4_positional_length;

    public $temb5_positional_length;

    public $temb1_positional;

    public $temb2_positional;

    public $temb3_positional;

    public $temb4_positional;

    public $temb5_positional;

    public $temb1_key='';

    public $temb2_key='';

    public $temb3_key='';

    public $temb4_key='';

    public $temb5_key='';

    public $key='';

    public $decollator=',';

    public $temb1='';

    public $temb2='';

    public $temb3='';

    public $temb4='';

    public $temb5='';


    public $left_direction='L';

    public $right_direction='R';



    public function __construct()
    {
        $this->passwordId=$this->formId.'_'.$this->passwordName;
        $this->verifyDirectoryPath=Yii::app()->runtimePath.DIRECTORY_SEPARATOR.$this->verifyDirectoryName;
        $this->temb1_direction=$this->left_direction;
        $this->temb2_direction=$this->left_direction;
        $this->temb3_direction=$this->right_direction;
        $this->temb4_direction=$this->left_direction;
        $this->temb5_direction=$this->right_direction;

    }


    /**
     *制作密码配对的名称
     */
    private function makeVerifyName(){

        $k=$this->gemRanKey($this->length);
        $this->verifyName=$k;

    }

    /**
     *制作密码配对的值
     */
    private function makeVerifyValue(){

        $this->enAlgorithm();

    }


    /**
     * @return string
     *
     */
    private function enAlgorithm() {


        $this->temb1_positional_length=rand(1,2);
        $this->temb2_positional_length=rand(1,4);
        $this->temb3_positional_length=rand(1,4);
        $this->temb4_positional_length=rand(1,6);
        $this->temb5_positional_length=$this->length-$this->temb1_positional_length-$this->temb2_positional_length-$this->temb3_positional_length-$this->temb4_positional_length;
        $this->temb1_positional=rand(0,3);
        $this->temb2_positional=rand(0,6);
        $this->temb3_positional=rand(0,2);
        $this->temb4_positional=rand(0,9);
        $this->temb5_positional=rand(0,3);
        $this->temb1_key=$this->gemRanKey($this->temb1_positional_length);
        $this->temb2_key=$this->gemRanKey($this->temb2_positional_length);
        $this->temb3_key=$this->gemRanKey($this->temb3_positional_length);
        $this->temb4_key=$this->gemRanKey($this->temb4_positional_length);
        $this->temb5_key=$this->gemRanKey($this->temb5_positional_length);
        $this->temb1=$this->temb1_direction.$this->temb1_positional.$this->temb1_positional_length;
        $this->temb2=$this->temb2_direction.$this->temb2_positional.$this->temb2_positional_length;
        $this->temb3=$this->temb3_direction.$this->temb3_positional.$this->temb3_positional_length;
        $this->temb4=$this->temb4_direction.$this->temb4_positional.$this->temb4_positional_length;
        $this->temb5=$this->temb5_direction.$this->temb5_positional.$this->temb5_positional_length;
        $this->key=$this->temb1_key.$this->temb2_key.$this->temb3_key.$this->temb4_key.$this->temb5_key;
        $this->verifyValue=
            $this->temb1.$this->decollator.
            $this->temb2.$this->decollator.
            $this->temb3.$this->decollator.
            $this->temb4.$this->decollator.
            $this->temb5.$this->decollator.
            $this->key;
    }
    /**
     * @return string
     *
     */
    private function deAlgorithm() {

        $this->key='';
        $this->verifyName='';

        $array=str_split($this->passwordValue ,1);

        foreach($array as $key=>$value){

            if($key%2 != 1 && strlen($this->verifyName)< $this->length){

                $this->verifyName.=$value;
            }else{
                $this->enPasswordValue.=$value;

            }
        }

        $enPasswordArray=str_split($this->enPasswordValue ,1);
        $enPasswordArray2=array_reverse($enPasswordArray);

        $this->enPasswordValue='';
        foreach($enPasswordArray2 as $value){
            $this->enPasswordValue.=$value;

        }


        $this->verifyPath=$this->verifyDirectoryPath.DIRECTORY_SEPARATOR.$this->verifyName;
        $this->readVerify();


        foreach ($arr=explode($this->decollator,$this->verifyValue) as $key=>$value){

            if($key==0){
                $this->temb1_direction=substr($value,0,1);
                $this->temb1_positional=substr($value,1,1);
                $this->temb1_positional_length=substr($value,2);

            }elseif($key==1){
                $this->temb2_direction=substr($value,0,1);
                $this->temb2_positional=substr($value,1,1);
                $this->temb2_positional_length=substr($value,2);
            }elseif($key==2){
                $this->temb3_direction=substr($value,0,1);
                $this->temb3_positional=substr($value,1,1);
                $this->temb3_positional_length=substr($value,2);
            }elseif($key==3){
                $this->temb4_direction=substr($value,0,1);
                $this->temb4_positional=substr($value,1,1);
                $this->temb4_positional_length=substr($value,2);
            }elseif($key==4){
                $this->temb5_direction=substr($value,0,1);
                $this->temb5_positional=substr($value,1,1);
                $this->temb5_positional_length=substr($value,2);
            }elseif($key==5){
                $this->key=$value;
            }
            $this->temb1_key=substr($this->key,0,$this->temb1_positional_length);
            $this->temb2_key=substr($this->key,$this->temb1_positional_length,$this->temb2_positional_length);
            $this->temb3_key=substr($this->key,$this->temb1_positional_length+$this->temb2_positional_length,$this->temb3_positional_length);
            $this->temb4_key=substr($this->key,$this->temb1_positional_length+$this->temb2_positional_length+$this->temb3_positional_length,$this->temb4_positional_length);
            $this->temb5_key=substr($this->key,$this->temb1_positional_length+$this->temb2_positional_length+$this->temb3_positional_length+$this->temb4_positional_length,$this->temb5_positional_length);
        }



        if($this->temb5_direction == $this->left_direction){
            $this->enPasswordValue=substr_replace($this->enPasswordValue,'',$this->temb5_positional,$this->temb5_positional_length);
        }else{

            $this->enPasswordValue=substr_replace($this->enPasswordValue,'',strlen($this->enPasswordValue)-$this->temb5_positional-$this->temb5_positional_length,$this->temb5_positional_length);
        }

        if($this->temb4_direction == $this->left_direction){
            $this->enPasswordValue=substr_replace($this->enPasswordValue,'',$this->temb4_positional,$this->temb4_positional_length);
        }else{
            $this->enPasswordValue=substr_replace($this->enPasswordValue,'',strlen($this->enPasswordValue)-$this->temb4_positional-$this->temb4_positional_length,$this->temb4_positional_length);
        }

        if($this->temb3_direction == $this->left_direction){
            $this->enPasswordValue=substr_replace($this->enPasswordValue,'',$this->temb3_positional,$this->temb3_positional_length);
        }else{
            $this->enPasswordValue=substr_replace($this->enPasswordValue,'',strlen($this->enPasswordValue)-$this->temb3_positional-$this->temb3_positional_length,$this->temb3_positional_length);
        }

        if($this->temb2_direction == $this->left_direction){
            $this->enPasswordValue=substr_replace($this->enPasswordValue,'',$this->temb2_positional,$this->temb2_positional_length);
        }else{
            $this->enPasswordValue=substr_replace($this->enPasswordValue,'',strlen($this->enPasswordValue)-$this->temb2_positional-$this->temb2_positional_length,$this->temb2_positional_length);
        }

        if($this->temb1_direction == $this->left_direction){
            $this->enPasswordValue=substr_replace($this->enPasswordValue,'',$this->temb1_positional,$this->temb1_positional_length);
        }else{
            $this->enPasswordValue=substr_replace($this->enPasswordValue,'',strlen($this->enPasswordValue)-$this->temb1_positional-$this->temb1_positional_length,$this->temb1_positional_length);
        }

        $this->passwordValue=$this->enPasswordValue;

    }

    /**
     * @param $length
     * @return string
     * 生成随机字母
     */
    private function gemRanKey($length) {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }


    /**
     *删除密码配对文件
     */
    private function delectVerify(){
        if(is_file($this->verifyPath)) {
            unlink($this->verifyPath);
        }

    }

    /**
     *读取密码配对文件
     */
    private function readVerify(){

        if(is_file($this->verifyPath)) {
            $this->verifyValue=file_get_contents($this->verifyPath);
        }
    }

    /**
     *创建密码配对库的暂存目录
     */
    private function createVerifyDirectory(){
        if(!file_exists($this->verifyDirectoryPath)){
            mkdir($this->verifyDirectoryPath);}
    }



    /**
     *加混淆
     */
    public function enVerify(){
        $this->createVerifyDirectory();
        $this->makeVerifyName();
        $this->makeVerifyValue();
        $this->verifyPath=$this->verifyDirectoryPath.DIRECTORY_SEPARATOR.$this->verifyName;

        if(!is_file($this->verifyPath)) {
            $fp=fopen($this->verifyPath,"w+");
            $str=$this->verifyValue;
            fputs($fp,$str);
            fclose($fp);
        }
    }

    /**
     *解混淆
     */
    public function deVerify(){
        $this->passwordValue=$this->post[$this->passwordName];
        $this->deAlgorithm();
        $this->post[$this->passwordName]=$this->passwordValue;
        //$this->delectVerify();
    }

    /**
     *清空残留的密码配对文件
     */
    public function delectAllVerify(){
        if(file_exists($this->verifyDirectoryPath)){
            if(count($this->allVerifyName=scandir($this->verifyDirectoryPath))>2){
                foreach($this->allVerifyName as $this->verifyName){
                    if($this->verifyName !='.' && $this->verifyName !='..'){
                        $this->verifyPath=$this->verifyDirectoryPath.DIRECTORY_SEPARATOR.$this->verifyName;
                        $this->delectVerify();
                    }
                }
            };
        }

    }

}
?>
