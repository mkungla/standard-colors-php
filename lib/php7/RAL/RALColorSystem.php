<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 3, 2016 - 2:56:21 PM
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
 * File         RALColorSystem.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */
namespace StandardColors\lib\php7\RAL;

/* Common objects and interfaces */
use \StandardColors\interfaces\ColorSystemIntreface;
use \StandardColors\objects\ColorObject;

/* Specific for PHP v7.x */
use \StandardColors\lib\php7\ColorSystemAbstract;

class RALColorSystem extends ColorSystemAbstract implements ColorSystemIntreface
{

    /**
     * Will return all colors from Color system
     *
     * {@inheritdoc}
     *
     * @return array of \StandardColors\objects\ColorObject 's
     */
    public function getAll()
    {
        return (is_array($this->colors) ? $this->colors : $this->loadColors());
    }

    /**
     * Will return all colors from Color system
     *
     * {@inheritdoc}
     *
     * @return array of \StandardColors\objects\ColorObject 's
     */
    public function loadColors()
    {
        $chart = $this->loadChart();
        $locale = $this->loadLocale($this->locale);
        
        /* If any of data sources failed to load return false */
        if (! $chart || ! $locale || ! is_array($chart) || ! is_array($locale))
            return false;
            
            /* Set $this->colors */
        foreach ($chart as $color) {
            /**
             * For RAL locale keys we use only digit from RAL color code
             * Same goes for $this->getColor($color_id);
             * where $color_id is also only digit from RAL color code
             */
            $color_key = trim(substr($color['RAL'], 4));
            
            /* Get name of color from locale array */
            $color_name = $locale[$color_key];
            
            /* Create ColorObject */
            $color_object = new ColorObject();
            $color_object->ID = $color['RAL'];
            $color_object->name = $color_name;
            
            /* RGB */
            $rgb = explode('-', $color['RGB']);
            
            $color_object->red = $rgb[0];
            $color_object->green = $rgb[1];
            $color_object->blue = $rgb[2];
            
            /* HEX */
            $color_object->hex = $color['HEX'];
            
            /* TEXT */
            $color_object->text_type = $color['TXT'];
            $color_object->text_hex = STANDARD_COLORS['TEXT'][$color['TXT']]['hex'];
            
            $color_object->text_red = STANDARD_COLORS['TEXT'][$color['TXT']]['r'];
            $color_object->text_green = STANDARD_COLORS['TEXT'][$color['TXT']]['g'];
            $color_object->text_blue = STANDARD_COLORS['TEXT'][$color['TXT']]['b'];
            
            /* CSS classes */
            /* foreground */
            $color_object->css_fg_hex = '.sc-ral-' . $color_key . '-fg-hex';
            $color_object->css_fg_rgb = '.sc-ral-' . $color_key . '-fg-rgb';
            /* background */
            $color_object->css_bg_hex = '.sc-ral-' . $color_key . '-bg-hex';
            $color_object->css_bg_rgb = '.sc-ral-' . $color_key . '-bg-rgb';
            
            /* Add ColorObject to $this->colors */
            $this->colors[$color_key] = $color_object;
        }
        return $this->colors;
    }

    /**
     * Update Color System distribution files
     *
     * {@inheritdoc}
     *
     * @return bool true upon success
     */
    public function dist()
    {
        /* Set paths CSS file */
        $css_file_root = STANDARD_COLORS['ROOT'] . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR . STANDARD_COLORS['COLOR_SYSTEMS']['RAL']['id'] . DIRECTORY_SEPARATOR . STANDARD_COLORS['COLOR_SYSTEMS']['RAL']['rev'] . DIRECTORY_SEPARATOR . 'css';
        $css_file = $css_file_root . DIRECTORY_SEPARATOR . strtolower(STANDARD_COLORS['COLOR_SYSTEMS']['RAL']['id']) . '.css';
        $css_file_min = $css_file_root . DIRECTORY_SEPARATOR . strtolower(STANDARD_COLORS['COLOR_SYSTEMS']['RAL']['id']) . '.min.css';
        
        /* Create directory if needed */
        if (! is_dir($css_file_root))
            mkdir($css_file_root, 0700, true);
            
            /* Touch the files */
        touch($css_file);
        touch($css_file_min);
        
        /* Get colors */
        $colors = $this->getAll();
        
        /**
         * Create CSS files
         */
        $CSS_header = '@CHARSET "UTF-8";' . "\n";
        $CSS_header .= '/*!' . "\n";
        $CSS_header .= ' * standard-colors (https://github.com/mkungla/standard-colors)' . "\n";
        $CSS_header .= ' * standard-colors-php (https://github.com/mkungla/standard-colors-php)' . "\n";
        $CSS_header .= ' *' . "\n";
        $CSS_header .= ' * @copyright:    2016 Marko Kungla - https://github.com/mkungla' . "\n";
        $CSS_header .= ' * Licensed under MIT (https://github.com/mkungla/standard-colors-php/blob/master/LICENSE)' . "\n";
        $CSS_header .= ' * Generated by:  dist.php at ' . date('c') . "\n";
        $CSS_header .= ' * ' . "\n";
        $CSS_header .= ' * Run dist.php from PHP cli to regenerate this file and other files in dist directory.' . "\n";
        $CSS_header .= ' */' . "\n";
        
        /* regular */
        $CSS_body = '';
        foreach ($colors as $color) {
            // $CSS_header
            $CSS_body .= sprintf("/* %s */\n", $color->ID);
            $CSS_body .= sprintf("%s {background-color:%s !important;}\n", $color->css_bg_hex, $color->hex);
            $CSS_body .= sprintf("%s {background-color:rgb(%s,%s,%s) !important;}\n", $color->css_bg_rgb, $color->red, $color->green, $color->blue);
            $CSS_body .= sprintf("%s {color:%s !important;}\n", $color->css_fg_hex, $color->text_hex);
            $CSS_body .= sprintf("%s {color:rgb(%s,%s,%s) !important;}\n", $color->css_fg_rgb, $color->text_red, $color->text_green, $color->text_blue);
            
        }
        /* Save regular CSS file */
        if(!file_put_contents($css_file,$CSS_header.$CSS_body))
            return false;
        
        /* minified */
        $CSS_body_min = $this->minify_css($CSS_body);
        $line_lenght = 2000;
        
        /* will hold our new wordwraped css.min */
        $CSS_body_min_wrapped = '';
        
        /* Custom wordwrap */
        while (strlen($CSS_body_min) > $line_lenght)
        {
            $pos = strpos($CSS_body_min, '}', $line_lenght);
            
            $CSS_body_min_wrapped .= substr($CSS_body_min,0, $pos+1)."\n";
            $CSS_body_min = substr($CSS_body_min, $pos+1);  
        }
        /* Save minified CSS file */
        if(!file_put_contents($css_file_min,$CSS_header.$CSS_body_min_wrapped))
            return false;
        
        return true;
    }
}
