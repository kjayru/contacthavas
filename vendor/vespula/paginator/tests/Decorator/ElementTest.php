<?php
namespace Vespula\Paginator\Decorator;

class ElementTest extends \PHPUnit_Framework_TestCase
{
    public function testMinimal()
    {
        $expected = '<div/>';

        $element = new Element('div');

        $this->assertEquals($expected, $element->__toString());
    }

    public function testText()
    {
        $expected = '<div>foo</div>';

        $element = new Element('div');
        $element->setText('foo');

        $this->assertEquals($expected, $element->__toString());
    }

    public function testAppendText()
    {
        $expected = '<div>foo bar</div>';

        $element = new Element('div');
        $element->setText('foo');
        $element->appendText(' bar');

        $this->assertEquals($expected, $element->__toString());
    }

    public function testPrependText()
    {
        $expected = '<div>foo bar</div>';

        $element = new Element('div');
        $element->setText('bar');
        $element->prependText('foo ');

        $this->assertEquals($expected, $element->__toString());
    }

    public function testAddAttrib()
    {
        $expected = '<div class="bar">foo</div>';

        $element = new Element('div');
        $element->setText('foo');
        $element->addAttribute('class', 'bar');

        $this->assertEquals($expected, $element->__toString());
    }

    public function testAppendAttrib()
    {
        $expected = '<div class="bar dog">foo</div>';

        $element = new Element('div');
        $element->setText('foo');
        $element->addAttribute('class', 'bar');
        $element->appendAttribute('class', 'dog');

        $this->assertEquals($expected, $element->__toString());
    }

    public function testAppendAttribNotSet()
    {
        $expected = '<div class="dog">foo</div>';

        $element = new Element('div');
        $element->setText('foo');
        $element->appendAttribute('class', 'dog');

        $this->assertEquals($expected, $element->__toString());
    }

    public function testAddAttribs()
    {
        $expected = '<div class="dog" id="bar">foo</div>';

        $element = new Element('div');
        $element->setText('foo');
        $element->addAttributes([
            'class'=>'dog',
            'id'=>'bar'
        ]);

        $this->assertEquals($expected, $element->__toString());
    }

    public function testReset()
    {
        $expected = '<div>foo</div>';

        $element = new Element('div');
        $element->setText('foo');
        $element->addAttributes([
            'class'=>'dog',
            'id'=>'bar'
        ]);

        $element->clearAttributes();

        $this->assertEquals($expected, $element->__toString());
    }

}
