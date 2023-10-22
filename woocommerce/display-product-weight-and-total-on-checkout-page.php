<?php

/**
 * Adds the weight of each item in the cart to the checkout page.
 *
 * @param array $item_data The item data.
 * @param array $cart_item The cart item.
 * @return array The updated item data.
 */
function add_cart_item_weight($item_data, $cart_item)
{
    // Calculate the weight of the item
    $item_weight = $cart_item['data']->get_weight() * $cart_item['quantity'];

    // Add the weight to the item data array
    $item_data[] = array(
        'key'       => __('Weight', 'woocommerce'),
        'value'     => $item_weight,
        'display'   => $item_weight . ' ' . get_option('woocommerce_weight_unit')
    );

    return $item_data;
}

// Hook the function to the 'woocommerce_before_checkout_form' action
add_action('woocommerce_before_checkout_form', 'display_cart_weight');

/**
 * Displays the total weight of the cart on the checkout page.
 *
 * @return void
 */
function display_cart_weight()
{
    // Get the total weight of the cart
    $cart_weight = WC()->cart->get_cart_contents_weight();

    // Output the total weight of the cart
    echo '<p class="cart-weight">' . __('Total Weight:', 'woocommerce') . ' ' . $cart_weight . ' ' . get_option('woocommerce_weight_unit') . '</p>';
}
