<?php
/**
 * Created by PhpStorm.
 * User: kvp
 * Date: 17.12.2017
 * Time: 18:00
 */

namespace model;
use Core;
use model;

class Registration extends model\Users
{
    public function __construct()
    {
        $this->db = new model\Users('users');

    }

    public  function Registration($Parameter)
    {
       // password
        $params =$this->_getDecodeJson($Parameter);

           $this->db->username = $params['username'];
           $this->db->email = $params['email'];
           $this->db->first_name = $params['first_name'];
           $this->db->birthday = $params['birthday'];
           $this->db->password_hash =  $this->_SetHashPassword($params['username']);
           $this->db->created_at = date("Y-m-d H:i:s");

           return $this->_status($this->db->_addUser());

    }

    public function _status($status_response){
        $_response=array();

        switch ($status_response) {
            case 23000:
                http_response_code(400);
                $_response['code']="400";
                $_response['status']="This username or email is already registered";
                break;
            case 00000:
                http_response_code(200);
                $_response['code']="200";
                $_response['status']="OK!";
                break;

        }
        if($status_response!=00000 && $status_response!=23000):
       http_response_code($status_response);
        $_response['code']=$status_response;
        $_response['status']="error";
        endif;

        return $_response;
    }
}