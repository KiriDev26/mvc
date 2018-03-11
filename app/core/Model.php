<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 16.12.17
 * Time: 16:30
 */

namespace vendor\core;



use DataBase\DB;

class Model
{
    
    protected function save($table, $row)
    {
        DB::getInstance()->insert($table, $row);
    }

}