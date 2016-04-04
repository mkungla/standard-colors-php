<?php

/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 4, 2016 - 1:22:13 AM
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
 * File         GeneralTests.php
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

class GeneralTests extends PHPUnit_Framework_TestCase
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

    public function test_general()
    {
        $this->assertInstanceOf('\StandardColors\ColorSystems',$this->SC);
    }
    
    /**
     * Locales should be array
     */
    public function test_getLocales()
    {
        $this->assertInternalType('array',$this->SC->getLocales());
    }
    
    /**
     * Default locale should be en_US
     */
    public function test_getLocale()
    {
        $this->assertEquals('en_US',$this->SC->getLocale());
    
    }
    
    /**
     * Setting supported locales
     */
    public function test_setLocale()
    {
        /* Default should be en_US */
        $this->assertEquals('en_US',$this->SC->getLocale());
        
        /* Set each supported locale */
        foreach($this->SC->getLocales() as $locale)
        {
            $this->assertTrue($this->SC->setLocale($locale));
            $this->assertEquals($locale,$this->SC->getLocale());
        }
        
        /* Set default back */
        $this->assertTrue($this->SC->setLocale('en_US'));
        $this->assertEquals('en_US',$this->SC->getLocale());
        
        /* Try to set non existsiong locale */
        $this->assertFalse($this->SC->setLocale('XXX'));
        $this->assertEquals('en_US',$this->SC->getLocale());
    }
    
    /**
     * Supported color systems array
     */
    public function test_getSupportedColorSystems()
    {
        $this->assertInternalType('array',$this->SC->getSupportedColorSystems());
    }
    
    /**
     * Is $this->CS OK?
     */
    public function test_cs()
    {
        foreach($this->SC->getSupportedColorSystems() as $CS => $conf)
        {
            $this->assertInstanceOf('\StandardColors\interfaces\ColorSystemIntreface',$this->SC->cs($CS));
        }
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
    

    public function test_functions()
    {
        $methods = get_class_methods($this->SC);
        
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
