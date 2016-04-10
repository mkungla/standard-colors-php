<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 7, 2016 - 11:28:25 PM
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
 * File         DomSelectOption.php
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

use \StandardColors\interfaces\html\DomSelectOptionInterface;
use \StandardColors\lib\php7\DomSelectOptionAbstract;

class DomSelectOption extends DomSelectOptionAbstract implements DomSelectOptionInterface
{

    /**
     * Enable disable background and foreground css classes or add custom
     *
     * @param bool $css_bg            
     * @param bool $css_fg            
     * @param string $css_custom            
     * @return self
     */
    public function css($css_bg = false, $css_fg = false, $css_custom = false)
    {
        if (is_string($css_custom))
            $this->css_custom = $css_custom;
        
        $this->css_bg = is_bool($css_bg) ? $css_bg : false;
        $this->css_fg = is_bool($css_fg) ? $css_fg : false;
        return $this;
    }

    /**
     * Option lable attribute {ID} | {KEY} | {NAME}
     *
     * @param string $attr_lable            
     * @return self
     */
    public function label($attr_label = false)
    {
        if (is_string($attr_label) || $attr_label === false)
            $this->attr_label = $attr_label;
        
        return $this;
    }

    /**
     * Option value attribute {ID} | {KEY} | {NAME} |
     *
     * @param string $attr_value            
     * @return self
     */
    public function value($attr_value = '{ID}')
    {
        if (is_string($attr_value) || $attr_value === false)
            $this->attr_value = $attr_value;
        return $this;
    }

    

    /**
     * Add color key to an array which sets colors to have diabled attribute
     *
     * @param string $disabled_colors            
     * @return self
     */
    public function disabled($disabled_colors = false)
    {
        if (is_array($disabled_colors) || $disabled_colors === false)
            $this->disabled_colors = $disabled_colors;
        return $this;
    }

    /**
     * Which color will be selected by default
     *
     * @param string $selected_color            
     * @return self
     */
    public function selected($selected_color = false)
    {
        if (is_string($selected_color) || $selected_color === false)
            $this->selected_color = $selected_color;
        return $this;
    }

    /**
     * Set any other HTML global or event attributes by key,val
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
     * Option text {ID} | {KEY} | {NAME} |
     *
     * @param string $attr_text
     * @return self
     */
    public function text($attr_text = '{ID}')
    {
        if (is_string($attr_text) || $attr_text === false)
            $this->attr_text = $attr_text;
            return $this;
    }
    
    /**
     * Return html select option element
     *
     * @param StandardColors\objects\ColorObject $ColorObject;            
     * @return string
     */
    public function render(\StandardColors\objects\ColorObject $ColorObject, $use_rgb = false)
    {
        $option = '<option';
        /* CSS */
        $css_bg = ($this->css_bg) ? (($use_rgb) ? $ColorObject->css_bg_rgb : $ColorObject->css_bg_hex) : false;
        $css_fg = ($this->css_fg) ? (($use_rgb) ? $ColorObject->css_fg_rgb : $ColorObject->css_fg_hex) : false;
        $css_custom = is_string($this->css_custom) ? $this->css_custom : false;
        $css_classes = ! empty($css_bg) ? $css_bg : '';
        $css_classes .= ! empty($css_fg) ? ' ' . $css_fg : '';
        $css_classes .= ! empty($css_custom) ? ' ' . $css_custom : '';
        $option .= ! empty($css_classes) ? sprintf(' class="%s"', $css_classes) : '';
        $option .= $this->nodeLabel($ColorObject);
        $option .= $this->nodeValue($ColorObject);
        $option .= $this->nodeDisabled($ColorObject);
        $option .= $this->nodeSelected($ColorObject);
        $option .= $this->nodeAttr($ColorObject);
        $option .= '>';
        $option .= $this->nodeText($ColorObject);
        $option .= '</option>' . "\n";
        return $option;
    }

    private function nodeText(\StandardColors\objects\ColorObject $ColorObject)
    {
        return (empty($this->attr_text) || ! is_string($this->attr_text)) ? $ColorObject->ID : $this->nodeTagReplace($ColorObject, $this->attr_text);
    }
    
    private function nodeLabel(\StandardColors\objects\ColorObject $ColorObject)
    {
        return (empty($this->attr_label) || ! is_string($this->attr_label)) ? '' : sprintf(' label="%s"',$this->nodeTagReplace($ColorObject, $this->attr_label));
    }
    
    private function nodeValue(\StandardColors\objects\ColorObject $ColorObject)
    {
        return (empty($this->attr_value) || ! is_string($this->attr_value)) ? '' : sprintf(' value="%s"',$this->nodeTagReplace($ColorObject, $this->attr_value));
    }

    private function nodeDisabled(\StandardColors\objects\ColorObject $ColorObject)
    {
        return !is_array($this->disabled_colors) ? '' : (in_array($ColorObject->KEY, $this->disabled_colors) ? ' disabled' : '');
    }
    
    private function nodeSelected(\StandardColors\objects\ColorObject $ColorObject)
    {
        return empty($this->selected_color) ? '' : ($this->selected_color == $ColorObject->KEY ? ' selected' : '');
    }
    
    private function nodeAttr(\StandardColors\objects\ColorObject $ColorObject)
    {
        $attributes = '';
        if(is_array($this->attributes) && !empty($this->attributes))
        {
            foreach($this->attributes as $attribute => $value)
            {
                $attributes .= sprintf(' %s="%s"',(string) $attribute, (string) $this->nodeTagReplace($ColorObject, $value));
            }
        }
        return $attributes;
    }
    
    private function nodeTagReplace(\StandardColors\objects\ColorObject $ColorObject, $content = '')
    {
        $tags = array(
            '{ID}',
            '{IDD}',
            '{KEY}',
            '{NAME}'
        );
        $values = array(
            $ColorObject->ID,
            str_replace(' ','-',$ColorObject->ID),
            $ColorObject->KEY,
            $ColorObject->name
        );
        
        return str_ireplace($tags, $values, $content);
    }
}

 