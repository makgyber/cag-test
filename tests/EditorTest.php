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

    public function testH()
    {
    	$this->_ed->processCommand('I 10 10');
    	$this->assertEquals($this->_ed->getImg()->getCellColor(1, 1), 'O');
    	$this->_ed->processCommand('H 1 5 5 R');
    	$this->assertEquals($this->_ed->getImg()->getCellColor(1, 5), 'R');
    }

    public function testV()
    {
    	$this->_ed->processCommand('I 10 10');
    	$this->assertEquals($this->_ed->getImg()->getCellColor(1, 1), 'O');
    	$this->_ed->processCommand('V 1 1 5 R');
    	$this->assertEquals($this->_ed->getImg()->getCellColor(1, 1), 'R');
    
    }

    public function testF()
    {
    	$this->_ed->processCommand('I 10 10');
    	$this->assertEquals($this->_ed->getImg()->getCellColor(5, 5), 'O');
    	$this->_ed->processCommand('F 5 5 R');
    	$this->assertEquals($this->_ed->getImg()->getCellColor(5, 5), 'R');
    	$this->assertEquals($this->_ed->getImg()->getCellColor(1, 1), 'R');
    }


    public function testInvalidCommand()
    {
    	$result = $this->_ed->processCommand('z');
    	$this->assertEquals("Please make sure all command-input letters are valid and CAPITALIZED\n", $result);
    	$result = $this->_ed->processCommand('i');
    	$this->assertEquals("Please check your syntax and parameter count. eg. `I X Y`\n", $result);  
    	$result = $this->_ed->processCommand('L');
    	$this->assertEquals("Please check your syntax and parameter count. eg. `L X Y C`\n", $result); 
    	$result = $this->_ed->processCommand('h');
    	$this->assertEquals("Please check your syntax and parameter count. eg. `H X Y1 Y2 C`\n", $result); 
    	$result = $this->_ed->processCommand('v');
    	$this->assertEquals("Please check your syntax and parameter count. eg. `V X Y1 Y2 C`\n", $result);   
    }


}
