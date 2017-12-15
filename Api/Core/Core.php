<?php

class Core

{
    public static $router;

    public static $db;

    public static $Default_core;



    public static function init()
    {
        spl_autoload_register(['static','loadClass']);
        static::coreapi();
        set_exception_handler(['Core','handleException']);

    }

    public static function coreapi()
    {
        static::$router = new Core\Router();
        static::$Default_core = new Core\Default_Core();
        static::$db = new model\Users('users');


    }

    public static function loadClass ($className)
    {

        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        require_once ROOTPATH.DIRECTORY_SEPARATOR.$className.'.php';

    }

    public function handleException (Throwable $e)
    {

        if($e instanceof Core\Error) {
            echo static::$Default_core->launchAction('Error', 'error404', [$e]);
        }else{
            echo static::$Default_core->launchAction('Error', 'error500', [$e]);
        }

    }

}