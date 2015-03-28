<?php

namespace tgraf\lib;
require_once('Image.php');

class Editor {
	protected $_img;

	public function __construct()
	{
		$this->_img =  new Image();
	}

	// create image
	public function I(array $params)
	{	
		$this->_img->createCanvas($params[1], $params[2]);
	}

	// show image
	public function S(array $params)
	{
		echo $this->_img->renderCanvas();
	}

	public function processCommand($input)
	{
		$cmd = explode(' ', $input);
	    if (method_exists($this, $cmd[0])) {
			call_user_func(array($this, $cmd[0]), $cmd);
		}
	}

	public function run() 
	{
		$fp = fopen('php://stdin', 'r');
		$in = '';
		while ($in != 'X'){
		    echo 'tgraf> ';
		    $in =  strtoupper(trim(fgets($fp)));
		    $this->processCommand($in);
		}
		echo "Bye!";
	}

	public function getImg()
	{
		return $this->_img;
	}

}