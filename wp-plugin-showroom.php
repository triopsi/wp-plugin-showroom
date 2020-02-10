<?php
/**
* Plugin Name: WP Plugin Showroom
* Plugin URI: https://www.wiki.profoxi.de
* Description: A Wordpress Shortcode Plugin to show a Wordpress plugin on the page or post.
* Version: 1.0.1
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
    define('PLGSHOW_VERSION', '1.0.1');

/**
 * Define path
 */
define('PLGSHOW_PATH', plugin_dir_path(__FILE__));

/* Loads plugin's text domain. */
add_action( 'init', 'plgshow_load_plugin_textdomain' );

/**
 * add option link into plugin list
 */
function plgshow_option_link( $links ) {
    $links[] = '<a href="' . admin_url( 'options-general.php?page=plgshow' ) . '" title="'. __( 'WP Plugin Showroom Settings', 'plgshow' ) .'">' . __( 'Settings', 'plgshow' ) . '</a>';
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'plgshow_option_link' );

/**
 * add meta links
 */
function plgshow_meta_links( $links, $plugin_file_name ) {
	if ( strpos( $plugin_file_name, basename(__FILE__) )  ) {
		$links[] = '<a href="https://wiki.profoxi.de" target="_blank" title="'. __( 'Documentation and examples', 'plgshow' ) .'"><strong>'. __( 'Documentation and examples', 'plgshow' ) .'</strong></a>';
		$links[] = '<a href="https://profiles.wordpress.org/triopsi/#content-plugins" target="_blank" title="'. __( 'More plugins by triopsi', 'plgshow' ) .'">'. __( 'More plugins by triopsi', 'plgshow' ) .'</a>';
	}
	return $links;
}
add_filter( 'plugin_row_meta', 'plgshow_meta_links', 10, 2 );

/* Front Scripts and Styles */
require_once('inc/plgshow-user.php');

/* Front Scripts and Styles */
require_once('inc/plgshow-admin.php');

/* add setting page */
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