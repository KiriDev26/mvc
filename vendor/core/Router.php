<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 16.12.17
 * Time: 18:14
 */

namespace vendor\core;


class Router
{


    public function up()
    {

        $route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $routing = [
            '/dateUser' => ['controller' => "UserController", 'action' => "form"],
            '/' => ['controller' => "ProductController", 'action' => "index_action"],
            '/test' => ['controller' => "MainController", 'action' => "test"],
            '/product/read' => ['controller' => "ProductController", 'action' => "read_action"],
            '/product/create' => ['controller' => "ProductController", 'action' => "create_action"],
            '/product/update_form' => ['controller' => "ProductController", 'action' => "form_action"],
            '/product/delete' => ['controller' => "ProductController", 'action' => "delete_action"],
            '/product/update' => ['controller' => "ProductController", 'action' => "update_action"],
            '/product/index' => ['controller' => "ProductController", 'action' => "index_action"],
            '/search' =>['controller' => "ProductController", 'action' => "search"],
            '/groupAction' => ['controller' => "ProductController", 'action' =>"group_action"],
            '/shopCart' =>['controller' => "ShoppingCartController", 'action'=>"addProductToCart"],
            '/deleteProductCart'=> ['controller'=>"ShoppingCartController", 'action'=>"deleteProduct_action"],
            '/indexToCart' => ['controller'=>"ShoppingCartController", 'action'=>"index"],
            '/indexToOrder'=> ['controller' =>"OrderController", 'action'=> "index" ]
        ];
        

        if (isset($routing[$route])) {
            $controller = "app\\Controllers\\" . $routing[$route]['controller'];


            $this_controller = new $controller();
            $this_controller->{$routing[$route]['action']}();

        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/404.php';
        }
    }
}