<?php
namespace Vespula\Paginator\Decorator;

use Zend\Diactoros\Uri;

class GenericTest extends \PHPUnit_Framework_TestCase
{
    protected $decorator;
    protected $uri;

    public function setUp()
    {
        $this->decorator = new Generic();
        $this->uri = new Uri('http://example.com?foo=bar');
    }

    public function testSetConfig()
    {
        $config = [
            'foo'=>'bar',
            'lorem'=>'ipsum',
            'container_tag'=>'div'
        ];

        $this->decorator->setConfig($config);

        $expected = [
            'container_tag'=>'div',
            'container_class'=>'pagination',
            'item_class'=>null,
            'item_tag'=>'li',
            'disabled_class'=>'disabled',
            'active_class'=>'active',
            'text_first'=>'First',
            'text_last'=>'Last',
            'text_next'=>'Next',
            'text_previous'=>'Previous',
            'aria_previous'=>'Previous page',
            'aria_next'=>'Next page',
            'aria_last'=>'Last page',
            'aria_first'=>'First page',
            'aria_current'=>'You are on page %s',
            'aria_page'=>'Page %s',
            'foo'=>'bar',
            'lorem'=>'ipsum'
        ];

        $this->assertEquals($expected, $this->decorator->getConfig());
    }

    public function testSetConfigKey()
    {
        $this->decorator->setConfigKey('foo', 'boo');

        $expected = [
            'container_tag'=>'ul',
            'container_class'=>'pagination',
            'item_class'=>null,
            'item_tag'=>'li',
            'disabled_class'=>'disabled',
            'active_class'=>'active',
            'text_first'=>'First',
            'text_last'=>'Last',
            'text_next'=>'Next',
            'text_previous'=>'Previous',
            'aria_previous'=>'Previous page',
            'aria_next'=>'Next page',
            'aria_last'=>'Last page',
            'aria_first'=>'First page',
            'aria_current'=>'You are on page %s',
            'aria_page'=>'Page %s',
            'foo'=>'boo',
        ];

        $this->assertEquals($expected, $this->decorator->getConfig());
    }

    public function testBuildList()
    {
        $page = 1;
        $page_count = 3;
        $page_numbers = [1,2,3];
        $param = 'p';

        $list = $this->decorator->buildList($page, $page_count, $page_numbers, $this->uri, $param);

        $expected = [
            [
                'text'=>'First',
                'active'=>false,
                'disabled'=>true,
                'rel'=>Generic::FIRST,
                'href'=>$this->uri->withQuery('foo=bar&p=1')
            ],
            [
                'text'=>'Previous',
                'active'=>false,
                'disabled'=>true,
                'rel'=>Generic::PREV,
                'href'=>$this->uri->withQuery('foo=bar&p=1')
            ],
            [
                'text'=>1,
                'active'=>true,
                'disabled'=>false,
                'rel'=>Generic::SELF,
                'href'=>$this->uri->withQuery('foo=bar&p=1')
            ],
            [
                'text'=>2,
                'active'=>false,
                'disabled'=>false,
                'rel'=>null,
                'href'=>$this->uri->withQuery('foo=bar&p=2')
            ],
            [
                'text'=>3,
                'active'=>false,
                'disabled'=>false,
                'rel'=>null,
                'href'=>$this->uri->withQuery('foo=bar&p=3')
            ],
            [
                'text'=>'Next',
                'active'=>false,
                'disabled'=>false,
                'rel'=>Generic::NEXT,
                'href'=>$this->uri->withQuery('foo=bar&p=2')
            ],
            [
                'text'=>'Last',
                'active'=>false,
                'disabled'=>false,
                'rel'=>Generic::LAST,
                'href'=>$this->uri->withQuery('foo=bar&p=3')
            ]
        ];

        $this->assertEquals($expected, $list);

    }

    public function testBuild()
    {
        $expected = '<ul class="pagination">' . PHP_EOL .
            '    <li class="disabled">First</li>' . PHP_EOL .
            '    <li class="disabled">Previous</li>' . PHP_EOL .
            '    <li class="active"><a href="http://example.com?foo=bar&page=1">1</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=2">2</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=3">3</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=2">Next</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=3">Last</a></li>' . PHP_EOL .
            '</ul>';

        $page = 1;
        $page_count = 3;
        $page_numbers = [1,2,3];

        $list = $this->decorator->buildList($page, $page_count, $page_numbers, $this->uri);

        $this->decorator->build($list);
        $actual = $this->decorator->getHtml();

        $this->assertEquals($expected, $actual);
    }
}
