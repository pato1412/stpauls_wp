<div id="frontend_customizer">
    <div class="customizer_wrapper">
        <h3><?php esc_html_e('Demos', 'smarty'); ?></h3>
        <div class="customizer_element">
            <select name="demos_switcher" id="demos_switcher">
                <option value="https://smartyschool.stylemixthemes.com/"><?php esc_html_e( 'School', 'smarty' ); ?></option>
                <option value="https://smartyschool.stylemixthemes.com/university/"><?php esc_html_e( 'University', 'smarty' ); ?></option>
                <option value="https://smartyschool.stylemixthemes.com/kindergarten/"><?php esc_html_e( 'Kindergarten', 'smarty' ); ?></option>
                <option value="https://smartyschool.stylemixthemes.com/school-two/"><?php esc_html_e( 'School Two', 'smarty' ); ?></option>
                <option value="https://smartyschool.stylemixthemes.com/university-two/"><?php esc_html_e( 'University Two', 'smarty' ); ?></option>
                <option value="https://smarty.loc/kindergarten-two/"><?php esc_html_e( 'Kindergarten Two', 'smarty' ); ?></option>
            </select>
        </div>

        <h3><?php esc_html_e( 'Color Skin', 'smarty' ); ?></h3>
        <div class="customizer_element">
            <div class="customizer_colors" id="site-skin-color">
                <span id="skin-green" class="active"></span>
                <span id="skin-orange"></span>
                <span id="skin-purple"></span>
                <span id="skin-red"></span>
            </div>
        </div>

        <h3><?php esc_html_e('Header Style', 'smarty'); ?></h3>
        <div class="customizer_element">
            <select name="header_style" id="site-header-style">
                <option value="style_1"><?php esc_html_e( 'Style 1', 'smarty' ); ?></option>
                <option value="style_2"><?php esc_html_e( 'Style 2', 'smarty' ); ?></option>
                <option value="style_3"><?php esc_html_e( 'Style 3', 'smarty' ); ?></option>
                <option value="style_4"><?php esc_html_e( 'Style 4', 'smarty' ); ?></option>
            </select>
        </div>

        <h3><?php esc_html_e('Layout', 'smarty'); ?></h3>
        <div class="customizer_element">
            <div class="stm_switcher" id="site-layout">
                <div class="switcher_label disable"><?php esc_html_e('Wide', 'smarty'); ?></div>
                <div class="switcher_nav"></div>
                <div class="switcher_label enable"><?php esc_html_e('Boxed', 'smarty'); ?></div>
            </div>
        </div>

        <div class="customizer_bg_image" id="site-bg-image" style="display: none;">
            <h3><?php esc_html_e('Background Image', 'smarty'); ?></h3>
            <div class="customizer_element">
                <div class="customizer_colors" id="site-bg-images">
                    <span id="site-bg_img_1" class="site-bg-image active" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/frontend-customizer/prev_img_1.png'); "></span>
                    <span id="site-bg_img_2" class="site-bg-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/frontend-customizer/prev_img_2.png'); "></span>
                    <br/>
                    <span id="site-bg_pattern_1" class="site-bg-image site-bg-image_pattern" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/frontend-customizer/prev_pattern_1.png'); "></span>
                    <span id="site-bg_pattern_2" class="site-bg-image site-bg-image_pattern" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/frontend-customizer/prev_pattern_2.png'); "></span>
                    <span id="site-bg_pattern_3" class="site-bg-image site-bg-image_pattern" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/frontend-customizer/prev_pattern_3.png'); "></span>
                </div>
            </div>
        </div>
    </div>
    <div id="frontend_customizer_button"><i class="fa fa-cog"></i></div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        "use strict";

        $("#frontend_customizer_button").on('click', function () {
            if ($("#frontend_customizer").hasClass('open')) {
                $("#frontend_customizer").removeClass('open');
            } else {
                $("#frontend_customizer").addClass('open');
            }
        });

        $("#frontend_customizer_button").on("mouseover", function() {
            $(this).find('.fa').addClass('fa-spin');
        });

        $("#frontend_customizer_button").on("mouseout", function() {
            $(this).find('.fa').removeClass('fa-spin');
        });

        $('#main').on('click', function (kik) {
            if (!$(kik.target).is('#frontend_customizer, #frontend_customizer *') && $('#frontend_customizer').is(':visible')) {
                $("#frontend_customizer").removeClass('open');
                $(this).find('.fa').removeClass('fa-spin');
            }
        });

        // Demos
        $("#demos_switcher").on("change", function() {
            var demosStyle = $(this).val();

            switch( demosStyle ) {
                case "https://smartyschool.stylemixthemes.com/" :
                    window.location = "https://smartyschool.stylemixthemes.com/";
                    break;
                case "https://smartyschool.stylemixthemes.com/university/" :
                    window.location = "https://smartyschool.stylemixthemes.com/university/";
                    break;
                case "https://smartyschool.stylemixthemes.com/kindergarten/" :
                    window.location = "https://smartyschool.stylemixthemes.com/kindergarten/";
                    break;
                case "https://smartyschool.stylemixthemes.com/school-two/" :
                    window.location = "https://smartyschool.stylemixthemes.com/school-two/";
                    break;
                case "https://smartyschool.stylemixthemes.com/university-two/" :
                    window.location = "https://smartyschool.stylemixthemes.com/university-two/";
                    break;
                case "https://smarty.loc/kindergarten-two/" :
                    window.location = "https://smarty.loc/kindergarten-two/";
                    break;
            }
        });

        var activeDemo = window.location.href;
        $("#demos_switcher option").each(function() {
            console.log($(this).val());
            if( $(this).val() === activeDemo ) {
                $(this).prop("selected", true);
            }
        });

        // Skin Color
        $("#site-skin-color span").on("click", function() {
            var skinName = $(this).attr("id");
            $(this).addClass("active").siblings().removeClass("active");
            $('#skin-style').remove();
            if( skinName != 'skin-green' ) {
                $('head').append('<link rel="stylesheet" id="skin-style" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/<?php echo smarty_get_layout_mode(); ?>/'+skinName+'.css" media="all">')
            }
        });

        // Header Style
        $("#site-header-style").on("change", function() {
            var headerStyle = $(this).val();

            switch( headerStyle ) {
                case "style_2" :
                    window.location = "<?php echo esc_url( get_the_permalink( 2666 ) ) . '?header_style=2'; ?>";
                    break;
                case "style_3" :
                    window.location = "<?php echo esc_url( get_the_permalink( 2674 ) ) . '?header_style=3'; ?>";
                    break;
                case "style_4" :
                    window.location = "<?php echo esc_url( get_the_permalink( 2676 ) ) . '?header_style=4'; ?>";
                    break;
                default:
                    window.location = "<?php echo esc_url( home_url('/') ); ?>";
                    break;
            }
        });

        <?php if( smarty_get_layout_mode() == 'school' ) : ?>
        if( $(".header").length && $(".header").hasClass("header_view-style_3") || $(".header").length && $(".header").hasClass("header_view-style_4") ) {
            $(".header .logo img").attr("src", '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/tmp/logo-white.svg' );
        }
        <?php endif; ?>

        var activeHeader = window.location.href.split("header_");

        if( activeHeader[1] ) {
            activeHeader = activeHeader[1].replace( '=', '_');

            $("#site-header-style option").each(function() {
                if( $(this).val() === activeHeader ) {
                    $(this).prop("selected", true);
                }
            });

        }

        // Site Layout
        $("#site-layout").on("click", function() {

            if( ! $(this).hasClass("active") ) {
                $(this).addClass("active");
                $('body').addClass("site-layout_boxed");

                if( $(".site-bg-image").hasClass("active") ) {
                    $("body").addClass($(".site-bg-image.active").attr("id"));

                    if( ! $(".site-bg-image.active").hasClass("site-bg-image_pattern") ) {
                        $("body").addClass('site-bg_image');
                    }
                }

                $("#site-bg-image").slideDown();
            } else {
                $(this).removeClass("active");
                $('body').removeClass("site-layout_boxed site-bg_image site-bg_img_1 site-bg_img_2 site-bg_pattern_1 site-bg_pattern_2 site-bg_pattern_3");
                $("#site-bg-image").slideUp();
            }

            return false;
        });

        $(document).on("click", ".site-bg-image", function() {
            var bgImageID = $(this).attr("id"),
                bgPattern = $(this).hasClass( 'site-bg-image_pattern' );

            $('body').removeClass("site-bg_image site-bg_img_1 site-bg_img_2 site-bg_pattern_1 site-bg_pattern_2 site-bg_pattern_3");

            $(this).addClass("active").siblings().removeClass("active");

            if( ! bgPattern ) {
                $('body').addClass("site-bg_image");
            }

            $('body').addClass(bgImageID);
        });

    });

</script>