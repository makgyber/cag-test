<?php
namespace tgraf\lib;

class Image {
	
	const MIN_X = 1;
	const MAX_Y = 250;
	const MIN_Y = 1;

	protected $_currentX;
	protected $_currentY;
	protected $_lastX;
	protected $_lastY;
	protected $_img = array();

	public function __const($x, $y)
	{
		if ($this->validateParams($x, $y)) {
			throw Exception('Invalid Parameters');
		}

		$this->_currentX = $x;
		$this->_currentY = $y;
		$this->_lastX = $x;
		$this->_lastY = $y;
		$this->_img = [$x, $y];
		return $this;
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
}