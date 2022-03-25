<?php $page_id = smarty_page_id(); ?>

<?php if ( get_post_meta( $page_id, 'stm_page_title_hide', true ) ) : ?>
    <?php if ( ! get_post_meta( $page_id, 'stm_page_breadcrumbs_hide', true ) ) : ?>
        <?php if ( in_array( 'breadcrumb-navxt/breadcrumb-navxt.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
            <div class="breadcrumbs">
                <div class="container">
                    <?php if(function_exists('bcn_display')) {bcn_display();} ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>