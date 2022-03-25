<?php
get_header();

$page_404_bg_img = get_theme_mod( 'page_404_bg_img' );
$page_404_styles = array();

if( !empty( $page_404_bg_img ) ) {
    $page_404_styles[] = 'background-image:' . 'url(' . esc_url( $page_404_bg_img ) . ')';
}

$page_404_style = smarty_element_style( $page_404_styles );
?>

<div class="content stm-border_color_green" <?php echo sanitize_text_field( $page_404_style ); ?>>
    <div class="container">
        <main class="main">
            <section class="error-404 not-found">
                <h1><?php echo wp_kses( __( 'The page you are looking for<br>does not exist.', 'smarty' ), array( 'br' => array(), 'b' => array(), 'strong' => array() ) ); ?></h1>
                <div class="stm-separator stm-separator_short">
                    <div class="stm-separator__line stm-border-bottom_color_green"></div>
                </div>
            </section><!-- /error-404 -->
        </main><!-- /main -->
    </div>
    <?php get_footer(); ?>
</div><!-- /content -->