<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 3, 2016 - 9:42:14 PM
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
 * File         dist.php
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
 * This script should be called from CLI
 * if some reason you want to re-generate
 * files in dist directory
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'autoload.php';

$SC = new \StandardColors\ColorSystems();

/* Update RAL css */
if (! $SC->cs('RAL'))
    die("Could not load Classic RAL System" . "\n");
print !$SC->cs('RAL')->dist() ? 'Error: Could not update dist files for RAL'."\n" : 'RAL dist updated!'."\n";

