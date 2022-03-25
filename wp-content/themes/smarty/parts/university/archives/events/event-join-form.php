<?php
wp_enqueue_script( 'ajaxsubmit' );
?>
<div class="join-event">
	<h4 class="join-event__title"><?php esc_html_e( 'Join event', 'smarty' ); ?></h4>
	<form action="<?php echo esc_url( home_url() ); ?>" method="post" class="form form_join-event">
		<div class="form__content">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="text" name="event_member[name]" placeholder="<?php esc_attr_e( 'Name', 'smarty'); ?> *" value="" />
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <input type="text" name="event_member[email]" placeholder="<?php esc_attr_e( 'E-Mail', 'smarty'); ?> *" value=""/>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <input type="text" name="event_member[phone]" placeholder="<?php esc_attr_e('Phone', 'smarty'); ?>" value="" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <textarea name="event_member[message]" cols="30" rows="10" placeholder="<?php esc_attr_e('Message', 'smarty'); ?> *"></textarea>
                        </div>
                        <div class="col-xs-12 text-right">
                            <?php
                            // Date
                            $stm_event_date_start = get_post_meta( get_the_ID(), 'stm_event_date_start', true );
                            $stm_event_date_end = get_post_meta( get_the_ID(), 'stm_event_date_end', true );

                            // Date Format
                            $event_month_start = date_i18n('n', $stm_event_date_start);
                            $event_month_end = date_i18n('n', $stm_event_date_end);
                            $event_day_start = date_i18n('j', $stm_event_date_start);
                            $event_day_end = date_i18n('j', $stm_event_date_end);
                            $event_year_start = date_i18n('Y', $stm_event_date_end);
                            $event_year_end = date_i18n('Y', $stm_event_date_end);

                            // Time - Number
                            $stm_event_time_end = get_post_meta( get_the_ID(), 'stm_event_time_end', true );
                            $stm_event_time_start = get_post_meta( get_the_ID(), 'stm_event_time_start', true );

                            // Time - Zone
                            $event_time_zone = get_post_meta( get_the_ID(), 'stm_event_time_zone', true );

                            // Venue
                            $stm_event_venue = get_post_meta( get_the_ID(), 'stm_event_venue', true);
                            ?>


                            <!-- Include script -->
                            <script type="text/javascript">(function () {
                                if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
                                if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
                                    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                    s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
                                    s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
                                    var h = d[g]('body')[0];h.appendChild(s); }})();
                            </script>

                            <script>
                                (function($) {
                                    "use strict";

                                    $(document).ready(function() {
                                        $( ".addtocalendar .stm-btn" ).click(function( event ) {
                                            event.stopPropagation();
                                            $(".atcb-list").slideDown();
                                            $(".stm-btn").addClass("stm-btn-active");
                                        });
                                        $( window ).click(function() {
                                            $(".atcb-list").slideUp();
                                            $(".stm-btn").removeClass("stm-btn-active");
                                        });
                                        $( window ).scroll(function() {
                                            $(".atcb-list").slideUp();
                                            $(".stm-btn").removeClass("stm-btn-active");
                                        });

                                    });

                                })(jQuery);
                            </script>

                            <!-- Place event data -->
                            <div class="addtocalendar atc-style-blue">
                                <var class="atc_event">
                                    <var class="atc_date_start"><?php echo esc_html($event_year_start); ?>-<?php echo esc_html($event_month_start); ?>-<?php echo esc_html($event_day_start); ?> <?php echo esc_html( $stm_event_time_start ); ?></var>
                                    <var class="atc_date_end"><?php echo esc_html($event_year_end); ?>-<?php echo esc_html($event_month_end); ?>-<?php echo esc_html($event_day_end); ?> <?php echo esc_html( $stm_event_time_end ); ?></var>
                                    <var class="atc_timezone"><?php if( !empty( $event_time_zone ) ) : ?><?php echo esc_html( $event_time_zone ); ?><?php else : ?><?php esc_html_e( 'Europe/London', 'smarty' ); ?><?php endif; ?></var>
                                    <var class="atc_title"><?php the_title(); ?></var>
                                    <var class="atc_description"><?php echo esc_html(get_the_excerpt()); ?></var>
                                    <var class="atc_location"><?php if( !empty( $stm_event_venue ) ) : ?><?php echo esc_html( $stm_event_venue ); ?><?php else : ?><?php esc_html_e( 'Not indicated', 'smarty' ); ?><?php endif; ?></var>
                                    <var class="atc_organizer_email"><?php if( !empty( $stm_event_email ) ) : $stm_event_email = explode( ';', $stm_event_email ); ?><?php foreach( $stm_event_email as $stm_event_email_val ) : ?><?php echo esc_attr( $stm_event_email_val ); ?><?php endforeach; ?><?php endif; ?></var>
                                </var>
                                <div class="stm-btn stm-btn_outline stm-btn_md stm-btn_red"><?php esc_html_e('Add to Calendar', 'smarty'); ?></div>
                            </div>

                            <!--<div class="form__loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>-->
                            <button type="submit" class="form__submit stm-btn stm-btn_outline stm-btn_md stm-btn_red stm-btn_icon-right"><?php esc_html_e('Submit', 'smarty'); ?><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                            <input type="hidden" name="action" value="event_join" />
                            <input type="hidden" name="event_member[event_id]" value="<?php the_ID(); ?>" />
                            <input type="hidden" name="event_member[event_url]" value='<?php the_permalink(); ?>' />
                            <input type="hidden" name="event_member[event_title]" value='<?php the_title(); ?>' />
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<div class="form__notice form__notice_information notice notice_information">
			<div class="notice__message">
				<?php esc_html_e('You already has been joined the event.', 'smarty'); ?>
			</div>
			<div class="notice__hide">&times;</div>
		</div>
		<div class="form__notice form__notice_success notice notice_success">
			<div class="notice__message">
				<?php esc_html_e('Thank you! You joined the event.', 'smarty'); ?>
			</div>
			<div class="notice__hide">&times;</div>
		</div>
	</form>
</div>