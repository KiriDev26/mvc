<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 16.12.17
 * Time: 18:40
 */

namespace Controller;

use app\User;


class UserController
{
    public function form($id = null)
    {
        $user = new User;
        $user->name;

        if ($id) {
            $user->fetch($id);
        }

        require 'Form.php';

    }

    public function create()
    {
        $user = new User;

        $user->load($_POST['User']);
        $user->save();


    }

    public function update($id)
    {


    }
}