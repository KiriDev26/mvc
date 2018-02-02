<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 25.01.18
 * Time: 17:39
 */

namespace app\Models;

use DataBase\DB;

class ShoppingCart
{
    public $Product;
    public $dataProduct;


    public function index(array $id)
    {

        $this->Product['id'] = $id;
        
        foreach ($this->Product['id'] as $key => $item) {
            $sql ="SELECT  product.id, product.name, category.title, product.price, product.description FROM product  INNER JOIN category ON product.category_id = category.id  WHERE product.id=$item";

            $this->Product[$key] = DB::getInstance()->custom_query($sql);
           
            
        }
        
        return $this->Product;
    }


    public function addProductToCart($id)
    {
        $this->Product = $id;
        $response = [];

        
        if (isset($_SESSION['ShoppingCart']) && array_search($this->Product, $_SESSION['ShoppingCart']) === false) {
            $_SESSION['ShoppingCart'][] = $this->Product;
            $this->dataProduct['count'] = count($_SESSION['ShoppingCart']);
            $this->dataProduct['success'] = 1;
        } else {
            $this->dataProduct['success'] = 0;
        }

        $response['dataProduct'] = $this->dataProduct;

        return $response;

    }


    public function deleteProductFromCart($id)
    {
        $this->Product = $id;

        $response = [];

        $this->dataProduct['count'] = 0;

        $key = array_search($this->Product, $_SESSION['ShoppingCart']);

        if ($key !== false) {

            unset($_SESSION['ShoppingCart'][$key]);
            $this->dataProduct['success'] = 1;
            $this->dataProduct['count'] = count($_SESSION['ShoppingCart']);

        } else {
            $this->dataProduct['success'] = 0;
        }
        if (in_array($_POST['cart'], $_SESSION['ShoppingCart'])) {
            $this->dataProduct['count'] = 1;
        }
        $response['dataProduct'] = $this->dataProduct;

        return $response;

    }

}