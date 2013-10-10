<?php
/**
 * @version   FController.php
 * @author   poctsy  <poctsy@foxmail.com>
 * @copyright Copyright (c) 2013 poctsy
 * @link      http://www.fircms.com
 */
class FController extends Controller {

    /**
     * @var string the default layout for the controller view. Defaults to 'column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $items=array();
    public $layout = '//layouts/column1';
    public $plugin_id;

    public function catalogList($pluginname) {

        $pluginId = Plugin::nameGetId($pluginname);
        $pluginTree=Catalog::findPluginTree($pluginId);
        $catalogList = Catalog::makeSelectTreeChild($pluginTree);
        return $catalogList;
    }


    
    final public function resolveViewFile($viewName, $viewPath, $basePath, $moduleViewPath = null) {
        if (empty($viewName))
            return false;

        if ($moduleViewPath === null)
            $moduleViewPath = $basePath;

        if (($renderer = Yii::app()->getViewRenderer()) !== null)
            $extension = $renderer->fileExtension;
        else
            $extension = '.php';
        if ($viewName[0] === '/') {
            if (strncmp($viewName, '//', 2) === 0)
                $viewFile = $basePath . $viewName;
            else
                $viewFile = $moduleViewPath . $viewName;
        }
        elseif (strpos($viewName, '.'))
            $viewFile = Yii::getPathOfAlias($viewName);
        else
            $viewFile = dirname($viewPath) . DIRECTORY_SEPARATOR . $viewName;

        if (is_file($viewFile . $extension))
            return Yii::app()->findLocalizedFile($viewFile . $extension);
        elseif ($extension !== '.php' && is_file($viewFile . '.php'))
            return Yii::app()->findLocalizedFile($viewFile . '.php');
        else
            return false;
    }

}
