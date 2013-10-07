<?php
/**
* @version   AttachmentModule.php  11:34 2013年09月12日
* @author    poctsy <pocmail@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
* @link      http://www.fircms.com
*/
class AttachmentModule extends FModule
{



    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'attachment.models.*',
            'attachment.components.*',
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
