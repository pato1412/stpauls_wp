<?php
$header_view_style =  get_theme_mod( 'header_view_style', 1 );
$top_bar_language = get_theme_mod( 'top_bar_language', true );
$sticky_header = get_theme_mod( 'sticky_header', false );

/* --- DEMO ---*/
if( isset( $_REQUEST['header_style'] ) ) {
    $header_view_style = intval( $_REQUEST['header_style'] );
}

$top_bar_show = get_theme_mod( 'top_bar_show', true );

$header_holder_class = 'header-holder';
if( !empty( $header_view_style ) ) {
    $header_holder_class .= ' header-holder_view-style_' . $header_view_style;
}

$header_class = 'header';
if( !empty( $header_view_style ) ) {
    $header_class .= ' header_view-style_' . $header_view_style;
}
?>

<?php $page_id = smarty_page_id(); ?>

<div class="<?php echo esc_attr( $header_holder_class ); ?> <?php if ( get_post_meta( $page_id, 'stm_page_title_hide', true ) ) : ?>header_holder_small<?php endif; ?>">

    <?php
        /* --- Top Bar ---*/
        smarty_get_layout_file( '/parts', '/header/header-' . $header_view_style );
    ?>

    <?php if( $sticky_header === true ) : ?>
        <script>
            (function($) {
                "use strict";

                $(document).ready(function() {
                    $("#masthead").affix({
                        offset: {top: $(".header-holder").outerHeight(true)}
                    });
                });

            })(jQuery);
        </script>
    <?php endif; ?>

</div><!-- /.header-holder -->