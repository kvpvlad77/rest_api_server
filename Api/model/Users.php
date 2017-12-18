<?php
/**
 * Created by PhpStorm.
 * User: kvp
 * Date: 15.12.2017
 * Time: 0:54
 */

namespace model;

use Core;
class Users extends Core\BaseModel
{

    public function _getUserInfoForAuthKey($authkey){

            $select = array(
                'where' => 'secret_key =' . $authkey . ''
            );
            $field = array('first_name','last_name', 'birthday','urlphoto', 'email');

            $usersInfo = $this->_getFieldResult($select, $field); // получаем все строки

            return $usersInfo; // выводим данные




    }
    public function _getFullUserInfoForAuthKey($authkey){
        if($authkey):
        $select = array(
            'where' => 'secret_key ='.$authkey.''
        );

        $usersInfo = $this->_getResult($select); // получаем все строки

        return $usersInfo; // выводим данные
         endif;
    }


    public function _addUser()
    {
     return $this->save();

    }

    public function _EditUser()
    {
        return $this->update();
    }

    protected function _getDecodeJson($json){

        $data = json_decode(json_encode($json),true);
        return $data;
    }

    protected function _SetHashPassword($passwod){

        $hash = password_hash($passwod, PASSWORD_DEFAULT);
        return $hash;
    }

    protected  function _GetOneRow(){

        $this->getOneRow();
    }

}