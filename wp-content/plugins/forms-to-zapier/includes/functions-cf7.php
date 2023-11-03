<?php

add_action( 'wpcf7_mail_sent', 'ftoz_cf7_submission' );

function ftoz_cf7_submission( $WPCF7_ContactForm ) {

    $submission  = WPCF7_Submission::get_instance();
    $posted_data = $submission->get_posted_data();
    $form_id     = $WPCF7_ContactForm->id();

    $posted_data["submission_date"] = date( "Y-m-d H:i:s" );

    global $wpdb;

    $saved_records = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}forms_to_zapier WHERE status = 1 AND form_provider = 'cf7' AND form_id = ".$form_id , ARRAY_A );

    foreach ( $saved_records as $record ) {
        ftoz_zapier_send_data( $record, $posted_data );
    }

    return $WPCF7_ContactForm;
}

function ftoz_cf7_get_forms( $form_provider ) {
    if( $form_provider != 'cf7' ) {
        return;
    }

    $args     = array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1 );
    $cf7Forms = get_posts( $args );
    $forms    = wp_list_pluck( $cf7Forms, 'post_title', 'ID' );

    return $forms;
}

function ftoz_cf7_get_form_name( $form_provider, $form_id ) {
    if( $form_provider != 'cf7' ) {
        return;
    }

    $form = get_post( $form_id );

    return $form->post_title;
}
