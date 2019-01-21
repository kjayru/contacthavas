<?php

namespace Vespula\Paginator\Decorator;

/**
 * This file is part of Vespula\Paginator
 * 
 * This is a generic pagination decorator. It produces a simple unordered list
 * 
 * @author Jon Elofson <jon.elofson@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

use Vespula\Paginator\Decorator\Element;

class Generic extends AbstractDecorator
{
    /**
     * {@inheritDoc}
     * @param array $list
     */
    public function build(array $list)
    {
        $container = new Element($this->config['container_tag']);

        if ($this->config['container_class']) {
            $container->addAttribute('class', $this->config['container_class']);
        }
        
        $listElements = [];
        foreach ($list as $item) {
            $itemElement = new Element($this->config['item_tag']);
            if ($item['active']) {
                $itemElement->addAttribute('class', $this->config['active_class']);
            }
            
            if (! $item['disabled']) {
                $linkElement = new Element('a');
                $linkElement->addAttribute('href', $item['href']);
                
                $linkElement->setText($item['text']);
                $itemElement->setText($linkElement);
            } else {
                $itemElement->addAttribute('class', $this->config['disabled_class']);
                $itemElement->setText($item['text']);
            }
            
            $listElements[] = '    ' . $itemElement;
        }
        
        $listHtml = implode(PHP_EOL, $listElements);
        $container->setText(PHP_EOL . $listHtml . PHP_EOL);
        
        $this->html = $container;

    }


}
