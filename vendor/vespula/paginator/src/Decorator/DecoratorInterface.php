<?php

namespace Vespula\Paginator\Decorator;

/**
 * This file is part of Vespula\Paginator
 * 
 * @author Jon Elofson <jon.elofson@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

use Psr\Http\Message\UriInterface;

interface DecoratorInterface
{
    /**
     * Create an array of metadata representing each page in the pagination. The 
     * metadata includes the text, href, active, disabled, and relation relation
     * 
     * @param int $page Current page number
     * @param int $page_count Number of pages
     * @param array $page_numbers An array of page numbers
     * @param UriInterface $uri A uri to created the hrefs
     * @param string $param The query param for "page=x"
     */
    public function buildList($page, $page_count, array $page_numbers, UriInterface $uri, $param = 'page');
    
    /**
     * Build the HTML for the pagination
     * 
     * @param array $list The metadata list for the pages
     * @return void
     */
    public function build(array $list);
    
    /**
     * Get the html generated in build()
     * 
     * @return string The HTML text
     */
    public function getHtml();
}
