<?php
/**
 * Created by PhpStorm.
 * User: kvp
 * Date: 13.12.2017
 * Time: 12:11
 */

namespace Core;

use Core;


class Default_Core
{

    public $defaultControllerName = 'api';

  //  public $defaultActionName = "index";

    public function launch()
    {

        list($controllerName, $actionName, $params) = Core::$router->resolve();

        echo $this->launchAction($controllerName, $actionName, $params);

    }


    public function launchAction($controllerName, $actionName, $params)
    {

      //  $controllerName = empty($controllerName)? $this->defaultControllerName : ucfirst($controllerName);
        if(!file_exists(ROOTPATH.DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.$controllerName.'.php')){
           new \Core\Error;
        }
        require_once ROOTPATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php';
        if(!class_exists("\\Controllers\\".ucfirst($controllerName))){
          new \Core\Error;
        }
        $controllerName = "\\Controllers\\".ucfirst($controllerName);
        $controller = new $controllerName;
        $actionName = empty($actionName) ? $this->defaultActionName : $actionName;
        if (!method_exists($controller, $actionName)){
            new \Core\Error;
        }

            return $controller->$actionName($params);

    }

}