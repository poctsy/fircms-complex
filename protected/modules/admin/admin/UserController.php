<?php
/**
* @version   UserController.php
* @author    poctsy <pocmail@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
* @link      http://www.fircms.com
*/

class UserController extends FController
{
    
       public $layout='//layouts/login';
	/**
	 * Declares class-based actions.
	 */
       	public function filters()
	{
		return array(
			'rights', 
		);
	}
        public function allowedActions() {
            return 'login,logout,error';
        }

        public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','Logout'),
				'users'=>array('@'),
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('user_error', $error);
		}
	}


	

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{       
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                 $user = User::model()->findBypk(Yii::app()->user->id);
                //记录当前ip 时间,记录过去的时间
                $user->last_login_time = $user->this_login_time;
                $user->last_login_ip = $user->this_login_ip;
                $user->this_login_time = time();
                $user->this_login_ip = Yii::app()->request->userHostAddress;
                $user->save();
                        $this->redirect(Yii::app()->user->returnUrl);}
		}
		// display the login form
		$this->render('user_login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout(false);
		$this->redirect(Yii::app()->homeUrl);
	}
}