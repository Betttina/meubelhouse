<?php



/* --- Cart page --- */
function change_remove_button_html( $sprintf, $cart_item_key ) {
    // changing the default X-icon to trash-can
    $sprintf = str_replace('&times;', '<i class="fa-solid fa-trash"></i>', $sprintf);
    return $sprintf;
}
add_filter('woocommerce_cart_item_remove_link', 'change_remove_button_html', 10, 2);


/* Proceed to checkout btn*/

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



// Remove shipping method/options in cart
function disable_shipping_calc_on_cart( $show_shipping ) {
    if( is_cart() ) {
        return false;
    }
    return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99 );


// Remove "Calculate Shipping"
add_filter('woocommerce_product_needs_shipping', function(){return false;});
