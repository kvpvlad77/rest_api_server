<?php
/**
 * Created by PhpStorm.
 * User: kvp
 * Date: 15.12.2017
 * Time: 0:52
 */

namespace Core;
use Core;

Abstract class BaseModel
{

    public $pdo;
    protected $table;
    protected $dataResult;


    public function __construct($tableName=false)
    {

        $settings = $this->getPDOSettings();
        $this->pdo = new \PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
        //имя таблицы
        $this->table = $tableName;


    }

    protected function getPDOSettings()
    {

        $config = include ROOTPATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'ConfigDb.php';
        $result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $result['user'] = $config['user'];
        $result['pass'] = $config['pass'];
        return $result;
    }

    abstract public function execute($query, array $params=null);

    public function fieldsTable(){
        return array(
            'id' => 'Id',
            'username' => 'User_name',
            'email' => 'Email',
            'birthday'=>'Birthday',
            'urlphoto'=>'Urlphoto',
            'password_hash'=>'Password_hash',
            'auth_key'=>'Auth_key',
            'created_at'=>'Updated_at',
            'flags'=>'Flags'
        );
    }
    // получить имя таблицы
    public function getTableName() {
        return $this->table;
    }

    // получить одну запись
    public function getOneRow(){
        if(!isset($this->dataResult) OR empty($this->dataResult)) return false;
        return $this->dataResult[0];
    }


    protected function _getResult($sql){

            $sql = $this->_getSelect($sql);
        try{
                $result = $this->pdo->query("SELECT * FROM $this->table" . $sql);

                $rows = $result->fetchall(\PDO::FETCH_ASSOC);

                return $rows;
        }catch(\PDOException $e) {

            echo $e->getMessage();
            exit;
        }
    }

    private function _getSelect($select) {

        if(is_array($select)){
            $allQuery = array_keys($select);
            array_walk($allQuery, function(&$val){
                $val = strtoupper($val);
            });

            $querySql = "";
            if(in_array("WHERE", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "WHERE"){
                        $querySql .= " WHERE " . $val;
                    }
                }
            }



            if(in_array("LIMIT", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "LIMIT"){
                        $querySql .= " LIMIT " . $val;
                    }
                }
            }

            return $querySql;
        }
        return false;
    }
  protected  function fetchOne(){
        if(!isset($this->dataResult) OR empty($this->dataResult)) return false;
        foreach($this->dataResult[0] as $key => $val){
            $this->$key = $val;
        }
        return true;
    }
    public function save() {
        $arrayAllFields = array_keys($this->fieldsTable());
        $arraySetFields = array();
        $arrayData = array();
        foreach($arrayAllFields as $field){
            if(!empty($this->$field)){
                $arraySetFields[] = $field;
                $arrayData[] = $this->$field;

            }
        }
        $forQueryFields =  implode(', ', $arraySetFields);
        $rangePlace = array_fill(0, count($arraySetFields), '?');
        $forQueryPlace = implode(', ', $rangePlace);

        try {

            $stmt = $this->pdo->prepare("INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)");

            $result = $stmt->execute($arrayData);

        }catch(\PDOException $e){
            echo 'Error : '.$e->getMessage();
            echo '<br/>Error sql : ' . "'INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)'";
            exit();
        }

        return $result;
    }

}