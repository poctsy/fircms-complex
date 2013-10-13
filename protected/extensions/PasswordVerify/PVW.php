<?php
/**
 * @version   PVW.php
 * @author    poctsy <poctsy@foxmail.com>
 * @link https://github.com/poctsy/PasswordVerify
 *
 * without encryption, simply confusion
 *不带加密，只是对密码的进行简单的混淆
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


class PVW extends CWidget
{

    public function run()
    {
        $protect=new PasswordVerify;

        $protect->enVerify();

        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript("jquery");
        $cs->registerScript("protect", "
        $('#$protect->passwordId').attr('value','')
        $(':submit').click(function(){
         var password=$('#$protect->passwordId').attr('value');
         if(password =='')return;
         if($('#$protect->passwordId').hasClass('hasVerify')==false)
         {

 if('$protect->temb1_direction' == '$protect->left_direction'){
 var password1=password.substring(0,$protect->temb1_positional)+'$protect->temb1_key'+password.substring($protect->temb1_positional,password.length);}
  if('$protect->temb1_direction' == '$protect->right_direction'){
 var password1=password.substring(0,password.length-$protect->temb1_positional)+'$protect->temb1_key'+password.substring(password.length-$protect->temb1_positional,password.length);}

  if('$protect->temb2_direction' == '$protect->left_direction'){
 var password2=password1.substring(0,$protect->temb2_positional)+'$protect->temb2_key'+password1.substring($protect->temb2_positional,password1.length);}
   if('$protect->temb2_direction' == '$protect->right_direction'){
 var password2=password1.substring(0,password1.length-$protect->temb2_positional)+'$protect->temb2_key'+password1.substring(password1.length-$protect->temb2_positional,password1.length);}

   if('$protect->temb3_direction' == '$protect->left_direction'){
 var password3=password2.substring(0,$protect->temb3_positional)+'$protect->temb3_key'+password2.substring($protect->temb3_positional,password2.length);}
  if('$protect->temb3_direction' == '$protect->right_direction'){
 var password3=password2.substring(0,password2.length-$protect->temb3_positional)+'$protect->temb3_key'+password2.substring(password2.length-$protect->temb3_positional,password2.length);}

   if('$protect->temb4_direction' == '$protect->left_direction'){
 var password4=password3.substring(0,$protect->temb4_positional)+'$protect->temb4_key'+password3.substring($protect->temb4_positional,password3.length);}
    if('$protect->temb4_direction' == '$protect->right_direction'){
 var password4=password3.substring(0,password3.length-$protect->temb4_positional)+'$protect->temb4_key'+password3.substring(password3.length-$protect->temb4_positional,password3.length);}

  if('$protect->temb5_direction' == '$protect->left_direction'){
 var password5=password4.substring(0,$protect->temb5_positional)+'$protect->temb5_key'+password4.substring($protect->temb5_positional,password4.length);}

 if('$protect->temb5_direction' == '$protect->right_direction'){
 var password5=password4.substring(0,password4.length-$protect->temb5_positional)+'$protect->temb5_key'+password4.substring(password4.length-$protect->temb5_positional,password4.length);}
        var str='$protect->verifyName';
        var arr=str.split('');
        var str2=password5;
        var arr2=str2.split('').reverse();
          $.each(arr,function(index,value){
           arr2[index]=value+arr2[index];
          })

         var newPassword=arr2.join('');
         }
        $('#$protect->passwordId').attr('value',newPassword)
        $('#$protect->passwordId').addClass('hasVerify')
        });
     ");


    }

}