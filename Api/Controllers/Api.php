<?php
namespace Controllers;
use Core;
class Api extends \Core\Controller
{


    public function login($data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sequential = array("a" => "1", "b" => "2", "c" => "3", "d" => "4", "e" => "65");
            $sql = "SELECT id,username FROM users";
            $list = Core::$db->execute($sql);


            return $this->render($list);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE'):
            $sequential = array("a" => "1", "b" => "2", "c" => "3", "d" => "4", "e" => "65");
            $sql = "SELECT id,username FROM users";
            $list = Core::$db->execute($sql);


            return $this->render($list);
        endif;

        return $this->Bad_Request();
    }

    public function Users($data)
    {
        if ('GET' === $this->REQUEST_METHOD()) {

            $list =Core::$db->_getAuthKey("'Gw5nCCnbFxMuXo6aY_kfO85zjBuUYUHi'");
            parse_str($data[0], $output);

            Core::$db->id='';
            Core::$db->username=$output["name"];
            Core::$db->email=$output["email"];
            Core::$db->_addUser();

            return $this->render($list);
        }
        if ('POST' === $this->REQUEST_METHOD()) {
            $list =Core::$db->_getAuthKey("'Gw5nCCnbFxMuXo6aY_kfO85zjBuUYUHi'");

            return $this->render($list);

            return $this->render($_POST);
        }


         if ('PUT' === $this->REQUEST_METHOD()):

            return $this->render($this->getContent());
         endif;



        return $this->Bad_Request();
    }

    public function UserPhoto($data)
    {

        if ('PUT' === $this->REQUEST_METHOD()):

        print_r($data);
            file_put_contents ( 'Upload/2.jpg', file_get_contents('php://input') );

            $list =Core::$db->_getAuthKey("'Gw5nCCnbFxMuXo6aY_kfO85zjBuUYUHi'");

            return $this->render($list);
            // создаем запрос


            return $this->render($list);

       endif;

        if ('DELETE' === $this->REQUEST_METHOD()):
            $list =Core::$db->_getAuthKey("'Gw5nCCnbFxMuXo6aY_kfO85zjBuUYUHi'");


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

