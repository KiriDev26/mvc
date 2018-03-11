<?php
//TODO- Реализовать отображение выбраной страницы + Валидировать 
namespace app\classes;

use DataBase\DB;

/**
 * Class pagination
 * @package app\classes
 */
class Pagination
{

    private $pages; // Total records
    private $getPage ; // This record
    public $default_page; // Maximum record
    public $start; // First value LIMIT
    public $number_links; // Number of pages

    
    public function __construct($id = null, $count, $table)
    {
        if (!$id) $id = 1;
        
    
        $this->getPage = $id;
        $this->default_page = $count;

        $sql = "SELECT COUNT(*) FROM $table";
        $row = DB::getInstance()->custom_query($sql);
        if(empty($row)) {
            Dbug($row);
            $this->pages = $row['0']['0'];
        }
        $this->number_links = ceil($this->pages / $this->default_page);


    }

    /**
     * @return значение с которого начинать выборку
     */
    public function pageLink()
    {
        $arm = $this->getPage - 1;
        $this->start = $this->default_page * $arm;

        return $this->start;
    }


}