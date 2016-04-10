<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 4, 2016 - 4:27:50 AM
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
 * File         ColorSystemTests.php
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

class ColorSystemTests extends PHPUnit_Framework_TestCase
{

    protected $SC;

    protected $ColorSystems;

    /**
     * Setup the test
     */
    protected function setUp()
    {
        if ($this->SC instanceof \StandardColors\ColorSystems)
            return;
        
        $this->SC = new ColorSystems();
        $ColorSystems = $this->SC->getSupportedColorSystems();
        /* we don't need values here just keys */
        $this->ColorSystems = array();
        foreach ($ColorSystems as $ColorSystem => $conf)
            array_push($this->ColorSystems, $ColorSystem);
    }

    public function test_general()
    {
        $this->assertInstanceOf('\StandardColors\ColorSystems', $this->SC);
        $this->assertInternalType('array', $this->ColorSystems);
    }

    /**
     * Will return all colors from Color system
     * and should be always array of \StandardColors\objects\ColorObject 's
     */
    public function test_getAll()
    {
        foreach ($this->ColorSystems as $ColorSystem) {
            $all_colors = $this->SC->cs($ColorSystem)->getAll();
            $this->assertInternalType('array', $all_colors);
            
            /**
             * Make sure that children are all
             * instanse of \StandardColors\objects\ColorObject
             */
            foreach ($all_colors as $color)
                $this->assertInstanceOf('\StandardColors\objects\ColorObject', $color);
        }
    }

    /**
     * Colors should be always array
     */
    public function test_loadColors()
    {
        foreach ($this->ColorSystems as $ColorSystem) {
            $this->assertInternalType('array', $this->SC->cs($ColorSystem)
                ->loadColors());
        }
    }

    /**
     * Lets match it with expected result
     */
    public function test_getDataPath()
    {
        foreach ($this->ColorSystems as $ColorSystem) {
            /* PHP 7 */
            if(PHP_VERSION_ID > 70000)
            {
                $expected = STANDARD_COLORS['DATA_ROOT'] . DIRECTORY_SEPARATOR . STANDARD_COLORS['COLOR_SYSTEMS'][$ColorSystem]['id'] . DIRECTORY_SEPARATOR . STANDARD_COLORS['COLOR_SYSTEMS'][$ColorSystem]['rev'];
            }
            else
            {
                $STANDARD_COLORS_COLOR_SYSTEMS = json_decode(STANDARD_COLORS_COLOR_SYSTEMS, true);
                $expected = STANDARD_COLORS_DATA_ROOT . DIRECTORY_SEPARATOR . $STANDARD_COLORS_COLOR_SYSTEMS[$ColorSystem]['id'] . DIRECTORY_SEPARATOR . $STANDARD_COLORS_COLOR_SYSTEMS[$ColorSystem]['rev'];
            }
            $this->assertEquals($expected, $this->SC->cs($ColorSystem)
                ->getDataPath());
        }
    }

    /**
     * Chart should be always array
     */
    public function test_loadChart()
    {
        foreach ($this->ColorSystems as $ColorSystem) {
            $this->assertInternalType('array', $this->SC->cs($ColorSystem)
                ->loadChart());
        }
    }

    /**
     * Locales should be always array
     */
    public function test_loadLocale()
    {
        foreach ($this->ColorSystems as $ColorSystem) {
            $this->assertInternalType('array', $this->SC->cs($ColorSystem)
                ->loadLocale());
        }
    }

    public function test_color()
    {
        foreach ($this->ColorSystems as $ColorSystem) {
            /* Non existsing key should return false */
            $this->assertFalse($this->SC->cs($ColorSystem)->color('NaN'));
            
            /* Get all colors */
            $all_colors = $this->SC->cs($ColorSystem)->getAll();
            $this->assertInternalType('array', $all_colors);
        
            /**
             * Make sure that children are all
             */
            foreach ($all_colors as $key => $color_object)
            {
                /* Can we load color with this key */
                $color = $this->SC->cs($ColorSystem)->color($key);
                $this->assertInstanceOf('\StandardColors\objects\ColorObject', $color);
                
                $this->assertEquals($color_object,$color);
                $this->assertInternalType('string',$color->bg());
                $this->assertInternalType('string',$color->fg());
            }
        }
    }
    
    public function test_minify_css()
    {
        /* We test this abstract class method with RAL */
        $CSS_header = '@CHARSET "UTF-8";' . "\n";
        $CSS_header .= '/*' . "\n";
        $CSS_header .= ' * standard-colors (https://github.com/mkungla/standard-colors)' . "\n";
        $CSS_header .= ' * standard-colors-php (https://github.com/mkungla/standard-colors-php)' . "\n";
        $CSS_header .= ' *' . "\n";
        $CSS_header .= ' * @copyright:    2016 Marko Kungla - https://github.com/mkungla' . "\n";
        $CSS_header .= ' * Licensed under MIT (https://github.com/mkungla/standard-colors-php/blob/master/LICENSE)' . "\n";
        $CSS_header .= ' * Generated by:  dist.php at ' . date('c') . "\n";
        $CSS_header .= ' * ' . "\n";
        $CSS_header .= ' * Run dist.php from PHP cli to regenerate this file and other files in dist directory.' . "\n";
        $CSS_header .= ' */' . "\n";
        
        /**
         * only '@CHARSET "UTF-8";'
         * should be left
         */
        $this->assertEquals('@CHARSET UTF-8;',$this->SC->cs('RAL')->minify_css($CSS_header));
        
        /* Check empty string */
        $this->assertEquals('',$this->SC->cs('RAL')->minify_css(''));
    }

    /**
     * Run dist and make sure it succeeds for all Color Systems
     */
    public function test_dist()
    {
        foreach ($this->ColorSystems as $ColorSystem) {
            $this->assertTrue($this->SC->cs($ColorSystem)->dist());
        }
    }
    
    /**
     * Assert that we can cet instance of HTML document for each color system
     */
    public function test_html()
    {
        /* Can we load HTML dom document for each color system */
        foreach ($this->ColorSystems as $ColorSystem) {
            $html = $this->SC->cs($ColorSystem)->html();
            $this->assertInstanceOf('\StandardColors\interfaces\HTML\DomDocumentInterface', $html);
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

    /* USE RAL to get required methods */
    public function test_functions()
    {
        $methods = get_class_methods($this->SC->cs('RAL'));
        
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
