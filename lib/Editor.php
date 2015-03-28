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

	/**
	* clear the table (return default color 'O')
	*/
	public function C(array $params)
	{
		$this->_img->clearCanvas();
	}

	/**
	* Color a pixel (H x1 y2 y c)
	*/
	public function L(array $params)
	{
		$this->_img->fillCell($params[1], $params[2], $params[3]);
	}

	/**
	* Horizontal Line (H x1 y2 y c)
	*/
	public function H(array $params)
	{
		$this->_img->fillHLine($params[1], $params[2], $params[3], $params[4]);
	}

	/**
	* Vertical Line (V x y1 y2 c)
	*/
	public function V(array $params)
	{
		$this->_img->fillVLine($params[1], $params[2], $params[3], $params[4]);
	}

	/**
	* Fill Area (F x y c)
	*/
	public function F(array $params)
	{
		$this->_img->fillCell($params[1], $params[2], $params[3]);
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