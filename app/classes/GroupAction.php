<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 22.01.18
 * Time: 16:03
 */

namespace app\classes;

use DataBase\DB;

/**
 * Class GroupAction 
 * @package app\classes
 */

class GroupAction
{
    /**
     * @array array_check выбранных елементов  
     */
    public static $array_check;

    /**
     * GroupAction constructor.
     * @param array $id  выбранных елементов 
     */
    public function __construct(array $id)
    {
        if ($id) {
            self::$array_check[] = $id;
        } else {
            echo "Выберете нужную строку";
        }
    }

    /**
     * @param  @var $table таблица из которой производить удаление группы елементов
     */
    public function dropGroup($table)
    {
        foreach (self::$array_check[0] as $key => $value) {
            
            DB::getInstance()->delete($table, 'id=' . $value);

        }
    }

}