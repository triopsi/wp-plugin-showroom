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
  add_action( 'admin_enqueue_scripts', 'add_admin_plgshow_style_js' );
  
  /**
   * Add Style and JS in the Admin page
   *
   * @return void
   */
  function add_admin_plgshow_style_js() {
    /* Color JS */
    // wp_enqueue_script( 'plgshow-admin-script-color', plugins_url('../assets/js/plgshow-admin-script-color.js', __FILE__), array( 'jquery', 'wp-color-picker'  ) );
  }
