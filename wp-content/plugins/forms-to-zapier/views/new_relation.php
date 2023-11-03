<?php
/**
 * new_integration.php
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://nasirahmed.com
 * @since      1.0.0
 *
 * @package    Forms_to_Zapier
 */

$nonce = wp_create_nonce( 'ftoz_relation' );
?>

<div class="wrap">

    <h1><?php esc_attr_e( 'New Integration', 'advanced-form-integration' ); ?></h1>
    <div id="ftoz_relation_new">

        <div id="poststuff">

            <div id="post-body" class="metabox-holder columns-2">

                <!-- main content -->
                <div id="post-body-content">

                    <div class="meta-box-sortables ui-sortable">





                            <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" >

                                <input type="hidden" name="action" value="ftoz_save_relations">

                                <input type="hidden" name="status" value="new_relation" />

                                <input type="hidden" name="_wpnonce" value="<?php echo $nonce; ?>" />

                                <h2><?php esc_attr_e( 'Select Correct Form And Save Webhook', 'forms-to-zapier' ); ?></h2>
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
                                            <select name="form_provider_id" v-model="formProviderId" @change="changeFormProvider"  required="required">
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
                                            <select name="form_id" v-model="formId" :disabled="formValidated == 1"  required="required">
                                                <option value=""> <?php _e( 'Select...', 'forms-to-zapier' ); ?> </option>
                                                <option v-for="(item, index) in forms" :value="index" > {{ item }}  </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="row-title">
                                            <label for="tablecell">
                                                <?php esc_attr_e( 'Webhook URL', 'forms-to-zapier' ); ?>
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
                                        <input class="button-primary" type="submit" name="save_relation" value="<?php esc_attr_e( 'Save Integration', 'forms-to-zapier' ); ?>" />
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
