<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 16.12.17
 * Time: 16:27
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

    $path = [
     '/vendor/core/Model.php',
     '/vendor/core/View.php',
     '/vendor/core/Controller.php',
     '/vendor/core/Loader.php',
        

    ];

 foreach ($path as $pth ) {
     require_once $_SERVER['DOCUMENT_ROOT'] . $pth;
 };

echo $_SERVER['DOCUMENT_ROOT'];