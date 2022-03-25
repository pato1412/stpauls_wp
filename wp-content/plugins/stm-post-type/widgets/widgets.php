<?php
// Smarty Social Networks
class Smarty_Social_Networks extends WP_Widget {

	public function __construct() {
		parent::__construct( 'stm_widget_social_networks', esc_html__( '(Smarty) Social networks', 'smarty' ), array(
			'classname'   => 'widget_social-networks',
			'description' => esc_html__( '(Smarty) Socials networks', 'smarty' ),
		) );
	}

	public function widget( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', $instance['title'] ). wp_kses_post( $args['after_title'] );
		}

		$socials = smarty_get_footer_socials();

		if( !empty( $socials ) ) : ?>
			<ul class="list list_inline list_social-networks">
				<?php foreach( $socials as $social_key => $social_val ) : ?>
					<li class="list__item"><a class="list__item-link list__item-link_<?php echo esc_attr( $social_key ); ?>" href="<?php echo esc_url($social_val); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr( $social_key ); ?>"></i></a></li>
				<?php endforeach; ?>
			</ul>
		<?php endif;

		echo wp_kses_post( $args['after_widget'] );
	}

	function update( $new_instance, $instance ) {
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function form( $instance ) {
		$title  = !empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'smarty' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<?php
	}
}
// Smarty Social Networks - Register
function smarty_load_socials_widget() {
	register_widget( 'Smarty_Social_Networks' );
}

add_action( 'widgets_init', 'smarty_load_socials_widget' );

// Smarty Media Gallery
class Smarty_Media_Gallery extends WP_Widget {

	public function __construct() {
		parent::__construct( 'stm_widget_media_gallery', esc_html__( '(Smarty) Media Gallery', 'smarty' ), array(
			'classname'   => 'widget_media-gallery',
			'description' => esc_html__( '(Smarty) Photo gallery', 'smarty' ),
		) );
	}

	public function widget( $args, $instance ) {
		/* --- Script & Style --- */
		$handle = array(
			'hoverdir',
			'fancybox',
			'fancybox'
		);

		if( ! wp_script_is( $handle ) ) {
			wp_enqueue_script( 'hoverdir' );
			wp_enqueue_script( 'fancybox' );
			wp_enqueue_style( 'fancybox' );
		}

		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', $instance['title'] ). wp_kses_post( $args['after_title'] );
		}

		$stm_gallery_args = array(
			'post_type' => 'stm_media_gallery',
			'posts_per_page' => -1
		);

		if( ! empty( $instance['count_items'] ) ) {
			$stm_gallery_args['posts_per_page'] = $instance['count_items'];
		}

		$stm_gallery = new WP_Query( $stm_gallery_args );

		?>

		<?php if( $stm_gallery->have_posts() ) : ?>
			<ul class="stm-media-gallery stm-media-gallery_widget">
				<?php while( $stm_gallery->have_posts() ) : $stm_gallery->the_post(); ?>
					<?php $media_type = get_post_meta( get_the_ID(), 'media_type', true ) ?>
					<?php if( $img_id = get_post_meta( get_the_ID(), 'media_item_img', true ) ) : ?>
						<?php
							if( function_exists( 'wpb_getImageBySize' ) ) {
								$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '320x320' ) );
							} else {
								$img = wp_get_attachment_image( $img_id, array( 320,320 ) );
							}
						?>
						<li class="stm-media-gallery__item">
							<div class="stm-media-gallery__item-group">
								<?php
									if( isset( $img['thumbnail'] ) ) {
										echo wp_kses_post( $img['thumbnail'] );
									} else {
										echo wp_kses_post( $img );
									}
								?>
								<?php ?>
								<?php if( $media_type == 'video' ) : ?>
									<?php if( $item_video_link = get_post_meta( get_the_ID(), 'media_item_link', true ) ) : ?>
										<a href="<?php echo esc_url( $item_video_link ); ?>?autoplay=1" class="stm-media-gallery__item-link stm-fancybox fancybox.iframe"><i class="stm-icon stm-icon-play"></i></a>
									<?php endif; ?>
								<?php elseif( $media_type == 'audio' ) : ?>
									<?php if( $item_audio_embed = get_post_meta( get_the_ID(), 'media_item_embed', true ) ) : ?>
										<?php
										 preg_match('/src="([^"]+)"/', $item_audio_embed, $match);
										 $item_audio_src = $match[1];
											preg_match('/height="([^"]+)"/', $item_audio_embed, $match);
											$item_audio_height = $match[1];
										?>
										<a href="<?php echo esc_url( $item_audio_src ); ?>" data-height="<?php echo esc_attr( $item_audio_height ); ?>" class="stm-media-gallery__item-link stm-fancybox fancybox.iframe"><i class="fa fa-music"></i></a>
									<?php endif; ?>
								<?php elseif( $media_type == 'image' ) : ?>
									<?php $full_img_src = wp_get_attachment_image_src( $img_id, 'full' ); ?>
									<?php if( !empty( $full_img_src[0] ) ) : ?>
										<a href="<?php echo esc_url( $full_img_src[0] ); ?>" class="stm-media-gallery__item-link stm-fancybox"><i class="fa fa-camera"></i></a>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</li>
					<?php endif; ?>
				<?php
				endwhile;
				wp_reset_postdata();
				?>
			</ul>
			<script>
				(function($) {
					"use strict";

					$(document).ready(function() {
						if ( $().hoverdir && $(".stm-media-gallery__item-group").length ) {
							$( '.stm-media-gallery__item-group' ).each( function() {
								$(this).hoverdir({ hoverElem: '.stm-media-gallery__item-link'});
							} );
						}
					});
				})(jQuery);
			</script>
		<?php endif;

		echo wp_kses_post( $args['after_widget'] );
	}

	function update( $new_instance, $instance ) {
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count_items'] = strip_tags( $new_instance['count_items'] );

		return $instance;
	}

	function form( $instance ) {
		$title = !empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$count_items = !empty( $instance['count_items'] ) ? esc_attr( $instance['count_items'] ) : '';

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'smarty' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'count_items' ) ); ?>"><?php esc_html_e( 'Count Items:', 'smarty' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'count_items' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'count_items' ) ); ?>" type="text" value="<?php echo esc_attr( $count_items ); ?>">
		</p>

		<?php
	}
}
// Smarty Media Gallery - Register
function smarty_load_media_gallery_widget() {
	register_widget( 'Smarty_Media_Gallery' );
}

add_action( 'widgets_init', 'smarty_load_media_gallery_widget' );

// Smarty Contact Details
class Smarty_Contact_Details extends WP_Widget {

	public function __construct() {
		parent::__construct( 'stm_widget_contact_details', esc_html__( '(Smarty) Contact details', 'smarty' ), array(
			'classname'   => 'widget_contact-details',
			'description' => esc_html__( '(Smarty) Contact details', 'smarty' ),
		) );
	}

	public function widget( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', $instance['title'] ). wp_kses_post( $args['after_title'] );
		}

		$contact_details = array(
			'address',
			'telephone',
			'fax',
			'email',
			'schedule'
		);

		if( !empty( $contact_details ) ) :

		?>

			<ul class="list list_unstyle list_contact-details">

				<?php foreach( $contact_details as $contact_detail ) : ?>
					<?php if( $instance[$contact_detail] ) : ?>
						<?php if( $contact_detail == 'email' ) : ?>
							<li class="list__item list__item_<?php echo esc_attr( $contact_detail ); ?>"><a href="mailto:<?php echo esc_attr( $instance[$contact_detail] ); ?>"><?php echo wp_kses_post( $instance[$contact_detail] ); ?></a></li>
						<?php else : ?>
							<li class="list__item list__item_<?php echo esc_attr( $contact_detail ); ?>"><?php echo wp_kses_post( $instance[$contact_detail] ); ?></li>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>

			</ul>

		<?php

		endif;

		echo wp_kses_post( $args['after_widget'] );
	}

	function update( $new_instance, $instance ) {
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['address'] = strip_tags( $new_instance['address'] );
		$instance['telephone'] = strip_tags( $new_instance['telephone'] );
		$instance['fax'] = strip_tags( $new_instance['fax'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		$instance['schedule'] = strip_tags( $new_instance['schedule'] );

		return $instance;
	}

	function form( $instance ) {
		$title = !empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$address = !empty( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';
		$telephone = !empty( $instance['telephone'] ) ? esc_attr( $instance['telephone'] ) : '';
		$fax = !empty( $instance['fax'] ) ? esc_attr( $instance['fax'] ) : '';
		$email = !empty( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
		$schedule = !empty( $instance['schedule'] ) ? esc_attr( $instance['schedule'] ) : '';

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'smarty' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address:', 'smarty' ); ?></label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"><?php echo wp_kses( $address, array(
					'a' => array(
						'href' => array()
					),
					'br' => array(),
					'strong' => array(),
					'b' => array()
				) ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'telephone' ) ); ?>"><?php esc_html_e( 'Telephone:', 'smarty' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'telephone' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'telephone' ) ); ?>" type="text" value="<?php echo esc_attr( $telephone ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>"><?php esc_html_e( 'Fax:', 'smarty' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'fax' ) ); ?>" type="text" value="<?php echo esc_attr( $fax ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'E-Mail:', 'smarty' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'schedule' ) ); ?>"><?php esc_html_e( 'Schedule:', 'smarty' ); ?></label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'schedule' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'schedule' ) ); ?>"><?php echo wp_kses( $schedule, array(
					'a' => array(
						'href' => array()
					),
					'br' => array(),
					'strong' => array(),
					'b' => array()
				) ); ?></textarea>
		</p>

		<?php
	}
}

// Smarty Contact Details - Register
function smarty_load_contact_details_widget() {
	register_widget( 'Smarty_Contact_Details' );
}

add_action( 'widgets_init', 'smarty_load_contact_details_widget' );
