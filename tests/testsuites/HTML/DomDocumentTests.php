<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 4, 2016 - 9:22:16 PM
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
 * File         DomSelectTests.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */
use \StandardColors\ColorSystems;

class DomDocumentTests extends PHPUnit_Framework_TestCase
{

    protected $SC;

    /**
     * Setup the test
     */
    protected function setUp()
    {
        if ($this->SC instanceof \StandardColors\ColorSystems)
            return;
        
        $this->SC = new ColorSystems();
    }

    /**
     * Add Custom warnings
     *
     * @param string $msg            
     * @param Exception $previous            
     */
    protected function addWarning($msg, Exception $previous = null)
    {
        $add_warning = $this->getTestResultObject();
        $msg = new PHPUnit_Framework_Warning($msg, 0, $previous);
        $add_warning->addWarning($this, $msg, time());
        $this->setTestResultObject($add_warning);
    }

    /**
     * Make sure we get ocject instance of DomSelectInterface
     */
    public function test_select()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectInterface', $this->SC->cs('RAL')
            ->html()
            ->select());
    }

    public function test_functions()
    {
        $methods = get_class_methods($this->SC->cs('RAL')->html());
        
        if (! $methods)
            return false;
        
        foreach ($methods as $method) {
            $skip = array(
                '__construct'
            );
            if (! in_array($method, $skip) && ! method_exists($this, "test_$method")) {
                $this->addWarning("Method $method has no test_$method! Implement test or add method into 'skip' array");
                
                break;
            }
        }
        $this->assertNull(null);
    }
}
 