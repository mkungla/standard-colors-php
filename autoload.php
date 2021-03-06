<?php

/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 2, 2016 - 11:57:23 PM
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
 * File         autoload.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */

/**
 * Include bootstrap file which sets constants and other global settings
 */
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'sc-bootstrap.php';

/**
 * Autoulad function
 * 
 * This autoloader is used when this library is used as
 * standalone library. You don't need this autoloader 
 * if you installed this library with composer.
 *  
 * @param string $class
 */
function standard_colors_autoloder($class = false)
{
    $class_n = preg_replace(array(
        '/StandardColors/',
        '/\\\\/'
    ), array(
        '',
        DIRECTORY_SEPARATOR
    ), $class);
    
    $class_file = STANDARD_COLORS_ROOT . $class_n . '.php';
    
    if (file_exists($class_file))
        require_once ($class_file);
}

/**
 * Register standard_colors_autoloder autoloader
 */
spl_autoload_register('standard_colors_autoloder');
