<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 7, 2016 - 11:25:21 PM
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
 * File         DomSelectAbstract.php
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

abstract class DomSelectAbstract
{

    protected $color_system;
    /**
     * Select option object of this html DomDocument
     *
     * @var unknown
     */
    protected $optionObj;

    /**
     * Select ID attribute
     *
     * @var string
     */
    protected $attr_id = false;

    /**
     * Select name attribute
     *
     * @var string
     */
    protected $attr_name = true;

    /**
     * Select autofocus attribute
     *
     * @var bool
     */
    protected $attr_autofocus = false;

    /**
     * Select disabled attribute
     *
     * @var bool
     */
    protected $attr_disabled = false;

    /**
     * Select multible attribute
     *
     * @var bool
     */
    protected $attr_multiple = false;

    /**
     * Select required attribute
     *
     * @var buul
     */
    protected $attr_required = false;

    /**
     * Select size attribute
     *
     * @var int
     */
    protected $attr_size = 0;

    /**
     * Show only colors set by filter in option list
     *
     * @var array
     */
    protected $filter_colors = false;

    /**
     * CSS classes
     *
     * @var string
     */
    protected $css_classes = false;

    /**
     * Other HTML global or event attributes
     *
     * @var array
     */
    protected $attributes = false;
    
    public function __construct($colors, $color_system)
    {
        $this->color_system = $color_system;
        $this->colors = $colors;
        $this->name(true);
    }
}
 