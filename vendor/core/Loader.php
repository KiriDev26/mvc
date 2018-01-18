<?php

/**
 * Created by PhpStorm.
 * User: punk
 * Date: 16.12.17
 * Time: 16:01
 */
class Loader
{

    public function loadClass($class)
    {


        $arr = explode('\\', $class);


        $file = $_SERVER['DOCUMENT_ROOT'] . "/" . implode('/', $arr) . '.php';
       

        if (is_file($file)) {
            require_once $file;


        }
    }


    
    
}