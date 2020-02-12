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

/* Shortcode on the Page */
add_shortcode("plgshow", "plgshow_shortcode");

//Needed to load the rating star function
require_once( ABSPATH . 'wp-admin/includes/template.php' );

/**
 * Show the Shortcode in the post/site/content
 *
 * @param [type] $atts
 * @return void
 */
function plgshow_shortcode($atts) {

    //Data of the current Post
    global $post;

    // Shortcode Parameter
	extract(shortcode_atts(array(
		'name'		            => '',
		'show_download_link'	=> 'true',
		'show_plugin_link'		=> 'true',
		), $atts));

    //Parameters
    $name		        = !empty($name) ? $name : '';
    $show_download_link = ( $show_download_link == 'false') ? false	: true;
    $show_plugin_link 	= ( $show_plugin_link == 'false') ? false	: true;
    ?>
    <style>
        .plgshow-footer a{
            color:#fff;
        }
    </style>

    <?php
    if(!empty($name)){

        //Get Transient
        $plgin_data = get_transient( 'plgshow_'. preg_replace( '/\-/', '_', $name ) );
        if( false === $plgin_data || empty($plgin_data) ){

            //Get data
            $plgin_data = apply_filters( 'plgshow_api_parser', $name );

            if( !is_null($plgin_data) || !empty($plgin_data) ){
                //Set Transient - 12h
                set_transient( 'plgshow_'. preg_replace( '/\-/', '_', $name ), $plgin_data, 720*60 );
            }
        }

        // Date format Internationalizion
        $plgshowDateFormat = get_option( 'date_format' );

        if( is_null($plgin_data) || empty($plgin_data) ){
            $shortcode_view = '
            <div class="plgshow-showroom">
                <div class="plgshow-plgtable">
                    <div class="plgshow-text-content">
                        <div class="plgshow-header">'.$name.'</div>
                        <div class="plgshow-description">' . __( 'Plugin not found!', 'plgshow' ) . '</div>
                    </div>
                </div>
            </div>
            ';
        }else{
                //Transformation Date
                $plgin_data->last_updated = date_i18n( $plgshowDateFormat, strtotime( $plgin_data->last_updated ) );
                
                $shortcode_view = '
                <div class="plgshow-showroom">
                    <div class="plgshow-plgtable">
                        <div class="plgshow-image"><img class="plugin-icon" src="'.$plgin_data->icons["1x"].'"></div>
                        <div class="plgshow-text-content">
                            <div class="plgshow-header"><a href="'.$plgin_data->url.'">'.$plgin_data->name.'</a></div>
                            <div class="plgshow-description">'.$plgin_data->short_description.'</div>
                            <div class="plgshow-author">'.__('by','plgshow').' '.$plgin_data->author.'</div>
                        </div>
                    </div>
                    <div class="plgshow-footer">
                        <div class="plgshow-footer-text">
                            <div class="plgshow-star-rating">'.wp_star_rating( array( 'rating' => $plgin_data->rating, 'type' => 'percent', 'number' => $plgin_data->num_ratings ) ).'</div>
                            ('.$plgin_data->num_ratings.')
                        </div>';

                        if($show_download_link || $show_plugin_link){
                            $shortcode_view .= '<div class="plgshow-dwn-link">';
                        }

                        if($show_download_link){
                            $shortcode_view .= '<a class="plgshow-button" href="'.$plgin_data->download_link.'" target="_blank"><span class="dashicons dashicons-download"></span> '.__('Download','plgshow').'</a>';
                        }

                        if($show_plugin_link){
                            $shortcode_view .= '<a class="plgshow-button" href="'.$plgin_data->url.'" target="_blank"><span class="dashicons dashicons-wordpress-alt"></span> '.__('Information','plgshow').'</a>';
                        }

                        if($show_download_link || $show_plugin_link){
                            $shortcode_view .= '</div>';
                        }
                        
                        if($plgin_data->active_installs != 0){
                            $shortcode_view .= '
                            <div class="plgshow-footer-text-downloads">
                            <span class="dashicons dashicons-yes"></span>'.number_format( filter_var( $plgin_data->active_installs, FILTER_SANITIZE_NUMBER_INT ) ).'+ '.__('Active Installs','plgshow').'
                            </div>';
                        }else{
                            $shortcode_view .= '
                            <div class="plgshow-footer-text-modi">
                            <span class="dashicons dashicons-edit"></span><span style="font-weight:bold;">'.__('Last Updated:','plgshow').'</span> '.$plgin_data->last_updated.'
                            </div>'; 
                        }
                $shortcode_view .= '</div>
                </div>
                ';
        }

    }
    return $shortcode_view;
  
  }