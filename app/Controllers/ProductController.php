<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 19.12.17
 * Time: 23:00
 */

namespace app\Controllers;

use app\Models\Product;
use app\classes\pagination;




class ProductController 
{
   

    
    
    public function index_action()
    {
        $Product = new Product();
        $pagination = new pagination($_GET['page'], 10, 'product');
        $Product ->index($pagination->pageLink(), $pagination->default_page );

        

        
        
        
        require_once  $_SERVER['DOCUMENT_ROOT'] . '/app/Views/Index_view.php';



    }
    
    public function form_action()
    {
        require_once  $_SERVER['DOCUMENT_ROOT'] . '/app/Views/Update_view.php';
        
    }
    
    
    
    
    public function create_action()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/Create_view.php';

        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $row = [
            'name' => $name,
            'category_id' => $category_id,
            'price' => $price,
            'description' => $description,
        ];
        
        $Product = new Product();
        $Product->create($row);
        header("Location: http://localhost:8080/");

    }
    
    
    
    
    public function read_action()
    {
        $Product = new Product();
        $Product->read($_GET['id']);
        
        require_once  $_SERVER['DOCUMENT_ROOT'] . '/app/Views/Read_view.php';
        
    }
    
    
    
    
    public function update_action()
    {
        $Product = new Product();
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $price = $_POST['price'];
        $description =$_POST['description'];
        $str =[
            'name' => $name,
            'category_id' => $category_id,
            'price' => $price,
            'description' => $description,
        ];
        //var_dump('Данные из формы', $str, '</br>');

        $Product->updateOne($_POST['id'], $str);
        header("Location: http://localhost:8080/");


    }
    
    
    
    
    public function delete_action()
    {
        $Product = new Product();

        if (isset($_GET['id']) or isset($_POST['id'])) {
            $id = $_REQUEST['id'];
        }

        $Product->deleteOne($id);
        header("Location: http://localhost:8080/");


    }

    
    
    
}