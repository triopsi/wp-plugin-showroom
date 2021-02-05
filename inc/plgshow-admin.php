<?php
/**
* Author: triopsi
* Author URI: http://wiki.profoxi.de
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

/**
 * Version Check
 *
 * @return void
 */
function plgshow_check_version() {
    if (PLGSHOW_VERSION !== get_option('plgshow_plugin_version'))
        plgshow_activation();
  }
  
  /* Loaded Plugin */
  add_action('plugins_loaded', 'plgshow_check_version');
  
  /* Add Admin panel */
  add_action( 'admin_enqueue_scripts', 'plgshow_add_admin_style_js' );
  
  /**
   * Add Style and JS in the Admin page
   *
   * @return void
   */
  function plgshow_add_admin_style_js() {

    /* CSS */
    wp_enqueue_style( 'plgshow-admin-style', plugins_url('../assets/css/plgshow-admin-style.css', __FILE__));
    
    /* Jquery Ajax JS */
    wp_enqueue_script( 'plgshow-admin', plugins_url('../assets/js/plgshow-admin.js', __FILE__), array( 'jquery' ) );

  }

/**
* Update Version Number
*
* @return void
*/
function plgshow_activation(){
	update_option('plgshow_plugin_version', PLGSHOW_VERSION);
}

/**
 * Find transients and delete it
 */
function plgshow_delete_transients(){

	global $wpdb;

	$wppic_transients = $wpdb->get_results(
		"SELECT option_name AS name,
		option_value AS value FROM $wpdb->options
		WHERE option_name LIKE '_transient_plgshow_%'"
  );
  
	foreach( ( array ) $wppic_transients as $singleTransient ){
		delete_transient( str_replace( '_transient_', '', $singleTransient->name ) );
  }
  
}
