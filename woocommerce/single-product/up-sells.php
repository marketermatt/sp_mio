<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$args = array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'posts_per_page' 		=> 4,
	'no_found_rows' 		=> 1,
	'orderby' 				=> 'rand',
	'post__in' 				=> $upsells
);

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>
	
	<div class="upsell products group">
        <?php if (sp_isset_option('upsell_product_title', 'isset')) {
            echo '<h2 class="section-title">' . sp_isset_option('upsell_product_title', 'value') . '</h2>';
        } else {
            echo '<h2 class="section-title">'.__('You May Also Like:', 'sp').'</h2>';	
        };
        ?>
		
		<ul class="products">
			
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
		
				<?php woocommerce_get_template_part( 'content', 'upsell' ); ?>
	
			<?php endwhile; // end of the loop. ?>
				
		</ul>
	</div>
	
<?php endif; 

wp_reset_query();