<?php

/**
 * Created by PhpStorm.
 * User: punk
 * Date: 19.10.17
 * Time: 22:26
 */
namespace DataBase;


use PDO;

class DB
{
    private static $instance;
    private $dbh;


    public function __construct()
    {

        $dsn = 'mysql:host=localhost;dbname=new mvc;charset=utf8';
        $user = 'root';
        $password = 'cobaka98';


        try {
            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();

        }
    }

    /**
     * @return DB
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }


    public function insert($table, $row)
    {
        $columns = [];


        foreach ($row as $key => $value) {
            $columns[] = $key;

        }

        $sql = "INSERT INTO $table SET " . pdoSet($table,$columns, $values);
        $stm = $this->dbh->prepare($sql);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stm->execute($values);


    }


    public function select($sample, $table, $criteria)
    {
        $sql = "SELECT $sample FROM $table WHERE $criteria";
        
        $stmt = $this->dbh->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }


    public function update($table, $str, $criteria)
    {
        $columns = [];
        

        foreach ($str as $key => $value) {
            $columns[] = $key;
        }

        
        $values["id"] = $_POST['product']['id'];
        $sql = "UPDATE $table SET " . pdoSet($table, $columns, $values) . " WHERE $criteria ";
        


        $stm = $this->dbh->prepare($sql);

        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stm->execute($values);


    }


    public function delete($table, $criteria)
    {
        $sql = "DELETE FROM $table WHERE  $criteria";

        $this->dbh->prepare($sql)->execute();

        
    }


    public function custom_query($sql)
    {
        $stmt = $this->dbh->query($sql);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        return $row;
        
    }

    public function getLastInsertId($table)
    {
        return $this->dbh->lastInsertId($table);
    }


}


function pdoSet($table, $allowed, &$values, $source = array())
{
   // Dbug($table);
    $set = '';
    $values = array();
    if (!$source) $source = &$_POST[$table];

   // Dbug($source);
    foreach ($allowed as $field) {
        if (isset($source[$field])) {
            $set .= "`" . str_replace("`", "``", $field) . "`" . "=:$field, ";
            $values[$field] = $source[$field];
            

        }
    }
    return substr($set, 0, -2);
}




