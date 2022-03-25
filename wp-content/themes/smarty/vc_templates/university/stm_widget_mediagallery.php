<?php
/* === VARIABLES === */
$title = '';
$count_items = '';
$view_type = '';

/* === GET ATTRIBUTES === */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* === ENQUEUE SCRIPT & STYLE ===

 * 1. Isotope
 * 2. ImagesLoaded
 * 3. FancyBox
 * 4. HoverDir
*/
wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'hoverdir' );
wp_enqueue_script( 'fancybox' );
wp_enqueue_style( 'fancybox' );

/* === CSS CLASS === */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/* === QUERY === */
$items_query_args = array(
    'post_type' => 'stm_media_gallery',
    'posts_per_page' => -1
);

if( $count_items ) {
    $items_query_args['posts_per_page'] = $count_items;
}

$items_query = new WP_Query( $items_query_args );
?>

<?php if( $items_query->have_posts() ) : ?>

    <div class="stm-media-gallery<?php echo esc_attr( $css_class ); ?>">
        <!-- Actions bar -->
        <h4 class="widget__title"><?php echo sanitize_text_field( $title ); ?></h4>
        <div class="vc_stm_media-gallery wpb_content_element">
            <div class="stm-media-gallery__items-row stm-media-gallery__items-row_view_<?php echo esc_attr( $view_type ); ?> row">

                <?php while( $items_query->have_posts() ) : $items_query->the_post(); ?>
                    <?php
                    $item_img_id = get_post_meta( get_the_ID(), 'media_item_img', true );
                    $media_type = get_post_meta( get_the_ID(), 'media_type', true );

                    if( !empty( $item_img_id ) && $item_img_id > 0 ) : ?>

                        <?php
                        if( $view_type == 'masonry' ) {
                            $stm_post_class = array( 'stm-media-gallery__item-col', 'col-md-4 col-sm-4 col-xs-12', 'media-type-' . $media_type );
                            $item_img = wp_get_attachment_image( $item_img_id, 'full' );
                        } else {
                            $stm_post_class = array( 'stm-media-gallery__item-col', 'col-md-4 col-sm-6 col-xs-12', 'media-type-' . $media_type );
                            $item_img = wpb_getImageBySize(array(
                                'attach_id' => $item_img_id,
                                'thumb_size' => '320x320',
                            ));
                            $item_img = $item_img['thumbnail'];
                        }
                        ?>
                        <div <?php post_class( $stm_post_class ); ?>>

                            <div class="stm-media-gallery__item">
                                <?php echo wp_kses_post( $item_img ); ?>

                                <?php if( $media_type == 'video' ) : ?>
                                    <?php if( $item_video_link = get_post_meta( get_the_ID(), 'media_item_link', true ) ) : ?>
                                        <a href="<?php echo esc_url( $item_video_link ); ?>?autoplay=1" class="stm-media-gallery__item-fancybox fancybox.iframe"><i class="stm-icon stm-icon-play"></i></a>
                                    <?php endif; ?>
                                <?php elseif( $media_type == 'audio' ) : ?>
                                    <?php if( $item_audio_embed = get_post_meta( get_the_ID(), 'media_item_embed', true ) ) : ?>

                                        <?php
                                        preg_match('/src="([^"]+)"/', $item_audio_embed, $match);
                                        $item_audio_src = $match[1];
                                        preg_match('/height="([^"]+)"/', $item_audio_embed, $match);
                                        $item_audio_height = $match[1];
                                        ?>

                                        <a href="<?php echo esc_url( $item_audio_src ); ?>" data-height="<?php echo esc_attr( $item_audio_height ); ?>" class="stm-media-gallery__item-fancybox fancybox.iframe"><i class="fa fa-music"></i></a>
                                    <?php endif; ?>
                                <?php elseif( $media_type == 'image' ) : ?>
                                    <?php $item_img_src = wp_get_attachment_image_src( $item_img_id, 'full' ); ?>
                                    <?php if( !empty( $item_img_src[0] ) ) : ?>
                                        <a href="<?php echo esc_url( $item_img_src[0] ); ?>" class="stm-media-gallery__item-fancybox"><i class="fa fa-camera"></i></a>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </div>

                        </div>

                    <?php endif; ?>

                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php
/* === SCRIPT ===
 *
 * - Masonry
 * - FancyBox
 * - ImagesLoaded
 * - Layout Switcher
 *
*/
?>
<script>
    (function($) {
        "use strict";
        var $container;

        $(document).ready(function() {
            // ImagesLoaded
            if( $(".stm-media-gallery__items-row_view_masonry").length ) {
                $container = $('.stm-media-gallery__items-row_view_masonry').imagesLoaded( function() {
                    $container.isotope({
                        itemSelector: '.stm-media-gallery__item-col',
                        layoutMode: 'masonry',
                        masonry: {
                            columnWidth: '.stm-media-gallery__item-col'
                        }
                    });
                });
            }

            if( $(".stm-media-gallery__items-row_view_grid").length ) {
                $container = $('.stm-media-gallery__items-row_view_grid').imagesLoaded( function() {
                    $container.isotope({
                        itemSelector: '.stm-media-gallery__item-col',
                        layoutMode: 'fitRows',
                        fitRows: {
                            columnWidth: '.stm-media-gallery__item-col'
                        }
                    });
                });
            }


            if ( $().hoverdir && $(".stm-media-gallery__item").length ) {
                $( '.stm-media-gallery__item' ).each( function() {
                    $(this).hoverdir({ hoverElem: '.stm-media-gallery__item-fancybox'});
                } );
            }

        });

        // Filter
        $('.stm-media-gallery__filters').on( 'click', '.stm-media-gallery__filter-link', function() {
            var filterValue = $(this).attr('data-filter');
            $container.isotope({ filter: filterValue });
            $(this).parent().addClass('stm-media-gallery__filter_active').siblings().removeClass('stm-media-gallery__filter_active');

            return false;
        });

        // FancyBox
        $(document).ready(function() {
            if( $(".stm-media-gallery__item-fancybox").length ) {
                $(".stm-media-gallery__item-fancybox").fancybox({
                    maxWidth	: '70%',
                    maxHeight	: '70%',
                    autoSize	: false,
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

        // View Switcher
        $(document).on("click", ".stm-media-gallery__layout-wide", function() {
            var $this = $(this);

            if( ! $this.hasClass("stm-media-gallery__layout-wide_active") ) {
                $this.addClass("stm-media-gallery__layout-wide_active");
                $this.closest('.stm-media-gallery').find('.stm-media-gallery__items').removeClass('container').addClass('stm-media-gallery__items_wide');
                $container.isotope('layout');
            } else {
                $this.removeClass("stm-media-gallery__layout-wide_active");
                $this.closest('.stm-media-gallery').find('.stm-media-gallery__items').removeClass('stm-media-gallery__items_wide').addClass('container');
                $container.isotope('layout');
            }

            return false;

        });

    })(jQuery);
</script>
