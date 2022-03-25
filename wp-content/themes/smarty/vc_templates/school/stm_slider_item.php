<?php
$item_type = '';
$img_id = '';
$img_size = '';
$video_img_id = '';
$video_link = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="stm-slider__item">
	<?php if( 'img' === $item_type && !empty( $img_id ) && $img_id > 0 ) : ?>
		<?php
			if( empty( $img_size ) ) {
				$img_size = '825x460';
			}

			$img = wpb_getImageBySize( array(
				'attach_id' => $img_id,
				'thumb_size' => $img_size
			) );

			echo wp_kses( $img['thumbnail'], array(
				'img' => array(
					'src' => array(),
					'width' => array(),
					'height' => array()
				)
			) );
		?>
	<?php endif; ?>

	<?php if( 'video' === $item_type && $video_link ) : ?>
			<div class="stm-slider__video<?php echo (( $video_img_id ) ? ' stm-slider__video_has_poster' : ''); ?>">
				<?php if( $video_img_id ) : ?>
						<a href="#" class="stm-slider__video-play"><span class="stm-icon stm-icon-play"></span></a>
						<?php
							$img_size = '825x460';

							$video_img = wpb_getImageBySize( array(
								'attach_id' => $video_img_id,
								'thumb_size' => $img_size,
								'class' => 'stm-slider__video-poster'
							) );
						?>

						<?php
							echo wp_kses( $video_img['thumbnail'], array(
								'img' => array(
									'src' => array(),
									'width' => array(),
									'height' => array(),
									'class' => array()
								)
							) );
						?>
				<?php endif; ?>

				<iframe class="stm-slider__video-iframe" width="100%" src="<?php echo esc_url( $video_link ); ?>" frameborder="0" allowfullscreen></iframe>
			</div>
	<?php endif; ?>
</div>
