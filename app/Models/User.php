<?php
namespace app\Models;


use DataBase\DB;


class User
{
    public $id;
    public $name;
    public $surname;
    public $email;
    public $password;


    public function save()
    {
        
        if ($this->id) {
            DB::getInstans()->Update();
        } else {
            DB::getInstance()->create();
        }


    }


    public function load(array $data)
    {
        //Принимает массив $data 
        foreach ($data as $field => $value) {
            $this->$field = $value;
        }


    }


    public function fetch(int $id)
    {
        $result = DB::getInstance()->readOne($id);
        //return SELECT * FROM user WHERE id=$id;
        return $result;
    }


}