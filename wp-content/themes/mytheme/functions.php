<?php


if(!defined('ABSPATH')){
    exit;
}

require_once("vite.php");
require_once("hooks.php");
require_once("cart.php");


require_once(get_template_directory() . "/init.php");




function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


function enqueue_font_awesome() {
    wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v6.5.1/css/all.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );



/*HERO */
function custom_hero_content() {
    if ( ! is_front_page() ) { // Exkludera startsidan om du önskar
        echo '<div class="hero">';
        the_title( '<h1 class="page-title">', '</h1>' );
        woocommerce_breadcrumb(); // Om du använder WooCommerce
        echo '</div>';
    }
}
add_action( 'woocommerce_before_main_content', 'custom_hero_content', 5 ); // Exempel för WooCommerce-sidor
// För andra sidor kan du behöva hitta en lämplig action hook.


/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
    // Change the breadcrumb delimeter from '/' to '>'
    $defaults['delimiter'] = ' &gt; ';
    return $defaults;
}

