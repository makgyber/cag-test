<?php
namespace tgraf\lib;

class Image {
	
	const MIN_X = 1;
	const MAX_Y = 250;
	const MIN_Y = 1;
	const DEFAULT_COLOR = 'O';
	protected $_currentX;
	protected $_currentY;
	protected $_lastX;
	protected $_lastY;
	protected $_lastColor;
	protected $_img;


	public function createCanvas($x, $y)
	{
		if ($this->validateParams($x, $y)) {
			$this->_currentX = $this->_lastX = $x;
			$this->_currentY = $this->_lastY = $y;
			$this->fillCanvas($x, $y, self::DEFAULT_COLOR);
		} else {
			return false;
		}
	}

	public function fillCell($x, $y, $color)
	{
		$this->_img[$x][$y] = $color;
	}

	public function fillCanvas($x, $y, $color)
	{
		for ($i=1; $i <= $x; $i++) {
			for($j=1; $j <= $y; $j++) {
				$this->fillCell($i, $j, $color);
			}
		}
	}

	public function fillHLine($x1, $x2, $y, $color)
	{
		for ($i = $x1; $i <= $x2; $i++) {
			$this->fillCell($i, $y, $color);
		}
	}

	public function fillVLine($x, $y1, $y2, $color)
	{
		for ($j = $y1; $j <= $y2; $j++) {
			$this->fillCell($x, $j, $color);
		}
	}

	public function fillArea($x, $y, $color)
	{
		// get the original color of selected cell
		$this->_lastColor = $this->getCellColor($x, $y);

		if ($this->_lastColor === $color) {
			//do nothing
			return $this;
		}

		// $this->_checkAdjacentCell($x, $y, $color);

		// go up the x-axis
		for ($rt = $x; $rt <= $this->_currentX; $rt++) {
			for ($up = $y; $up <= $this->_currentY; $up++) {
				if($this->getCellColor($rt, $up) == $this->_lastColor) {
					$this->fillCell($rt, $up, $color);
				}else{
				//	break;
				}
			}

			for ($down = $y - 1; $down >= self::MIN_Y; $down--) {
				if($this->getCellColor($rt, $down) == $this->_lastColor) {
					$this->fillCell($rt, $down, $color);
				}else{
				//	break;
				}
			}
		}

		// go down the x-axis
		for ($lt = $x - 1; $lt >= self::MIN_X; $lt--) {
			for ($up = $y; $up <= $this->_currentY; $up++) {
				if($this->getCellColor($lt, $up) == $this->_lastColor) {
					$this->fillCell($lt, $up, $color);
				}else{
				//	break;
				}
			}

			for ($down = $y - 1; $down >= self::MIN_Y; $down--) {
				if($this->getCellColor($lt, $down) == $this->_lastColor) {
					$this->fillCell($lt, $down, $color);
				}else{
				//	break;
				}
			}
		}
	}	

	public function renderCanvas()
	{
		echo "\n";
		for($j=1; $j <= $this->_currentY; $j++) {
			for ($i=1; $i <= $this->_currentX; $i++) {
				echo $this->getCellColor($i, $j);
			}
			echo "\n";
		}
	}

	public function clearCanvas()
	{
		for($j=1; $j <= $this->_currentY; $j++) {
			for ($i=1; $i <= $this->_currentX; $i++) {
				$this->fillCell($i, $j, self::DEFAULT_COLOR);
			}
		}
		return $this;
	}

	public function validateParams($x, $y)
	{
		if ($x < self::MIN_X) {
			return false;
		}

		if ($y > self::MAX_Y || $y < self::MIN_Y) {
			return false;
		}

		return true;

	}

	public function getImg()
	{
		return $this->_img;
	}

	public function getCellColor($x, $y)
	{
		return $this->_img[$x][$y];
	}
}