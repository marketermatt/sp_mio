<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $woocommerce;
?>

<?php if ( ( $woocommerce->cart->needs_shipping() || get_option('woocommerce_require_shipping_address') == 'yes' ) && ! $woocommerce->cart->ship_to_billing_address_only() ) : ?>
			
	<?php 
		if ( empty( $_POST ) ) :
			
			$shiptobilling = (get_option('woocommerce_ship_to_same_address')=='yes') ? 1 : 0;
			$shiptobilling = apply_filters('woocommerce_shiptobilling_default', $shiptobilling);
		
		else :
		
			$shiptobilling = $checkout->get_value('shiptobilling');
		
		endif;
	?>

	<p class="form-row" id="shiptobilling">
		<input id="shiptobilling-checkbox" class="input-checkbox" <?php checked($shiptobilling, 1); ?> type="checkbox" name="shiptobilling" value="1" />
		<label for="shiptobilling-checkbox" class="checkbox"><?php _e('Ship to billing address?', 'sp'); ?></label>
	</p>
			
	<h3><?php _e('Shipping Address', 'sp'); ?></h3>
			
	<div class="shipping_address">
					
		<?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>
		
		<?php foreach ($checkout->checkout_fields['shipping'] as $key => $field) : ?>
		
			<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
		
		<?php endforeach; ?>
		
		<?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>
								
	</div>
		
<?php endif; ?>
		
<?php do_action('woocommerce_before_order_notes', $checkout); ?>
		
<?php if (get_option('woocommerce_enable_order_comments')!='no') : ?>
		
	<?php if ($woocommerce->cart->ship_to_billing_address_only()) : ?>
	
		<h3><?php _e('Additional Information', 'sp'); ?></h3>
	
	<?php endif; ?>
			
	<?php foreach ($checkout->checkout_fields['order'] as $key => $field) : ?>
	
		<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
			
	<?php endforeach; ?>
								
<?php endif; ?>
		
<?php do_action('woocommerce_after_order_notes', $checkout); ?>