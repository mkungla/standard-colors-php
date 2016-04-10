<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 6, 2016 - 12:42:15 PM
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
 * File         DomDocumentInterface.php
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

interface DomDocumentInterface
{

    /**
     * Retruns new or loaded select object for current html DomDocument
     * 
     * @return DomSelectInterface
     */
    public function select();
}

 