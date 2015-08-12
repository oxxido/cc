<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	/**
	 * Class to store data for view
	 *
	 * @var stdClass
	 */
	//protected $data;

	public function __get($name)
	{
		if($name == "data")
		{
			$this->data = new \stdClass();
		}
		return $this->data;
	}

	protected function view($file, $data = false)
	{
		$data = (array) ($data ? $data : $this->data);
		return view($file, $data);
	}

	protected function json($data = false)
	{
		$data = (array) ($data ? $data : $this->data);
        return \Response::json($data);
	}
}