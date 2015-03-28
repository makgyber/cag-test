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
		if(count($params) == 3){
			$this->_img->createCanvas($params[1], $params[2]);
		}else{
			return "Please check your syntax and parameter count. eg. `I X Y`\n";
		}
		
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
	* Color a pixel (L x y c)
	*/
	public function L(array $params)
	{
		if(count($params) == 4){
			$this->_img->fillCell($params[1], $params[2], $params[3]);
		}else{
			return "Please check your syntax and parameter count. eg. `L X Y C`\n";
		}
		
	}

	/**
	* Horizontal Line (H x1 y2 y c)
	*/
	public function H(array $params)
	{
		if( count($params) == 5) {
			if($params[1] > $params[2]){
				$x1 = $params[2];
				$x2 = $params[1];
			}else{
				$x1 = $params[1];
				$x2 = $params[2];
			}			
			$this->_img->fillHLine($x1, $x2, $params[3], $params[4]);
		} else {
			return "Please check your syntax and parameter count. eg. `H X Y1 Y2 C`\n";
		}
	}

	/**
	* Vertical Line (V x y1 y2 c)
	*/
	public function V(array $params)
	{
		if( count($params) == 5) {
			if($params[2] > $params[3]){
				$y1 = $params[3];
				$y2 = $params[2];
			}else{
				$y1 = $params[2];
				$y2 = $params[3];
			}
			$this->_img->fillVLine($params[1], $y1, $y2, $params[4]);
		} else {
			return "Please check your syntax and parameter count. eg. `V X Y1 Y2 C`\n";
		}
	}

	/**
	* Fill Area (F x y c)
	*/
	public function F(array $params)
	{
		if(count($params) == 4){
			$this->_img->fillArea($params[1], $params[2], $params[3]);
		}else{
			return "Please check your syntax and parameter count. eg. `F X Y C`\n";
		}
	}

	public function processCommand($input)
	{
		$result = '';
		$cmd = explode(' ', $input);
	    if (method_exists($this, $cmd[0])) {
			$result = call_user_func(array($this, $cmd[0]), $cmd);
		} else {
			$result = "Please make sure all command-input letters are valid and CAPITALIZED\n";
		}
		return $result;
	}

	public function run() 
	{
		$fp = fopen('php://stdin', 'r');
		$in = '';
		echo "\f";
		while ($in != 'X'){
		    echo 'tgraf> ';
		    $in =  trim(fgets($fp));
		    echo $this->processCommand($in);
		}
		echo "Bye!\n";
	}

	public function getImg()
	{
		return $this->_img;
	}

}