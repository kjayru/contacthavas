<?php

namespace Vespula\Paginator\Decorator;

/**
 * This file is part of Vespula\Paginator
 * 
 * @author Jon Elofson <jon.elofson@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

use Psr\Http\Message\UriInterface;

abstract class AbstractDecorator implements DecoratorInterface
{
    const FIRST = 'first';
    const LAST = 'last';
    const NEXT = 'next';
    const PREV = 'previous';
    const SELF = 'self';

    /**
     * The list of page metadata
     * @var array
     */
    protected $list = [];
    
    /**
     * The resulting HTML for display
     * @var string
     */
    protected $html;

    /**
     * The default configuration
     * 
     * @var array
     */
    protected $config = [
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
        'aria_page'=>'Page %s'
    ];

    /**
     * Adapter (decorator) specific config
     * 
     * @var array
     */
    protected $adapter_config = [];

    /**
     * Constructor. Supply an config overrides
     * 
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->adapter_config = array_merge($this->adapter_config, $config);
        $this->config = array_merge($this->config, $this->adapter_config);
    }

    /**
     * Set the configuration elements after construction
     * 
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = array_merge($this->config, $config);
    }
    
    /**
     * Set a config element by name
     * 
     * @param string $key
     * @param string $value
     */
    public function setConfigKey($key, $value)
    {
        $this->config[$key] = $value;
    }

    /**
     * Get the current configuration
     * 
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Build the list metadata used to create the HTML
     * 
     * @param int $page Current page
     * @param int $page_count Number of pages
     * @param array $page_numbers Array of page numbers
     * @param UriInterface $uri The uri for the hrefs
     * @param string $param The query param for 'page=x'
     * @return array
     */
    public function buildList($page, $page_count, array $page_numbers, UriInterface $uri, $param = 'page')
    {
        foreach ($page_numbers as $number) {
            $href = $this->addQueryParam($uri, $param, $number);
            $active = $number == $page ? true : false;
            $disabled = false;
            $rel = null;
            $text = $number;

            if ($number == $page) {
                $rel = self::SELF;
            }

            $this->list[] = [
                'text'=>$text,
                'active'=>$active,
                'disabled'=>$disabled,
                'rel'=>$rel,
                'href'=>$href,
            ];

        }

        $this->addPrevious($page, $uri, $param);
        $this->addFirst($page, $uri, $param);
        $this->addNext($page, $page_count, $uri, $param);
        $this->addLast($page, $page_count, $uri, $param);

        return $this->list;
    }
    
    /**
     * Add "first" to the list array.
     * 
     * @param int $page Page number
     * @param UriInterface $uri The uri object
     * @param string $param the name of the page param
     */
    protected function addFirst($page, UriInterface $uri, $param)
    {
        $href = $this->addQueryParam($uri, $param, 1);
        $disabled = false;

        if ($page == 1) {
            $disabled = true;
        }

        $text = $this->config['text_first'];

        array_unshift($this->list, [
            'text'=>$text,
            'active'=>false,
            'disabled'=>$disabled,
            'rel'=>self::FIRST,
            'href'=>$href
        ]);
    }
    
    /**
     * Add previous to the list array
     * 
     * @param int $page
     * @param UriInterface $uri
     * @param string $param
     */
    protected function addPrevious($page, UriInterface $uri, $param)
    {
        $href = $this->addQueryParam($uri, $param, $page-1);
        $disabled = false;
        if ($page == 1) {
            $href = $this->addQueryParam($uri, $param, $page);
            $disabled = true;
        }

        $text = $this->config['text_previous'];

        array_unshift($this->list, [
            'text'=>$text,
            'active'=>false,
            'disabled'=>$disabled,
            'rel'=>self::PREV,
            'href'=>$href
        ]);
    }

    /**
     * Add "Next" to the page list metadata 
     * 
     * @param int $page
     * @param int $page_count
     * @param UriInterface $uri
     * @param string $param
     */
    protected function addNext($page, $page_count, UriInterface $uri, $param)
    {
        $href = $this->addQueryParam($uri, $param, $page+1);
        $disabled = false;
        if ($page == $page_count) {
            $href = $this->addQueryParam($uri, $param, $page);
            $disabled = true;
        }

        $text = $this->config['text_next'];

        array_push($this->list, [
            'text'=>$text,
            'active'=>false,
            'disabled'=>$disabled,
            'rel'=>self::NEXT,
            'href'=>$href
        ]);
    }

    /**
     * Add "Last" to the page list metadata 
     * 
     * @param int $page
     * @param int $page_count
     * @param UriInterface $uri
     * @param string $param
     */
    protected function addLast($page, $page_count, UriInterface $uri, $param)
    {
        $href = $this->addQueryParam($uri, $param, $page_count);
        $disabled = false;

        if ($page == $page_count) {
            $disabled = true;
        }

        $text = $this->config['text_last'];

        array_push($this->list, [
            'text'=>$text,
            'active'=>false,
            'disabled'=>$disabled,
            'rel'=>self::LAST,
            'href'=>$href
        ]);
    }
    
    /**
     * Add a query param to the URI
     * 
     * @param UriInterface $uri
     * @param string $param
     * @param string $value
     * @return UriInterface
     */
    protected function addQueryParam(UriInterface $uri, $param, $value)
    {
        $queryString = $uri->getQuery();
        $queryArray = [];
        parse_str($queryString, $queryArray);
        $queryArray[$param] = $value;

        return $uri->withQuery(http_build_query($queryArray));
    }

    /**
     * Get the finalized HTML string
     * 
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }
}
