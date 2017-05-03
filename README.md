# ACF RGBA Color Picker

**The new RGBA Color Picker v2.1 is a completely re-written version**

![advanced custom field RGA color picker](http://repository.dreihochzwo.de/plugins/acf-extended-color-picker/acf-rgba-color-picker.jpg)

### Features

The RGBA Color Picker is a color picker that supports transparency colors in RGBA-Mode. In addition, the plugin offers the possibility to customize the color palette according to your own wishes.

Moreover, the plugin can be updated via the WordPress Update feature.

### Custom color palettes

Use the filter `acf_extended_color_picker_colors` filter to create your own color palettes for the color picker.

Put a code like this into yout theme functions.php (you can use HEX or RGBA color values:

```php
function set_acf_extended_colorpicker_palette() {
	$palette = array(
		'#FFF',
		'#0018ff',
		'#00FF36',
		'rgba(255,168,0,0.7)'
	);

	return $palette;
}
add_filter('acf/extended_color_picker/palette', 'set_acf_extended_colorpicker_palette');
```
If you have an options page where you define some standard colors, create an array from this options like (this is an example using a repeater field to set the colors; if you store your colors within a delimter separted string, convert this string into an array):

```php
function set_acf_extended_colorpicker_palette() {
	// optional - add colors which are not set in the options page
	$palette = array(
		'#FFF',
		'#000'
	);

	if ( have_rows('YOUR_COLOR_REPEATER_FIELD', 'YOUR_OPTIONS_PAGE') ) {
		while( have_rows('YOUR_COLOR_REPEATER_FIELD', 'YOUR_OPTIONS_PAGE') ) { the_row();
			$palette[] = get_sub_field('YOUR_COLOR_FIELD');
		}
	}

	return $palette;
}
add_filter('acf/extended_color_picker/palette', 'set_acf_extended_colorpicker_palette');
```

**This plugin needs the installation/activation of Advanced Custom Fields v5**

### Installation

**Install as Plugin**

1. Copy the 'acf-extended-color-picker' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

**Include within theme**

ACF RGBA Color Picker can be included in the theme by using the `acf/extended_color_picker/url` filter.

1.	Copy the 'acf-extended-color-picker' folder into your theme folder (can use sub folders).
2.	Edit your functions.php file and add the code below (make sure the path is correct to include the acf-extended-color-picker.php file)

```php
include_once( 'includes/acf-extended-color-picker/acf-extended-color-picker.php' );

add_filter( 'acf/extended_color_picker/url', 'acf_extended_color_picker_url' );
function acf_extended_color_picker_url( $url ) {
	$url = get_template_directory_uri() . '/includes/acf-extended-color-picker/';

	return $url;
}
```

### Compatibility

This ACF field type is only compatible with ACF Pro v5


### Changelog
**2.1.2**
* Fixed a bug in script

**2.1.1**
* Fix bug with wrong internal ACF name

**2.1.0**
* Rewritten JS file for optimization and fixing a bug where multiple color buttons are displayd after adding color picker field to repeater or flexible content field.
* Color picker now displays typical transparent background grid, if no color is selected or color is cleared.

**2.0.0**
* New RGBA color picker library (thanks to [Sergio P.A.](https://github.com/23r9i0/) for the [wp-color-picker-alpha](https://github.com/23r9i0/wp-color-picker-alpha/))
* New update function (thanks to [Janis Elsts](http://w-shadow.com/) for the [Plugin Update Checker](http://w-shadow.com/blog/2010/09/02/automatic-updates-for-any-plugin/))
* New `acf/extended_color_picker/palette` filter to create color palettes for the color picker

**1.0.0**
* First release
