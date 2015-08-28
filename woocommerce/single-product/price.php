<?php
/**
 * Single Product Price, including microdata for SEO
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

global $post, $product;
?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	<p itemprop="price" class="price"><?php echo $product->get_price_html(); ?></p>
	
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
	
</div>
