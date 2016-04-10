<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 3, 2016 - 7:05:40 PM
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
 * File         ColorObject.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */
namespace StandardColors\objects;

class ColorObject
{

    public $ID;

    public $KEY;
    
    public $name;

    public $red;

    public $green;

    public $blue;
    
    public $hex;
    
    public $text_type;
    
    public $text_hex;
    
    public $text_red;
    
    public $text_green;
    
    public $text_blue;
    
    public $css_fg_hex;
    
    public $css_fg_rgb;
    
    public $css_bg_hex;
    
    public $css_bg_rgb;
    
    /**
     * Get RGB background color with specified delimitter
     * 
     * @param string $delimitter
     * @return string
     */
    public function bg($delimitter = ',')
    {
        return implode($delimitter, array($this->red, $this->green, $this->blue));
    }
    
    /**
     * Get RGB foreground color with specified delimitter
     *
     * @param string $delimitter
     * @return string
     */
    public function fg($delimitter = ',')
    {
        return implode($delimitter, array($this->text_red, $this->text_green, $this->text_blue));
    }
}
 