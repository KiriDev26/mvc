<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 23.01.18
 * Time: 0:53
 */

namespace app\Models;


use DataBase\DB;
use vendor\core\Model;

class Order extends Model
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
        foreach ($Product as $key => $value) {

           $arr[][$value] =  DB::getInstance()->select('price', 'product', 'id='.$key );
           $result['product'][$key] = DB::getInstance()->select('name', 'product', 'id='.$key );
           $result['product'][$key]['quantity'] = $value;

        }
        
        $result['price'] =  $this->calculator($arr);

        return $result;

    }



    private function calculator($Product)
    {
            foreach ($Product as $key) {
                foreach ($key as $quantity => $price){
                        $result_one[] = $quantity * $price['price'];
                }
            }

        $sum = array_sum($result_one);

        
        return $sum;
    }





}