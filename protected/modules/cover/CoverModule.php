<?php
/**
* cover module class file.
*
* @author poc <pocmail@foxmail.com>
* @copyright Copyright &copy; 2013 poc
* @version 0.4.0
* 
* change the default
* 模块管理控制器统一规范  采用驼峰式写法，前缀Q 例如:QManage
*

*/
class CoverModule extends FModule
{



    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'cover.models.*',
            'cover.components.*',
        ));
         $this->setControllerPath($this->controllerPath);
         $this->setViewPath($this->viewPath);
 
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
