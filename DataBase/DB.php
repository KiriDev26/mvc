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

        $dsn = 'mysql:host=localhost;dbname=new mvc';
        $user = 'root';
        $password = 'cobaka98';


        try {
            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();

        }
    }

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


        //$allowed = array("name","surname","email"); // allowed fields
        $sql = "INSERT INTO $table SET " . pdoSet($columns, $values);
        $stm = $this->dbh->prepare($sql);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stm->execute($values);


    }


    public function select($table, $criteria)
    {
        $sql = "SELECT * FROM $table WHERE $criteria";
        
        $stmt = $this->dbh->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }


    public function update($table, $str, $criteria)
    {
        $columns = [];
        //var_dump($str);


        foreach ($str as $key => $value) {
            $columns[] = $key;
        }
        $values["id"] = $_POST['id'];
        $sql = "UPDATE $table SET " . pdoSet($columns, $values) . " WHERE $criteria ";
        //var_dump($values);


        $stm = $this->dbh->prepare($sql);

        //var_dump($values);
        //var_dump($columns);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stm->execute($values);
        //var_dump($stm);

    }


    public function delete($table, $criteria)
    {
        $sql = "DELETE FROM $table WHERE  $criteria";

        $this->dbh->prepare($sql)->execute();

        
    }


    public function custom_query($sql)
    {
        $stmt = $this->dbh->query($sql);
        $row = $stmt->fetchAll();
        
        return $row;
        
    }


}


function pdoSet($allowed, &$values, $source = array())
{
    $set = '';
    $values = array();
    if (!$source) $source = &$_POST;
    foreach ($allowed as $field) {
        if (isset($source[$field])) {
            $set .= "`" . str_replace("`", "``", $field) . "`" . "=:$field, ";
            $values[$field] = $source[$field];
            //var_dump($set);

        }
    }
    return substr($set, 0, -2);
}




