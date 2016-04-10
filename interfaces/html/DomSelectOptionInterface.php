<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 7, 2016 - 11:31:11 PM
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
 * File         DomSelectOptionInterface.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */
namespace StandardColors\interfaces\html;

interface DomSelectOptionInterface
{

    /**
     * Enable disable background and foreground css classes or add custom
     *
     * @param bool $css_bg            
     * @param bool $css_fg            
     * @param string $css_custom            
     * @return self
     */
    public function css($css_bg = false, $css_fg = false, $css_custom = false);

    /**
     * Option lable attribute {ID} | {KEY} | {NAME} | 
     * bool: false; to disable lable 
     *
     * @param true $attr_lable            
     * @return self
     */
    public function label($attr_lable = false);

    /**
     * Option value attribute {ID} | {KEY} | {NAME} | 
     * 
     * @param string $attr_value            
     * @return self
     */
    public function value($attr_value = '{ID}');
    
    /**
     * Option text {ID} | {KEY} | {NAME} |
     *
     * @param string $attr_text
     * @return self
     */
    public function text($attr_text = '{ID}');

    /**
     * Add color key to an array which sets colors to have diabled attribute
     *
     * @param string $disabled_colors            
     * @return self
     */
    public function disabled($disabled_colors = false);

    /**
     * Which color will be selected by default
     *
     * @param string $selected_color            
     * @return self
     */
    public function selected($selected_color = false);

    /**
     * Set any other HTML global or event attributes by key,val
     *
     * @param string $attr            
     * @param string $val            
     * @return self
     */
    public function attr($attr = false, $val = false);
    
    /**
     * Return html select option element
     *
     * @param  StandardColors\objects\ColorObject $ColorObject;
     * @return string
     */
    public function render(\StandardColors\objects\ColorObject $ColorObject);
}
 