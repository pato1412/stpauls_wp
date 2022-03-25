<?php
/* --- VARIABLES --- */
$img_id = $filter_enable = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/* --- SCRIPT & STYLE ---
 *
 * 1. HoverDir
 * 2. OwlCarousel
 *
*/
if( ! wp_script_is( 'hoverdir' ) ) {
    wp_enqueue_script( 'hoverdir' );
}

if( ! wp_script_is( 'fancybox' ) ) {
    wp_enqueue_script( 'fancybox' );
    wp_enqueue_style( 'fancybox' );
}

if( ! wp_script_is( 'owl-carousel' ) ) {
    wp_enqueue_style( 'owl-carousel' );
}

if( ! wp_script_is( 'owl-carousel' ) ) {
    wp_enqueue_script( 'owl-carousel' );
}

/* --- QUERY --- */
$gallery_query = new WP_Query( array(
    'post_type' => 'stm_media_gallery',
    'posts_per_page' => -1
) );

$gallery_query_one = new WP_Query( array(
    'post_type' => 'stm_media_gallery',
    'posts_per_page' => 1,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key'     => 'media_featured',
            'value'   => 'on',
            'compare' => 'LIKE',
        ),
        array(
            'key'     => 'media_type',
            'value'   => 'video',
            'compare' => 'LIKE',
        )
    )
) );

$gallery_query_four = new WP_Query( array(
    'post_type' => 'stm_media_gallery',
    'posts_per_page' => 5,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key'     => 'media_featured',
            'value'   => 'on',
            'compare' => 'LIKE',
        ),
        array(
            'key'     => 'media_type',
            'value'   => 'video',
            'compare' => 'LIKE',
        )
    )
) );

/* --- ID --- */
$menu_id = uniqid('stm-menu-');
$carousel_id = uniqid('stm-carousel-');
$carousel_copy_id = uniqid('stm-copy-carousel-');

?>


<!--Gallery Query One-->
<?php if( $gallery_query_one->have_posts() ) : ?>
    <ul class="stm-media-list-one just-video">
        <?php while( $gallery_query_one->have_posts() ) : $gallery_query_one->the_post(); ?>

            <?php $media_type = get_post_meta( get_the_ID(), 'media_type', true ); ?>

            <?php if( $img_id = get_post_meta( get_the_ID(), 'media_item_img', true ) ) : ?>

                <?php $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '1080x656' ) ); ?>

                <li <?php post_class( array( 'stm-media-list__item', 'media-type-'.$media_type ) ); ?>>
                    <?php
                    /* --- Video --- */
                    if( $media_type == 'video' ) : ?>
                        <?php if( $item_video_link = get_post_meta( get_the_ID(), 'media_item_link', true ) ) : ?>
                            <a href="<?php echo esc_url( $item_video_link ); ?>?autoplay=1" class="stm-media-gallery__item-fancybox fancybox.iframe">
                                <span class="stm-media-list-thumbnail">
                                    <?php echo wp_kses_post( $img['thumbnail'] ); ?>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                </span>
                                <span class="stm-media-list-content">
                                    <span class="stm-media-list-title"><?php the_title(); ?></span>
                                    <?php if( $media_item_desc = get_post_meta( get_the_ID(), 'media_item_descr', true ) ) : ?>
                                        <span class="stm-media-list-desc"><?php echo wp_kses_post($media_item_desc); ?></span>
                                    <?php endif; ?>
                                </span>
                            </a>
                        <?php endif; ?>

                    <?php
                    /* --- Audio --- */
                    elseif( $media_type == 'audio' && $item_audio_embed = get_post_meta( get_the_ID(), 'media_item_embed', true ) ) : ?>

                        <?php
                        preg_match('/src="([^"]+)"/', $item_audio_embed, $match);
                        $item_audio_src = $match[1];
                        preg_match('/height="([^"]+)"/', $item_audio_embed, $match);
                        $item_audio_height = $match[1];
                        ?>

                        <a href="<?php echo esc_url( $item_audio_src ); ?>" data-height="<?php echo esc_attr( $item_audio_height ); ?>" class="stm-media-gallery__item-fancybox fancybox.iframe">
                            <span class="stm-media-list-thumbnail">
                                <?php echo wp_kses_post( $img['thumbnail'] ); ?>
                                <i class="fa fa-volume-up" aria-hidden="true"></i>
                            </span>
                            <span class="stm-media-list-content">
                                <span class="stm-media-list-title"><?php the_title(); ?></span>
                                <?php if( $media_item_desc = get_post_meta( get_the_ID(), 'media_item_descr', true ) ) : ?>
                                    <span class="stm-media-list-desc"><?php echo wp_kses_post($media_item_desc); ?></span>
                                <?php endif; ?>
                            </span>
                        </a>

                    <?php
                    /* --- Image --- */
                    elseif( $media_type == 'image' ) : ?>

                        <?php $full_img_src = wp_get_attachment_image_src( $img_id, 'full' ); ?>

                        <?php if( !empty( $full_img_src[0] ) ) : ?>
                            <a href="<?php echo esc_url( $full_img_src[0] ); ?>" class="stm-media-gallery__item-fancybox">
                                <span class="stm-media-list-thumbnail">
                                    <?php echo wp_kses_post( $img['thumbnail'] ); ?>
                                    <i class="fa fa-camera"></i>
                                </span>
                                <span class="stm-media-list-content">
                                    <span class="stm-media-list-title"><?php the_title(); ?></span>
                                    <?php if( $media_item_desc = get_post_meta( get_the_ID(), 'media_item_descr', true ) ) : ?>
                                        <span class="stm-media-list-desc"><?php echo wp_kses_post($media_item_desc); ?></span>
                                    <?php endif; ?>
                                </span>
                            </a>
                        <?php endif; ?>

                    <?php endif; ?>
                </li>

            <?php endif; ?>

        <?php endwhile; ?>
    </ul>
    <?php wp_reset_postdata(); ?>

<?php endif; ?>
<!--Gallery Query Four-->
<?php if( $gallery_query_four->have_posts() ) : ?>
    <ul class="stm-media-list just-video">
        <?php while( $gallery_query_four->have_posts() ) : $gallery_query_four->the_post(); ?>

            <?php $media_type = get_post_meta( get_the_ID(), 'media_type', true ); ?>

            <?php if( $img_id = get_post_meta( get_the_ID(), 'media_item_img', true ) ) : ?>

                <?php $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '150x96' ) ); ?>

                <li <?php post_class( array( 'stm-media-list__item', 'media-type-'.$media_type ) ); ?>>
                    <?php
                    /* --- Video --- */
                    if( $media_type == 'video' ) : ?>

                        <?php if( $item_video_link = get_post_meta( get_the_ID(), 'media_item_link', true ) ) : ?>
                            <a href="<?php echo esc_url( $item_video_link ); ?>?autoplay=1" class="stm-media-gallery__item-fancybox fancybox.iframe">
                                <span class="stm-media-list-thumbnail">
                                    <?php echo wp_kses_post( $img['thumbnail'] ); ?>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                </span>
                                <span class="stm-media-list-content">
                                    <span class="stm-media-list-title"><?php the_title(); ?></span>
                                </span>
                            </a>
                        <?php endif; ?>

                    <?php
                    /* --- Audio --- */
                    elseif( $media_type == 'audio' && $item_audio_embed = get_post_meta( get_the_ID(), 'media_item_embed', true ) ) : ?>

                        <?php
                        preg_match('/src="([^"]+)"/', $item_audio_embed, $match);
                        $item_audio_src = $match[1];
                        preg_match('/height="([^"]+)"/', $item_audio_embed, $match);
                        $item_audio_height = $match[1];
                        ?>

                        <a href="<?php echo esc_url( $item_audio_src ); ?>" data-height="<?php echo esc_attr( $item_audio_height ); ?>" class="stm-media-gallery__item-fancybox fancybox.iframe">
                            <span class="stm-media-list-thumbnail">
                                <?php echo wp_kses_post( $img['thumbnail'] ); ?>
                                <i class="fa fa-volume-up" aria-hidden="true"></i>
                            </span>
                            <span class="stm-media-list-content">
                                <span class="stm-media-list-title"><?php the_title(); ?></span>
                            </span>
                        </a>

                    <?php
                    /* --- Image --- */
                    elseif( $media_type == 'image' ) : ?>

                        <?php $full_img_src = wp_get_attachment_image_src( $img_id, 'full' ); ?>

                        <?php if( !empty( $full_img_src[0] ) ) : ?>
                            <a href="<?php echo esc_url( $full_img_src[0] ); ?>" class="stm-media-gallery__item-fancybox">
                                <span class="stm-media-list-thumbnail">
                                    <?php echo wp_kses_post( $img['thumbnail'] ); ?>
                                    <i class="fa fa-camera"></i>
                                </span>
                                <span class="stm-media-list-content">
                                    <span class="stm-media-list-title"><?php the_title(); ?></span>
                                </span>
                            </a>
                        <?php endif; ?>

                    <?php endif; ?>
                </li>

            <?php endif; ?>

        <?php endwhile; ?>
    </ul>
    <?php wp_reset_postdata(); ?>

<?php endif; ?>


<!-- SCRIPT -->
<script>
    (function($) {
        "use strict";

        var carouselId = '#<?php echo esc_js( $carousel_id ); ?>',
            carouselIdCopy = '#<?php echo esc_js( $carousel_copy_id ); ?>',
            menuId = '#<?php echo esc_js( $menu_id ); ?>',
            $carousel = $(carouselId);

        // Init HoverDir
        function initHoverDir() {
            if ( $().hoverdir && $(".stm-media-gallery__item").length ) {
                $( '.stm-media-gallery__item' ).each( function() {
                    $(this).hoverdir({ hoverElem: '.stm-media-gallery__item-fancybox'});
                } );
            }
        }

        // Carousel - Filter
        function smartyOwlFilter(smartyFilter) {
            $carousel.trigger('destroy.owl.carousel');
            $carousel.removeClass("owl-loaded");
            $carousel.find(".owl-stage-outer").remove();
            $carousel.find(".stm-carousel__item").remove();

            if( smartyFilter === 'all' ) {
                $(carouselIdCopy + ' .stm-carousel__item').clone().appendTo($(carouselId));
            } else {
                $(carouselIdCopy + ' .stm-carousel__item.' + smartyFilter).clone().appendTo($(carouselId));
            }

            $carousel.owlCarousel({
                dots: false,
                lazyLoad: true,
                responsive:{
                    0 : {
                        items : 1
                    },
                    480 : {
                        items : 2
                    },
                    640 : {
                        items : 3
                    },
                    768 : {
                        items : 4
                    },
                    992 : {
                        items : 5
                    },
                    1024 : {
                        items : 6
                    }
                }
            });

            initHoverDir();
        }

        $( menuId +' .stm-menu__item-link' ).click(function(e) {
            var galleryFilter = $(this).data('gallery-filter');

            $( menuId +' .stm-menu__item' ).removeClass( 'stm-menu__item_active' );
            $(this).parent().addClass('stm-menu__item_active');

            smartyOwlFilter( galleryFilter );

            e.preventDefault();
        });

        $(window).load(function() {
            // Carousel
            $carousel.owlCarousel({
                dots: false,
                lazyLoad: true,
                responsive:{
                    0 : {
                        items : 1
                    },
                    480 : {
                        items : 2
                    },
                    640 : {
                        items : 3
                    },
                    768 : {
                        items : 4
                    },
                    992 : {
                        items : 5
                    },
                    1024 : {
                        items : 6
                    }
                }
            });

            $(carouselId + ' .stm-carousel__item').clone().appendTo($(carouselIdCopy));

            // HoverDir
            initHoverDir();

            // FancyBox
            if( $(".stm-media-gallery__item-fancybox").length ) {
                $(".stm-media-gallery__item-fancybox").fancybox({
                    maxWidth : '70%',
                    maxHeight : '70%',
                    autoSize : false,
                    padding: 0,
                    closeClick: false,
                    openEffect: 'none',
                    closeEffect: 'none',
                    beforeLoad: function() {
                        if( $(this.element).attr("data-height") ) {
                            this.height = $(this.element).attr("data-height");
                        }
                    }

                });
            }
        });
    })(jQuery);
</script>