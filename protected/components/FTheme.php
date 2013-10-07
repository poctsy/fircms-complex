<?php
class FTheme extends CTheme
{

    /**
     * Finds the layout file for the specified controller's layout.
     * @param CController $controller the controller
     * @param string $layoutName the layout name
     * @return string the layout file path. False if the file does not exist.
     */
    public function getLayoutFile($controller,$layoutName)
    {
        $moduleViewPath=$basePath=$this->getViewPath();
        $module=$controller->getModule();
        if(empty($layoutName))
        {
            while($module!==null)
            {
                if($module->layout===false)
                    return false;
                if(!empty($module->layout))
                    break;
                $module=$module->getParentModule();
            }
            if($module===null)
                $layoutName=Yii::app()->layout;

            else
            {
                $layoutName=$module->layout;
                $moduleViewPath.='/'.$module->getId();
            }
        }
        elseif($module!==null)
            $moduleViewPath.='/'.$module->getId();


        return $controller->resolveViewFile($layoutName,dirname($moduleViewPath).'/layouts',$basePath,$moduleViewPath);
    }
}
