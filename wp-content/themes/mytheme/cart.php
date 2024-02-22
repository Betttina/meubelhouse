<?php
/* --- Cart page --- */


// Change "Remove item"-button
function change_remove_button_html( $sprintf, $cart_item_key ) {
    // changing the default X-icon to trash-can
    // sprintf = current html-elem
    $sprintf = str_replace('&times;', '<i class="fa-solid fa-trash"></i>', $sprintf);
    return $sprintf;
}
add_filter('woocommerce_cart_item_remove_link', 'change_remove_button_html', 10, 2);



/* Change text-content in "Proceed to checkout"-btn */
// gettext = filterhook = Filters text with its translation.

add_filter( 'gettext', 'change_proceed_to_checkout_text', 20, 3 );
function change_proceed_to_checkout_text( $translated_text, $text, $domain ) {
    // Kontrollera om texten kommer från WooCommerce
    if ( 'woocommerce' === $domain ) {
        switch ( $translated_text ) {
            case 'Proceed to checkout':
                $translated_text = 'Check Out';
                break;
        }
    }
    return $translated_text;
}



// Disable (inaktivera) shipping method/options in cart
//
function disable_shipping_calc_on_cart( $show_shipping ) {
    // check if user is in cart
    // returns false to hide shipping option
    if( is_cart() ) {
        return false;
    }
    return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99 );


// anonym function
// Remove the alternative: "Calculate Shipping"
add_filter('woocommerce_product_needs_shipping', function(){return false;});
