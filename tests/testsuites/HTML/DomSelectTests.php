<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 8, 2016 - 12:49:06 AM
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

class DomSelectTests extends PHPUnit_Framework_TestCase
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
     * Make sure we get ocject instance of DomOptionInterface
     */
    public function test_option()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectOptionInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option());
    }

    /**
     * Test that we can set custom id as select id
     *
     * bool true: Color Sytem name, whitespaces replaced with dash,
     * bool false: No id attribute
     * string: custom id
     */
    public function test_id()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->id());
        
        /* bool true */
        $set_id = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->id(true);
        
        $this->assertEquals('CS-RAL', $this->getProperty($set_id, 'attr_id'));
        
        /* bool false */
        $set_id2 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->id(false);
        
        $this->assertFalse($this->getProperty($set_id2, 'attr_id'));
        
        /* Custom string */
        $set_id3 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->id('custom-string');
        
        $this->assertEquals('custom-string', $this->getProperty($set_id3, 'attr_id'));
    }

    /**
     * Test name attribute
     *
     * bool true: Color Sytem name, whitespaces replaced with dash perfixed CS-,
     * bool false: No name attribute
     * string: custom name attribute
     *
     * @param
     *            string | bool $attr_id
     * @return self
     */
    public function test_name()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->name());
        
        /* Test default */
        $set_name = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->name();
        $this->assertEquals('CS-RAL', $this->getProperty($set_name, 'attr_name'));
        
        /* Test false */
        $set_name2 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->name(false);
        $this->assertFalse($this->getProperty($set_name2, 'attr_name'));
        
        /* Test custom */
        $set_name = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->name('custom-name');
        $this->assertEquals('custom-name', $this->getProperty($set_name, 'attr_name'));
    }

    /**
     * Work with color keys only found in provided array.
     * Default uses all colors
     *
     * @param
     *            string | bool $filter_colors
     * @return self
     */
    public function test_colors()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->colors());
        
        /* Default must be false */
        $colors = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->colors();
        $this->assertFalse($this->getProperty($colors, 'filter_colors'));
        
        /* Only these colors */
        $set_filter_colors = array(
            'color-01',
            'color-02'
        );
        $colors2 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->colors($set_filter_colors);
        
        $filter_colors = $this->getProperty($colors2, 'filter_colors');
        $this->assertInternalType('array', $filter_colors);
        
        $this->assertEquals($filter_colors, $set_filter_colors);
    }

    /**
     * Add css classes to select
     *
     * @param string $css_classes            
     * @return self
     */
    public function test_css()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->css());
        
        $set_css = 'custom-css-class';
        $css = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->css($set_css);
        
        $css_attr = $this->getProperty($css, 'css_classes');
        
        $this->assertEquals($set_css, $css_attr);
    }

    public function test_autofocus()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->autofocus());
        
        $autofocus = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->autofocus();
        $autofocus_attr = $this->getProperty($autofocus, 'attr_autofocus');
        $this->assertFalse($autofocus_attr);
        
        $autofocus2 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->autofocus(true);
        $autofocus_attr2 = $this->getProperty($autofocus2, 'attr_autofocus');
        $this->assertTrue($autofocus_attr2);
        
        $autofocus3 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->autofocus();
        $autofocus_attr3 = $this->getProperty($autofocus3, 'attr_autofocus');
        $this->assertFalse($autofocus_attr3);
    }

    /**
     * Add disabled attribute to select
     *
     * @param string $attr_disabled            
     * @return self
     */
    public function test_disabled()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->disabled());
        
        $disabled = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->disabled();
        $disabled_attr = $this->getProperty($disabled, 'attr_disabled');
        $this->assertFalse($disabled_attr);
        
        $disabled2 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->disabled(true);
        $disabled_attr2 = $this->getProperty($disabled2, 'attr_disabled');
        $this->assertTrue($disabled_attr2);
        
        $disabled3 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->disabled();
        $disabled_attr3 = $this->getProperty($disabled3, 'attr_disabled');
        $this->assertFalse($disabled_attr3);
    }

    /**
     * Add multiple attribute to select
     *
     * @param string $attr_multiple            
     * @return self
     */
    public function test_multiple()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->multiple());
        
        $multiple = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->multiple();
        $multiple_attr = $this->getProperty($multiple, 'attr_multiple');
        $this->assertFalse($multiple_attr);
        
        $multiple2 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->multiple(true);
        $multiple_attr2 = $this->getProperty($multiple2, 'attr_multiple');
        $this->assertTrue($multiple_attr2);
        
        $multiple3 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->multiple();
        $multiple_attr3 = $this->getProperty($multiple3, 'attr_multiple');
        $this->assertFalse($multiple_attr3);
    }

    /**
     * Add required attribute to select
     *
     * @param string $attr_required            
     * @return self
     */
    public function test_required()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->required());
        
        $required = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->required();
        $required_attr = $this->getProperty($required, 'attr_required');
        $this->assertFalse($required_attr);
        
        $required2 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->required(true);
        $required_attr2 = $this->getProperty($required2, 'attr_required');
        $this->assertTrue($required_attr2);
        
        $required3 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->required();
        $required_attr3 = $this->getProperty($required3, 'attr_required');
        $this->assertFalse($required_attr3);
    }

    /**
     * Set size attribute of select
     *
     * @param number $attr_size            
     * @return self
     */
    public function test_size()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->size());
        
        $size = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->size();
        $size_attr = $this->getProperty($size, 'attr_size');
        $this->assertEquals(0, $size_attr);
        
        $size2 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->size(10);
        $size_attr2 = $this->getProperty($size2, 'attr_size');
        $this->assertEquals(10, $size_attr2);
        
        $size3 = $this->SC->cs('RAL')
            ->html()
            ->select()
            ->size();
        $size_attr3 = $this->getProperty($size3, 'attr_size');
        $this->assertEquals(0, $size_attr3);
    }

    /**
     * Set any other HTML global or event attributes by key,val
     *
     * $attributes
     *
     * @param string $attr            
     * @param string $val            
     * @return self
     */
    public function test_attr()
    {
        $this->assertInstanceOf('\StandardColors\interfaces\html\DomSelectInterface', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->attr());
        
        $attributes = array(
            'data-id' => 1,
            'data-name' => 2
        );
        
        foreach ($attributes as $attr => $value) {
            $this->SC->cs('RAL')
                ->html()
                ->select()
                ->attr($attr, $value);
        }
        
        $this->assertEquals($attributes, $this->getProperty($this->SC->cs('RAL')
            ->html()
            ->select(), 'attributes'));
    }

    public function test_render()
    {
        
        /* Defaults */
        /* Colorsytem name spaces with dash or custom id */
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->id(true);
        /* Colorsytem name spaces with dash or custom name */
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->name(true);
        
        /* default: all | array('1000','2000') of colors */
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->colors(false);
        
        /* default none | custom css classes */
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->css('custom-css-class');
        
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->autofocus(true);
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->disabled(true);
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->multiple(true);
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->required(true);
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->size(10); // int
        
        /* HTML Global Attributes Global Attributes in HTML. */
        /* Event Attributes in HTML. */
        /* no extra attribures added */
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->attr('data-id', 'custom-id');
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->attr('data-name', 'custom-name');
        
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->colors(array(
            '1005',
            '9010',
            'c2',
            '9011'
        ));
        
        /* bg fg custom classes */
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->css(true, true, 'custom-option-class');
        
        /* <option label="Volvo">Volvo (Latin for "I roll")</option> */
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->label('{KEY} - {NAME}');
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->value('{IDD}');
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->text('{ID} - {NAME}');
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->disabled(array(
            9010
        ));
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->selected('9011');
        
        /* HTML Global Attributes Global Attributes in HTML. */
        /* Event Attributes in HTML. */
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->attr('data-id', '{IDD}');
        $this->SC->cs('RAL')
            ->html()
            ->select()
            ->option()
            ->attr('data-name', '{NAME}');
        
        $this->assertInternalType('string', $this->SC->cs('RAL')
            ->html()
            ->select()
            ->render(true));
    }

    public function test_functions()
    {
        $methods = get_class_methods($this->SC->cs('RAL')
            ->html()
            ->select());
        
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

    public function getProperty($obj, $prop_name)
    {
        $tmp = new \ReflectionClass($obj);
        $prop = $tmp->getProperty($prop_name);
        $prop->setAccessible(true);
        return $prop->getValue($obj);
    }
}

 