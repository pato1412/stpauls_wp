<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$rating   = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '87' ), '' ); ?>

		<div class="comment-text">

			<?php do_action( 'woocommerce_review_before_comment_meta', $comment ); ?>

			<?php if ( $comment->comment_approved == '0' ) : ?>

				<p class="meta"><em><?php esc_html_e( 'Your comment is awaiting approval', 'smarty' ); ?></em></p>

			<?php else : ?>

				<div class="product-review-meta">
					<strong class="product-review-author" itemprop="author"><?php comment_author(); ?></strong> <?php

						if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
							if ( $verified )
								echo '<em class="verified">(' . esc_html__( 'verified owner', 'smarty' ) . ')</em> ';

					?>
					<time class="product-review-date" itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time>

					<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) : ?>

						<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'smarty' ), $rating ) ?>">
							<?php $rating_percent = ( $rating / 5 ) * 100; ?>
							<span style="width:<?php echo intval( $rating_percent ); ?>%"><strong itemprop="ratingValue"><?php echo esc_html( $rating ); ?></strong> <?php esc_html_e( 'out of 5', 'smarty' ); ?></span>
						</div>

					<?php endif; ?>
				</div>

			<?php endif; ?>

			<?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>

			<div itemprop="description" class="product-review-description"><?php comment_text(); ?></div>

			<?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>

		</div>
	</div>
