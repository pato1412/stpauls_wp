<?php
wp_enqueue_script( 'ajaxsubmit' );

$donationOptions = get_theme_mod( 'donation_options' );
if( empty( $donationOptions['currency_position'] ) ){
    $donationOptions['currency_position'] = 'right';
}
if( empty( $donationOptions['currency'] ) ){
    $donationOptions['currency'] = 'USD';
}
if( empty( $donationOptions['currency_symbol'] ) ){
    $donationOptions['currency_symbol'] = '$';
}
if( empty( $donationOptions['donation_amount_1'] ) ){
    $donationOptions['donation_amount_1'] = 10;
}
if( empty( $donationOptions['donation_amount_2'] ) ){
    $donationOptions['donation_amount_2'] = 20;
}
if( empty( $donationOptions['donation_amount_3'] ) ){
    $donationOptions['donation_amount_3'] = 30;
}
?>
<div class="modal modal_donation fade" id="donate-form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><small><?php esc_html_e( 'You are donating to:', 'smarty' ); ?></small><?php the_title(); ?></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo esc_url( home_url() ); ?>" class="form form_donation">
                    <div class="form__amount">
                        <div class="form__amount-title"><?php esc_html_e( 'How much would you like to donate?', 'smarty' ); ?></div>
                        <div class="form__amount-values">
                            <input class="form__amount-value" type="radio" id="amount<?php echo esc_attr( $donationOptions['donation_amount_1'] ); ?>" name="donor[amount]" checked="checked" value="<?php echo esc_attr( $donationOptions['donation_amount_1'] ); ?>" /><label for="amount<?php echo esc_attr( $donationOptions['donation_amount_1'] ); ?>" class="form__amount-label active"><?php if($donationOptions['currency_position']=='left'){echo esc_html( $donationOptions['currency_symbol'] );}?><?php echo esc_html( $donationOptions['donation_amount_1'] ); ?><?php if($donationOptions['currency_position']=='right'){echo esc_html( $donationOptions['currency_symbol'] );}?></label>
                            <input class="form__amount-value" type="radio" id="amount<?php echo esc_attr( $donationOptions['donation_amount_2'] ); ?>" name="donor[amount]" value="<?php echo esc_attr( $donationOptions['donation_amount_2'] ); ?>" /><label for="amount<?php echo esc_attr( $donationOptions['donation_amount_2'] ); ?>" class="form__amount-label"><?php if($donationOptions['currency_position']=='left'){echo esc_html( $donationOptions['currency_symbol'] );}?><?php echo esc_html( $donationOptions['donation_amount_2'] ); ?><?php if($donationOptions['currency_position']=='right'){echo esc_html( $donationOptions['currency_symbol'] );}?></label>
                            <input class="form__amount-value" type="radio" id="amount<?php echo esc_attr( $donationOptions['donation_amount_3'] ); ?>" name="donor[amount]" value="<?php echo esc_attr( $donationOptions['donation_amount_3'] ); ?>" /><label for="amount<?php echo esc_attr( $donationOptions['donation_amount_3'] ); ?>" class="form__amount-label"><?php if($donationOptions['currency_position']=='left'){echo esc_html( $donationOptions['currency_symbol'] );}?><?php echo esc_html( $donationOptions['donation_amount_3'] ); ?><?php if($donationOptions['currency_position']=='right'){echo esc_html( $donationOptions['currency_symbol'] );}?></label>
                            <input class="form__amount-value-custom" type="text" name="donor[custom_amount]" placeholder="<?php printf( esc_html__( "Your amount (%s)", 'smarty' ),  $donationOptions["currency"] ); ?>" />
                        </div>
                    </div>
                    <div class="form__fields">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form__item">
                                    <input type="text" name="donor[first_name]" class="form-control" value="" placeholder="<?php esc_attr_e( 'Name', 'smarty' ); ?> *" />
                                    <span class="form-error form-error_first_name"></span>
                                </div>
                                <div class="form__item">
                                    <input type="text" name="donor[phone]" class="form-control" id="form-donor-phone" value="" placeholder="<?php esc_attr_e( 'Phone', 'smarty' ); ?> *" />
                                    <span class="form-error form-error_phone"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form__item">
                                    <input type="text" name="donor[email]" class="form-control" value="" placeholder="<?php esc_attr_e( 'E-mail', 'smarty' ); ?> *" />
                                    <span class="form-error form-error_email"></span>
                                </div>
                                <div class="form__item">
                                    <input type="text" class="form-control" name="donor[address]" placeholder="<?php esc_attr_e( 'Address', 'smarty' ); ?>" />
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form__item">
                                    <textarea id="form-donor-notes" class="form-control" name="donor[notes]" placeholder="<?php esc_attr_e( 'Additional Note', 'smarty' ); ?>"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form__action">
                        <button type="submit" class="stm-btn stm-btn_outline stm-btn_md stm-btn_blue stm-btn_icon-right"><?php esc_html_e( 'Donate', 'smarty' ); ?><i class="stm-icon stm-icon-arrow-right"></i></button>
                        <div class="form__action-loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>
                        <input type="hidden" name="action" value="donate" />
                        <input type="hidden" name="security" value="<?php echo wp_create_nonce('donate'); ?>" />
                        <input type="hidden" name="donor[donation_id]" value="<?php the_ID(); ?>" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>