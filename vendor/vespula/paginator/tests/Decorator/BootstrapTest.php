<?php
namespace Vespula\Paginator\Decorator;

use Zend\Diactoros\Uri;

class BootstrapTest extends \PHPUnit_Framework_TestCase
{
    protected $decorator;
    protected $uri;

    public function setUp()
    {
        $this->decorator = new Bootstrap();
        $this->uri = new Uri('http://example.com?foo=bar');
    }

    public function testBuildFirst()
    {
        $expected = '<ul class="pagination">' . PHP_EOL .
            '    <li class="disabled"><span aria-label="First page">First</span></li>' . PHP_EOL .
            '    <li class="disabled"><span aria-label="Previous page">Previous</span></li>' . PHP_EOL .
            '    <li class="active"><span aria-label="Page 1">1 <span class="sr-only">(current)</span></span></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=2" aria-label="Page 2">2</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=3" aria-label="Page 3">3</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=2" aria-label="Next page">Next</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=3" aria-label="Last page">Last</a></li>' . PHP_EOL .
            '</ul>';

        $page = 1;
        $page_count = 3;
        $page_numbers = [1,2,3];

        $list = $this->decorator->buildList($page, $page_count, $page_numbers, $this->uri);

        $this->decorator->build($list);
        $actual = (string) $this->decorator->getHtml();

        $this->assertEquals($expected, $actual);
    }

    public function testBuildLast()
    {
        $expected = '<ul class="pagination">' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=1" aria-label="First page">First</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=2" aria-label="Previous page">Previous</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=1" aria-label="Page 1">1</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=2" aria-label="Page 2">2</a></li>' . PHP_EOL .
            '    <li class="active"><span aria-label="Page 3">3 <span class="sr-only">(current)</span></span></li>' . PHP_EOL .
            '    <li class="disabled"><span aria-label="Next page">Next</span></li>' . PHP_EOL .
            '    <li class="disabled"><span aria-label="Last page">Last</span></li>' . PHP_EOL .
            '</ul>';

        $page = 3;
        $page_count = 3;
        $page_numbers = [1,2,3];

        $list = $this->decorator->buildList($page, $page_count, $page_numbers, $this->uri);

        $this->decorator->build($list);
        $actual = (string) $this->decorator->getHtml();

        $this->assertEquals($expected, $actual);
    }

    public function testBuildMiddle()
    {
        $expected = '<ul class="pagination">' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=1" aria-label="First page">First</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=1" aria-label="Previous page">Previous</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=1" aria-label="Page 1">1</a></li>' . PHP_EOL .
            '    <li class="active"><span aria-label="Page 2">2 <span class="sr-only">(current)</span></span></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=3" aria-label="Page 3">3</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=3" aria-label="Next page">Next</a></li>' . PHP_EOL .
            '    <li><a href="http://example.com?foo=bar&page=3" aria-label="Last page">Last</a></li>' . PHP_EOL .
            '</ul>';

        $page = 2;
        $page_count = 3;
        $page_numbers = [1,2,3];

        $list = $this->decorator->buildList($page, $page_count, $page_numbers, $this->uri);

        $this->decorator->build($list);
        $actual = (string) $this->decorator->getHtml();

        $this->assertEquals($expected, $actual);
    }
}
