<?php
/**
 * Created by PhpStorm.
 * User: kvp
 * Date: 17.12.2017
 * Time: 21:50
 */

namespace model;
use Core;
use model;

class GetInfoUser
{
    public function __construct()
    {
        $this->db = new model\Users('users');

    }

    public  function GetInfoUser($Parameter)
    {

        $list = $this->db->_getUserInfoForAuthKey($Parameter);



        return $list;
    }


}