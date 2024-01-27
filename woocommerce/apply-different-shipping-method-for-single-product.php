
<?php
/**
 * Apply different shipping method for a single product.
 *
 * This code snippet demonstrates how to apply a different shipping method for a specific product in WooCommerce.
 * By using the 'woocommerce_package_rates' filter, we can modify the available shipping methods and their costs.
 * In this example, we check if the product ID matches the desired product, and if so, we change the shipping method to 'Flat Rate'.
 * 
 * Before you can use the snippet, you need to:
 * 1. Replace the product ID with the ID of your product.
 * 2. Create if not already existing a shipping method that you want to apply to the product.
 * 3. Replace the shipping method ID with the ID of your shipping method.
 * 
 * @param array $rates The available shipping rates.
 * @param array $package The package details.
 * @return array The modified shipping rates.
 */
add_filter('woocommerce_package_rates', 'different_shipping_method_for_product', 10, 2);

function different_shipping_method_for_product($rates, $package)
{
    // Product ID to check in the cart
    $product_id = 123; // Replace with your product ID
    $product_in_cart = false;

    // Check if the product is in the cart
    foreach ($package['contents'] as $item) {
        if ($item['product_id'] == $product_id) {
            $product_in_cart = true;
            break;
        }
    }

    // Check if the product is in the cart but not alone
    if ($product_in_cart && count($package['contents']) > 1) {
        // Loop through shipping methods and disable the shipping method
        foreach ($rates as $rate_id => $rate) {
            if ($rate_id === 'flat_rate:10') { // Replace with your shipping method ID, if its not flat rate, change the prefix as well
                unset($rates[$rate_id]); // Remove the shipping method
            }
        }
    }

    // Check if the product is NOT in the cart
    if (!$product_in_cart) {
        // Loop through shipping methods and disable flat_rate:10 in the default zone (zone_id = 0)
        foreach ($rates as $rate_id => $rate) {
            if ($rate_id === 'flat_rate:10') {
                unset($rates[$rate_id]); // Remove the shipping method
            }
        }
    }

    return $rates;
}
?>