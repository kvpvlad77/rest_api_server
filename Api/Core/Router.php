<?php
/**
 * Created by PhpStorm.
 * User: kvp
 * Date: 13.12.2017
 * Time: 11:23
 */

namespace Core;
use Core;
class Router

{

    public function resolve()
    {

        if (($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false) {
            $route = substr($_SERVER['REQUEST_URI'], 0, $pos);
        }

        $route = $_SERVER['REQUEST_URI'];
        $route = is_null($route) ? $_SERVER['REQUEST_URI'] : $route;
        $route = explode('/', $route);
        array_shift($route);
        $result[0] =array_shift($route);
        $result[1] = array_shift($route);
        $result[2] = $route;
        return $result;

    }
}