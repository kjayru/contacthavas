<?php

namespace Vespula\Paginator\Decorator;

/**
 * This file is part of Vespula\Paginator
 * 
 * The element class is responsible for creating simple HTML elements, specifically, 
 * it makes generation of the attributes easier.
 * 
 * @author Jon Elofson <jon.elofson@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

class Element
{
    /**
     * The element tag without <>
     * @var string
     */
    protected $tag;
    
    /**
     * The array of attributes with the attribute name as the key and the 
     * attribute value as the value
     * 
     * @var array
     */
    protected $attributes = [];
    
    /**
     * The optional text (inner html) for the element
     * 
     * @var string
     */
    protected $text;

    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    /**
     * Set the element text
     * 
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
    
    /**
     * Prepend (add to the beginning) text to the current element text
     * 
     * @param string $text
     */
    public function prependText($text)
    {
        $this->text = $text . $this->text;
    }
    
    /**
     * Append (add to the end) text to the current element text
     * 
     * @param string $text
     */
    public function appendText($text)
    {
        $this->text .= $text;
    }

    /**
     * Add an attribute by attribute name
     * 
     * @param string $name Attribute name (class, id, etc)
     * @params string $value The attribute value
     */
    public function addAttribute($name, $value = null)
    {
        $this->attributes[$name] = $value;
    }
    
    /**
     * Append (add to the end) an attribute value to an existing attribute, 
     * or create a new attribute if it doesn't exist.
     * 
     * @param type $name
     * @param type $value
     */
    public function appendAttribute($name, $value)
    {
        if ($this->hasAttribute($name)) {
            $this->attributes[$name] .= ' ' . $value;
        } else {
            $this->attributes[$name] = $value;
        }
    }

    /**
     * Add several attributes at once. Array in key value pairs.
     * 
     * @param array $attributes
     */
    public function addAttributes(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }
    
    /**
     * Check for existence of an attribute by name
     * 
     * @param string $attribute The attribute name
     * @return boolean True if yes, false if no
     */
    protected function hasAttribute($attribute)
    {
        return array_key_exists($attribute, $this->attributes);
    }

    /**
     * Clear (reset) the attribute array to []
     */
    public function clearAttributes()
    {
        $this->attributes = [];
    }

    /**
     * Convert the array of attrbutes to a string representation (class=xxx id=xx)
     * @return string
     */
    protected function attributesToString()
    {
        if (! $this->attributes) {
            return '';
        }
        $attribs = [];

        foreach ($this->attributes as $name=>$value) {
            if ($value === false) {
                continue;
            }
            if (is_null($value) || $value === true) {
                $attribs[] = $name;
                continue;
            }
            $attribs[] = $name . '="' . $value .'"';
        }

        return ' ' . implode(' ', $attribs);
    }

    /**
     * Display the element as a string
     * 
     * @return string
     */
    public function __toString()
    {
        $output =  '<' . $this->tag;
        $attribs = $this->attributesToString();
        $output .= $attribs;

        if ($this->text) {
            $output .= '>' . $this->text . '</' . $this->tag . '>';
            return $output;
        }

        $output .= '/>';
        return $output;
    }
}
