<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 02.03.18
 * Time: 19:02
 */

namespace app\Models;


abstract class AbstractUser
{
	public $id;
	public $email;
	public $password;
	public $phone;
	public $status;

	abstract protected function find();

	abstract protected function add($row);

	abstract protected function findOne($criteria, $value);

	abstract protected function update($id, $row);

	abstract protected function delete($id);
	/*
	 * @protected method
	 * @params  string $status
	 * this method determines role users
	 */
	abstract protected function role($status);





}