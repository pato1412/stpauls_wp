<?php
if(!function_exists('stm_set_html_content_type')){
	function stm_set_html_content_type() {
		return 'text/html';
	}
}
if( ! function_exists('smarty_event_member_info') ) {

	function smarty_event_member_info($data ){

		$return['result'] = true;

		$event_member_data['post_title'] = $data['name'] . esc_html__( ' joined the event: ', 'smarty' ) . '"' . get_the_title( $data['event_id'] ) . '"';
		$event_member_data['post_content'] = $data['message'];
		$event_member_data['post_type']  = 'event_member';
		$event_member_id = wp_insert_post( $event_member_data );

		update_post_meta( $event_member_id, 'event_member_email', $data['email'] );
		update_post_meta( $event_member_id, 'event_member_phone', $data['phone'] );
		update_post_meta( $event_member_id, 'event_member_eventID', $data['event_id'] );
		$event_attended = get_post_meta($data['event_id'], 'event_attended', true );
		update_post_meta( $data['event_id'], 'event_attended', $event_attended + 1 );

		return $return;

	}
}


// 2. Event join
if (!function_exists('smarty_event_join')) {
	function smarty_event_join() {
		$json = array();
		$json['errors'] = array();

		$name = $_POST['event_member']['name'];
		$email = $_POST['event_member']['email'];
		$phone =  $_POST['event_member']['phone'];
		$message = $_POST['event_member']['message'];
		$url = $_POST['event_member']['event_url'];
		$title = $_POST['event_member']['event_title'];

		if ( ! filter_var( $name, FILTER_SANITIZE_STRING ) ) {
			$json['errors']['name'] = true;
		}

		if ( ! is_email( $email ) ) {
			$json['errors']['email'] = true;
		}

		if ( ! filter_var( $message, FILTER_SANITIZE_STRING ) ) {
			$json['errors']['message'] = true;
		}

		if (empty($json['errors'])) {
			$json['success'] = smarty_event_member_info( $_POST['event_member'] );
		}

		//Sending Mail to admin
		add_filter( 'wp_mail_content_type', 'stm_set_html_content_type' );

		$to      = get_bloginfo( 'admin_email' );
		$subject = esc_html__( 'New Event Member', 'smarty' );
		$body    = esc_html__( 'Event: ', 'smarty' ) . '<a href="'. $url .'">' . $title . '</a><br/>';
		$body .= esc_html__( 'Name: ', 'smarty' ) . $name . '<br/>';
		$body .= esc_html__( 'Email: ', 'smarty' ) . $email . '<br/>';
		$body .= esc_html__( 'Phone: ', 'smarty' ) . $phone . '<br/>';
		$body .= esc_html__( 'Message: ', 'smarty' ) . $message . '<br/>';

		wp_mail( $to, $subject, $body);
		wp_mail( $email, $subject, 'You have been joined to the event - ' . '<a href="'. $url .'">' . $title . '</a>' );

		remove_filter( 'wp_mail_content_type', 'stm_set_html_content_type' );

		echo json_encode($json);
		exit;
	}
}

add_action('wp_ajax_event_join', 'smarty_event_join');
add_action('wp_ajax_nopriv_event_join', 'smarty_event_join');

function stm_add_vc_settings($name, $callback, $url){
	if( function_exists('vc_add_shortcode_param') ) {
		vc_add_shortcode_param( $name, $callback, $url);
	}
}
