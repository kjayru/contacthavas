<?php
namespace Vespula\Paginator\Decorator;
use Vespula\Paginator\Paginator;
use Zend\Diactoros\Uri;

class PaginatorTest extends \PHPUnit_Framework_TestCase
{
    public function testPaginate()
    {
        $paginator = new Paginator(new Generic());

        $expected = '<ul class="pagination">' . PHP_EOL .
            '    <li class="disabled">First</li>' . PHP_EOL .
            '    <li class="disabled">Previous</li>' . PHP_EOL .
            '    <li class="active"><a href="http://example.com?page=1">1</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?page=2">2</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?page=3">3</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?page=2">Next</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?page=3">Last</a></li>' . PHP_EOL .
            '</ul>';

        $uri = new Uri('http://example.com');
        $actual = $paginator->paginate(1, 30, $uri);

        $this->assertEquals($expected, $actual);
    }
    
    public function testGetMeta()
    {
        $paginator = new Paginator(new Generic());

        $expected = [
            'page'=>1,
            'total'=>30,
            'pages'=>3,
            'paging'=>10,
            'start'=>1,
            'end'=>10,
        ];

        $uri = new Uri('http://example.com');
        $paginator->paginate(1, 30, $uri);
        $actual = $paginator->getMeta();
        $this->assertEquals($expected, $actual);
    }
    
    public function testPaginateZeroTotal()
    {
        $paginator = new Paginator(new Generic());

        $expected = null;

        $uri = new Uri('http://example.com');
        $actual = $paginator->paginate(1, 0, $uri);

        $this->assertEquals($expected, $actual);
    }
    
    public function testMetaZeroTotal()
    {
        $paginator = new Paginator(new Generic());

        $expected = [
            'page'=>1,
            'total'=>0,
            'pages'=>0,
            'paging'=>10,
            'start'=>0,
            'end'=>0,
        ];

        $uri = new Uri('http://example.com');
        $paginator->paginate(1, 0, $uri);
        $actual = $paginator->getMeta();
        $this->assertEquals($expected, $actual);
    }
}
