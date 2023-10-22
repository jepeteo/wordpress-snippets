<?php

/**
 * This file contains a function that prevents adding products on backorder to cart.
 *
 * @param bool   $passed_validation Whether the validation passed or not.
 * @param int    $product_id        The ID of the product being added to cart.
 * @param int    $variation_id      The ID of the product variation being added to cart.
 *
 * @return bool Whether the validation passed or not.
 */
function prevent_adding_products_on_backorder_to_cart($passed_validation, $product_id, $variation_id = '')
{
    if ($variation_id) {
        // Product variation is being added to cart
        $variation = wc_get_product($variation_id);
        if ($variation->is_on_backorder()) {
            // Product variation is on backorder, prevent adding to cart
            wc_add_notice(__('Product variation on backorder cannot be added to the cart.', 'your-text-domain'), 'error');
            $passed_validation = false;
        }
    } else {
        // Product is being added to cart
        $product = wc_get_product($product_id);
        if ($product->is_on_backorder()) {
            // Product is on backorder, prevent adding to cart
            wc_add_notice(__('Products on backorder cannot be added to the cart.', 'your-text-domain'), 'error');
            $passed_validation = false;
        }
    }
    return $passed_validation;
}
add_filter('woocommerce_add_to_cart_validation', 'prevent_adding_products_on_backorder_to_cart', 10, 3);
