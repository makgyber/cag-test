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
    	$this->assertEquals(-1, $this->img->createCanvas($x, $y));
    }

    /**
    * @dataProvider parameterProvider
    */
    public function testValidateParams($x, $y, $expected)
    {
    	$this->assertEquals($expected, $this->img->validateParams($x, $y));
    }

    public function parameterProvider()
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

}
