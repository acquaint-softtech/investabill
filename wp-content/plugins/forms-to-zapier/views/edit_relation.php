<?php
    global $wpdb;

    $table             = $wpdb->prefix . 'forms_to_zapier';
    $data              = $wpdb->get_row( "SELECT * FROM " . $table . " WHERE id =" . $id, ARRAY_A );
    $integration_title = $data["integration_title"];
    $form_providers    = ftoz_get_form_providers();
    $form_provider     = $data["form_provider"];
    $forms             = call_user_func( "ftoz_{$form_provider}_get_forms", $form_provider );
    $form_id           = $data["form_id"];
    $webhook_url       = $data["zapier_webhook_url"];
    $nonce             = wp_create_nonce( 'ftoz_relation' );
?>
<script type="text/javascript">
    var integrationTitle = <?php echo json_encode( $integration_title ); ?>;
    var formProviders    = <?php echo json_encode( $form_providers ); ?>;
    var formProvider     = <?php echo json_encode( $form_provider ); ?>;
    var forms            = <?php echo json_encode( $forms ); ?>;
    var formId           = <?php echo json_encode( $form_id ); ?>;
    var webhookUrl       = <?php echo json_encode( $webhook_url ); ?>;
</script>

<div class="wrap">

    <div id="icon-options-general" class="icon32">  </div>
    <h1> <?php esc_attr_e( 'Update Integration: ', 'forms-to-zapier' ); echo $integration_title; ?></h1>

    <div id="ftoz-edit-relation">

        <div id="poststuff">

            <div id="post-body" class="metabox-holder columns-2">

                <div id="post-body-content">

                    <div class="meta-box-sortables ui-sortable">

            <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" >

                <input type="hidden" name="action" value="ftoz_save_relations">

                <input type="hidden" name="status" value="update_relation" />

                <input type="hidden" name="edit_id" value="<?php echo $id; ?>" />

                <input type="hidden" name="_wpnonce" value="<?php echo $nonce; ?>" />

                <table class="widefat">

                    <tbody>
                    <tr>
                        <td class="row-title">
                            <label for="tablecell">
                                <?php esc_attr_e( 'Title', 'forms-to-zapier' ); ?>
                            </label>
                        </td>
                        <td>
                            <input type="text" class="regular-text" v-model="integrationTitle" name="integration_title" placeholder="<?php _e( 'Enter title here', 'forms-to-zapier'); ?>" required="required">
                        </td>
                    </tr>
                    <tr>
                        <td class="row-title">
                            <label for="tablecell">
                                <?php esc_attr_e( 'Form Provider', 'forms-to-zapier' ); ?>
                            </label>
                        </td>
                        <td>
                            <select name="form_provider_id" v-model="formProviderId" disabled="disabled">
                                <option value=""> <?php _e( 'Select...', 'forms-to-zapier' ); ?> </option>
                                <?php
                                foreach ( $form_providers as $key => $value ) {
                                    echo "<option value='" . $key . "'> " . $value . " </option>";
                                } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="row-title">
                            <label for="tablecell">
                                <?php esc_attr_e( 'Form Name', 'forms-to-zapier' ); ?>
                            </label>
                        </td>
                        <td>
                            <select name="form_id" v-model="formId" :disabled="formValidated == 1" disabled="disabled">
                                <option value=""> <?php _e( 'Select...', 'forms-to-zapier' ); ?> </option>
                                <option v-for="(item, index) in forms" :value="index" > {{ item }}  </option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="row-title">
                            <label for="tablecell">
                                <?php esc_attr_e( 'Zapier Webhook URL', 'forms-to-zapier' ); ?>
                            </label>
                        </td>
                        <td>
                            <input type="text" class="regular-text" v-model="webhookUrl" name="webhook_url" placeholder="<?php _e( 'Enter URL here', 'forms-to-zapier'); ?>" required="required">
                        </td>
                    </tr>
                    </tbody>
                </table>

                <br>

                <br>
                <!-- Save intigartion Starts -->
                <div>
                    <p>
                        <input class="button-primary" type="submit" name="update_relation" value="<?php esc_attr_e( 'Update Integration', 'forms-to-zapier' ); ?>" />
                        <a class="button-secondary" style="color: red" href="<?php echo admin_url('admin.php?page=forms-to-zapier')?>" class="button-secondary"> <?php esc_attr_e( 'Cancel', 'forms-to-zapier' ); ?></a>
                    </p>
                </div>
                <!-- Save intigartion Ends -->
            </form>

                        <!-- .postbox -->

                    </div>
                    <!-- .meta-box-sortables .ui-sortable -->

                </div>
                <!-- post-body-content -->

                <!-- sidebar -->
                <div id="postbox-container-1" class="postbox-container">

                    <div class="meta-box-sortables">

                    </div>
                    <!-- .meta-box-sortables -->

                </div>
                <!-- #postbox-container-1 .postbox-container -->

            </div>
            <!-- #post-body .metabox-holder .columns-2 -->

            <br class="clear">
        </div>
        <!-- #poststuff -->
    </div>


</div> <!-- .wrap -->

