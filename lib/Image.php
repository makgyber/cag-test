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

	

	public function fillVLine($x1, $x2, $y, $color)
	{

	}

	public function fillHLine()
	{

	}

	public function fillArea()
	{

	}

	public function reset()
	{
		unset($this->_img);
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
}