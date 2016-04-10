<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 4, 2016 - 10:42:44 PM
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
 * File         DomDocument.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */
namespace StandardColors\lib\php5\html;

use \StandardColors\interfaces\html\DomDocumentInterface;


/* Specific for PHP v5.x */
use \StandardColors\lib\php5\DomDocumentAbstract;
use \StandardColors\lib\php5\html\DomSelect;

class DomDocument extends DomDocumentAbstract implements DomDocumentInterface
{

    /**
     * Retruns new or loaded select object for current html DomDocument
     *
     * @return DomSelectInterface
     */
    public function select()
    {
        /* @formatter:off */
        return (! $this->selectObj instanceof DomSelect)
        ? ($this->selectObj = new DomSelect($this->colors, $this->color_system))
        : $this->selectObj;
        /* @formatter:on */
    }
}
 