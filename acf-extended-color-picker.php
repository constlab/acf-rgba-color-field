<?php
/*
Plugin Name: ACF RGBA Color Picker
Plugin URI: https://github.com/tmconnect/ACF-RGBA-Color-Field
Description: Adds an Advanced Custom Field field for an extended color picker with transparency option. This plugin needs the installation/activation of ACF PRO v5.4.0.
Version: 2.1.3
Author: Thomas Meyer
Author URI: www.dreihochzwo.de
Text Domain: acf-extended-color-picker
License: GPLv2 or later
Copyright: Thomas Meyer
*/

/*  Copyright 2014-2016 Thomas Meyer  (email : support@dreihochzwo.de)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// check if class already exists
if ( ! class_exists( 'acf_plugin_extended_color_picker' ) ) :

	class acf_plugin_extended_color_picker {

		/*
		*  __construct
		*
		*  This function will setup the class functionality
		*
		*  @type	function
		*  @date	17/02/2016
		*  @since	1.0.0
		*
		*  @param	n/a
		*  @return	n/a
		*/

		public function __construct() {

			// vars
			$this->settings = [
				'version' => '2.1.3',
				'url'     => plugin_dir_url( __FILE__ ),
				'path'    => plugin_dir_path( __FILE__ )
			];

			// set text domain
			// https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
			load_plugin_textdomain( 'acf-extended-color-picker', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
			load_plugin_textdomain( 'dhz_updater', false, dirname( plugin_basename( __FILE__ ) ) . '/assets/update/' );

			//Initialize the update checker.
			require __DIR__ . 'assets/update/plugin-update-checker.php';
			$ExampleUpdateChecker = PucFactory::buildUpdateChecker(
				'http://repository.dreihochzwo.de/plugins/acf-extended-color-picker/info.json',
				__FILE__,
				'acf-extended-color-picker'
			);

			/**
			 * Let's make sure ACF Pro is installed & activated
			 * If not, we give notice and kill the activation of ACF RGBA Color Picker.
			 * Also works if ACF Pro is deactivated.
			 */
			function acf_extended_color_picker_or_die() {

				if ( ! class_exists( 'acf' ) || (int) str_replace( '.', '', acf_get_setting( 'version' ) ) < 540 ) {
					deactivate_plugins( plugin_basename( __FILE__ ) );
					if ( isset( $_GET['activate'] ) ) {
						unset( $_GET['activate'] );
					}
					add_action( 'admin_notices', 'acf_extended_color_picker_dependent_plugin_notice' );
				}
			}

			add_action( 'admin_init', 'acf_extended_color_picker_or_die' );

			function acf_extended_color_picker_dependent_plugin_notice() {
				echo '<div class="error"><p>' . __( 'ACF RGBA Color Picker requires ACF PRO v5.4.0 or newer to be installed &amp; activated.', 'acf-extended-color-picker' ) . '</p></div>';
			}

			// include field
			add_action( 'acf/include_field_types', [ $this, 'include_field_types' ] ); // v5

		}

		/*
		*  include_field_types
		*
		*  This function will include the field type class
		*
		*  @type	function
		*  @date	17/02/2016
		*  @since	1.0.0
		*
		*  @param	$version (int) major ACF version. Defaults to false
		*  @return	n/a
		*/

		public function include_field_types( $version = false ) {

			// support empty $version
			if ( ! $version ) {
				$version = 5;
			}


			// include
			include_once __DIR__ . 'fields/acf-extended-color-picker-v5.php';

		}
	}

// initialize
	new acf_plugin_extended_color_picker();

// class_exists check
endif;
