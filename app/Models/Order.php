<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 23.01.18
 * Time: 0:53
 */

namespace app\Models;


use DataBase\DB;

class Order
{
    public $id;
    public $Product;
    public $User;
    public $quantity;
    public $status;
    public $date;
    public $price;
    public $totalOrder;

    public function index_order(array $Product)
    {
        Dbug($Product);
        foreach ($Product as $key => $value)
        {

           $price []=  DB::getInstance()->select('price', 'product', 'id='.$key );
           $result['product'][$key] = DB::getInstance()->select('name', 'product', 'id='.$key );
           $result['quantity'][$key] = $value;
        }
        $array = array_merge($result['product'], $result['quantity'] );
        Dbug($array);
       
        $result['price'] =  $this->calculator($Product,$price);


        return $result;

    }


    private function calculator($Product, $price)
    {
        foreach ($price as $key2=>$value2 )
            
        foreach ($Product as $key1 => $value1) {
            
            $result[$key1] =  (int)$value1 *   (int)$value2['price'];
            
        }
        $this->totalOrder=array_sum($result);

        return $result;
    }


}