<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 19.12.17
 * Time: 23:00
 */

namespace app\Controllers;

use app\Models\Product;
use app\classes\Pagination;
use app\classes\Search;
use app\classes\GroupAction;
use app\classes\Upload;
use core\Controller;


class ProductController extends Controller
{


    public function index_action()
    {
        $Product = new Product();
        if (!isset($_GET['page'])) {
            $_GET['page'] = 10;
        }

        $Pagination = new Pagination($_GET['page'], 10, 'product');
        $output['Pagination'] = $Product->index('*', 'product', $Pagination->pageLink(), $Pagination->default_page);
        $output['Category'] = $Product->index('category.id, category.title', 'category');
        $output['Product'] = $Product->index('*', 'product');
        $output['Img'] = $Product->index('img.path, img.id', 'product  JOIN img ON product.img_id=img.id');


        foreach ($output['Product'] as  &$product ){
            foreach ($output['Category'] as $category){
                if ($category['id'] == $product['category_id'] ) {
                    $product['category_title'] = $category['title'];
                }
            }
            foreach ($output['Img'] as $img){
                if ($img['id'] == $product['img_id']) {
                   $product['img_id'] = $img['path'];
                }


            }

        }
        Dbug($output);
        Controller::render("Index_view", $output);
    }


    public function create_action()
    {
        $Product = new Product();

        $output['Category'] = $Product->index('category.id, category.title', 'category', 0, 10);
        Controller::render('Create_view', $output);

        if (isset($_POST['add'])) {
            foreach ($_POST['product'] as $key => $value) {

                $row[$key] = $value;

            }
            //header("Location: http://localhost:8080/");

            //Dbug($_FILES['img']['error']['path']);
            $Product->create ($row, $_FILES);
        }

    }


    public function read_action()
    {
        $Product = new Product();
        $output[] = $Product->read($_GET['id']);

        Controller::render('Read_view', $output);

    }


    public function update_action()
    {

        $Product = new Product();
        $output['Category'] = $Product->index('category.id, category.title', 'category', 0, 10);
        Controller::render('Update_view', $output);


        if (isset($_POST['updateGo'])) {

            foreach ($_POST['product'] as $key => $value) {

                $row[$key] = $value;

            }
            $Product->UpdateOne($row['id'], $row);
            header("Location: http://localhost:8080/");
        }

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


    public function search()
    {
        $Search = new Search($_GET['query']);
        $Search->preparation();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/Search_result.php';
    }


    public function group_action()
    {
        $GroupAction = new GroupAction($_POST['checkboxGroup']);
        $GroupAction->dropGroup('product');
        header("Location: http://localhost:8080/");
    }


}