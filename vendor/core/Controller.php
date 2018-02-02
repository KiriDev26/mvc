<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 16.12.17
 * Time: 16:31
 */

namespace core;


class Controller
{
    

    protected function render($view, $array = null)
    {
        extract($array);


        require_once  $_SERVER['DOCUMENT_ROOT'] . "/app/Views/$view".".php";

    }

}