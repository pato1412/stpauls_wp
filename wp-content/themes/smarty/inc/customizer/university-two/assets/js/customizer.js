jQuery(document).ready(function ($) {
    "use strict";

    $(".stm-icons-wrapper label").on("click", function () {
        $(this).closest("ul").find("li.active").removeClass("active");
        $(this).closest("li").addClass("active");
    });

    $(".stm-color-selector").wpColorPicker({
        change: _.throttle(function () {
            $(this).trigger('change');
        })
    });

    $(".stm_iconpicker").fontIconPicker({
        theme: "fip-bootstrap",
        emptyIcon: false
        //source: stm_icons_array
    });

    $(".stm-multiple-checkbox-wrapper input[type='checkbox']").on("change", function () {

        var checkbox_values = jQuery(this).parents(".customize-control").find("input[type='checkbox']:checked").map(function () {
            return this.value;
        }).get().join(",");

        $(this).parents(".stm-multiple-checkbox-wrapper").find("input[type='hidden']").val(checkbox_values).trigger("change");
    });

    $(".stm-socials-wrapper input[type='text']").on("change, keyup", function () {

        var data = $(this).closest("form").serialize();

        console.log(data);

        $(this).parents('.stm-socials-wrapper').find('input[type="hidden"]').val(data).trigger('change');
    });

    /* Skin Color */
    if( $("#site_skin_color").val() != "custom" ) {
        $("#customize-control-skin_color_base, #customize-control-skin_color_secondary, #customize-control-skin_color_third").hide();
    }

    $(document).on("change", "#site_skin_color", function(){
        if( $("#site_skin_color").val() === "custom" ) {
            $("#customize-control-skin_color_base, #customize-control-skin_color_secondary, #customize-control-skin_color_third").show();
        } else {
            $("#customize-control-skin_color_base, #customize-control-skin_color_secondary, #customize-control-skin_color_third").hide();
        }
    });

    /* Boxed */
    var $bgType = $("#customize-control-site_bg_type"),
        $bgImg = $("#customize-control-site_bg_image"),
        $bgImgCustom = $("#customize-control-site_bg_image_custom"),
        $bgPattern = $("#customize-control-site_bg_pattern"),
        $bgPatternCustom = $("#customize-control-site_bg_patter_custom");

    if( ! $("#site_layout_boxed").prop("checked") ) {
        $bgType.hide();
        $bgImg.hide();
        $bgImgCustom.hide();
        $bgPattern.hide();
        $bgPatternCustom.hide();
    } else {
        $bgType.find("input").each(function() {
           if( $(this).prop("checked") ) {
               if( $(this).val() == 'image' ) {
                   $bgPattern.hide();
                   $bgPatternCustom.hide();

                   if( $bgImg.find('input[type="radio"]:checked').val() != 'custom' ) {
                       $bgImgCustom.hide();
                   }
               } else {
                   $bgImg.hide();
                   $bgImgCustom.hide();
                   if( $bgPattern.find('input[type="radio"]:checked').val() != 'custom' ) {
                       $bgPatternCustom.hide();
                   }
               }
           }
        });
    }

    $(document).on("change", "#site_layout_boxed", function() {
        if( ! $(this).prop("checked") ) {
            $bgType.hide();
            $bgImg.hide();
            $bgImgCustom.hide();
            $bgPattern.hide();
            $bgPatternCustom.hide();
        } else {
            $bgType.show();
            $bgType.find("input").each(function() {
                if( $(this).prop("checked") ) {
                    if( $(this).val() == 'image' ) {
                        $bgPattern.hide();
                        $bgPatternCustom.hide();
                        $bgImg.show();

                        if( $bgImg.find('input[type="radio"]:checked').val() == 'custom' ) {
                            $bgImgCustom.show();
                        }
                    } else {
                        $bgPattern.show();
                        $bgImg.hide();
                        $bgImgCustom.hide();
                        if( $bgPattern.find('input[type="radio"]:checked').val() == 'custom' ) {
                            $bgPatternCustom.show();
                        }
                    }
                }
            });
        }
    });

    $(document).on("change", '#customize-control-site_bg_type input[type="radio"]', function() {
        if( $(this).val() == 'image' ) {
            $bgImg.show();
            $bgPattern.hide();
            $bgPatternCustom.hide();
            if( $bgImg.find('input[type="radio"]:checked').val() == 'custom' ) {
                $bgImgCustom.show();
            }
        } else {
            $bgImg.hide();
            $bgImgCustom.hide();
            $bgPattern.show();
            if( $bgPattern.find('input[type="radio"]:checked').val() == 'custom' ) {
                $bgPatternCustom.show();
            }
        }
    });

    $(document).on("change", '#stm-customize-control-site_bg_image input[type="radio"]', function() {
        if( $(this).val() === 'custom' ) {
            $bgImgCustom.show();
        } else {
            $bgImgCustom.hide();
        }
    });

    $(document).on("change", '#stm-customize-control-site_bg_pattern input[type="radio"]', function() {
        if( $(this).val() === 'custom' ) {
            $bgPatternCustom.show();
        } else {
            $bgPatternCustom.hide();
        }
    });

    /* Header */

    // Load
    var $headerViewStyle = $('#customize-control-header_view_style input[type="radio"]:checked').val(),
        $topBarContacts = $("#customize-control-top_bar_contacts"),
        $contactDetailsPhone = $("#customize-control-contact_details-phone"),
        $contactDetailsEmail = $("#customize-control-contact_details-email"),
        $contactDetailsAddress = $("#customize-control-contact_details-address"),
        $topBarSocials = $("#customize-control-top_bar_socials"),
        $topBarSocialsEnable = $("#customize-control-topbar_socials_enable"),
        $topBarNavMenu = $("#customize-control-top_bar_nav"),
        $topBarAccount = $("#customize-control-top_bar_account"),
        $topBarLanguage = $("#stm-customize-control-top_bar_language"),
        $topBarSearch = $("#customize-control-top_bar_search");

    switch ( $headerViewStyle ) {
        case '1':
            $topBarContacts.hide();
            $contactDetailsPhone.hide();
            $contactDetailsEmail.hide();
            $contactDetailsAddress.hide();
            $topBarSocials.hide();
            $topBarSocialsEnable.hide();
            break;
        case '2':
            $topBarNavMenu.hide();
            $topBarAccount.hide();
            $contactDetailsAddress.hide();

            if( ! $("#top_bar_contacts").prop("checked") ) {
                $contactDetailsPhone.hide();
                $contactDetailsEmail.hide();
            }

            if( ! $("#top_bar_socials").prop("checked") ) {
                $topBarSocialsEnable.hide();
            }
            break;
        case '3':
            $topBarNavMenu.hide();
            $topBarAccount.hide();
            $topBarSocials.hide();
            $topBarSocialsEnable.hide();

            if( ! $("#top_bar_contacts").prop("checked") ) {
                $contactDetailsPhone.hide();
                $contactDetailsEmail.hide();
                $contactDetailsAddress.hide();
            }

            break;
        case '4':
            $topBarNavMenu.hide();
            $topBarAccount.hide();
            $contactDetailsAddress.hide();

            if( ! $("#top_bar_contacts").prop("checked") ) {
                $contactDetailsPhone.hide();
                $contactDetailsEmail.hide();
            }

            if( ! $("#top_bar_socials").prop("checked") ) {
                $topBarSocialsEnable.hide();
            }

            break;
    }

    // Change
    $(document).on("change", "#customize-control-header_view_style input[type='radio']", function() {
        switch ( $(this).val() ) {
            case '1':
                $topBarLanguage.show();
                $topBarSearch.show();
                $topBarNavMenu.show();
                $topBarAccount.show();
                $topBarContacts.hide();
                $contactDetailsPhone.hide();
                $contactDetailsEmail.hide();
                $contactDetailsAddress.hide();
                $topBarSocials.hide();
                $topBarSocialsEnable.hide();
                break;
            case '2':
                $topBarContacts.show();
                $topBarLanguage.show();
                $topBarSearch.show();
                $topBarSocials.show();
                $topBarNavMenu.hide();
                $topBarAccount.hide();
                $contactDetailsAddress.hide();

                if( ! $("#top_bar_socials").prop("checked") ) {
                    $topBarSocialsEnable.hide();
                } else {
                    $topBarSocialsEnable.show();
                }

                if( ! $("#top_bar_contacts").prop("checked") ) {
                    $contactDetailsPhone.hide();
                    $contactDetailsEmail.hide();
                } else {
                    $contactDetailsPhone.show();
                    $contactDetailsEmail.show();
                }

                break;
            case '3':
                $topBarContacts.show();
                $topBarLanguage.show();
                $topBarSearch.show();
                $topBarNavMenu.hide();
                $topBarAccount.hide();
                $topBarSocials.hide();
                $topBarSocialsEnable.hide();

                if( ! $("#top_bar_contacts").prop("checked") ) {
                    $contactDetailsPhone.hide();
                    $contactDetailsEmail.hide();
                    $contactDetailsAddress.hide();
                } else {
                    $contactDetailsPhone.show();
                    $contactDetailsEmail.show();
                    $contactDetailsAddress.show();
                }

                break;
            case '4':
                $topBarContacts.show();
                $topBarLanguage.show();
                $topBarSearch.show();
                $topBarSocials.show();
                $topBarNavMenu.hide();
                $topBarAccount.hide();
                $contactDetailsAddress.hide();

                if( ! $("#top_bar_contacts").prop("checked") ) {
                    $contactDetailsPhone.hide();
                    $contactDetailsEmail.hide();
                } else {
                    $contactDetailsPhone.show();
                    $contactDetailsEmail.show();
                }

                if( ! $("#top_bar_socials").prop("checked") ) {
                    $topBarSocialsEnable.hide();
                } else {
                    $topBarSocialsEnable.show();
                }

                break;
        }
    });

    $(document).on("change", "#top_bar_socials", function() {
        if( ! $("#top_bar_socials").prop("checked") ) {
            $topBarSocialsEnable.hide();
        } else {
            $topBarSocialsEnable.show();
        }
    });

    $(document).on("change", "#top_bar_contacts", function() {
        if( ! $("#top_bar_contacts").prop("checked") ) {
            $contactDetailsPhone.hide();
            $contactDetailsEmail.hide();
            $contactDetailsAddress.hide();
        } else {
            $contactDetailsPhone.show();
            $contactDetailsEmail.show();

            if( $('#customize-control-header_view_style input[type="radio"]:checked').val() != 4) {
                $contactDetailsAddress.show();
            }
        }
    });

    $(document).on("change", "#top_bar_socials", function() {
        if( ! $("#top_bar_socials").prop("checked") ) {
            $topBarSocialsEnable.hide();
        } else {
            $topBarSocialsEnable.show();
        }
    });

});