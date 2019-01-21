<?php

namespace Vespula\Paginator\Decorator;

/**
 * This file is part of Vespula\Paginator
 * 
 * @author Jon Elofson <jon.elofson@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

use Vespula\Paginator\Decorator\Element;

class Bootstrap extends AbstractDecorator
{
    /**
     * Adapter/Decorator specific config
     * 
     * @var array
     */
    protected $adapter_config = [
        'aria_current'=>'(current)',
        'sr_class'=>'sr-only'
    ];

    /**
     * {@inheritDoc}
     * 
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
                $linkElement = new Element('span');
                $spanElement = new Element('span');
                $spanElement->addAttribute('class', $this->config['sr_class']);
                $spanElement->setText($this->config['aria_current']);
                $linkElement->setText($item['text'] . ' ' . $spanElement);

            } else {
                $linkElement = new Element('a');
                $linkElement->addAttribute('href', $item['href']);
                $linkElement->setText($item['text']);

            }

            if ($item['disabled']) {
                $itemElement->addAttribute('class', $this->config['disabled_class']);
                $linkElement = new Element('span');
                $linkElement->setText($item['text']);
            }

            switch ($item['rel']) {
                case self::FIRST :
                    $linkElement->addAttribute('aria-label', $this->config['aria_first']);
                break;
                case self::LAST :
                    $linkElement->addAttribute('aria-label', $this->config['aria_last']);
                break;
                case self::PREV :
                    $linkElement->addAttribute('aria-label', $this->config['aria_previous']);
                break;
                case self::NEXT :
                    $linkElement->addAttribute('aria-label', $this->config['aria_next']);
                break;
                default :
                    $linkElement->addAttribute('aria-label', sprintf($this->config['aria_page'], $item['text']));
                break;
            }

            $itemElement->setText($linkElement);

            $listElements[] = '    ' . $itemElement;
        }

        $listHtml = implode(PHP_EOL, $listElements);
        $container->setText(PHP_EOL . $listHtml . PHP_EOL);

        $this->html = $container;

    }


}
