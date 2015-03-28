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
    		array(1, 251, false),
    		
    	);
    }


    
}
