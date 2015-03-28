<?php
namespace tgraf\lib;

require_once('../lib/Image.php');

class ImageTest extends \PHPUnit_Framework_TestCase
{
    protected $img;

    public function setUp()
    {
		$this->img = new Image();
    }

    public function testNewImage()
    {
    	$this->assertTrue($this->img instanceOf Image);
    }

    /**
    * @dataProvider validateParamProvider
    */
    public function testValidateParams($x, $y, $expected)
    {
    	$this->assertEquals($expected, $this->img->validateParams($x, $y));
    }

    
    public function validateParamProvider()
    {
    	return array(
    		array(1, 1, true),
    		array(2, 2, true),
    		array(1, 251, false),
    		array(0, 0, false),
    		array(1, 0, false),
    		array(0, 1, false),
    		array(4, 4, true)
    	);
    }

    /**
    * @dataProvider canvasProvider
    */
    public function testCreateCanvas($x, $y, $expected)
    {
    	$this->img->createCanvas($x, $y);
    	$this->assertEquals($this->img->getImg(), $expected);
    }

    public function canvasProvider()
    {
    	return array(
    		array(1, 1, array(1 => array(1 => 'O'))),
    		array(2, 1, array(1 => array(1 => 'O'), 2 => array(1 => 'O'))),
    		array(1, 251, false)
    	);
    }

    public function testFillHLine()
    {
    	$this->img->createCanvas(10, 10);
    	$this->img->fillHLine(5, 9, 3, 'R');
    	$this->assertEquals($this->img->getCellColor(4, 3), 'O');
    	$this->assertEquals($this->img->getCellColor(5, 3), 'R');
    	$this->assertEquals($this->img->getCellColor(9, 3), 'R');
    	$this->assertEquals($this->img->getCellColor(9, 4), 'O');
    }

    public function testFillVLine()
    {
    	$this->img->createCanvas(10, 10);
    	$this->img->fillVLine(5, 2, 6, 'R');
    	$this->assertEquals($this->img->getCellColor(4, 3), 'O');
    	$this->assertEquals($this->img->getCellColor(5, 3), 'R');
    	$this->assertEquals($this->img->getCellColor(5, 6), 'R');
    	$this->assertEquals($this->img->getCellColor(6, 7), 'O');
    }
    
    public function testFillArea()
    {
    	$this->img->createCanvas(10, 10);
    	$this->img->renderCanvas();
    	$this->img->fillArea(5, 5, 'R');
    	$this->img->renderCanvas();
    	$this->assertEquals($this->img->getCellColor(1, 1), 'R');
    	$this->assertEquals($this->img->getCellColor(5, 5), 'R');
    	$this->assertEquals($this->img->getCellColor(10, 10), 'R');
    }

    public function testFillAreaBoundaries()
    {
    	$this->img->createCanvas(10, 10);
    	$this->img->renderCanvas();
    	$this->img->fillHLine(2, 8, 2, 'G');

    	$this->img->renderCanvas();
    	$this->img->fillVLine(3, 3, 9, 'B');
    	$this->img->renderCanvas();
    	$this->img->fillArea(5, 5, 'R');
    	$this->img->renderCanvas();
    }
}
