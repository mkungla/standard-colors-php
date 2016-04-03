<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 3, 2016 - 3:10:08 PM
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
 * File         ColorSystemIntreface.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */
namespace StandardColors\interfaces;

interface ColorSystemIntreface
{

    /**
     * Get path to standards data
     *
     * This method returns standards data path used for current
     * Color System which is constructed by using correct Color System ID
     * and data revison directory.
     *
     * @return string $path (Without trailin slash)
     */
    public function getDataPath();

    /**
     * Will return all colors from Color system
     *
     * If colors are not loaded from standards library,
     * then colors will be loaded.
     *
     * This->method differs from $this->loadColors()
     * by that it will return colors from $this->colors if
     * colors are already loaded else it will call method
     * $this->loadColors();
     *
     * @return array of \StandardColors\objects\ColorObject 's
     */
    public function getAll();

    /**
     * Will return all colors from Color system
     *
     * If colors are not loaded from standards library,
     * then colors will be loaded.
     *
     * This method differs from $this->getAll()
     * by that it will always load colors from standards library and
     * reconstruct or set $this->colors
     *
     * @return array of \StandardColors\objects\ColorObject 's
     */
    public function loadColors();

    /**
     * Will load chart.json for requested Color System
     *
     * @return array Contents of chart.json | bool false
     */
    public function loadChart();

    /**
     * Will load locale json for requested Color System and set locale
     *
     * @return array Contents of locale.{$locale_id}.json | bool false
     */
    public function loadLocale();

    /**
     * Get color object by key from Collor System
     *
     * @param unknown $color_key            
     * @return \StandardColors\objects\ColorObject of the color | bool false
     */
    public function color($color_key);

    /**
     * Update Color System distribution files
     *
     * If there are any files to be created for this Color System in dist directory
     * then this method should create these files.
     * Most commonly it you might create or update css files for this Color System
     *
     * @return bool true upon success
     */
    public function dist();
}