<?php
/**
* Plugin Name: WP Plugin Showroom
* Plugin URI: https://www.wiki.profoxi.de
* Description: A Wordpress Shortcode Plugin to show a Wordpress plugin on the page or post.
* Version: 1.0.0
* Author: triopsi
* Author URI: http://wiki.profoxi.de
* Text Domain: plgshow
* Domain Path: /lang/
* License: GPL3
* License URI: https://www.gnu.org/licenses/gpl-3.0
*
* plgshow is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 2 of the License, or
* any later version.
*  
* plgshow is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*  
* You should have received a copy of the GNU General Public License
* along with plgshow. If not, see https://www.gnu.org/licenses/gpl-3.0.
**/

//Definie plugin version
if (!defined('PLGSHOW_VERSION'))
    define('PLGSHOW_VERSION', '1.0.0');

/**
 * Define path
 */
define('PLGSHOW_PATH', plugin_dir_path(__FILE__));

/* General */
/* Loads plugin's text domain. */
add_action( 'init', 'plgshow_load_plugin_textdomain' );

/* Front Scripts and Styles */
require_once('inc/plgshow-user.php');

/* Front Scripts and Styles */
require_once('inc/plgshow-admin.php');
require_once('inc/plgshow-setting.php');

/* Shortcode */
require_once('inc/plgshow-shortcode.php');

/**
 * Init Script. Load languages
 *
 * @return void
 */
function plgshow_load_plugin_textdomain() {
    load_plugin_textdomain( 'plgshow', FALSE, basename(PLGSHOW_PATH).'/lang/' );
}