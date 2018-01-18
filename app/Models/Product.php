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



    public function index($start, $end)
    {
        
       $sql = "SELECT * FROM product LIMIT $start, $end ";
       $this->row = DB::getInstance()->custom_query($sql);
    }


    public function create( $row, $criteria = null)
    {
        if ($this->id) {
            DB::getInstance()->update('product', $row, $criteria);
        } else {
            DB::getInstance()->insert('product', $row);
        }
    }


    public function read($id)
    {

        $this->row = DB::getInstance()->select('product', 'id =' . $id);
        

    }


    public function updateOne($id, $str)
    {
        //var_dump('Массив модели', $str, '</br>');
         DB::getInstance()->update('product', $str, 'id = ' . $id );

    }


    public function deleteOne($id)
    {
        DB::getInstance()->delete('product','id = '. $id );
        
    }
}