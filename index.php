<?php 
/*
Plugin Name: ALT Lab Gravity Form Review Before Submit
Plugin URI:  https://github.com/
Description: Adds a review before submission option to a Gravity Form
Version:     1.01
Author:      ALT Lab (Matt Roberts)
Author URI:  http://altlab.vcu.edu
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: my-toolset

*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


// add_action('wp_enqueue_scripts', 'gf_review_load_scripts');

function prefix_load_scripts() {                           
    $deps = array('jquery');
    $version= '1.01'; 
    $in_footer = true;    
    wp_enqueue_script('gf-review-main-js', plugin_dir_url( __FILE__) . 'js/gf-review-main.js', $deps, $version, $in_footer); 
    wp_enqueue_style( 'gf-review-main-css', plugin_dir_url( __FILE__) . 'css/gf-review-main.css');
}

// From here https://docs.gravityforms.com/gform_review_page/

add_filter( 'gform_review_page', 'add_review_page', 10, 3 );
function add_review_page( $review_page, $form, $entry ) {
 
    // Enable the review page
    $review_page['is_enabled'] = true;
 
    if ( $entry ) {
        // Populate the review page.
        $review_page['content'] = GFCommon::replace_variables( '{all_fields}', $form, $entry );
    }
 
    return $review_page;
}


//LOGGER -- like frogger but more useful

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

  //print("<pre>".print_r($a,true)."</pre>");
