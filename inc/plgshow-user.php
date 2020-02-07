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


/* Add CSS Class to the front */
add_action( 'wp_enqueue_scripts', 'add_plgshow_front_css', 99 );

function add_plgshow_front_css() {

   /* CSS */
   wp_enqueue_style( 'plgshow-style', plugins_url('../assets/css/plgshow-style.css', __FILE__));
   wp_enqueue_style( 'dashicons' );

}

add_filter( 'plgshow_api_parser', 'plgshow_plugin_api', 10, 1 );
function plgshow_plugin_api( $slug ){
   // return $slug;
   //Include Plugin API
   require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
	$plugin_info = plugins_api( 'plugin_information', array(
			'slug' 		            => $slug,
			'is_ssl' 	            => true,
			'fields' 	            => array(
               'sections' 			   => false,
               'tags' 				   => false,
               'short_description'  => true,
               'icons' 			      => true,
               'banners' 			   => true,
               'reviews' 			   => false,
               'active_installs' 	=> true
			)
	   ) );

	if( !is_wp_error( $plugin_info ) ){
		$plgshow_data  = (object) array(
				'url' 				   => 'https://wordpress.org/plugins/'.$slug.'/', //depreciated since 2.5
				'name' 				   => $plugin_info->name,
				'slug' 				   => $slug,
				'version' 			   => $plugin_info->version,
				'author' 			   => $plugin_info->author,
				'author_profile'	   => $plugin_info->author_profile,
				'contributors'		   => $plugin_info->contributors,
				'requires' 			   => $plugin_info->requires,
				'tested' 			   => $plugin_info->tested,
				'requires' 			   => $plugin_info->requires,
				'rating' 			   => $plugin_info->rating,
				'num_ratings' 		   => $plugin_info->num_ratings,
				'ratings'			   => $plugin_info->ratings,
				'downloaded'		   => $plugin_info->active_installs,
				'active_installs'    => $plugin_info->active_installs,
				'last_updated' 	   => $plugin_info->last_updated,
				'last_updated_mk'    => $plugin_info->last_updated,
				'added' 			      => $plugin_info->added,
				'homepage' 			   => $plugin_info->homepage,
				'short_description'  => $plugin_info->short_description,
				'download_link' 	   => $plugin_info->download_link,
				'donate_link' 		   => $plugin_info->donate_link,
				'icons' 			      => $plugin_info->icons,
				'banners' 			   => $plugin_info->banners,
		);
	}else{
      $plgshow_data = null;
   }
	return $plgshow_data;

}