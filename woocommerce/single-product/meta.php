<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $post, $product;
?>
<div class="bottom-meta group">
<ul class="social group">
<?php if (sp_isset_option( 'gplusone_button', 'boolean', 'true' )) : ?>
<li>

      <?php if (sp_isset_option( 'gplusone_counter', 'value' ) == '' || ! sp_isset_option( 'gplusone_counter', 'isset' )) {
            $counter = 'false';	
        } else {
            $counter = 'true';	
        }
    echo sp_gplusonebutton_shortcode(array('url' => 'post','size' => sp_isset_option( 'gplusone_size', 'value' ), 'count' => $counter)); ?>
</li>
<?php endif; ?>

<?php if (sp_isset_option( 'facebook_like_button', 'boolean', 'true' )) : ?>
<li>                                                
    <div class="fb-like" data-href="<?php echo the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
</li>                            
<?php endif; ?>
</ul>
<?php 
if ( sp_isset_option( 'product_rating_stars', 'boolean', 'true' ) )
    echo sp_get_star_rating(); 
?>			

</div><!--close bottom-meta-->

<div class="product_meta">

	<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option('woocommerce_enable_sku') == 'yes' && $product->get_sku() ) : ?>
		<span itemprop="productID" class="sku"><?php _e('SKU:', 'sp'); ?> <?php echo $product->get_sku(); ?>.</span>
	<?php endif; ?>
	
	<?php echo $product->get_categories( ', ', ' <span class="posted_in">'.__('Category:', 'sp').' ', '.</span>'); ?>
	
	<?php echo $product->get_tags( ', ', ' <span class="tagged_as">'.__('Tags:', 'sp').' ', '.</span>'); ?>

</div>