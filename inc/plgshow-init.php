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

function plgshowLoadBlock() {
    
    wp_enqueue_script( 'plg-showroom', plugins_url('../assets/js/plgshow-blocks.js', __FILE__), array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), true );
    
    register_block_type( 'plgshow-wp/plg-showroom', array(
          'attributes'  => array(
              'slug' => array(
                  'type' => 'string'
              )
          ),
          'editor_script'   => 'plg-showroom',
          'render_callback' => 'plugin_block_editor_cb',
    ) );

    if( function_exists( 'wp_set_script_translations' ) ) {
        wp_set_script_translations( 'plg-showroom', 'plgshow' );
    }elseif ( function_exists( 'gutenberg_get_jed_locale_data' ) ) {
        $locale  = gutenberg_get_jed_locale_data( 'plgshow' );
        $content = 'wp.i18n.setLocaleData( ' . wp_json_encode( $locale ) . ', "plgshow" );';
        wp_script_add_data( 'plg-showroom', 'data', $content );
    }elseif ( function_exists( 'wp_get_jed_locale_data' ) ) {
		/* for 5.0 */
		$locale  = wp_get_jed_locale_data( 'plgshow' );
		$content = 'wp.i18n.setLocaleData( ' . wp_json_encode( $locale ) . ', "plgshow" );';
		wp_script_add_data( 'plg-showroom', 'data', $content );
	}

}

function plugin_block_editor_cb( $attributes ) {
	if ( is_admin() ) {
		return;
	}
	$args = array(
		'name'        => $attributes['slug'],
	);
	if ( ! empty( $attributes['slug'] ) ) {
		$args['name'] = $attributes['slug'];
	}

    $html = '<b>'.$args['name'].'</b>';//plgshow_shortcode( $args );
    // $html = '[plgshow name="';
    // $html .= $args['slug'];
    // $html .= '"]';
	return $html;
}
   
add_action('init', 'plgshowLoadBlock');