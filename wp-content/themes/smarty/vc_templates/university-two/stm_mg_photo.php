<?php
/* --- VARIABLES --- */
$img_id = $filter_enable = '';
$carousel_height = '';
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
    'posts_per_page' => -1,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key'     => 'media_featured',
            'value'   => 'on',
            'compare' => 'LIKE',
        ),
        array(
            'key'     => 'media_type',
            'value'   => 'image',
            'compare' => 'LIKE',
        )
    )
) );

/* --- ID --- */
$menu_id = uniqid('stm-menu-');
$carousel_id = uniqid('stm-carousel-');
$carousel_copy_id = uniqid('stm-copy-carousel-');

$carousel_height_inline_styles = array(
    'height:' . esc_attr( $carousel_height )
);

$carousel_height_inline_style = smarty_element_style( $carousel_height_inline_styles );

?>

<?php if( $carousel_enable ) : ?>
    <?php if( $gallery_query->have_posts() ) : ?>
        <div class="stm-media-gallery<?php echo esc_attr( $css_class ); ?>">

            <!-- Carousel -->
            <div class="stm-carousel stm-carousel_centered stm-carousel_wide just-photo" id="<?php echo esc_attr( $carousel_id ) ?>">

                <?php while( $gallery_query->have_posts() ) : $gallery_query->the_post(); ?>

                    <?php $media_type = get_post_meta( get_the_ID(), 'media_type', true ); ?>

                    <?php if( $img_id = get_post_meta( get_the_ID(), 'media_item_img', true ) ) : ?>

                        <?php $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '1680x696' ) ); ?>

                        <div <?php post_class( array( 'stm-carousel__item', 'stm-media-gallery__item', 'media-type-'.$media_type ) ); ?> <?php echo sanitize_text_field( $carousel_height_inline_style ); ?>>
                            <?php echo wp_kses_post( $img['thumbnail'] ); ?>

                            <?php
                            /* --- Image --- */
                            if( $media_type == 'image' ) : ?>

                                <?php $full_img_src = wp_get_attachment_image_src( $img_id, 'full' ); ?>

                                <?php if( !empty( $full_img_src[0] ) ) : ?>
                                    <a href="<?php echo esc_url( $full_img_src[0] ); ?>" class="stm-media-gallery__item-fancybox"><i class="stm-icon stm-icon-media-loupe"></i></a>
                                    <span class="stm-media-gallery__item-icon"><i class="fa fa-camera"></i></span>
                                <?php endif; ?>

                            <?php endif; ?>
                        </div>

                    <?php endif; ?>

                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>

            </div>
        </div>

        <div id="<?php echo esc_attr( $carousel_copy_id ); ?>" class="hide"></div>

    <?php endif; ?>
<?php else : ?>
    <?php if( $gallery_query->have_posts() ) : ?>
        <div class="<?php echo esc_attr( $css_class ); ?>">
            <ul class="stm-media-list just-photo">
                <?php while( $gallery_query->have_posts() ) : $gallery_query->the_post(); ?>

                    <?php $media_type = get_post_meta( get_the_ID(), 'media_type', true ); ?>

                    <?php if( $img_id = get_post_meta( get_the_ID(), 'media_item_img', true ) ) : ?>

                        <?php $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '340x220' ) ); ?>

                        <li <?php post_class( array( 'stm-media-list__item', 'media-type-'.$media_type ) ); ?>>
                            <?php
                            /* --- Image --- */
                            if( $media_type == 'image' ) : ?>

                                <?php $full_img_src = wp_get_attachment_image_src( $img_id, 'full' ); ?>

                                <?php if( !empty( $full_img_src[0] ) ) : ?>
                                    <a href="<?php echo esc_url( $full_img_src[0] ); ?>" class="stm-media-gallery__item-fancybox">
                                        <span class="stm-media-list-thumbnail">
                                            <?php echo wp_kses_post( $img['thumbnail'] ); ?>
                                            <i class="fa fa-camera"></i>
                                        </span>
                                    </a>
                                <?php endif; ?>

                            <?php endif; ?>
                        </li>

                    <?php endif; ?>

                <?php endwhile; ?>
            </ul>
            <?php wp_reset_postdata(); ?>
        </div>
    <?php endif; ?>
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
                nav: true,
                responsive:{
                    0 : {
                        items : 1
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