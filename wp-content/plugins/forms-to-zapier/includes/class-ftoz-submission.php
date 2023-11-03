<?php

class Forms_To_Zapier_Submission {
    public function __construct() {
        add_action( 'wp_ajax_ftoz_get_forms', array( $this,'ftoz_get_forms' ) );
        add_action( 'wp_ajax_ftoz_get_form_fields', array( $this,'ftoz_get_form_fields' ) );
        add_action( 'admin_post_ftoz_save_relations', array( $this,'ftoz_save_relations' ) );
    }

    public function ftoz_get_forms() {
        if( !wp_verify_nonce( $_POST['nonce'], 'forms-to-zapier' ) ) {
            return;
        }

        $form_provider = sanitize_text_field( $_POST['formProviderId'] );

        if( $form_provider ) {
            $forms = call_user_func( "ftoz_{$form_provider}_get_forms", $form_provider );

            if( !is_wp_error( $forms ) ) {
                wp_send_json_success( $forms );
            }
        }

        exit();
    }

    public function ftoz_get_form_fields() {
        if( !wp_verify_nonce( $_POST['nonce'], 'forms-to-zapier' ) ) {
            return;
        }

        $form_provider = sanitize_text_field( $_POST['formProviderId'] );
        $form_id       = sanitize_text_field( $_POST['formId'] );

        if( $form_provider && $form_id ) {
            $fields = call_user_func( "ftoz_{$form_provider}_get_form_fields", $form_provider, $form_id );

            if( !is_wp_error( $fields ) ) {
                wp_send_json_success( $fields );
            }
        }

        exit();
    }

    public function ftoz_save_relations() {

        if( !wp_verify_nonce( $_POST["_wpnonce"], 'ftoz_relation' ) ) {
            return;
        }

        $form_provider_id  = isset( $_POST["form_provider_id"] ) ? sanitize_text_field( $_POST["form_provider_id"] ) : "";
        $integration_title = isset( $_POST["integration_title"] ) ? sanitize_text_field( $_POST["integration_title"] ) : "";
        $form_id           = isset( $_POST["form_id"] ) ? sanitize_text_field( $_POST["form_id"] ) : "";
        $webhook_url       = isset( $_POST["webhook_url"] ) ? sanitize_text_field( $_POST["webhook_url"] ) : "";
        $status            = isset( $_POST["status"] ) ? sanitize_text_field( $_POST["status"] ) : "";



        global $wpdb;

        $relation_table   = $wpdb->prefix . 'forms_to_zapier';

        if ( $status == 'new_relation' ) {

            $action_status = $wpdb->insert(
                $relation_table,
                array(
                    'integration_title' => $integration_title,
                    'form_provider'     => $form_provider_id,
                    'form_id'           => $form_id,
                    'form_name'         => call_user_func( "ftoz_{$form_provider_id}_get_form_name", $form_provider_id, $form_id ),
                    'zapier_webhook_url'       => $webhook_url,
                    'status'            => true
                )
            );

        }

        if ( $status == 'update_relation' ) {

            $id = esc_sql( trim( $_POST['edit_id'] ) );

            if ( $status != 'update_relation' &&  !empty( $id ) ) {
                exit;
            }

            $action_status = $wpdb->update( $relation_table,
                array(
                    'integration_title'  => $integration_title,
                    'zapier_webhook_url' => $webhook_url
                ),
                array(
                    'id'                => $id
                )
            );
        }

        if ( $action_status ) {
            forms_to_zapier_redirect( admin_url( 'admin.php?page=forms-to-zapier&status=1' ) );
        } else {
            forms_to_zapier_redirect( admin_url( 'admin.php?page=forms-to-zapier&status=0' ) );
        }
    }
}