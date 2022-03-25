<?php

// Do not allow directly accessing this file.
if( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

$demos = array(
    'school' => array(
        'label' => esc_html__( 'School', 'smarty' )
    ),
    'school-two' => array(
        'label' => esc_html__( 'School Two', 'smarty' )
    ),
    'kindergarten' => array(
        'label' => esc_html__( 'Kindergarten', 'smarty' )
    ),
    'kindergarten-two' => array(
        'label' => esc_html__( 'Kindergarten Two', 'smarty' )
    ),
    'university' => array(
        'label' => esc_html__( 'University', 'smarty' )
    ),
    'university-two' => array(
        'label' => esc_html__( 'University Two', 'smarty' )
    )
);

$auth_code = stm_check_auth();
$plugins = smarty_register_required_plugins( true );

/*Check if demo import plugin installed*/
$demo_plugin_installed = false;
if( in_array( 'stm-importer/stm-importer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( 'stm-importer/stm-importer.php' ) ) ) {
    $demo_plugin_installed = true;
}
?>
<div class="wrap about-wrap stm-admin-wrap  stm-admin-demos-screen">
    <?php stm_get_admin_tabs( 'demos' ); ?>

    <?php if( !empty( $auth_code ) ):
        $current_demo = get_option( 'stm_layout_mode', '' );
        ?>
        <div class="stm_demo_import_choices">
            <script type="text/javascript">
                var stm_layouts = {};
            </script>
            <?php foreach ( $demos as $demo_key => $demo_value ): ?>
                <script type="text/javascript">
                    stm_layouts['<?php echo esc_attr( $demo_key ); ?>'] = <?php echo json_encode( smarty_layout_plugins( $demo_key ) ); ?>;
                </script>
                <label class="<?php if( $demo_key == $current_demo ) echo 'active'; ?>">
                    <div class="inner">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/admin/screens/img/preview/' . $demo_key . '.png' ); ?>"/>
                        <?php if( $demo_key == $current_demo ): ?>
                            <div class="installed"><?php esc_html_e( 'Installed', 'smarty' ); ?></div>
                        <?php else: ?>
                            <div class="install"
                                 data-name="<?php echo esc_attr( $demo_value[ 'label' ] ); ?>"
                                 data-layout="<?php echo esc_attr( $demo_key ); ?>"><?php esc_html_e( 'Import', 'smarty' ); ?></div>
                        <?php endif; ?>
                        <span class="stm_layout__label"><?php echo esc_attr( $demo_value[ 'label' ] ); ?></span>
                    </div>
                </label>
            <?php endforeach; ?>
        </div>


        <div class="stm_install__demo_popup">
            <div class="stm_install__demo_popup_close"></div>
            <div class="inner">

                <!-- Privacy Policy -->
                <div class="privacy_policy">
                    <h4><?php esc_html_e( 'Privacy Policy', 'smarty' ); ?></h4>
                    <div class="stm_install__demo_popup_close"></div>
                    <div class="stm_plugins_status">
                        <?php require_once( get_template_directory() . '/inc/privacy_policy.php' ); ?>
                    </div>
                    <div class="privacy_policy_button decline"
                         data-value="decline"><?php esc_html_e( 'Decline', 'smarty' ); ?></div>
                    <div class="privacy_policy_button"
                         data-value="accept"><?php esc_html_e( 'Accept', 'smarty' ); ?></div>
                    <input type="hidden" name="skip_api" id="skip_api" value="0"/>
                </div>

                <div class="demo_install" style="display: none;">
                    <h4><?php esc_html_e( 'Demo Installation', 'smarty' ); ?></h4>
                    <div class="stm_install__demo_popup_close"></div>
                    <div class="stm_plugins_status">
                        <?php foreach ( $plugins as $plugin ):
                            $active = ( smarty_check_plugin_active( $plugin[ 'slug' ] ) ) ? 'installed' : 'not-installed';
                            $active_text = ( $active == 'installed' ) ? esc_html__( 'Installed & Activated', 'smarty' ) : esc_html__( 'Not installed', 'smarty' );
                            ?>
                            <div id="<?php echo sanitize_text_field( 'stm_' . $plugin[ 'slug' ] ); ?>"
                                 class="stm_single_plugin_info <?php echo esc_attr( $active ); ?>"
                                 data-active="<?php echo esc_attr( $active ); ?>"
                                 data-slug="<?php echo sanitize_text_field( $plugin[ 'slug' ] ); ?>">
                                <div class="image">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/admin/screens/img/plugins/' . $plugin[ 'slug' ] . '.png' ); ?>"/>
                                </div>
                                <div class="title"><?php echo sanitize_text_field( $plugin[ 'name' ] ); ?></div>
                                <div class="status">
                                    <span><?php echo sanitize_text_field( $active_text ); ?></span>
                                    <div class="loading-dots"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="stm_content_status">
                            <div class="image">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/admin/screens/img/plugins/demo.png' ); ?>"/>
                            </div>
                            <div class="title"><?php esc_html_e( 'Demo content', 'smarty' ); ?></div>
                            <div class="status"><span></span>
                                <div class="loading-dots"></div>
                            </div>
                        </div>
                    </div>
                    <div class="stm_install__demo_start"><?php esc_html_e( 'Setup Layout', 'smarty' ); ?></div>
                </div>

            </div>
        </div>
    <?php else: ?>
        <div class="stm-admin-message">
            <?php printf( wp_kses_post( __( 'Please enter your Activation Token before running the Smarty.', 'smarty' ) ) ); ?>
        </div>
    <?php endif; ?>
</div>

<script type="text/javascript">
    (function ($) {
        var plugins = <?php echo html_entity_decode( json_encode( wp_list_pluck( $plugins, 'slug' ) ) ); ?>;
        var layout = 'default';
        var layout_name = 'New York';

        var plugin = false;
        var layout_plugins = [];
        var installation = false;

        <?php if(!empty( $_GET[ 'layout_importing' ] )): ?>
        layout = '<?php echo esc_js( $_GET[ 'layout_importing' ] ); ?>';
        <?php if(!empty( $demos[ $_GET[ 'layout_importing' ] ] )): ?>
        layout_name = '<?php echo esc_js( $demos[ $_GET[ 'layout_importing' ] ][ 'label' ] ); ?>';
        <?php endif; ?>

        /* Privacy Policy */
        $('.stm_install__demo_popup .privacy_policy').hide();
        $('.stm_install__demo_popup .demo_install').show();
        <?php endif; ?>

        $(document).ready(function () {
            next_installable();
            show_popup();

            <?php if(!empty( $_GET[ 'layout_importing' ] )): ?>
            layout = '<?php echo esc_js( $_GET[ 'layout_importing' ] ); ?>';
            $('.stm_demo_import_choices .install').click();
            setTimeout(function () {
                $('.stm_install__demo_popup .inner .stm_install__demo_start').click();
            }, 1000);

            window.history.pushState('', '', '<?php echo esc_url( remove_query_arg( 'layout_importing' ) ) ?>');
            <?php endif; ?>

            $('.stm_install__demo_popup .inner .stm_install__demo_start').on('click', function (e) {
                e.preventDefault();

                if ($(this).attr('target') === '_blank') {
                    var win = window.open($(this).attr('href'), '_blank');
                    win.focus();

                    return;
                }

                if (!$(this).hasClass('installing')) {
                    next_installable();

                    if (!plugin) {
                        /* Plugins installed, Install demo */
                        performAjax('import_demo');
                    } else {
                        /* Install plugin */
                        performAjax(plugins[plugin]);
                    }
                }
            });

            /* Privacy Policy */
            $('.privacy_policy_button').on('click', function (e) {
                e.preventDefault();

                $('.stm_install__demo_popup .privacy_policy').hide();
                $('.stm_install__demo_popup .demo_install').show();

                if ($(this).data('value') == 'decline') {
                    $('#skip_api').val(1);
                }

            });

        });

        function performAjax(plugin_slug) {
            installation = true;
            var installing = "<?php esc_html_e( 'Installing', 'smarty' ); ?>";
            var installed = "<?php esc_html_e( 'Installed & Activated', 'smarty' ); ?>";
            var $current_plugin = $('#stm_' + plugin_slug);

            <?php if(!empty( $_GET[ 'layout_importing' ] )): ?>
            layout = '<?php echo esc_js( $_GET[ 'layout_importing' ] ); ?>';
            <?php if(!empty( $demos[ $_GET[ 'layout_importing' ] ] )): ?>
            layout_name = '<?php echo esc_js( $demos[ $_GET[ 'layout_importing' ] ][ 'label' ] ); ?>';
            <?php endif; ?>
            <?php endif; ?>

            $.ajax({
                url: ajaxurl,
                dataType: 'json',
                context: this,
                data: {
                    'layout': layout,
                    'plugin': plugin_slug,
                    'action': 'smarty_install_plugin',
                    'security': smarty_install_plugin
                },
                beforeSend: function () {
                    $current_plugin
                        .addClass('installing')
                        .find('.status > span').text(installing);
                    $('.stm_install__demo_popup .inner .stm_install__demo_start').addClass('installing');
                },
                complete: function (data) {
                    $current_plugin
                        .removeClass('installing')
                        .find('.status > span').html(installed).text();

                    var dt = data.responseJSON;
                    if (typeof dt.next !== 'undefined') {
                        plugin = dt.plugin_slug;
                        performAjax(dt.next);
                    }

                    if (typeof dt.activated !== 'undefined' && dt.activated) {
                        plugin = dt.plugin_slug;
                        $current_plugin.removeClass('.not-installed').addClass('installed').attr('data-active', 'installed');
                    }

                    if (typeof dt.import_demo !== 'undefined' && dt.import_demo) {
                        install_demo()
                    }
                },
                error: function () {
                    window.location.href += '&layout_importing=' + layout;
                }

            });
        }

        function install_demo() {
            installation = true;
            var importing_demo_text = "<?php esc_html_e( 'Importing Demo', 'smarty' ); ?>";
            var imported_demo_text = "<?php esc_html_e( 'Imported', 'smarty' ); ?>";

            <?php if(!empty( $_GET[ 'layout_importing' ] )): ?>
            layout = '<?php echo esc_js( $_GET[ 'layout_importing' ] ); ?>';
            <?php if(!empty( $demos[ $_GET[ 'layout_importing' ] ] )): ?>
            layout_name = '<?php echo esc_js( $demos[ $_GET[ 'layout_importing' ] ][ 'label' ] ); ?>';
            <?php endif; ?>
            <?php endif; ?>

            $.ajax({
                url: ajaxurl,
                dataType: 'json',
                context: this,
                data: {
                    'demo_template': layout,
                    'action': 'stm_demo_import_content'
                },
                beforeSend: function () {
                    $('.stm_content_status').addClass('installing');
                    $('.stm_content_status .status > span').text(importing_demo_text);
                },
                complete: function (data) {
                    installation = false;
                    $('.stm_install__demo_popup .inner .stm_install__demo_start').removeClass('installing');
                    $('.stm_content_status').removeClass('installing').addClass('installed');
                    $('.stm_content_status .status > span').text(imported_demo_text);

                    var dt = data.responseJSON;
                    if (typeof dt.title !== 'undefined' && typeof dt.url !== 'undefined') {
                        var demo_start = '.stm_install__demo_popup .inner .stm_install__demo_start';
                        $(demo_start).text(dt.title);
                        $(demo_start).attr('href', dt.url);
                        $(demo_start).attr('target', '_blank');
                        $('<a class="stm_install_demo_to" href="' + dt.theme_options + '">' + dt.theme_options_title + '</a>').insertBefore(demo_start);
                    }

                    /* Privacy Policy */
                    /* Analytics */
                    if ($('#skip_api').val() == 0) {
                        $.ajax({
                            url: 'https://panel.stylemixthemes.com/api/active/',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                theme: 'smarty',
                                layout: layout_name,
                                website: "<?php echo esc_url( get_site_url() ); ?>",

                                <?php
                                $token = get_option( 'envato_market', array() );
                                $token = ( !empty( $token[ 'token' ] ) ) ? $token[ 'token' ] : ''; ?>
                                token: "<?php echo esc_js( $token ); ?>"
                            }
                        });
                    }
                }
            });
        }

        function show_popup() {
            $('.stm_demo_import_choices .install').on('click', function (e) {
                e.preventDefault();
                layout = $(this).attr('data-layout');
                layout_name = $(this).attr('data-name');

                <?php if(!empty( $_GET[ 'layout_importing' ] )): ?>
                layout = '<?php echo esc_js( $_GET[ 'layout_importing' ] ); ?>';
                <?php if(!empty( $demos[ $_GET[ 'layout_importing' ] ] )): ?>
                layout_name = '<?php echo esc_js( $demos[ $_GET[ 'layout_importing' ] ][ 'label' ] ); ?>';
                <?php endif; ?>
                <?php endif; ?>

                hide_plugins(layout);
                $('.stm_install__demo_popup').addClass('active');
            });

            $('.stm_install__demo_popup_close').on('click', function (e) {
                e.preventDefault();
                if (!installation) {
                    $('.stm_install__demo_popup').removeClass('active');
                }
            });
        }

        function next_installable() {
            $('.stm_single_plugin_info').each(function () {
                var active = $(this).attr('data-active');
                var currentPlugin = $(this).attr('data-slug');
                if (active == 'not-installed' && !plugin && layout_plugins.indexOf(currentPlugin) !== -1) plugin = currentPlugin;
            });
        }

        function hide_plugins(layout) {
            layout_plugins = stm_layouts[layout];

            $('.stm_single_plugin_info').each(function () {
                var plugin_slug = $(this).attr('data-slug');
                if (layout_plugins.indexOf(plugin_slug) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        }

    })(jQuery);
</script>