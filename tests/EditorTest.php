<?php
namespace tgraf\lib;

require_once('../lib/Image.php');
require_once('../lib/Editor.php');

class EditorTest extends \PHPUnit_Framework_TestCase
{
    protected $_ed;

    public function setUp()
    {
		$this->_ed = new Editor();
    }

    public function testConstruct()
    {
    	$this->assertTrue($this->_ed instanceof Editor);
    }

    public function testCreateImage()
    {
    	$this->_ed->processCommand('I 2 2');
    	$img = $this->_ed->getImg();
    	$this->assertTrue($img instanceof Image);
    	$this->assertEquals($img->getCellColor(2, 2), 'O');
    }
}
