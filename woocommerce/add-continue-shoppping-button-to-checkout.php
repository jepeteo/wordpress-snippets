<?php

/**
 * Add continue shopping button to checkout.
 * Also add a class to the button to style it differently if you want.
 * 
 * @return void
 */

add_action('woocommerce_proceed_to_checkout', 'teo_add_continue_shopping_button');

function teo_add_continue_shopping_button()
{
    $shop_page_url = get_permalink(wc_get_page_id('shop'));
    echo '<a href="' . $shop_page_url . '" class="button continue-shopping">Continue shopping</a>';
}
