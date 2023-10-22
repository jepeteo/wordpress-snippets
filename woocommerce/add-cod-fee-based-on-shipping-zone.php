<?php

/**
 * Add COD fee based on shipping zone.
 *
 * @return void
 */
function add_cod_fee_based_on_shipping_zone()
{
    // Get the chosen payment method
    $chosen_gateway = WC()->session->get('chosen_payment_method');

    // Exit function if chosen payment method is not COD
    if ($chosen_gateway != 'cod') {
        return;
    }

    // Get the chosen shipping methods
    $chosen_shipping_methods = wc_get_chosen_shipping_method_ids();

    // Exit function if 'wbs' shipping method is not selected
    // 'wbs' is the shipping method ID of 'WooCommerce Weight Based Shipping' plugin
    // Change 'wbs' to your shipping method ID or remove / comment this condition if you want to apply the fee to all shipping methods
    if (!in_array('wbs', $chosen_shipping_methods)) {
        return;
    }

    // Get cart shipping packages
    $shipping_packages =  WC()->cart->get_shipping_packages();

    // Get the WC_Shipping_Zones instance object for the first package
    $shipping_zone = wc_get_shipping_zone(reset($shipping_packages));

    // Get the ID of the shipping zone
    $zone_id   = $shipping_zone->get_id();

    // Add COD fee based on the shipping zone
    switch ($zone_id) {
        case "2":
            $cod_fee = 3;
            WC()->cart->add_fee(__('COD', 'woocommerce'), $cod_fee);
            break;
        case "3":
            $cod_fee = 4;
            WC()->cart->add_fee(__('COD', 'woocommerce'), $cod_fee);
            break;
        case "4":
            $cod_fee = 5;
            WC()->cart->add_fee(__('COD', 'woocommerce'), $cod_fee);
            break;
    }
}
add_action('woocommerce_cart_calculate_fees', 'add_cod_fee_based_on_shipping_zone');
