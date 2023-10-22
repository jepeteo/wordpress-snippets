<?php

/**
 * Add a notice before payment regarding shipping costs.
 *
 * @return void
 */
function add_notice_before_payment()
{
    echo '<p class="shipping-notice">' . __('Notice before payment options', 'text-domain') . '</p>';
}
add_action('woocommerce_review_order_before_payment', 'add_notice_before_payment');
