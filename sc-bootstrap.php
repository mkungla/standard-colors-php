<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 3, 2016 - 3:21:54 PM
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
 * File         sc-bootstrap.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */
$SC_CFG_VARS = array(
    'ROOT' => dirname(__FILE__),
    'DATA_ROOT' => dirname(__FILE__).DIRECTORY_SEPARATOR.'standards',
    'NAME' => 'Standard Colors',
    'VERSION' => '0.9.0',
    'STABILITY' => 'prototype',
    'COLOR_SYSTEMS' => array(
        'RAL' => array(
            'id' => 'RAL',
            'rev' => 'rev-1'
        )
    ),
    'LOCALES' => array(
        'de_DE',
        'en_US',
        'es_ES',
        'fr_FR',
        'it_IT',
        'nl_NL'
    ),
    'TEXT' => array(
        'dark' => array(
            'r' => 0,
            'g' => 0,
            'b' => 0,
            'hex' => '#000'
        ),
        'light' => array(
            'r' => 255,
            'g' => 255,
            'b' => 255,
            'hex' => '#fff'
        )
    )
);

/* Universal */
define("STANDARD_COLORS_ROOT", $SC_CFG_VARS['ROOT']);
define("STANDARD_COLORS_DEFAULT_LOCALE", 'en_US');

/**
 * Are ve using PHP >= than 7 or PHP 5
 * We are not supporting PHP version >= 8 since by date
 * it does not exist and we have now clue what changes it might bring
 */
if (defined('PHP_VERSION_ID') && PHP_VERSION_ID >= 80000) {
    print phpversion() . " is not supported yet!" . "\n";
    exit(1);
} elseif (defined('PHP_VERSION_ID') && PHP_VERSION_ID >= 70000) {
    /* We are using PHP 7 */
    define("STANDARD_COLORS_PHP", 7);
    
    /* Define constant array */
    define("STANDARD_COLORS", $SC_CFG_VARS);
} else {
    /*
     * We are using php 5,
     *
     * At least I hope that you are not using PHP 4. 3,
     * Personal Home Page Tools or Forms Interpreter :).
     * Time to move on
     *
     *
     * Currently we just hope that it works with HHVM
     * TODO: #1 Test Standard Colors with HHVM
     */
    define("STANDARD_COLORS_PHP", 5);
    
    /* Define constants from array */
    foreach ($SC_CFG_VARS as $SC_CFG_KEY => $SC_CFG_VAR) {
        /* Create KEY name */
        $KEY_NAME = 'STANDARD_COLORS_' . $SC_CFG_KEY;
        
        if (is_string($SC_CFG_VAR)) {
            /* if value is string */
            $VALUE = $SC_CFG_VAR;
        } elseif (is_array($SC_CFG_VAR)) {
            /* If we got array of values */
            $VALUE = json_encode($SC_CFG_VAR);
        } else {
            die("Unexpected type while defining constants!");
        }
        
        /* Define constant */
        $skip = array('STANDARD_COLORS_ROOT');
        if(!in_array($KEY_NAME,$skip))
            define($KEY_NAME, $VALUE);
    }
}

/* We don't need it anymore */
unset($SC_CFG_VARS);
