# Standard Colors - PHP library 

This library is to easy your work with different color standards.

 * Submodule of [mkungla/standard-colors][1]
 * Issue Tracking under parent repo: [mkungla/standard-colors issues:][2]
 * Contributions welcome.

## Standalone PHP Library
*Even though this library is submodule of [mkungla/standard-colors][1], it is standalone library.*
*[mkungla/standard-colors][1] is parent project to set standards for all programming languages supported and found in parent repos `langs/` directory.*

## Installation and setup
- **Using Composer:**
```bash
$ composer require mkungla/standard-colors-php
# You might want to check out minimum-stability of tags/releases!
# If you want to install non-stable releases 
```
Then you just have to require composers autoloader in your project.
```php
require_once 'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
use StandardColors\ColorSystems;
// Load Standard Colors library
$SC = new ColorSystems;
```
- **From Source:**
```bash
$ git clone git@github.com:mkungla/standard-colors-php.git
```
When you use source then you have to require included autoloader
```php
require_once 'standard-colors-php'.DIRECTORY_SEPARATOR.'autoload.php';
use StandardColors\ColorSystems;
// Load Standard Colors library
$SC = new ColorSystems;
```

## Usage

- **Getting and setting Locales**

If some color in color system has name then you can get that name from selected locale. Default locale is `en_US`
```php
/**
 * Get supported locales
 * @return Array
 * (
 *    [0] => de_DE
 *    [1] => en_US
 *    [2] => es_ES
 *    [3] => fr_FR
 *    [4] => it_IT
 *    [5] => nl_NL
 * )
 */
$locales = $SC->getLocales();
// Set locale
if(!$SC->setLocale('en_US'))
    die('Could not set locale, Locale not supported or check spelling!'."\n");
// Get current locale
$current_locale = $SC->getLocale();
```
- **Get Suppored Color Systems and initiate color system**
In these exsamples we use Classic RAL System (RAL) 
```php
/**
 * Get Suppored Color Systems
 * @return array
 * (
 *    [RAL] => Array
 *        (
 *            [id] => RAL
 *            [name] => Classic RAL System
 *            [rev] => rev-1
 *        )
 *     ...
 *)
 */
$supported_color_systems = $SC->getSupportedColorSystems();

/**
 * Load Color System
 *
 * You don't have to load it explicitly since it will be loaded whenever you first call it. 
 * @param string
 * RAL: Classic RAL System
 * FS-595: The Federal Standard color system
 * PMS: The Pantone Colour Matching System
 * BS: The British Standards
 */
if(!$SC->cs('RAL'))
    die("Could not load Classic RAL System"."\n");
```

- **Get all color obejcts from requested Color System space**

```php
/**
 * Get array of color objects from color system
 * @return array of object StandardColors\objects\ColorObject
 * While iterating through array you can get access following public properties
 * Ex: key 1000 in RAl
 * [1000] => StandardColors\objects\ColorObject Object
 *  (
 *    [ID] => RAL 1000 // Real color code
 *    [KEY] => 1000 // KEY used in this library
 *    [name] => Groenbeige // Name in selected locale if available
 *    [red] => 214 // Color RGB red value
 *    [green] => 199 // Color RGB green value
 *    [blue] => 148 // Color RGB blue value
 *    [hex] => #BEBD7F // Color HEX
 *    [text_type] => dark // Foreground contrast type
 *    [text_hex] => #000 // Foreground color HEX
 *    [text_red] => 0 // Foreground RGB red
 *    [text_green] => 0 // Foreground RGB green
 *    [text_blue] => 0 // Foreground RGB blue
 *    // CSS files can be found in dist directory
 *    [css_fg_hex] => sc-ral-1000-fg-hex // Foreground css class using HEX
 *    [css_fg_rgb] => sc-ral-1000-fg-rgb // Foreground css class using RGB
 *    [css_bg_hex] => sc-ral-1000-bg-hex // Background css class using HEX
 *    [css_bg_rgb] => sc-ral-1000-bg-rgb // Background css class using RGB
 *  )
 */
 $all_colors_in_ral = $SC->cs('RAL')->getAll();
 if(!$all_colors_in_ral)
    die('Failed to get data for Classic RAL System.'."\n");
 ```
 
 - **Get single color object by Library KEY**
 
 ```php
 $color =  $SC->cs('RAL')->color(1000);
 if(!$color)
    die('Could not find requested color.'."\n");
 ```
 
## HTML Document
HTML Document `$SC->cs('RAL')->html()` is to render different html elements for color system.
 
### HTML Select
Gonfigure and get select box for Color System.

```php
/** 
 * Set id attribute for select element
 * bool false: disabled
 * bool true: CS-RAL (CS- perfixed short colorsytem name)
 */
$SC->cs('RAL')->html()->select()->id(true);

/**
 * Set name attribute for select element
 * bool false: disabled
 * bool true: Color Sytem name, whitespaces replaced with dash perfixed CS-,
 * string: custom name attribute
 */
$SC->cs('RAL')->html()->select()->name(true);
 
/**
 * Set colors to be used
 * bool false: all (default)
 * array of color keys: ex: array('1000','2000') etc
 */
$SC->cs('RAL')->html()->select()->colors(false);

/**
 * Add css class(es) to select element
 * bool false: none (default)
 * string css classes
 */
$SC->cs('RAL')->html()->select()->css('custom-css-class custom-css-class2');

// Add autofocus attribute (default false)
$SC->cs('RAL')->html()->select()->autofocus(true);

// Add disabled attribute (default false)
$SC->cs('RAL')->html()->select()->disabled(true);

// Add multiple attribute (default false)
$SC->cs('RAL')->html()->select()->multiple(true);

// Add required attribute (default false)
$SC->cs('RAL')->html()->select()->required(true);

// Add and set size attribute (int) - (default false)
$SC->cs('RAL')->html()->select()->size(10);

// Add any other attributes by key value  ex:
$SC->cs('RAL')->html()->select()->attr('data-id','custom-id');
$SC->cs('RAL')->html()->select()->attr('data-name','custom-name');
```

### HTML Select option

Setting welect option text values you can use tags mixed with custom text

| Tag           | Description                                           |
| :-------------|:------------------------------------------------------|
| `{ID}`        | Color real ID                                         |
| `{IDD}`       | Color real ID where whitespaces are replaced with `-` |
| `{KEY}`       | Color ID (key) used within this library               |
| `{NAME}`      | Color name if available from current locale           |


```php
// Option css classes 1-bool: add background class 2-bool: Add foreground class 3-string: add custom class
$SC->cs('RAL')->html()->select()->option()->css(true,true,'custom-option-class');

// Add label attribute
$SC->cs('RAL')->html()->select()->option()->label('{KEY} - {NAME}');

// Add value attribute
$SC->cs('RAL')->html()->select()->option()->value('{IDD}');

// Add option text
$SC->cs('RAL')->html()->select()->option()->text('{ID} - {NAME}');

// Set array of color keys which options are listed but disabled
$SC->cs('RAL')->html()->select()->option()->disabled(array(1000,1001));

// Set which color by key is selected by default. Default non of the option have selected attribute
$SC->cs('RAL')->html()->select()->option()->selected('1002');

// Add other attributes for option element Ex:
$SC->cs('RAL')->html()->select()->option()->attr('data-id','{IDD}');
$SC->cs('RAL')->html()->select()->option()->attr('data-name','{NAME}');
$SC->cs('RAL')->html()->select()->option()->attr('data-description','Color ID: {ID} key is {KEY} and name is {NAME}. Id whithout whitespaces is {IDD}');

```

### HTML Select render

```php
// @param bool false (default) use HEX colors for disblay, bool true uses RGB colors for display
$select_element = $SC->cs('RAL')->html()->select()->render(true);
```

[1]: https://github.com/mkungla/standard-colors
[2]: https://github.com/mkungla/standard-colors/issues
