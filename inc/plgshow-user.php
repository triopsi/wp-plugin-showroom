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
add_action( 'wp_enqueue_scripts', 'plgshow_add_plgshow_front_css', 99 );

function plgshow_add_plgshow_front_css() {

   /* CSS */
   wp_enqueue_style( 'plgshow-style', plugins_url('../assets/css/plgshow-style.css', __FILE__));
   wp_enqueue_style( 'dashicons' );

}

add_filter( 'plgshow_api_parser', 'plgshow_plugin_api', 10, 1 );

/**
 * Parse the plugin API
 *
 * @param [string] $slug
 * @return object
 */
function plgshow_plugin_api( $slug ){

   	//Include Plugin API
   	require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );

    //Set query
	$plugin_info = plugins_api( 'plugin_information', array(
			'slug' 		            	=> $slug,
			'is_ssl' 	            	=> true,
			'fields' 	            	=> array(
               'sections' 			   	=> false,
               'tags' 				   	=> false,
               'short_description'  	=> true,
               'icons' 			      	=> true,
               'banners' 			   	=> true,
               'reviews' 			   	=> false,
               'active_installs' 		=> true
			)
	   ) );

	//Check response
	if( !is_wp_error( $plugin_info ) ){
		$plgshow_data = (object) array(
				'url' 				   	=> 'https://wordpress.org/plugins/'.$slug.'/',
				'name' 				   	=> $plugin_info->name,
				'slug' 				   	=> $slug,
				'version' 			   	=> $plugin_info->version,
				'author' 			   	=> $plugin_info->author,
				'last_updated_mk'    	=> $plugin_info->last_updated,
				'banners' 			   	=> $plugin_info->banners,
				'author_profile'	   	=> $plugin_info->author_profile,
				'contributors'		   	=> $plugin_info->contributors,
				'requires' 			   	=> $plugin_info->requires,
				'tested' 			   	=> $plugin_info->tested,
				'requires' 			   	=> $plugin_info->requires,
				'rating' 			   	=> $plugin_info->rating,
				'num_ratings' 		   	=> $plugin_info->num_ratings,
				'added' 			    => $plugin_info->added,
				'homepage' 			   	=> $plugin_info->homepage,
				'short_description'  	=> $plugin_info->short_description,
				'download_link' 	   	=> $plugin_info->download_link,
				'donate_link' 		   	=> $plugin_info->donate_link,
				'icons' 			    => $plugin_info->icons,
				'ratings'			   	=> $plugin_info->ratings,
				'downloaded'		   	=> $plugin_info->active_installs,
				'active_installs'     	=> $plugin_info->active_installs,
				'last_updated' 	   		=> $plugin_info->last_updated,
		);
	}else{
	  $plgshow_data = NULL;
	  $plgshow_data = (object) json_decode('{"url":"https:\/\/wordpress.org\/plugins\/akismet\/","name":"Akismet Anti-Spam","slug":"akismet","version":"4.1.3","author":"Automattic<\/a>","author_profile":"https:\/\/profiles.wordpress.org\/automattic","contributors":{"matt":{"profile":"https:\/\/profiles.wordpress.org\/matt","avatar":"https:\/\/secure.gravatar.com\/avatar\/767fc9c115a1b989744c755db47feb60?s=96&d=monsterid&r=g","display_name":"Matt Mullenweg"},"ryan":{"profile":"https:\/\/profiles.wordpress.org\/ryan","avatar":"https:\/\/secure.gravatar.com\/avatar\/c22398fb9602c967d1dac8174f4a1a4e?s=96&d=monsterid&r=g","display_name":"Ryan Boren"},"andy":{"profile":"https:\/\/profiles.wordpress.org\/andy","avatar":"https:\/\/secure.gravatar.com\/avatar\/35756b05226763c9539679ccec26a1c0?s=96&d=monsterid&r=g","display_name":"Andy Skelton"},"mdawaffe":{"profile":"https:\/\/profiles.wordpress.org\/mdawaffe","avatar":"https:\/\/secure.gravatar.com\/avatar\/94e778f51997baa3f47ecaca4e819090?s=96&d=monsterid&r=g","display_name":"Michael Adams (mdawaffe)"},"tellyworth":{"profile":"https:\/\/profiles.wordpress.org\/tellyworth","avatar":"https:\/\/secure.gravatar.com\/avatar\/88de7e0be9f793ed162ffa78b9cd4a12?s=96&d=monsterid&r=g","display_name":"Tellyworth"},"josephscott":{"profile":"https:\/\/profiles.wordpress.org\/josephscott","avatar":"https:\/\/secure.gravatar.com\/avatar\/582b66ad5ae1b69c7601a990cb9a661a?s=96&d=monsterid&r=g","display_name":"Joseph Scott"},"lessbloat":{"profile":"https:\/\/profiles.wordpress.org\/lessbloat","avatar":"https:\/\/secure.gravatar.com\/avatar\/bdf4fe4742e39fe4c61ee3201c2c8c27?s=96&d=monsterid&r=g","display_name":"lessbloat"},"eoigal":{"profile":"https:\/\/profiles.wordpress.org\/eoigal","avatar":"https:\/\/secure.gravatar.com\/avatar\/72dd449e5e79e046c1c09ed8712b525a?s=96&d=monsterid&r=g","display_name":"Eoin Gallagher"},"cfinke":{"profile":"https:\/\/profiles.wordpress.org\/cfinke","avatar":"https:\/\/secure.gravatar.com\/avatar\/a1378d3f89a30d5daa8d7cca0bd80574?s=96&d=monsterid&r=g","display_name":"Christopher Finke"},"automattic":{"profile":"https:\/\/profiles.wordpress.org\/automattic","avatar":"https:\/\/secure.gravatar.com\/avatar\/687b3bf96c41800814e3b93766444283?s=96&d=monsterid&r=g","display_name":"Automattic"},"jgs":{"profile":"https:\/\/profiles.wordpress.org\/jgs","avatar":"https:\/\/secure.gravatar.com\/avatar\/0ad9eb4e67bac47214cef94d46d1318f?s=96&d=monsterid&r=g","display_name":"Greg"},"procifer":{"profile":"https:\/\/profiles.wordpress.org\/procifer","avatar":"https:\/\/secure.gravatar.com\/avatar\/a3204f7f269d90f82ff92474c8e8e5c6?s=96&d=monsterid&r=g","display_name":"Josh Smith"},"stephdau":{"profile":"https:\/\/profiles.wordpress.org\/stephdau","avatar":"https:\/\/secure.gravatar.com\/avatar\/5b8d74a711e183850bd70ccdd440d15e?s=96&d=monsterid&r=g","display_name":"Stephane Daury (stephdau)"}},"requires":"4.0","tested":"5.3.2","rating":94,"num_ratings":851,"ratings":{"5":753,"4":41,"3":11,"2":8,"1":38},"downloaded":5000000,"active_installs":5000000,"last_updated":"2019-11-13 8:46pm GMT","last_updated_mk":"2019-11-13 8:46pm GMT","added":"2005-10-20","homepage":"https:\/\/akismet.com\/","short_description":"Akismet checks your comments and contact form submissions against our global database of spam to protect you and your site from malicious content.","download_link":"https:\/\/downloads.wordpress.org\/plugin\/akismet.4.1.3.zip","donate_link":"","icons":{"1x":"https:\/\/ps.w.org\/akismet\/assets\/icon-128x128.png?rev=969272","2x":"https:\/\/ps.w.org\/akismet\/assets\/icon-256x256.png?rev=969272"},"banners":{"low":"https:\/\/ps.w.org\/akismet\/assets\/banner-772x250.jpg?rev=479904","high":false}}',true);
   }
	return $plgshow_data;
}