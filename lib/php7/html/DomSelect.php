<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 4, 2016 - 9:18:23 PM
 * Contact      marko.kungla@gmail.com
 * @copyright   2016 Marko Kungla - https://github.com/mkungla
 * @license     The MIT License (MIT)
 * 
 * Package name    standard-colors-php
 * @category       mkungla
 * @package        standard-colors
 * @subpackage     php
 * 
 * Lang         PHP (php version >= 5.3)
 * Encoding     UTF-8
 * File         DomSelect.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */
namespace StandardColors\lib\php7\html;

use \StandardColors\interfaces\html\DomSelectInterface;
use \StandardColors\lib\php7\DomSelectAbstract;
use \StandardColors\lib\php7\html\DomSelectOption;

class DomSelect extends DomSelectAbstract implements DomSelectInterface
{

    /**
     *
     * @return DomSelectOptionInterface
     */
    public function option()
    {
        /* @formatter:off */
         return (! $this->optionObj instanceof DomSelectOption)
         ? ($this->optionObj = new DomSelectOption())
         : $this->optionObj;
         /* @formatter:on */
    }

    /**
     * Select id attribute
     *
     * bool true: Color Sytem name, whitespaces replaced with dash,
     * bool false: No id attribute
     * string: custom id
     *
     * @param
     *            string | bool $attr_id
     * @return self
     */
    public function id($attr_id = false)
    {
        $this->attr_id = $attr_id === true ? 'CS-' . str_replace(' ', '-', $this->color_system) : (is_string($attr_id) ? $attr_id : false);
        
        return $this;
    }

    /**
     * Select name attribute
     *
     * bool true: Color Sytem name, whitespaces replaced with dash perfixed CS-,
     * bool false: No name attribute
     * string: custom name attribute
     *
     * @param
     *            string | bool $attr_id
     * @return self
     */
    public function name($attr_name = true)
    {
        $this->attr_name = $attr_name === true ? 'CS-' . str_replace(' ', '-', $this->color_system) : (is_string($attr_name) ? $attr_name : false);
        
        return $this;
    }

    /**
     * Work with color keys only found in provided array.
     * Default uses all colors
     *
     * @param
     *            string | bool $filter_colors
     * @return self
     */
    public function colors($filter_colors = false)
    {
        if (is_array($filter_colors) && ! empty($filter_colors))
            $this->filter_colors = $filter_colors;
        
        return $this;
    }

    /**
     * Add css classes to select
     *
     * @param string $css_classes            
     * @return self
     */
    public function css($css_classes = false)
    {
        if (is_string($css_classes))
            $this->css_classes = $css_classes;
        
        return $this;
    }

    /**
     * Add autofocus attribute to select
     *
     * @param string $attr_autofocus            
     * @return self
     */
    public function autofocus($attr_autofocus = false)
    {
        $this->attr_autofocus = is_bool($attr_autofocus) ? $attr_autofocus : false;
        return $this;
    }

    /**
     * Add disabled attribute to select
     *
     * @param string $attr_disabled            
     * @return self
     */
    public function disabled($attr_disabled = false)
    {
        $this->attr_disabled = is_bool($attr_disabled) ? $attr_disabled : false;
        return $this;
    }

    /**
     * Add multiple attribute to select
     *
     * @param string $attr_multiple            
     * @return self
     */
    public function multiple($attr_multiple = false)
    {
        $this->attr_multiple = is_bool($attr_multiple) ? $attr_multiple : false;
        return $this;
    }

    /**
     * Add required attribute to select
     *
     * @param string $attr_required            
     * @return self
     */
    public function required($attr_required = false)
    {
        $this->attr_required = is_bool($attr_required) ? $attr_required : false;
        return $this;
    }

    /**
     * Set size attribute of select
     *
     * @param number $attr_size            
     * @return self
     */
    public function size($attr_size = 0)
    {
        $this->attr_size = is_int($attr_size) ? $attr_size : 0;
        return $this;
    }

    /**
     * Set any other HTML global or event attributes by key,val
     *
     * $attributes
     *
     * @param string $attr            
     * @param string $val            
     * @return self
     */
    public function attr($attr = false, $val = false)
    {
        if (is_string($attr) && ! empty($val))
            $this->attributes[$attr] = $val;
        return $this;
    }

    /**
     * Return html select element
     *
     * @return string
     */
    public function render($use_rgb = false)
    {
        $select = '<select';
        $select .= $this->nodeId();
        $select .= $this->nodeName();
        $select .= $this->nodeCss();
        $select .= $this->nodeSize();
        $select .= $this->nodeAutofocus();
        $select .= $this->nodeDisabled();
        $select .= $this->nodeMultiple();
        $select .= $this->nodeRequired();
        $select .= $this->nodeAttr();
        $select .= '>'."\n";
        $select .= $this->nodeOptions($use_rgb);
        $select .= '</select>' . "\n";
        return $select;
    }

    private function nodeId()
    {
        $attr_id = ($this->attr_id === true) ? $this->color_system : (is_string($this->attr_id) ? $this->attr_id : false);
        return empty($attr_id) ? '' : sprintf(' id="%s"', $attr_id);
    }

    private function nodeName()
    {
        $attr_name = ($this->attr_name === true) ? $this->color_system : (is_string($this->attr_name) ? $this->attr_name : false);
        return empty($attr_name) ? '' : sprintf(' name="%s"', $attr_name);
    }

    private function nodeCss()
    {
        $css_classes = (is_string($this->css_classes) && ! empty($this->css_classes) ? $this->css_classes : false);
        return empty($css_classes) ? '' : sprintf(' class="%s"', $css_classes);
    }
    
    private function nodeAutofocus()
    {
        return empty($this->attr_autofocus) ? '' : ' autofocus'; 
    }
    
    private function nodeDisabled()
    {
        return empty($this->attr_disabled) ? '' : ' disabled';
    }
    
    private function nodeMultiple()
    {
        return empty($this->attr_multiple) ? '' : ' multiple';
    }
    
    private function nodeRequired()
    {
        return empty($this->attr_required) ? '' : ' required';
    }
    
    private function nodeSize()
    {
        $attr_size = (is_int($this->attr_size) && !empty($this->attr_size)) ? $this->attr_size : false;
        return empty($attr_size) ? '' : sprintf(' size="%d"', $attr_size);
    }
    
    private function nodeAttr()
    {
        if(!is_array($this->attributes) || empty($this->attributes))
            return '';
        
        $attributes = '';
        foreach($this->attributes as $attribute => $value)
        {
            $attributes .= sprintf(' %s="%s"',(string) $attribute, (string) $value);
        }
        return $attributes;
    }
    
    private function nodeOptions($use_rgb = false)
    {
        $options = '';
        if(is_array($this->filter_colors) && !empty($this->filter_colors))
        {
            foreach($this->filter_colors as $color)
            {
                if(array_key_exists($color,$this->colors))
                    $options .= "\t".$this->option()->render($this->colors[$color],$use_rgb);
            }
        }
        return $options;
    }
}
 