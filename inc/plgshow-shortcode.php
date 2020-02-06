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


//Show the Shortcode in the post/site/content
function plgshow_shortcode($atts) {

    //Data of the current Post
    global $post;

    ob_start();

    // Shortcode Parameter
	extract(shortcode_atts(array(
		'name'		            => '',
		'show_title'		    => 'true',
		'show_download_link'	=> 'true',
		'show_plugin_link'		=> 'true',
		), $atts));

    
    $name		        = !empty($name) ? $name : '';
    $show_title 		= ( $show_title == 'false') ? false	: true;
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
        $plgin_data = apply_filters( 'plgshow_api_parser', $name );
        if( !$plgin_data ){
            $shortcode_view = '
            <div class="plgshow-showroom">
                <div class="plgshow-plgtable">
                    <div class="plgshow-image"></div>
                    <div class="plgshow-text-content">
                        <div class="plgshow-header">'.$name.'</div>
                        <div class="plgshow-description">' . __( 'Plugin not found', 'plgshow' ) . '</div>
                    </div>
                </div>
            </div>
            ';
        
        }else{
                $shortcode_view = '
                <div class="plgshow-showroom">
                    <div class="plgshow-plgtable">
                        <div class="plgshow-image"><img class="plugin-icon" src="'.$plgin_data->icons.'"></div>
                        <div class="plgshow-text-content">
                            <div class="plgshow-header">'.$plgin_data->name.'</div>
                            <div class="plgshow-description">'.$plgin_data->short_description.'</div>
                            <div class="plgshow-author">'.__('by','plgshow').' '.$plgin_data->author.'</div>
                        </div>
                    </div>
                    <div class="plgshow-footer">
                        <div class="plgshow-footer-text">
                            <div class="plgshow-star-rating">
                                <span class="screen-reader-text">5.0 rating based on 33 ratings</span>
                                <div class="star star-full" aria-hidden="true"></div>
                                <div class="star star-full" aria-hidden="true"></div>
                                <div class="star star-full" aria-hidden="true"></div>
                                <div class="star star-full" aria-hidden="true"></div>
                                <div class="star star-full" aria-hidden="true"></div>
                            </div>
                        </div>
                        <div class="plgshow-dwn-link">
                            <a class="btn button btn-secondary" href="'.$plgin_data->download_link.'" target="_blank">'.__('Download','plgshow').'</a>  <a class="btn button btn-primary" href="'.$plgin_data->url.'" target="_blank">'.__('Information','plgshow').'</a>
                        </div>
                    </div>
                </div>
                ';
        }

    }
    return $shortcode_view;
  
  }