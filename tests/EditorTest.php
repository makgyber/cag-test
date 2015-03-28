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

    public function testI()
    {
    	$this->_ed->processCommand('I 2 2');
    	$img = $this->_ed->getImg();
    	$this->assertTrue($img instanceof Image);
    	$this->assertEquals($img->getCellColor(2, 2), 'O');
    }

    public function testC()
    {
    	$this->_ed->processCommand('I 2 2');
    
    }

    public function testL()
    {
    	$this->_ed->processCommand('I 10 10');
    	$this->assertEquals($this->_ed->getImg()->getCellColor(2, 2), 'O');
    	$this->_ed->processCommand('L 2 2 G');
    	$this->assertEquals($this->_ed->getImg()->getCellColor(2, 2), 'G');
    }
}
