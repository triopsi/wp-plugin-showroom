<?php
/**
 * Author: triopsi
 * Author URI: http://wiki.profoxi.de
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0
 *
 * Plgshow is free software: you can redistribute it and/or modify
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
 *
 * @package plgshow
 **/

/**
 * Add Block Editor Assets
 */
function plgshow_wp_plugin_showroom_block_assets() {
	// Styles.
	wp_enqueue_style( 'plgshow-block-style', plugins_url( '../assets/css/plgshow-block-style.css', __FILE__ ), array( 'wp-editor' ), false, 'all' );
}
add_action( 'enqueue_block_assets', 'plgshow_wp_plugin_showroom_block_assets' );


/**
 * Add Gutenberg Block
 */
function plgshow_plgshowLoadBlock() {

	// Add Script Block.
	wp_enqueue_script( 'plg-showroom', plugins_url( '../assets/js/plgshow-blocks.js', __FILE__ ), array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), true );

	// Add Atributes for server-side-parse.
	register_block_type(
		'plgshow-wp/plg-showroom',
		array(
			'attributes'      => array(
				'slug' => array(
					'type' => 'string',
				),
			),
			'editor_script'   => 'plg-showroom',
			'render_callback' => 'plgshow_plugin_block_editor_cb',
		)
	);

	// set js variable.
	wp_localize_script(
		'plg-showroom',
		'plgshow',
		array(
			'logo_plugin' => plugins_url( '../assets/img/icon-128x128.png', __FILE__ ),
			'title'       => __( 'Plugin-Showroom', 'plgshow' ),
			'des'         => __( 'Add a plugin showcase to your post/site.', 'plgshow' ),
			'plgname'     => __( 'Pluginname: ', 'plgshow' ),
			'plgsug'      => __( 'PLUGIN-SLUG', 'plgshow' ),
		)
	);
}

/**
 * Add Block Callback
 */
function plgshow_plugin_block_editor_cb( $attributes ) {
	if ( is_admin() ) {
		return;
	}
	$args = array(
		'name' => $attributes['slug'],
	);
	if ( ! empty( $attributes['slug'] ) ) {
		$args['name'] = $attributes['slug'];
	}

	$html = plgshow_shortcode( $args );
	return $html;
}

add_action( 'init', 'plgshow_plgshowLoadBlock' );
