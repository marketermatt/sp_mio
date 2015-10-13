<?php
/**
 * Product attributes
 * @package 	WooCommerce/Templates
 * @version     2.1.3
 *
 * Used by list_attributes() in the products class
 */

global $woocommerce;

$alt = 1;
$attributes = $product->get_attributes();

if ( empty( $attributes ) && ( ! $product->enable_dimensions_display() || ( ! $product->has_dimensions() && ! $product->has_weight() ) ) ) return;
?>
<table class="shop_attributes">
			
	<?php if ( $product->enable_dimensions_display() ) : ?>	
		
		<?php if ( $product->has_weight() ) : $alt = $alt * -1; ?>
		
			<tr class="<?php if ( $alt == 1 ) echo 'alt'; ?>">
				<th><?php _e('Weight', 'sp') ?></th>
				<td><?php echo $product->get_weight() . ' ' . get_option('woocommerce_weight_unit'); ?></td>
			</tr>
		
		<?php endif; ?>
		
		<?php if ($product->has_dimensions()) : $alt = $alt * -1; ?>
		
			<tr class="<?php if ( $alt == 1 ) echo 'alt'; ?>">
				<th><?php _e('Dimensions', 'sp') ?></th>
				<td><?php echo $product->get_dimensions(); ?></td>
			</tr>		
		
		<?php endif; ?>
		
	<?php endif; ?>
			
	<?php foreach ($attributes as $attribute) : 
		
		if ( ! isset( $attribute['is_visible'] ) || ! $attribute['is_visible'] ) continue;
		if ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) continue;
		
		$alt = $alt * -1; 
		?>
			
		<tr class="<?php if ( $alt == 1 ) echo 'alt'; ?>">
			<th><?php echo wc_attribute_label( $attribute['name'] ); ?></th>
			<td><?php
				if ( $attribute['is_taxonomy'] ) {
					
					$values = woocommerce_get_product_terms( $product->id, $attribute['name'], 'names' );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
					
				} else {
				
					// Convert pipes to commas and display values
					$values = explode( '|', $attribute['value'] );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
					
				}
			?></td>
		</tr>
				
	<?php endforeach; ?>
	
</table>