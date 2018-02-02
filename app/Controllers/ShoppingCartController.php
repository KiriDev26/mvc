<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 24.01.18
 * Time: 16:36
 */

namespace app\Controllers;

use app\Models\Product;
use app\Models\ShoppingCart;
use core\Controller;

class ShoppingCartController extends Controller
{


    public function index()
    {
        if (isset($_SESSION['ShoppingCart'])) {
            $Basket = new ShoppingCart();
            $result = $Basket->index($_SESSION['ShoppingCart']);
            unset($result['id']);
        } else {
            echo "Вы не добавили не одного товара в корзину!";
        }
        Controller::render('ShoppingCart_view', $result);
    }


    public function addProductToCart()
    {

        if (!empty($_POST['cart'])) {
            $Basket = new ShoppingCart();
            $result['result'] = $Basket->addProductToCart($_POST['cart']);

            echo json_encode($result);
        } else {
            echo "Выберете товар ";
        }
    }


    public function deleteProduct_action()
    {
        $id = isset($_POST['cart']) ? intval($_POST['cart']) : null;
        if (!$id) exit;


        if (!empty($id)
        ) {
            $Basket = new ShoppingCart();
            $result['result'] = $Basket->deleteProductFromCart($_POST['cart']);

            echo json_encode($result);
        } else {
            echo "Выберете товар ";
        }
    }


}

    
    
    
    













