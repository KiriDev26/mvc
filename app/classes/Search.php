<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 17.01.18
 * Time: 23:52
 */

namespace app\classes;

use DataBase\DB;

/**
 * Class Search
 * @package app\classes
 */
class Search
{
    /**
     * @array $input  хранит значение поисковой строки
     * @array $output  массив с результатом поиска
     */
    public $input; // array inquiry
    public $output; // array 

    /**
     * Search constructor.
     * @param $string строка поискового запроса
     */
    public function __construct($string)
    {
        $this->input[] = explode(" ", $string);
    }

    public function preparation()
    {

        foreach ($this->input['0'] as $key => $value) {
            $sql = "SELECT * FROM product WHERE name LIKE '%{$value}%'  ";
            $resultSearch = DB::getInstance()->custom_query($sql);
        }

        foreach ($resultSearch as $key => $value) {
            $sq = "SELECT * FROM product WHERE id= {$value['id']}";
            $this->output[] = DB::getInstance()->custom_query($sq);
        }


    }


}