<?php

namespace Vespula\Paginator;

/**
 * This paginator creates html links, generally in the form of an unordered list
 * for display on a web page. All that is required is a page number, total record 
 * number, and URI object.
 * 
 * The output is formatted based on decorators. It comes with a generic decorator, 
 * and one each for Bootstrap and Foundation.
 * 
 * Custom decorators can be created so long as they implement the DecoratorInterface. 
 * They should extend the AbstractDecorator.
 * 
 * @author Jon Elofson <jon.elofson@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */


use Psr\Http\Message\UriInterface;
use Vespula\Paginator\Decorator\DecoratorInterface;

class Paginator 
{
    /**
     * The decorator
     * 
     * @var DecoratorInterface
     */
    protected $decorator;
    
    /**
     * The rows per page
     * 
     * @var int
     */
    protected $paging = 10;
    
    /**
     * The current page number
     * @var int
     */
    protected $page;
    
    /**
     * The number of pages
     * @var integer
     */
    protected $total;


    /**
     * Constructor
     * 
     * @param DecoratorInterface $decorator
     */
    public function __construct(DecoratorInterface $decorator)
    {
        $this->decorator = $decorator;

    }
    
    /**
     * Get the current decorator
     * 
     * @return DecoratorInterface
     */
    public function getDecorator()
    {
        return $this->decorator;
    }
    
    /**
     * Set the decorator object
     * 
     * @param DecoratorInterface $decorator
     */
    public function setDecorator(DecoratorInterface $decorator)
    {
        $this->decorator = $decorator;
    }
    
    /**
     * Set the paging value
     * 
     * @param int $paging
     * @return $this
     */
    public function setPaging($paging)
    {
        // Rather than forcing php 7 type declaration
        $this->paging = (int) $paging;
        if ($this->paging == 0) {
            $this->paging = 10;
        }
        return $this;
    }
    
    /**
     * Returns information about the pagination. Total, starting and ending 
     * record #s, number of pages, current page, records, per page
     * 
     * @return array Metadata about the pagination
     */
    public function getMeta()
    {
        $pages = ceil($this->total / $this->paging);

        $start = (($this->page - 1) * $this->paging) + 1;
        
        if ($this->total == 0) {
            $start = 0;
        }
        
        $end = $this->page * $this->paging;
        if ($end > $this->total) {
            $end = $this->total;
        }

        $meta = [
            'page'=>$this->page,
            'total'=>$this->total,
            'pages'=>$pages,
            'paging'=>$this->paging,
            'start'=>$start,
            'end'=>$end
        ];
        
        return $meta;
    }
    
    /**
     * Get the html that displays the pagination (1,2,3,4, etc)
     * 
     * @param integer $page Current page number
     * @param integer $total Total number of records
     * @param UriInterface $uri The uri for creating links
     * @param type $param The 'page' query parameter
     * @return string HTML for the pagination.
     */
    public function paginate($page, $total, UriInterface $uri, $param = 'page')
    {

        $page_count = ceil($total / $this->paging);
        
        if ($page > $page_count) {
            $page = $page_count;
        }
        
        if ($page < 1) {
            $page = 1;
        }
        
        $this->page = $page;
        $this->total = $total;
        
        $page_numbers = $this->getPageNumbers($page, $page_count);
        $list = [];
        
        if ($page_numbers) {
            $list = $this->decorator->buildList($page, $page_count, $page_numbers, $uri, $param);
        }
        
        if ($list) {
            $this->decorator->build($list);
        }
        
        
        return $this->decorator->getHtml();
    }  
    
    /**
     * Get the array of page numbers 
     * 
     * @param int $page Page number
     * @param int $page_count Number of pages
     * @return array
     */
    protected function getPageNumbers($page, $page_count)
    {
        if ($page_count == 0) {
            return [];
        }
        if ($page_count <= 10) {
            return range(1, $page_count);
        }
        
        if ($page <= 6) {
            return range(1, 10);
        }
        
        $end = $page + 4;
        if ($end >= $page_count) {
            $end = $page_count;
        }
        
        $start = $end - 9;
        if ($start < 1) {
            $start = 1;
        }
        
        return range($start, $end);
    }
}