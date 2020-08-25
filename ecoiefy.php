<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://pawelements.com
 * @since             1.0.0
 * @package           Pawelements
 *
 * @wordpress-plugin
 * Plugin Name:       Ecoiefy Companion
 * Plugin URI:        https://demo.themepaw.com/ecoiefy
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Themepaw
 * Author URI:        https://demo.themepaw.com/ecoiefy
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ecoiefy
 * Domain Path:       /languages
 */


// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/*
Constants
------------------------------------------ */

/* Set plugin version constant. */
define( 'ECOIEFY_VERSION', '0.1');

/* Set constant path to the plugin directory. */
define( 'ECOIEFY_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

// Plugin Addons Folder Path
define( 'ECOIEFY_ADDONS_DIR', plugin_dir_path( __FILE__ ) . 'widgets/' );

// Assets Folder URL
define( 'ECOIEFY_ASSETS_ASSETS', plugins_url( 'assets/', __FILE__ ) );

//All Custom Post Including
require_once( ECOIEFY_PATH . 'inc/cpt/ecoiefy-cpt.php' );

require_once( ECOIEFY_PATH. 'base.php' );
require_once( ECOIEFY_PATH. '/inc/helper-functions.php' );