<?php

//<!-- ---####*** Change text Woo  ***####--- --> 

function filter_gettext( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Thêm vào giỏ hàng' :
        $translated_text = __( 'Thêm vào danh sách', 'woocommerce' );
        break;
        break;
    }
    return $translated_text;
}
add_filter( 'gettext',  'filter_gettext', 10, 3 );

//<!-- ---####*** Add Shortcode  ***####--- -->
function relatedProduct() {
    echo do_shortcode('[block id="nhung-dich-vu-duoc-yeu-thich"]');}
// add_action( 'woocommerce_after_single_product', 'relatedProduct', 20 );

// // <!-- ---####*** Remove tab and create new tabs on HTML ***####--- -->
// function wc_remove_reviews_tab($tabs) {
//   unset($tabs['reviews']);
//   return $tabs;
// }
// add_filter( 'woocommerce_product_tabs', 'wc_remove_reviews_tab', 98 );
