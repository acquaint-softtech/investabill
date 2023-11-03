<?php

/**
 * Class Admin_Menu
 *
 */
class Forms_To_Zapier_Admin_Menu {
    /**
     * Class constructor.
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    /**
     * Register the admin menu.
     *
     * @return void
     */
    public function admin_menu() {
        global $submenu;

        $hook1 = add_menu_page( esc_html__( 'Forms to Zapier', 'forms-to-zapier' ), esc_html__( 'Forms to Zapier', 'forms-to-zapier' ), 'manage_options', 'forms-to-zapier', array( $this, 'zapier_routing' ), 'dashicons-admin-links' );
        add_submenu_page( 'forms-to-zapier', esc_html__( 'Forms to Zapier', 'forms-to-zapier' ), esc_html__( 'Integrations', 'forms-to-zapier' ), 'manage_options', 'forms-to-zapier', array( $this, 'zapier_routing' ) );
        $hook2 = add_submenu_page( 'forms-to-zapier', esc_html__( 'Mapping', 'forms-to-zapier' ), esc_html__( 'Add New', 'forms-to-zapier' ), 'manage_options', 'forms-to-zapier-new', array( $this, 'zapier_new_mapping' ) );

        add_action( 'admin_head-' . $hook1, array( $this, 'enqueue_assets' ) );
        add_action( 'admin_head-' . $hook2, array( $this, 'enqueue_assets' ) );
    }

    public function enqueue_assets() {
        wp_enqueue_style( 'ftoz-main-style' );
        wp_enqueue_script( 'ftoz-vuejs' );
        wp_enqueue_script( 'ftoz-main-script' );
    }

    /**
     * Display the Tasks page.
     *
     * @return void
     */
    public function zapier_routing() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

        switch ( $action ) {
            case 'edit':
                $this->ftoz_edit( $id );
                break;
            case 'status':
                $this->ftoz_change_status($id);
                break;
            default:
                $this->ftoz_list_page() ;
                break;
        }
    }

    public function ftoz_list_page() {
        if ( isset( $_GET['status'] ) ) {
            $status = $_GET['status'];
        }

        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">
                <?php _e( 'Integrations', 'forms-to-zapier' ); ?>
            </h1>
            <a href="<?php echo admin_url( 'admin.php?page=forms-to-zapier-new' ); ?>" class="page-title-action"><?php _e( 'Add New', 'forms-to-zapier' ); ?></a>

            <?php

            $list_table = new Forms_To_Zapier_List_Table();
            $list_table->prepare_items();
            $list_table->display();

            ?>
        </div>
        <?php
    }

    public function zapier_new_mapping(){

        $form_providers = ftoz_get_form_providers();

        require_once FORMS_TO_ZAPIER_VIEWS . '/new_relation.php';
    }

    public function ftoz_view( $id='' ) {
    }

    public function ftoz_edit( $id='' ) {

        if ( $id ) {
            require_once FORMS_TO_ZAPIER_VIEWS . '/edit_relation.php';
        }
    }

    # Relation Status Change ftoz_status
    public function ftoz_change_status( $id='' ) {
        echo $id;

        global $wpdb;

        $relation_table = $wpdb->prefix . "forms_to_zapier";
        $status_data    = $wpdb->get_row( "SELECT * FROM {$relation_table} WHERE id = {$id}", ARRAY_A );
        $status         = $status_data["status"];

        if ( $status ) {
            $action_status = $wpdb->update( $relation_table,
                array(
                    'status' => false,
                ),
                array( 'id'=> $id )
            );
        }else{
            $action_status = $wpdb->update( $relation_table,
                array(
                    'status' => true ,
                ),
                array( 'id'=> $id )
            );
        }

        forms_to_zapier_redirect( admin_url( 'admin.php?page=forms-to-zapier' ) );
    }
}
