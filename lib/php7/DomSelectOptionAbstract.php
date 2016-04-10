<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 7, 2016 - 11:30:31 PM
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
 * File         DomSelectOptionAbstract.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */
namespace StandardColors\lib\php7;

abstract class DomSelectOptionAbstract
{

    protected $css_bg = false;

    protected $css_fg = false;

    protected $css_custom = false;

    protected $attr_label = false;

    protected $attr_id = false;
    
    protected $attr_value = '{ID}';
    
    protected $attr_text = '{ID}';

    protected $disabled_colors = false;

    protected $selected_color = false;

    protected $attributes = false;
}