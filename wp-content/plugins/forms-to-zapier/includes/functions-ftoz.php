<?php

# Redirect
function forms_to_zapier_redirect( $url ) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';
    echo  $string ;
}

// Form providers
function ftoz_get_form_providers() {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';

    $providers = array();

    if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
        $providers['cf7'] = __( 'Contact Form 7', 'forms-to-zapier' );
    }

    return apply_filters( 'ftoz_form_providers', $providers );
}

function ftoz_zapier_send_data( $record, $posted_data ) {

    $webhook_url = $record["zapier_webhook_url"];

    if( !$webhook_url ) {
        return;
    }

    $args = array(

        'headers' => array(
            'Content-Type' => 'application/json',
        ),
        'body' => json_encode( $posted_data )
    );

    $return = wp_remote_post( $webhook_url, $args );

    if ( $return['response']['code'] == 200 ) {
        return array( 1 );
    } else {
        return array( 0, $return )  ;
    }
}

/*
 * Get User IP
 */
function ftoz_get_user_ip() {
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    }
    else {
        $ip = $remote;
    }

    return $ip;
}

/*
 * Sanitize text or array field
 */
function ftoz_sanitize_text_or_array_field($array_or_string) {
    if( is_string($array_or_string) ){
        $array_or_string = sanitize_text_field($array_or_string);
    }elseif( is_array($array_or_string) ){
        foreach ( $array_or_string as $key => &$value ) {
            if ( is_array( $value ) ) {
                $value = ftoz_sanitize_text_or_array_field($value);
            }
            else {
                $value = sanitize_text_field( $value );
            }
        }
    }

    return $array_or_string;
}