<?php
if(!class_exists('WP_List_Table')) require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');

// Plugin class.
class Forms_To_Zapier_List_Table extends WP_List_Table {

    /**
     * Construct function
     * Set default settings.
     */
    function __construct() {
        global $status, $page;
        //Set parent defaults
        parent::__construct(array(
            'ajax'     => FALSE,
            'singular' => 'relation',
            'plural'   => 'relations',
        ));
    }

    /**
     * Renders the columns.
     *
     * @since 1.0.0
     */
    function column_default( $item, $column_name ) {

        switch ($column_name) {
            case 'id':
                $value = $item['id'];
                break;
            case 'integration_title':
                $value = $item['integration_title'];
                break;
            case 'form_provider':
                $value = $item['form_provider'];
                break;
            case 'form_name':
                $value = $item['form_name'];
                break;
            case 'zapier_webhook_url':
                $value = $item['zapier_webhook_url'];
                break;
            case 'action':
            default:
                $value = '';
        }

        return apply_filters( 'ftoz_table_column_value', $value, $item, $column_name );
    }

    /**
     * Retrieve the table columns.
     *
     * @since 1.0.0
     * @return array $columns Array of all the list table columns.
     */
    function get_columns() {
        $columns = array(
            'cb'                 => '<input type="checkbox" />',
            'integration_title'  => esc_html__( 'Title', 'forms-to-zapier' ),
            'form_provider'      => esc_html__( 'Form Provider', 'forms-to-zapier' ),
            'form_name'          => esc_html__( 'Form', 'forms-to-zapier' ),
            'zapier_webhook_url' => esc_html__( 'Zapier Webhook', 'forms-to-zapier' ),
            'status'             => esc_html__( 'Status', 'forms-to-zapier' )
        );

        return apply_filters( 'ftoz_table_columns', $columns );
    }

    /**
     * Render the checkbox column.
     *
     * @since 1.0.0
     *
     * @return string
     */
    public function column_cb( $item ) {
        return '<input type="checkbox" name="id[]" value="' . absint( $item['id'] ) . '" />';
    }

    public function column_form_provider( $item ) {
        $form_providers = ftoz_get_form_providers();

        if( array_key_exists( $item['form_provider'], $form_providers ) ) {
            return $form_providers[$item['form_provider']];
        } else {
            return __( 'Deactivated?', 'forms-to-zapier');
        }

    }

    /**
     * Render the form name column with action links.
     *
     * @since 1.0.0
     *
     * @return string
     */
    public function column_integration_title( $item ) {

        $name = ! empty( $item['integration_title'] ) ? $item['integration_title'] : $item['form_provider'];
        $name = sprintf( '<span><strong>%s</strong></span>', esc_html__( $name ) );

        // Build all of the row action links.
        $row_actions = array();

        // Edit.
        $row_actions['edit'] = sprintf(
            '<a href="%s" title="%s">%s</a>',
            add_query_arg(
                array(
                    'action' => 'edit',
                    'id'     => $item['id'],
                ),
                admin_url( 'admin.php?page=forms-to-zapier' )
            ),
            esc_html__( 'Edit This Relation', 'forms-to-zapier' ),
            esc_html__( 'Edit', 'forms-to-zapier' )
        );

        // Delete.
        $row_actions['delete'] = sprintf(
            '<a href="%s" class="relation-delete" title="%s">%s</a>',
            wp_nonce_url(
                add_query_arg(
                    array(
                        'action'  => 'delete',
                        'id' => $item['id'],
                    ),
                    admin_url( 'admin.php?page=forms-to-zapier' )
                ),
                'ftoz_delete_relation_nonce'
            ),
            esc_html__( 'Delete this relation', 'forms-to-zapier' ),
            esc_html__( 'Delete', 'forms-to-zapier' )
        );

        // Build the row action links and return the value.
        return $name . $this->row_actions( apply_filters( 'ftoz_relation_row_actions', $row_actions, $item ) );
    }

    /**
     * Define bulk actions available for our table listing.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_bulk_actions() {

        $actions = array(
            'delete' => esc_html__( 'Delete', 'forms-to-zapier' ),
        );

        return $actions;
    }

    /**
     * Process the bulk actions.
     *
     * @since 1.0.0
     */
    public function process_bulk_actions() {

        $ids = isset( $_GET['id'] ) ? $_GET['id'] : array();

        if ( ! is_array( $ids ) ) {
            $ids = array( $ids );
        }

        $ids    = array_map( 'absint', $ids );
        $action = ! empty( $_REQUEST['action'] ) ? $_REQUEST['action'] : false;

        if ( empty( $ids ) || empty( $action ) ) {
            return;
        }

        // Delete one or multiple relations - both delete links and bulk actions.
        if ( 'delete' === $this->current_action() ) {

            if (
                wp_verify_nonce( $_GET['_wpnonce'], 'bulk-forms' ) ||
                wp_verify_nonce( $_GET['_wpnonce'], 'ftoz_delete_relation_nonce' )
            ) {

                foreach ( $ids as $id ) {
                    $this->delete( $id );
                }
                ?>
                <div class="notice updated">
                    <p>
                        <?php
                        if ( count( $ids ) === 1 ) {
                            esc_html_e( 'Relation was successfully deleted.', 'forms-to-zapier' );
                        } else {
                            esc_html_e( 'Relations were successfully deleted.', 'forms-to-zapier' );
                        }
                        ?>
                    </p>
                </div>
                <?php
            } else {
                ?>
                <div class="notice updated">
                    <p>
                        <?php esc_html_e( 'Security check failed. Please try again.', 'forms-to-zapier' ); ?>
                    </p>
                </div>
                <?php
            }
        }
    }

    /**
     * Message to be displayed when there are no relations.
     *
     * @since 1.0.0
     */
    public function no_items() {
        printf(
            wp_kses(
                __( 'Whoops, you haven\'t created a relation yet. Want to <a href="%s">give it a go</a>?', 'forms-to-zapier' ),
                array(
                    'a' => array(
                        'href' => array(),
                    ),
                )
            ),
            admin_url( 'admin.php?page=forms-to-zapier-new' )
        );
    }

    /**
     * Sortable settings.
     */
    function get_sortable_columns() {
        return array(
            'integration_title'    => array('integration_title', TRUE),
            'form_provider'        => array('form_provider', TRUE)
        );
    }

    public function fetch_table_data() {
        global $wpdb;
        $wpdb_table    = $wpdb->prefix . 'forms_to_zapier';
        $orderby       = ( isset( $_GET['orderby'] ) ) ? esc_sql( $_GET['orderby'] ) : 'id';
        $order         = ( isset( $_GET['order'] ) ) ? esc_sql( $_GET['order'] ) : 'DESC';

        $user_query    = "SELECT * FROM ". $wpdb_table ." ORDER BY " . $orderby ."  ". $order ;
        $query_results = $wpdb->get_results( $user_query, ARRAY_A );
        return $query_results;
    }

    //Query, filter data, handle sorting, pagination, and any other data-manipulation required prior to rendering
    public function prepare_items() {
        // Process bulk actions if found.
        $this->process_bulk_actions();

        $per_page              = 20;
        $count                 = $this->count();
        $columns               = $this->get_columns();
        $hidden                = array();
        $sortable              = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        $table_data            = $this->fetch_table_data();
        $this->items           = $table_data;
        $this->admin_header();

        $this->set_pagination_args(
            array(
                'total_items' => $count,
                'per_page'    => $per_page,
                'total_pages' => ceil( $count / $per_page ),
            )
        );
    }

    public function column_status($item) {

        if ($item['status']) {
            $actions = "<span onclick='window.location=\"admin.php?page=forms-to-zapier&action=status&id=".$item['id']."\"'  class='span_activation_cheackbox'  ><a class='a_activation_cheackbox' href='?page=forms-to-zapier&action=edit&id=".$item['id']."'>  <input type='checkbox' name='status' checked=checked > </a></span>" ;
        }else{
            $actions = "<span onclick='window.location=\"admin.php?page=forms-to-zapier&action=status&id=".$item['id']." \"'  class='span_activation_cheackbox'  ><a class='a_activation_cheackbox' href='?page=forms-to-zapier&action=edit&id=".$item['id']."'>  <input type='checkbox' name='status' > </a></span>" ;
        }


        // print_r($item);

        return   $actions ;
    }

    # delete
    public function delete( $id='' ) {
        global $wpdb;
        $relation_table = $wpdb->prefix.'forms_to_zapier';
        $action_status  =  $wpdb->delete( $relation_table, array( 'id' => $id ) );

        if ( $action_status ) {
            forms_to_zapier_redirect( admin_url( 'admin.php?page=forms-to-zapier&status=1' ) );
        } else {
            forms_to_zapier_redirect( admin_url( 'admin.php?page=forms-to-zapier&status=0' ) );
        }
        exit;
    }

    # delete
    public function count() {
        global $wpdb;

        $relation_table = $wpdb->prefix.'forms_to_zapier';
        $count          =  $wpdb->get_var("SELECT COUNT(*) FROM " . $relation_table );

        return $count;
    }

    public function admin_header() {
        $page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
        if( 'forms-to-zapier' != $page )
            return;

        echo '<style type="text/css">';
        echo '.wp-list-table .column-id { width: 18%; }';
        echo '.wp-list-table .column-integration_title { width: 18%; }';
        echo '.wp-list-table .column-form_provider { width: 18%; }';
        echo '.wp-list-table .column-form_name { width: 18%; }';
        echo '.wp-list-table .column-zapier_webhook_url { width: 30%; }';
        echo '.wp-list-table .column-status { width: 8%; }';
        echo '</style>';
    }
}
