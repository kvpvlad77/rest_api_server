<?php

namespace Core;

use Core;

class Controller
{
    public  $filename="_api.log";



   public function REQUEST_METHOD(){

       return $_SERVER['REQUEST_METHOD'];
   }

    public function renderJson ($body)
    {


        return json_encode($body);

    }

    public function render (array $params = [])
    {
        if(is_array($params)):
        header("Content-type:application/json");
        return $this->renderJson($params);
        endif;
    }


    public function Logger($errmsg)
    {
     return false;
    }
    public function Bad_Request()
    {
        header('HTTP/1.0 400 Bad Request');
        return $this->renderJson(array('error' => 'Bad Request'));
    }

    public function getContent()
    {
        if ('PUT' === $this->REQUEST_METHOD()):

            if (0<strlen(trim($this->content = file_get_contents('php://input')))) {

                parse_str(file_get_contents('php://input'), $_VARS_REQUEST);

                return $_VARS_REQUEST;

            }
        endif;
        if ('DELETE' === $this->REQUEST_METHOD()):

            if (0<strlen(trim($this->content = file_get_contents('php://input')))) {

                parse_str(file_get_contents('php://input'), $_VARS_REQUEST);

                return $_VARS_REQUEST;

            }
        endif;

    }

    public function _GetSecretKey($data){

        parse_str($data[0], $output);
        if(!empty($output['secret_key'])) {
        return $output['secret_key'];
        }
        return 1;

    }
}