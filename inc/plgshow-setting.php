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
 * top level menu
 */
function plgshow_option_menue(){

    add_options_page( 
        __('WP Plugin Options','plgshow'), 
        __('WP Plugin Options','plgshow'),
        'manage_options',
        'plgshow',
        'plgshow_options_page_html'
    );
}

/**
* register our plgshow_options_page to the admin_menu action hook
*/
add_action( 'admin_menu', 'plgshow_option_menue' );

/**
 * top level menu:
 * callback functions
 */
function plgshow_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
    return;
    }
    ?>
	<div class="wrap">
		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		<div id="post-body-content">
			<div id="wppic-admin-page" class="meta-box-sortabless">
				<div id="wppic-shortcode" class="postbox">
					<h3 class="hndle"><span><?php _e( 'How to use WP Plugin Showroom shortcode?', 'plgshow' ) ; ?></span></h3>
					<div class="inside">
						<h3 class="wp-pic-title"><?php _e( 'Shortcode parameters', 'plgshow' ) ; ?></h3>
						<ul>
                            <li><strong>name:</strong> plugin name (Slug name) - <?php _e( 'the slug name of the plugin. https://wordpress.org/plugins/SLUG-NAME/', 'plgshow' ); ?></li>
                            <li><strong>show_download_link:</strong> true/false - <?php _e( 'show the downloadlink? default: true', 'plgshow' ); ?></li>
                            <li><strong>show_plugin_link:</strong> true/false - <?php _e( 'show the wordpresslink? default: true', 'plgshow' ); ?></li>
						</ul>
						<p><?php _e( 'Sample:', 'plgshow' ); ?></p>
						<p>
							<pre> [plgshow name="wp-plugin-showroom" show_download_link="true" show_plugin_link="true"] </pre>
						</p>
                        <div class="plgshow-wrap-option-page">
                            <p class="trash_buffer">
                                <button id="trash-buffer" target="_blank" class="button button-primary btn-trash-buffer" data-success="<?php _e( 'Buffer was successfully delete', 'plgshow' ); ?>" data-error="<?php _e( 'Something went wrong', 'plgshow' ); ?>">🚮 <?php _e('Delete buffer', 'plgshow'); ?></button>
                                <span class="trash-buffer-spinner" style="display: none; background-image: url( '<?php echo admin_url(); ?>images/spinner-2x.gif' );"></span>
                            </p>
                            <a href="https://paypal.me/triopsi" target="_blank" class="button button-secondary">❤️ <?php _e('Donate', 'plgshow'); ?></a> 
                            <a href="https://wiki.profoxi.de/" target="_blank" class="button button-secondary">ℹ️ <?php _e('Help', 'plgshow'); ?></a> 
                        </div>
					 </div>
				</div>
			</div>
        <?php if(WP_DEBUG){ ?>
            <div class="debug-info">
                <h3><?php _e('Debug information','plgshow'); ?></h3>
                <p><?php _e('You are seeing this because your WP_DEBUG variable is set to true.','plgshow'); ?></p>
                <pre>plgshow_plugin_version: <?php print_r(get_option( 'plgshow_plugin_version' )) ?></pre>
                <pre>plgshow_show_transients: <?php print_r(plgshow_show_transients()); ?></pre>
            </div><!-- /.debug-info -->
        <?php } ?>
    </div>
    <?php
}

/**
 * Find transients
 */
function plgshow_show_transients(){

    global $wpdb;
    
	$wppic_transients = $wpdb->get_results(
		"SELECT option_name AS name,
		option_value AS value FROM $wpdb->options
		WHERE option_name LIKE '_transient_plgshow_%'"
    );
  
  return $wppic_transients;
}


/**
 * Ajax buffer clear handle
 */
function plgshow_trash_buffer() {
	plgshow_delete_transients();
}
add_action( 'wp_ajax_plgshow_trash_buffer', 'plgshow_trash_buffer' );