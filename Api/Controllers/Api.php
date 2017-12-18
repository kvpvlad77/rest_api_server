<?php
namespace Controllers;
use Core;
use Couchbase\Exception;
use model;
class Api extends \Core\Controller
{


    public function login($data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') :



            return $this->render();
        endif;
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE'):


            return $this->render();
        endif;

        return $this->Bad_Request();
        }
   //Получение личных данных по secret_key GET
        public function Users($data)
        {
        if ('GET' === $this->REQUEST_METHOD()) {
            if ($this->_GetSecretKey($data)!=1) {

            $infouser = new \model\GetInfoUser();
            return $this->render($infouser->GetInfoUser("'" . $this->_GetSecretKey($data) . "'"));
        }
          http_response_code(401);
           return $this->render(array('401' => 'Unauthorized'));


        }
      //Авторизация пользователей POST
        if ('POST' === $this->REQUEST_METHOD()) {

            $params =new \model\Registration();

            return $this->render($params->Registration($_POST));
        }
       //Редактирование личных данных PUT
         if ('PUT' === $this->REQUEST_METHOD()):
            $params =new \model\EditorUser();

            return $this->render($params->edit($this->getContent()));
         endif;



        return $this->Bad_Request();
    }

    public function UserPhoto($data)
    {

        if ('PUT' === $this->REQUEST_METHOD()):

        print_r($data);
            file_put_contents ( 'Upload/2.jpg', file_get_contents('php://input') );

            $list =Core::$db->_getAuthKey("'463e4eca7e819aa8ca9'");

            return $this->render($list);
            // создаем запрос

       endif;

        if ('DELETE' === $this->REQUEST_METHOD()):
            $list =Core::$db->_getAuthKey("'463e4eca7e819aa8ca9'");


            return $this->render($this->getContent());
        endif;

            return $this->Bad_Request();

    }

    public function ChangePass($data)
    {
        if ('PUT' === $this->REQUEST_METHOD()):

            parse_str(file_get_contents('php://input'), $_PUT);

            return $this->render($this->getContent());

        endif;
            return $this->Bad_Request();
    }
}

