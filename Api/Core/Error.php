<?php
namespace Core;

use Core;
/**
 * Created by PhpStorm.
 * User: kvp
 * Date: 13.12.2017
 * Time: 12:43
 */
class Error
{
    public  $filename="_api.log";
    public function __construct()
    {
        // регистрация ошибок
        set_error_handler(array($this, 'OtherErrorCatcher'));

        // перехват критических ошибок
        register_shutdown_function(array($this, 'FatalErrorCatcher'));

        // создание буфера вывода
        ob_start();
    }

    public function OtherErrorCatcher($errno, $errstr)
    {
        // контроль ошибок:
        // - записать в лог
        return false;
    }

    public function FatalErrorCatcher()
    {
        $error = error_get_last();
        if (isset($error))
            if($error['type'] == E_ERROR
                || $error['type'] == E_PARSE
                || $error['type'] == E_COMPILE_ERROR
                || $error['type'] == E_CORE_ERROR  || $error['type'] == E_RECOVERABLE_ERROR)//||$error['type'] ==E_NOTICE)
            {
                ob_end_clean();	// сбросить буфер, завершить работу буфера

                // контроль критических ошибок:
                // - записать в лог
                // - вернуть заголовок 500
                // - вернуть после заголовка данные для пользователя
                http_response_code(500);
                foreach ($error as $value) {
                    error_log($value .'\n', 3, __DIR__."/Logs/" . $this->filename);
                }
            }
            else
            {
                //ob_end_flush();	// вывод буфера, завершить работу буфера
            }
        else
        {
            //ob_end_flush();	// вывод буфера, завершить работу буфера
        }
    }
}

