<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 16.12.17
 * Time: 20:52
 */

namespace app\Controllers;


class MainController
{
    public function index()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/Index_view.php';
    }
    
   
}