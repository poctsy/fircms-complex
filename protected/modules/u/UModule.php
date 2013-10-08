<?php
/**
* @author   poctsy  <poctsy@foxmail.com>
* @copyright Copyright (c) 2013 poctsy
* @link      http://www.fircms.com
* @version   UModule.php
*/

class UModule extends  FModule {


    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'u.models.*',
            'u.components.*',
        ));
       $this->setControllerPath($this->controllerPath);
       $this->setViewPath($this->viewPath);
  
       
    }

}
