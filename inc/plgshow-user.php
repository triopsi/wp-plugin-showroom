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

   /* JS */
//    wp_enqueue_script( 'plgshow-script', plugins_url('../assets/js/plgshow-script.js', __FILE__), array( 'jquery' ) );

}

/***************************************************************
 * Fetching plugins data with WordPress.org Plugin API
 ***************************************************************/
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
      $plgshow_data = (object) array(
            'url' 				   => 'https://wordpress.org/plugins/about-us-shortcode/',
            'name' 				   => 'About Us Team',
            'slug' 				   => 'about-us-shortcode',
            'version' 			   => '0.1.0',
            'author' 			   => 'triopsi',
            'author_profile'	   => array( array( 'name' => 'triopsi', 'image' => 'https://secure.gravatar.com/avatar/afb5c644ae8d03d2e886cc1a2bf84dd7?s=32&d=mm&r=g', 'url' => 'https://profiles.wordpress.org/triopsi/' ) ),
            'contributors'		   => array( array( 'name' => 'triopsi', 'image' => 'https://secure.gravatar.com/avatar/afb5c644ae8d03d2e886cc1a2bf84dd7?s=32&d=mm&r=g', 'url' => 'https://profiles.wordpress.org/triopsi/' ) ),
            'requires' 			   => 'WP 5.3+',
            'tested' 			   => 'WP 5.3.2',
            'rating' 			   => '100',
            'num_ratings' 		   => '1',
            'ratings'			   => '5',
            'downloaded'		   => '77',
            'active_installs'    => '20',
            'last_updated' 	   => '06/02/2020',
            'last_updated_mk'    => '06/02/2020',
            'added' 			      => '06/02/2020',
            'homepage' 			   => 'http://wiki.profoxi.de',
            'short_description'  => 'A very simple "About Us" site Plugin. Create Teams and copy-paste the shortcode everywhere in your post or site.',
            'download_link' 	   => 'https://downloads.wordpress.org/plugin/about-us-shortcode.0.1.0.zip',
            'donate_link' 		   => 'https://www.paypal.me/triopsi',
            'icons' 			      => 'https://ps.w.org/about-us-shortcode/assets/icon-128x128.png',
            'banners' 			   => 'https://ps.w.org/about-us-shortcode/assets/banner-772x250.png',
      );
   }
	return $plgshow_data;

}