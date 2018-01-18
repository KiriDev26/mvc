<?php
//TODO- Реализовать отображение выбраной страницы + Валидировать 
namespace app\classes;

use DataBase\DB;

class pagination
{

    private $pages; // Total records
    private $getPage; // This record
    public $default_page; // Maximum record
    public $start; // First value LIMIT
    public $number_links; // Number of pages


    public function __construct($id, $count, $table)
    {
        $this->getPage = $id;
        $this->default_page = $count;

        $sql = "SELECT COUNT(*) FROM $table";
        $row = DB::getInstance()->custom_query($sql);
        $this->pages = $row['0']['0'];

        $this->number_links = ceil($this->pages / $this->default_page);


    }


    public function pageLink()
    {
        $arm = $this->getPage - 1;
        $this->start = $this->default_page * $arm;

        return $this->start;
    }


}