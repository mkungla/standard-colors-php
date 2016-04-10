<?php
/** @formatter:off
 * ******************************************************************
 * Created by   Marko Kungla on Apr 4, 2016 - 10:51:21 PM
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
 * File         DomSelectInterface.php
 * Code format  PSR-2
 * @link        https://github.com/mkungla/standard-colors-php
 ^ @issues      https://github.com/mkungla/standard-colors/issues
 * ********************************************************************
 * Contributors:
 * @author Marko Kungla <marko.kungla@gmail.com>
 * ********************************************************************
 * Comments:
 * @formatter:on */
 namespace StandardColors\interfaces\html;
 
 interface DomSelectInterface
 {
     /**
      * @return DomSelectOptionInterface
      */
     public function option();
     
     /**
      * Select id attribute
      * 
      * bool true: Color Sytem name, whitespaces replaced with dash,
      * bool false: No id attribute
      * string: custom id
      * 
      * @param string | bool $attr_id
      * @return self
      */
     public function id($attr_id = false);
     
     /**
      * Select name attribute
      *
      * bool true: Color Sytem name, whitespaces replaced with dash perfixed CS-,
      * bool false: No name attribute
      * string: custom name attribute
      *
      * @param string | bool $attr_id
      * @return self
      */
     public function name($attr_name = true);
     
     /**
      * Work with color keys only found in provided array. Default uses all colors
      * 
      * @param string | bool $filter_colors
      * @return self
      */
     public function colors($filter_colors = false);
     
     /**
      * Add css classes to select
      * 
      * @param string $css_classes
      * @return self
      */
     public function css($css_classes = false);
     
     /**
      * Add autofocus attribute to select
      * 
      * @param string $attr_autofocus
      * @return self
      */
     public function autofocus($attr_autofocus = false);
     
     /**
      * Add disabled attribute to select
      * 
      * @param string $attr_disabled
      * @return self
      */
     public function disabled($attr_disabled = false);
     
     /**
      * Add multiple attribute to select
      * 
      * @param string $attr_multiple
      * @return self
      */
     public function multiple($attr_multiple = false);
     
     /**
      * Add required attribute to select
      * 
      * @param string $attr_required
      * @return self
      */
     public function required($attr_required = false);
     
     /**
      * Set size attribute of select
      * 
      * @param number $attr_size
      * @return self
      */
     public function size($attr_size = 0);
     
     /**
      * Set any other HTML global or event attributes by key,val
      * 
      * @param string $attr
      * @param string $val
      * @return self
      */
     public function attr($attr = false,$val = false);
     
     /**
      * Return html select element
      * 
      * @return string
      */
     public function render();
 }
 