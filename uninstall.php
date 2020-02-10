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

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
/* Delete plugin options */
delete_option("plgshow_plugin_version");

/* Delete transients */
global $wpdb;

$wppic_transients = $wpdb->get_results(
    "SELECT option_name AS name,
    option_value AS value FROM $wpdb->options
    WHERE option_name LIKE '_transient_plgshow_%'"
);

foreach( ( array ) $wppic_transients as $singleTransient ){
    delete_transient( str_replace( '_transient_', '', $singleTransient->name ) );
}
