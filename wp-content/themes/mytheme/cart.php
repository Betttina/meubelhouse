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



