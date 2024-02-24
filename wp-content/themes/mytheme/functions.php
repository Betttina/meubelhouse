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



/* HERO */
// ej klar med denna bit
function custom_hero_content() {
    if ( ! is_front_page() ) { // Exkludera startsidan om du önskar
        echo '<div class="hero">';
        the_title( '<h1 class="page-title">', '</h1>' );
        woocommerce_breadcrumb(); // Om du använder WooCommerce
        echo '</div>';
    }
}
add_action( 'woocommerce_before_main_content', 'custom_hero_content', 5 );



/*** Change the breadcrumb separator */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
    // Change the breadcrumb delimeter from '/' to '>'
    $defaults['delimiter'] = ' &gt; ';
    return $defaults;
}

/* for header secondary_menu: add icons to pages */
// atts = attributes for html-links elem
// item = menu-object (instans av WP_Post)
// args contains wp_nav_menu() arguments
// for every id-match -> adds 2 new attributes to atts-array
// aria-label = for accessibility


function add_fontawesome_icons_to_menu( $atts, $item, $args ) {
    // check menu-objects id and add icon
    if ('menu-item-59' === $item->ID) {
        $atts['aria-label'] = 'My Account';
        $atts['data-icon'] = 'fas fa-user';
    } elseif ('menu-item-36' === $item->ID) {
        $atts['aria-label'] = 'Search';
        $atts['data-icon'] = 'fas fa-search';
    }

    return $atts;
}
// when html is generated for menu-links -> function excavates
// filter-hook to modify attributes for <a> for nav
add_filter('nav_menu_link_attributes', 'add_fontawesome_icons_to_menu', 10, 3);


