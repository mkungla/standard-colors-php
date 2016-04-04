<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 4, 2016 - 5:53:29 AM
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
 * File         ColorSystemAbstract.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */
namespace StandardColors\lib\php5;

abstract class ColorSystemAbstract
{

    /**
     * All colors
     *
     * @var array of \StandardColors\objects\ColorObject 's
     */
    protected $colors;

    /**
     * Locale ID which was supplied to constructor
     *
     * @var string locale ID
     */
    protected $locale;

    /**
     * Which Standard data revision this version of library uses
     *
     * Like: rev-1 etc.
     *
     * @var unknown
     */
    protected $standard_rev;

    /**
     * ColorSystem constructor
     */
    public function __construct($locale_id)
    {
        $this->locale = $locale_id;
    }

    /**
     * Get path to standards data
     *
     * {@inheritdoc}
     *
     * @return string $path (Without trailin slash)
     */
    public function getDataPath()
    {
        $STANDARD_COLORS_COLOR_SYSTEMS = json_decode(STANDARD_COLORS_COLOR_SYSTEMS, true);
        return STANDARD_COLORS_DATA_ROOT . DIRECTORY_SEPARATOR . $STANDARD_COLORS_COLOR_SYSTEMS[$this->standard_id]['id'] . DIRECTORY_SEPARATOR . $STANDARD_COLORS_COLOR_SYSTEMS[$this->standard_id]['rev'];
    }

    /**
     * Will load chart.json for requested Color System
     *
     * @return array Contents of chart.json | bool false
     */
    public function loadChart()
    {
        /* Chart file path for Color system */
        $chart_file = $this->getDataPath() . DIRECTORY_SEPARATOR . 'chart.json';
        
        /* Check does this file exists */
        /* We trust that this file contains valid json data */
        return (! file_exists($chart_file)) ? false : json_decode(file_get_contents($chart_file), true);
    }

    /**
     * Will load locale json for requested Color System and set locale
     *
     * @return array Contents of locale.{$locale_id}.json | bool false
     */
    public function loadLocale()
    {
        /* Locale file path for Color system */
        $locale_file = $this->getDataPath() . DIRECTORY_SEPARATOR . 'locale.' . $this->locale . '.json';
        
        /* Check does this file exists */
        /* We trust that this file contains valid json data */
        return (! file_exists($locale_file)) ? false : json_decode(file_get_contents($locale_file), true);
    }

    /**
     * Get color object by key from Collor System
     *
     * @param unknown $color_key            
     * @return \StandardColors\objects\ColorObject of the color | bool false
     */
    public function color($color_key)
    {
        /* Load colors if these are not loaded yet */
        if (! is_array($this->colors))
            $this->loadColors();
        
        return array_key_exists($color_key, $this->colors) ? $this->colors[$color_key] : false;
    }
    
    // CSS Minifier https://gist.github.com/tovic/d7b310dea3b33e4732c0
    public function minify_css($input)
    {
        if (trim($input) === "")
            return $input;
        return preg_replace(array(
            // Remove comment(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
            '#(?<=[\s:,\-])0+\.(\d+)#s',
            // Minify string value
            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
            // Minify HEX color code
            '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
            // Remove empty selector(s)
            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
        ), array(
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2'
        ), $input);
    }
}
 