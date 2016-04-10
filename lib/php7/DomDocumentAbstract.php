<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 7, 2016 - 10:31:11 PM
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
 * File         DomDocumentAbstract.php
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
 
abstract class DomDocumentAbstract
{
    /**
     * Select object of this html DomDocument
     * @var unknown
     */
    protected $selectObj;
    
    protected $colors;
    
    protected $color_system;
    
    public function __construct($colors, $color_system)
    {
        $this->colors = $colors;
        $this->color_system = $color_system;
    }
}
