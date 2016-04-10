<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 3, 2016 - 2:51:04 PM
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
 * File         ColorSystems.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */
namespace StandardColors;

class ColorSystems
{

    /**
     * 
     * @var supported_color_systems array
     */
    private $supported_color_systems;

    /**
     * Array Color System objects loaded at runtime
     *
     * @var loaded_color_systems
     */
    private $loaded_color_systems;

    /**
     * Array of supported locales
     * 
     * @var array supported_locales;
     */
    private $supported_locales;
    
    /**
     * If requested then  HTMLDocument
     * @var \StandardColors\lib\HTMLDocument $html_document
     */
    private $html_document;
    
    /**
     * StandardColors ColorSystems constructor
     */
    public function __construct()
    {
        switch(STANDARD_COLORS_PHP)
        {
            case 7 :
                $this->supported_color_systems = STANDARD_COLORS['COLOR_SYSTEMS'];
                $this->supported_locales = STANDARD_COLORS['LOCALES'];
            break;
            case 5 :
                $this->supported_color_systems = json_decode(STANDARD_COLORS_COLOR_SYSTEMS,true);
                $this->supported_locales = json_decode(STANDARD_COLORS_LOCALES,true);
            break;
        }
         
        $this->loaded_color_systems = array();
    }

    /**
     * Main access method
     *
     * This is the method trough every request is made.
     * In failure it returns false otherwise object of
     * requested Color System
     *
     * @param string $color_system            
     * @return bool | \StandardColors\interfaces\ColorSystemIntreface
     */
    public function cs($color_system = false)
    {
        /**
         * check did we got Color System name which we can load.
         * If so lets let 'load' method to decide either we have to
         * load it or can return already loaded Color Standard object
         */
        return (! $color_system || ! is_string($color_system) || ! array_key_exists($color_system, $this->supported_color_systems)) ? false : $this->load($color_system);
    }

    /**
     * Get supported locales
     * 
     * @return array of supported locales
     */
    public function getLocales()
    {
        return $this->supported_locales;
    }
    
    /**
     * Set locale to be used
     * 
     * NB! locale can be set until you first call ->cs($color_system) 
     * since if locale is not set by time loading requested
     * Color Sysem then default language is set which can noty be 
     * changed runtime.
     * 
     * @param string $locale_id
     * @return bool
     */
    public function setLocale($locale_id = STANDARD_COLORS_DEFAULT_LOCALE)
    {
        if(is_string($locale_id) && in_array($locale_id, $this->supported_locales))
        {
            /* Locale was successfully set */
            $this->locale = $locale_id;
            return true;
        } else {
            /* We could not set requested locale */
            return false;
        }
            
    }
    
    /**
     * Get currently used locale
     * 
     * @return string locale ID
     */
    public function getLocale()
    {
        if(empty($this->locale))
            $this->setLocale();
        
        return $this->locale;
    }
    
    /**
     * Get supported Color Systems
     * 
     * Options
     * RAL: Classic RAL System
     * FS: The Federal Standard color system
     * PMS: The Pantone Colour Matching System
     * BS: The British Standards
     * 
     * @return array supported Color Systems
     */
    public function getSupportedColorSystems()
    {
        return $this->supported_color_systems;
    }
    
    /**
     * load | return requested Color System
     *
     * This private method returns requested Colur system object
     * if Color System is not loaded yet then it loads it.
     *
     * @param string $color_system            
     * @return \StandardColors\interfaces\ColorSystemIntreface
     */
    private function load($color_system)
    {              
        /**
         * Check if requested Color System is already loaded
         * If not then load it.
         */
        if (! array_key_exists($color_system, $this->loaded_color_systems)) {
            /* Create conditional class name based on which php version we are using */
            $color_standard_class = '\StandardColors\lib\php' . STANDARD_COLORS_PHP . '\\CS\\' . $color_system . '\\' . $color_system . 'ColorSystem';
            if(!class_exists($color_standard_class))
                return false;
            
            /** 
             * This sets default locale if it is not set by user
             * Load the class 
             * */
            $this->loaded_color_systems[$color_system] = new $color_standard_class($color_system, $this->getLocale());
        }
        
        /**
         * Return requested Color System object
         */
        return $this->loaded_color_systems[$color_system];
    }
    
}
