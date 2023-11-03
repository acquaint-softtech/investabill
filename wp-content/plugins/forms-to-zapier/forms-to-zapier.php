<?php

/**
 * Plugin Name: Forms to Zapier
 * Description: Sends Form submissions to Zapier webhook.
 * Plugin URI: http://pluginja.com
 * Author: nasirahmed
 * Author URI: http://nasirahmed.com
 * Version: 1.1.9
 * License: GPL2
 * Text Domain: forms-to-zapier
 * Domain Path: languages
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'forms_to_zapier' ) ) {
    forms_to_zapier()->set_basename( false, __FILE__ );
} else {
    // DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.
    if ( !function_exists( 'forms_to_zapier' ) ) {
        
        if ( !function_exists( 'forms_to_zapier' ) ) {
            // Create a helper function for easy SDK access.
            function forms_to_zapier()
            {
                global  $forms_to_zapier ;
                
                if ( !isset( $forms_to_zapier ) ) {
                    // Include Freemius SDK.
                    require_once dirname( __FILE__ ) . '/freemius/start.php';
                    $forms_to_zapier = fs_dynamic_init( array(
                        'id'             => '4000',
                        'slug'           => 'forms-to-zapier',
                        'type'           => 'plugin',
                        'public_key'     => 'pk_a2b42c1d0d57a6afde31bb5565772',
                        'is_premium'     => false,
                        'premium_suffix' => 'Personal',
                        'has_addons'     => false,
                        'has_paid_plans' => true,
                        'menu'           => array(
                        'slug'    => 'forms-to-zapier',
                        'support' => false,
                    ),
                        'is_live'        => true,
                    ) );
                }
                
                return $forms_to_zapier;
            }
            
            // Init Freemius.
            forms_to_zapier();
            // Signal that SDK was initiated.
            do_action( 'forms_to_zapier_loaded' );
        }
    
    }
    // ... Your plugin's main file logic ...
    /**
     * Froms to Zapier Main Class
     */
    class Forms_To_Zapier
    {
        /**
         * Initializes the Forms_To_Zapier class
         *
         * Checks for an existing Forms_To_Zapier instance
         * and if it doesn't find one, creates it.
         *
         * @since 1.0
         * @return mixed | bool
         */
        public static function init()
        {
            static  $instance = false ;
            if ( !$instance ) {
                $instance = new Forms_To_Zapier();
            }
            return $instance;
        }
        
        /**
         * Constructor for the Forms_To_Zapier class
         *
         * Sets up all the appropriate hooks and actions
         *
         * @since 1.0
         * @return void
         */
        public function __construct()
        {
            register_activation_hook( __FILE__, [ $this, 'activate' ] );
            register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );
            $this->init_plugin();
        }
        
        /**
         * Initialize plugin
         *
         * @since 1.0.0
         * @return void
         */
        public function init_plugin()
        {
            /* Define constats */
            $this->define_constants();
            /* Include files */
            $this->includes();
            /* Instantiate classes */
            $this->init_classes();
            /* Initialize the action hooks */
            $this->init_actions();
            /* Initialize the filter hooks */
            $this->init_filters();
        }
        
        /**
         * Placeholder for activation function
         *
         * @since 1.0
         * @return void
         */
        public function activate()
        {
            $this->create_table();
            // Create default tables when plugin activates
        }
        
        /**
         * Placeholder for creating tables while activationg plugin
         *
         * @since 1.0
         * @return void
         */
        private function create_table()
        {
            global  $wpdb ;
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            $collate = '';
            
            if ( $wpdb->has_cap( 'collation' ) ) {
                if ( !empty($wpdb->charset) ) {
                    $collate .= "DEFAULT CHARACTER SET {$wpdb->charset}";
                }
                if ( !empty($wpdb->collate) ) {
                    $collate .= " COLLATE {$wpdb->collate}";
                }
            }
            
            $SQL = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}forms_to_zapier(\n\t\t      `id` bigint(20) NOT NULL AUTO_INCREMENT,\n\t\t      `integration_title` varchar(250) NOT NULL,\n\t\t      `form_provider` varchar(250) NOT NULL,\n\t\t      `form_id` varchar(250) NOT NULL,\n\t\t      `form_name` varchar(250) NOT NULL,\n\t\t      `zapier_webhook_url` varchar(250) NOT NULL,\n\t\t      `status` varchar(25) NOT NULL,\n\t\t      `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,\n\t\t       KEY `id` (`id`)\n\t\t    ) {$collate};";
            dbDelta( $SQL );
        }
        
        /**
         * Placeholder for deactivation function
         *
         * @since 1.0
         * @return void
         */
        public function deactivate()
        {
        }
        
        /**
         * Define Add-on constants
         *
         * @since 1.0
         * @return void
         */
        public function define_constants()
        {
            define( 'FORMS_TO_ZAPIER_FILE', __FILE__ );
            // Plugin Main Folder Path
            define( 'FORMS_TO_ZAPIER_PATH', dirname( FORMS_TO_ZAPIER_FILE ) );
            // Parent Directory Path
            define( 'FORMS_TO_ZAPIER_INCLUDES', FORMS_TO_ZAPIER_PATH . '/includes' );
            // Include Folder Path
            define( 'FORMS_TO_ZAPIER_URL', plugins_url( '', FORMS_TO_ZAPIER_FILE ) );
            // URL Path
            define( 'FORMS_TO_ZAPIER_ASSETS', FORMS_TO_ZAPIER_URL . '/assets' );
            // Asset Folder Path
            define( 'FORMS_TO_ZAPIER_VIEWS', FORMS_TO_ZAPIER_PATH . '/views' );
            // View Folder Path
        }
        
        /**
         * Include the required files
         *
         * @since 1.0
         * @return void
         */
        public function includes()
        {
            include FORMS_TO_ZAPIER_INCLUDES . '/class-ftoz-admin-menu.php';
            include FORMS_TO_ZAPIER_INCLUDES . '/class-ftoz-list-table.php';
            include FORMS_TO_ZAPIER_INCLUDES . '/class-ftoz-submission.php';
            include FORMS_TO_ZAPIER_INCLUDES . '/functions-cf7.php';
            include FORMS_TO_ZAPIER_INCLUDES . '/functions-ftoz.php';
        }
        
        /**
         * Instantiate classes
         *
         * @since 1.0
         * @return void
         */
        public function init_classes()
        {
            // Admin Menu Class
            new Forms_To_Zapier_Admin_Menu();
            // Submission Handler Class
            new Forms_To_Zapier_Submission();
        }
        
        /**
         * Initializes action hooks
         *
         * @since 1.0
         * @return  void
         */
        public function init_actions()
        {
            add_action( 'init', array( $this, 'localization_setup' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
        }
        
        /**
         * Initialize plugin for localization
         *
         * @since 1.0
         *
         * @uses load_plugin_textdomain()
         *
         * @return void
         */
        public function localization_setup()
        {
            load_plugin_textdomain( 'forms-to-zapier', false, FORMS_TO_ZAPIER_FILE . '/languages/' );
        }
        
        /**
         * Initializes action filters
         *
         * @since 1.0
         * @return  void
         */
        public function init_filters()
        {
        }
        
        /**
         * Register Script
         *
         * @since 1.0
         * @return mixed | void
         */
        public function register_scripts( $hook )
        {
            wp_register_script(
                'ftoz-vuejs',
                FORMS_TO_ZAPIER_ASSETS . '/js/vue.min.js',
                array( 'jquery' ),
                '',
                1
            );
            wp_register_script(
                'ftoz-main-script',
                FORMS_TO_ZAPIER_ASSETS . '/js/assets.js',
                array( 'ftoz-vuejs' ),
                '',
                1
            );
            wp_register_style( 'asset-main-style', FORMS_TO_ZAPIER_ASSETS . '/css/assets.css' );
            $localize_scripts = array(
                'nonce'          => wp_create_nonce( 'forms-to-zapier' ),
                'delete_confirm' => __( 'Are you sure to delete?', 'forms-to-zapier' ),
            );
            wp_localize_script( 'ftoz-main-script', 'ftoz', $localize_scripts );
        }
    
    }
    $ftoz = Forms_To_Zapier::init();
}
