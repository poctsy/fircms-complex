<?php
/**
 * @version   FModule.php
 * @author   poctsy  <pocmail@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 */
class FModule extends CWebModule {

    public $flashSuccessKey;
    public $flashErrorKey;
    public $viewPath;  //模块加载的视图
    public $controllerPath; //模块加载的控制器


    //设置模块视图路径
    public function setViewPath($viewPath) {
        if (strcasecmp(Fircms::$app,Fircms::$adminapp) === 0) {
            if (!isset($viewPath)) {
                $viewPath = $this->getBasePath() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin';
            }
        } else {
            if (!isset($viewPath)) {
                $viewPath = $this->getBasePath() . DIRECTORY_SEPARATOR . 'views';
            }
        }
        CWebModule::setViewPath($viewPath);
    }

    //设置模块控制器路径
    public function setControllerPath($controllerPath) {

        if (strcasecmp(Fircms::$app,Fircms::$adminapp) === 0) {
            if (!isset($controllerPath)) {
                $controllerPath = $this->getBasePath() . DIRECTORY_SEPARATOR .'admin';
            }
        } else {
            if (!isset($controllerPath)) {
                $controllerPath = $this->getBasePath() . DIRECTORY_SEPARATOR .'controllers';
            }
        }
        CWebModule::setControllerPath($controllerPath);
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

}