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
if (!isset($_SESSION['ShoppingCart'])) {
    $_SESSION['ShoppingCart'] = array();
}


$path = [
    '/app/core/Model',
    '/app/core/View',
    '/app/core/Controller',
    '/app/core/Loader',
    '/app/bootstrap/help'


];

foreach ($path as $pth) {
    require_once $_SERVER['DOCUMENT_ROOT'] . $pth . '.php';
};

