<?php
/**
 * Created by PhpStorm.
 * User: punk
 * Date: 05.03.18
 * Time: 18:39
 */

namespace app\classes;


use DataBase\DB;

/**
 * Class Upload
 * @package app\classes
 */
class Upload
{


	/**
	 * dir save images
	 */
	//TODO: Реализовать settings для сохранения картинок.
	const  ABSOLUTE_PATH = '/app/Views/media/images/';
	/**
	 * @var $id
	 */
	public $id;

	/**
	 * @var array
	 */
	public $newFile;
	/**
	 * @var array
	 */
	private $path = [];


	/**
	 * Upload constructor.
	 * @param $file
	 */
	public function __construct (array $file)
	{

		$file['img']['name']['path'] = explode ('.', $file['img']['name']['path']);
		$file['img']['name']['path'] = array_pop ($file['img']['name']['path']);
		$file['img']['name']['path'] = $this->dateFormat().'.'.$file['img']['name']['path'];


		$this->path['path'] = $file['img']['name']['path'];

		$_POST['img']['path'] = $file['img']['name']['path'];
Dbug($file['img']['name']['path']);
		$this->newFile = $file;
	}

	/**
	 * @return bool|string date
	 */
	private function dateFormat ()
	{
		$date = date ("Y-m-dH:i:s:ms");

		return $date;
	}

	/**
	 * @method Upload img in directory /app/Views/media/images/
	 */
	public function save ()
	{
		if (!empty($this->path)) {
			/** @var $instance DB */
			$instance = DB::getInstance ();

			$instance->insert ('img', $this->path);

			$this->id = $instance->getLastInsertId ('img');

			if (is_uploaded_file ($this->newFile['img']['tmp_name']['path'])) {
				// Если файл загружен успешно, перемещаем его
				// из временной директории в конечную
				move_uploaded_file ($this->newFile['img']['tmp_name']['path'], $_SERVER['DOCUMENT_ROOT'].self::ABSOLUTE_PATH.$this->path['path']);
			} else {
				echo ("Ошибка загрузки файла");
			}
		}
		return $this->id;

	}
}