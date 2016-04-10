<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 8, 2016 - 12:52:41 AM
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
 * File         DomSelectOptionTests.php
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

class DomSelectOptionsTests extends PHPUnit_Framework_TestCase
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

    public function test_css()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectOptionInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->css());
        
        $css = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->css(true, true, 'custom-css-class');
        
        $css_custom = $this->getProperty($this->SC->cs('RAL')
            ->html()
            ->select()
            ->option(), 'css_custom');
        $css_bg = $this->getProperty($this->SC->cs('RAL')
            ->html()
            ->select()
            ->option(), 'css_bg');
        $css_fg = $this->getProperty($this->SC->cs('RAL')
            ->html()
            ->select()
            ->option(), 'css_fg');
        
        $this->assertTrue($css_bg);
        $this->assertTrue($css_fg);
        $this->assertEquals('custom-css-class', $css_custom);
    }

    public function test_label()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectOptionInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->label());
        
        $set_label = '{ID}-{NAME}';
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->label($set_label);
        
        $attr_label = $this->getProperty($this->SC->cs('RAL')
            ->html()
            ->select()
            ->option(), 'attr_label');
        
        $this->assertEquals($set_label, $attr_label);
    }

    public function test_value()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectOptionInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->value());
        
        $set_value = '{ID}-{NAME}';
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->value('{ID}-{NAME}');
        
        $attr_value = $this->getProperty($this->SC->cs('RAL')
            ->html()
            ->select()
            ->option(), 'attr_value');
        
        $this->assertEquals($set_value, $attr_value);
    }

    public function test_text()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectOptionInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->text());
        
        $set_text = '{ID}-{NAME}';
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->text('{ID}-{NAME}');
        
        $attr_text = $this->getProperty($this->SC->cs('RAL')
            ->html()
            ->select()
            ->option(), 'attr_text');
        
        $this->assertEquals($set_text, $attr_text);
    }

    public function test_disabled()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectOptionInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->disabled());
        /* Default must be false */
        $disabled = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->disabled();
        $this->assertFalse($this->getProperty($disabled, 'disabled_colors'));
        
        /* Only these colors */
        $disabled_colors = array(
            'color-01',
            'color-02'
        );
        $colors2 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->disabled($disabled_colors);
        
        $attr_disabled_colors = $this->getProperty($colors2, 'disabled_colors');
        $this->assertInternalType('array', $attr_disabled_colors);
        
        $this->assertEquals($disabled_colors, $attr_disabled_colors);
    }

    public function test_selected()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectOptionInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->selected());
        
        $selected = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->selected('color-code-1');
        
        $attr_selected = $this->getProperty($selected, 'selected_color');
        
        $this->assertEquals('color-code-1', $attr_selected);
    }

    public function test_attr()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectOptionInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->attr());
        
        $attributes = array(
            'data-id' => 1,
            'data-name' => 2
        );
        
        foreach ($attributes as $attr => $value) {
            $this->SC->cs('RAL')
                ->html()
                ->select()
                ->option()
                ->attr($attr, $value);
        }
        
        $this->assertEquals($attributes, $this->getProperty($this->SC->cs('RAL')
            ->html()
            ->select()->option(), 'attributes'));
    }

    public function test_functions()
    {
        $methods = get_class_methods($this->SC->cs('RAL')
            ->html()
            ->select()
            ->option());
        
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

    public function test_render()
    {
        $this->assertInternalType('string', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->render());
    
    }
    
    public function getProperty($obj, $prop_name)
    {
        $tmp = new \ReflectionClass($obj);
        $prop = $tmp->getProperty($prop_name);
        $prop->setAccessible(true);
        return $prop->getValue($obj);
    }
}
 