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
    public $id;
    public $username;
    public $email;
    public $birthday;
    public $urlphoto;
    public $password;
    public $auth_key;
    public $created_at;
    public $flags;


    public function execute($query, array $params=null){

        if(is_null($params)){
            $result = $this->pdo->query($query);
            return $result->fetch();
        }
        $result = $this->pdo->prepare($query);
        $result->execute($params);
        return $result->fetch();
    }

    public function _getAuthKey($authkey){
        $select = array(
            'where' => 'auth_key ='.$authkey.''
        );

        $usersInfo = $this->_getResult($select); // получаем все строки

        return $usersInfo; // выводим данные

    }
    public function _addUser()
    {
        $this->save();
    }

}