<?php
namespace app\Controllers;

use app\Models\Order;
use core\Controller;

/**
 * Created by PhpStorm.
 * User: punk
 * Date: 27.01.18
 * Time: 13:48
 */
class OrderController extends Controller
{
    
    public function index()
    {
        $Product=[];
        foreach ($_SESSION['ShoppingCart'] as $key) {
            $Product[$key] = $_POST['quantity_'.$key];
        }
        
        $Order = new Order;
        $output =  $Order->index_order($Product);
        Controller::render('Order_view', $output );


    }
    
}