<?php
/**
 * Created by PhpStorm.
 * User: kvp
 * Date: 17.12.2017
 * Time: 15:45
 */

namespace model;
use Core;
use model;
class EditorUser extends model\Users
{
  private $db;

public function __construct()
{
    $this->db = new model\Users('users');
}

public  function edit($Parameter)
{

 $params =$this->_getDecodeJson($Parameter);

    if($this->db->_getFullUserInfoForAuthKey("'".$params['secret_key']."'")){

        $this->db->username = $params['username'];
        $this->db->email = $params['email'];
        $this->db->first_name = $params['first_name'];
        $this->db->birthday = date("Y-m-d H:i:s");
        $this->db->urlphoto = $params['urlphoto'];
        $this->db->created_at = $params['created_at'];
        $this->db->flags =$params['flags'];
        $this->db->_EditUser();

//return ;
    }



    return array('error' => 'Bad Request');
}
}