<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 18.12.17
 * Time: 17:34
 */

namespace app\Models;

use DataBase\DB;
use app\classes\pagination;
use app\classes\Search;

class Product
{
    public $id;
    public $name;
    public $category;
    public $price;
    public $description;
    public $discount;
    public $amount;

    public $row;


    public function index($sample, $table, $start = null, $end = null)
    {
        if ($start == null && $end == null) {
            $start = 0;
            $end = 10;
        }
        $sql = "SELECT $sample FROM $table LIMIT $start, $end ";
        $result = DB::getInstance()->custom_query($sql);


        return $result;
    }


    public function create($row)
    {
        DB::getInstance()->insert('product', $row);

    }


    public function read($id)
    {

        $result = DB::getInstance()->select('*', 'product', 'id =' . $id);

        return $result;
    }


    public function updateOne($id, $str)
    {
        DB::getInstance()->update('product', $str, 'id = ' . $id);

    }


    public function deleteOne($id)
    {
        DB::getInstance()->delete('product', 'id = ' . $id);

    }
}