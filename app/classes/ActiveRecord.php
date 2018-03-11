<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 02.03.18
 * Time: 20:12
 */

namespace app\classes;

use DataBase\DB;


abstract class ActiveRecord
{
	function __construct ($Object = [])
	{
		if (isset ($Object)) {
			$property = get_object_vars($Object);
			 

		}
	}

}