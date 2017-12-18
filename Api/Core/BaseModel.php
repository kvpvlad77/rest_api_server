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
    protected $dberror;


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

    //abstract public function execute($query, array $params=null);
    public function fieldsTable(){
        return array(
            'id' => 'Id',
            'username' => 'User_name',
            'email' => 'Email',
            'first_name'=>'First_name',
            'last_name'=>'Last_name',
            'birthday'=>'Birthday',
            'urlphoto'=>'Urlphoto',
            'password_hash'=>'Password_hash',
            'secret_key'=>'Secret_key',
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
// получить запись по id

    protected function _getResult($par){

            $sql = $this->_getSelect($par);
        try{
                $result = $this->pdo->query("SELECT * FROM $this->table " . $par);

                $rows = $result->fetch(\PDO::FETCH_ASSOC);

                return $rows;

        }catch(\PDOException $e) {

            echo $e->getMessage();
            exit;
        }
    }

    protected function _getFieldResult($sql,array $arrayFields=null){

        $querySelectSql = "";
        if($arrayFields!=null):
        $arrayData = array();
        foreach($arrayFields as $field){


                $arrayData[] =$field;


        }
        $Fields=implode(', ',$arrayData);
            elseif($arrayFields==null):
                $Fields='*';
        endif;

        $sql = $this->_getSelect($sql);
        try{

            $result = $this->pdo->query("SELECT $Fields FROM $this->table " . $sql);

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

    public function update(){
        $arrayAllFields = array_keys($this->fieldsTable());
        $arrayForSet = array();

        foreach($arrayAllFields as $key => $value){
            var_dump($this->$value);
            if(!empty($this->$value)){


                if(strtoupper($value) !== 'Id'){
                    $arrayForSet[] = $value . ' = '. $this->$value . '';

                }
               else{
                    $whereID = $this->$value;

                }
            }

        }
      //  var_dump($this->$field);
        if(!isset($arrayForSet) OR empty($arrayForSet)){
            echo "Array data table `$this->table` empty!";
            exit;
        }
        if(!isset($whereID) OR empty($whereID)){
            echo "id table `$this->table` not found!";
            exit;
        }

        $strForSet = implode(', ', $arrayForSet);

        try {

            $stmt = $this->pdo->prepare("UPDATE $this->table SET $strForSet WHERE `id` = $whereID");
            $stmt->execute();
            $result = $stmt->errorCode();
        }catch(PDOException $e){
            echo 'Error : '.$e->getMessage();
            echo '<br/>Error sql : ' . "'UPDATE $this->table SET $strForSet WHERE `id` = $whereID'";
            exit();
        }
        return $result;
    }

    public function save() {

        $arrayAllFields = array_keys($this->fieldsTable());
        $arraySetFields = array();
        //$arraySetFieldsAndupdate = array();
        $arrayData = array();
        foreach($arrayAllFields as $field){
            if(!empty($this->$field)){
                $arraySetFields[] = $field;
                $arrayData[] = $this->$field;
               // $arraySetFieldsAndupdate[]= $field.'="'.$this->$field.'"';
            }
        }

        $forQueryFields =  implode(', ', $arraySetFields);
        $rangePlace = array_fill(0, count($arraySetFields), '?');
        $forQueryPlace = implode(', ', $rangePlace);
        //$forQueryPlaceUpdate=implode(', ',   $arraySetFieldsAndupdate);

        try {
            $stmt = $this->pdo->prepare("INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)");
           // ON DUPLICATE KEY UPDATE   $forQueryPlaceUpdate ");
            $stmt->execute($arrayData);
            $result = $stmt->errorCode();
        }catch(\PDOException $e){
            echo 'Error : '.$e->getMessage();
            echo '<br/>Error sql : ' . "'INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)";
            exit();
        }

        return  $result;
    }



}