<?php 
/**
 * Register and Enqueue Styles.
 */
add_action( 'wp_enqueue_scripts', 'tradecredebt_register_styles' );

function tradecredebt_register_styles() {

  $theme_version = wp_get_theme()->get( 'Version' );

  wp_enqueue_style( 'bootdtrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', null, $theme_version );
  wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', null, $theme_version );

  wp_enqueue_style( 'slick-style', get_template_directory_uri() . '/css/slick.css', null, $theme_version );
  wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.min.js', array(), $theme_version, false );

  wp_enqueue_style( 'tradecredebt-style', get_template_directory_uri() . '/css/style.css', null, $theme_version );
  wp_enqueue_style( 'tradecredebt-responsive', get_template_directory_uri() . '/responsive.css', null, $theme_version );


}

/**
 * Register and Enqueue Scripts.
 */
add_action( 'wp_enqueue_scripts', 'tradecredebt_register_scripts' );

function tradecredebt_register_scripts() {

  $theme_version = wp_get_theme()->get( 'Version' );
  wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.2.1.min.js', array(), $theme_version, false );
  wp_enqueue_script( 'fontawesome-v5-15-4-js', get_template_directory_uri() . '/js/fontawesome-v5.15.4.js', array(), $theme_version, false );
  wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), $theme_version, false );
  wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array(), $theme_version.'.3', false );

  
}

add_action( 'admin_enqueue_scripts', 'tradecredebt_register_admin_script' );

function tradecredebt_register_admin_script() {
    wp_enqueue_script( 'wp_repeater', get_template_directory_uri() . '/js/wp_repeater.js', [ 'jquery', 'underscore', 'wp-util' ], '1.0', true );
    wp_enqueue_style( 'admin-style', get_template_directory_uri() . '/css/admin-style.css', null, '1.0' );
}



if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));

    acf_add_options_sub_page(array(
		'page_title' 	=> 'Automation Form Link UP TO DM',
		'menu_title'	=> 'Automation DM',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}

/*
** Regiter Footer Menus
*/
add_action( 'init', 'register_my_menus' );
function register_my_menus() {

     register_nav_menus(
          array(
               'footer-menu-one' => __( 'Footer Menu 1' ),
               'footer-menu-two' => __( 'Footer Menu 2' ),
               'footer-menu-three' => __( 'Footer Menu 3' ),
               'footer-menu-four' => __( 'Footer Menu 4' ),
               'footer-menu-five' => __( 'After Copyright text' ),
          )
     );

}

class Tradecredebt_Nav_Walker extends Walker_Nav_Menu  {
    /**
     * What the class handles.
     *
     * @since 3.0.0
     * @var string
     *
     * @see Walker::$tree_type
     */
    public $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    private $no_ = 1;
 
    /**
     * Database fields to use.
     *
     * @since 3.0.0
     * @todo Decouple this.
     * @var array
     *
     * @see Walker::$db_fields
     */
    public $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id',
    );
 
    /**
     * Starts the list before the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::start_lvl()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n"; 
        }
        $indent = str_repeat( $t, $depth );
 
        // Default class.
        // if( $depth == 0 ){ $classes = array( 'sub-menu', 'list-unstyled collapse' ); }else{
          $classes = array( 'list-unstyled collapse'  );
        // }
 
        /**
         * Filters the CSS class(es) applied to a menu list element.
         *
         * @since 4.8.0
         *
         * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
         * @param stdClass $args    An object of `wp_nav_menu()` arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
 
        $output .= "{$n}{$indent}<ul$class_names id='depth".$depth.$this->$no."'>{$n}";
        $this->$no++;
    }
 
    /**
     * Ends the list of after the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::end_lvl()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent  = str_repeat( $t, $depth );
        $output .= "$indent</ul>{$n}";
    }
 
    /**
     * Starts the element output.
     *
     * @since 3.0.0
     * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
     *
     * @see Walker::start_el()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';
 
        $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'nav-item';
 
        /**
         * Filters the arguments for a single nav menu item.
         *
         * @since 4.4.0
         *
         * @param stdClass $args  An object of wp_nav_menu() arguments.
         * @param WP_Post  $item  Menu item data object.
         * @param int      $depth Depth of menu item. Used for padding.
         */
        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
 
        /**
         * Filters the CSS classes applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
         * @param WP_Post  $item    The current menu item.
         * @param stdClass $args    An object of wp_nav_menu() arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */ 
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
 
        /**
         * Filters the ID applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param WP_Post  $item    The current menu item.
         * @param stdClass $args    An object of wp_nav_menu() arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
 
        $output .= $indent . '<li' . $id . $class_names . '>';
 
        $atts           = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        if ( '_blank' === $item->target && empty( $item->xfn ) ) {
            $atts['rel'] = 'noopener noreferrer';
        } else {
            $atts['rel'] = $item->xfn;
        }
        $atts['href']         = ! empty( $item->url ) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';
 
        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` para#depth3meter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @type string $title        Title attribute.
         *     @type string $target       Target attribute.
         *     @type string $rel          The rel attribute.
         *     @type string $href         The href attribute.
         *     @type string $aria_current The aria-current attribute.
         * }
         * @param WP_Post  $item  The current menu item.
         * @param stdClass $args  An object of wp_nav_menu() arguments.
         * @param int      $depth Depth of menu item. Used for padding.
         */
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
 
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
 
        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $item->title, $item->ID );
 
        /**
         * Filters a menu item's title.
         *
         * @since 4.4.0
         *
         * @param string   $title The menu item's title.
         * @param WP_Post  $item  The current menu item.
         * @param stdClass $args  An object of wp_nav_menu() arguments.
         * @param int      $depth Depth of menu item. Used for padding.
         */
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
 
        $item_output  = $args->before;
        $item_output .= '<a class="nav-link" ' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
 
        /**
         * Filters a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string   $item_output The menu item's starting HTML output.
         * @param WP_Post  $item        Menu item data object.
         * @param int      $depth       Depth of menu item. Used for padding.
         * @param stdClass $args        An object of wp_nav_menu() arguments.
         */
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
 
    /**
     * Ends the element output, if needed.
     *
     * @since 3.0.0
     *
     * @see Walker::end_el()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Page data object. Not used.
     * @param int      $depth  Depth of page. Not Used.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $output .= "</li>{$n}";
    }
 
}

// Add custom validation for CF7 form fields
function is_company_email($email){ // Check against list of common public email providers & return true if the email provided *doesn’t* match one of them
if(
preg_match('/@gmail.com/i', $email) ||
preg_match('/@hotmail.com/i', $email) ||
preg_match('/@live.com/i', $email) ||
preg_match('/@msn.com/i', $email) ||
preg_match('/@aol.com/i', $email) ||
preg_match('/@yahoo.com/i', $email) ||
preg_match('/@inbox.com/i', $email) ||
preg_match('/@gmx.com/i', $email) ||
preg_match('/@me.com/i', $email) ||
preg_match('/@mail.com/i', $email) ||
preg_match('/@yopmail.com/i', $email)
){
return false; // It's a publicly available email address
}else{
return true; // It's probably a company email address
}
}

function custom_email_validation_filter($result, $tag) {

$tag = new WPCF7_Shortcode( $tag );

if ( 'your-email' == $tag->name ) {

    $the_value = isset( $_POST['your-email'] ) ? trim( $_POST['your-email'] ) : "";

    if(!is_company_email($the_value)){
        $result->invalidate( $tag, "Please Enter a valid Business Email ID" );
    }
}

if ( 'email' == $tag->name ) {

    $the_value = isset( $_POST['email'] ) ? trim( $_POST['email'] ) : "";

    if(!is_company_email($the_value)){
        $result->invalidate( $tag, "Please Enter a valid Business Email ID" );
    }
}


return $result;
}

add_filter( 'wpcf7_validate_email', 'custom_email_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_email*', 'custom_email_validation_filter', 10, 2 );


function wpdocs_custom_excerpt_length( $length ) {
    return 15;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function ce4_excerpt_more($more) {
    global $post;
    return '';
}
add_filter('excerpt_more', 'ce4_excerpt_more');


function custom_admin_head() {
    $css = '';
    $css = 'td.media-icon img[src$=".svg"] { width: 100% !important; height: auto !important; }';
    $css = '.acf-image-uploader.active .has-image { min-width: 150px !important; min-height: 100px !important; }';
    echo '<style type="text/css">'.$css.'</style>';
}
add_action('admin_head', 'custom_admin_head');

add_action('admin_menu', 'questionnaire_menu_pages');
function questionnaire_menu_pages() {
    add_menu_page('Questionnaire Rate Control', 'Questionnaire Rate Control', 'manage_options', 'questionnaire_settings', 'questionnaire_settings_callback' );
    add_menu_page('Banner Rate Control', 'Banner Rate Control', 'manage_options', 'questionnaire_banner_settings', 'questionnaire_banner_settings_callback' );
    add_menu_page('Compare Text Control', 'Compare Text Control', 'manage_options', 'questionnaire_compare_settings', 'questionnaire_compare_settings_callback' );
}

function questionnaire_settings_callback() {
    ?>
    <h1>Questionnaire Rate Control</h1>
    <p>Please click <a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=gf_edit_forms&id=13" target="_blank">here</a> to change text for Form A</p>
    <p>Please click <a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=gf_edit_forms&id=14" target="_blank">here</a> to change text for Form B</p>
    <form method="POST" action="options.php">
    <?php
    settings_fields( 'questionnaire_settings-page' );
    do_settings_sections( 'questionnaire_settings-page' );
    submit_button();
    ?>
    </form>
    <?php
}

add_action( 'admin_init', 'questionnaire_settings_init' );

function questionnaire_settings_init() {

    add_settings_section(
        'demand_setting_section',
        __( 'Demand', 'my-textdomain' ),
        'setting_section_callback_function',
        'questionnaire_settings-page'
    );


    add_settings_field(
        'demand_regulated',
        __( 'Demand Regulated', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_settings-page',
        'demand_setting_section',
        array('name' => 'demand_regulated')
    );

    register_setting( 'questionnaire_settings-page', 'demand_regulated' );

    add_settings_field(
        'demand_credebt',
        __( 'Demand Credebt', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_settings-page',
        'demand_setting_section',
        array('name' => 'demand_credebt')
    );

    register_setting( 'questionnaire_settings-page', 'demand_credebt' );

    add_settings_field(
        'demand_high_risk',
        __( 'Demand High Risk', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_settings-page',
        'demand_setting_section',
        array('name' => 'demand_high_risk')
    );

    register_setting( 'questionnaire_settings-page', 'demand_high_risk' );

    add_settings_section(
        'fixed_setting_section',
        __( 'Fixed', 'my-textdomain' ),
        'setting_section_callback_function',
        'questionnaire_settings-page'
    );


    add_settings_field(
        'fixed_regulated',
        __( 'Fixed Regulated', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_settings-page',
        'fixed_setting_section',
        array('name' => 'fixed_regulated')
    );

    register_setting( 'questionnaire_settings-page', 'fixed_regulated' );

    add_settings_field(
        'fixed_credebt',
        __( 'Fixed Credebt', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_settings-page',
        'fixed_setting_section',
        array('name' => 'fixed_credebt')
    );

    register_setting( 'questionnaire_settings-page', 'fixed_credebt' );

    add_settings_field(
        'fixed_high_risk',
        __( 'Fixed High Risk', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_settings-page',
        'fixed_setting_section',
        array('name' => 'fixed_high_risk')
    );

    register_setting( 'questionnaire_settings-page', 'fixed_high_risk' );


    add_settings_section(
        'term_setting_section',
        __( 'Term', 'my-textdomain' ),
        'setting_section_callback_function',
        'questionnaire_settings-page'
    );


    add_settings_field(
        'term_regulated',
        __( 'Term Regulated', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_settings-page',
        'term_setting_section',
        array('name' => 'term_regulated')
    );

    register_setting( 'questionnaire_settings-page', 'term_regulated' );

    add_settings_field(
        'term_credebt',
        __( 'Term Credebt', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_settings-page',
        'term_setting_section',
        array('name' => 'term_credebt')
    );

    register_setting( 'questionnaire_settings-page', 'term_credebt' );

    add_settings_field(
        'term_high_risk',
        __( 'Term High Risk', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_settings-page',
        'term_setting_section',
        array('name' => 'term_high_risk')
    );

    register_setting( 'questionnaire_settings-page', 'term_high_risk' );
}

function setting_section_callback_function() {
    echo '';
}

function text_setting_markup($args) {
    echo '<input type="text" id="'.$args['name'].'" name="'.$args['name'].'" value="'.get_option( $args['name'] ).'">';
    if($args['hide_percentage'] != 'yes') {
        echo ' %';
    }
}

function textarea_setting_markup($args) {
    echo '<textarea id="'.$args['name'].'" name="'.$args['name'].'" rows="4" cols="50">'.get_option( $args['name'] ).'</textarea>';
}

function questionnaire_banner_settings_callback() {
    ?>
    <h1>Banner Rate Control</h1>
    <form method="POST" action="options.php">
    <?php
    settings_fields( 'questionnaire_banner_settings-page' );
    do_settings_sections( 'questionnaire_banner_settings-page' );
    submit_button();
    ?>
    </form>
    <?php
}
add_action( 'admin_init', 'questionnaire_banner_settings_init' );

function questionnaire_banner_settings_init() {
    add_settings_section(
        'demand_setting_section',
        __( 'Demand', 'my-textdomain' ),
        'setting_section_callback_function',
        'questionnaire_banner_settings-page'
    );


    add_settings_field(
        'demand_title',
        __( 'Demand Title', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_banner_settings-page',
        'demand_setting_section',
        array('name' => 'demand_title', 'hide_percentage' => 'yes')
    );

    register_setting( 'questionnaire_banner_settings-page', 'demand_title' );

    add_settings_field(
        'demand_value',
        __( 'Demand Value', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_banner_settings-page',
        'demand_setting_section',
        array('name' => 'demand_value')
    );

    register_setting( 'questionnaire_banner_settings-page', 'demand_value' );

    add_settings_field(
        'demand_description',
        __( 'Demand Description', 'my-textdomain' ),
        'textarea_setting_markup',
        'questionnaire_banner_settings-page',
        'demand_setting_section',
        array('name' => 'demand_description')
    );

    register_setting( 'questionnaire_banner_settings-page', 'demand_description' );

    add_settings_section(
        'fixed_setting_section',
        __( 'Fixed', 'my-textdomain' ),
        'setting_section_callback_function',
        'questionnaire_banner_settings-page'
    );


    add_settings_field(
        'fixed_title',
        __( 'Fixed Title', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_banner_settings-page',
        'fixed_setting_section',
        array('name' => 'fixed_title', 'hide_percentage' => 'yes')
    );

    register_setting( 'questionnaire_banner_settings-page', 'fixed_title' );

    add_settings_field(
        'fixed_value',
        __( 'Fixed Value', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_banner_settings-page',
        'fixed_setting_section',
        array('name' => 'fixed_value')
    );

    register_setting( 'questionnaire_banner_settings-page', 'fixed_value' );

    add_settings_field(
        'fixed_description',
        __( 'Fixed Description', 'my-textdomain' ),
        'textarea_setting_markup',
        'questionnaire_banner_settings-page',
        'fixed_setting_section',
        array('name' => 'fixed_description')
    );

    register_setting( 'questionnaire_banner_settings-page', 'fixed_description' );


    add_settings_section(
        'term_setting_section',
        __( 'Term', 'my-textdomain' ),
        'setting_section_callback_function',
        'questionnaire_banner_settings-page'
    );


    add_settings_field(
        'term_title',
        __( 'Term Title', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_banner_settings-page',
        'term_setting_section',
        array('name' => 'term_title', 'hide_percentage' => 'yes')
    );

    register_setting( 'questionnaire_banner_settings-page', 'term_title' );

    add_settings_field(
        'term_value',
        __( 'Term Value', 'my-textdomain' ),
        'text_setting_markup',
        'questionnaire_banner_settings-page',
        'term_setting_section',
        array('name' => 'term_value')
    );

    register_setting( 'questionnaire_banner_settings-page', 'term_value' );

    add_settings_field(
        'term_description',
        __( 'Term Description', 'my-textdomain' ),
        'textarea_setting_markup',
        'questionnaire_banner_settings-page',
        'term_setting_section',
        array('name' => 'term_description')
    );

    register_setting( 'questionnaire_banner_settings-page', 'term_description' );
}

function questionnaire_compare_settings_callback() {
    ?>
    <h1>Compare Text Control</h1>

    <form class="compare-admin-form-wrap" method="POST" action="options.php">

    <?php
    settings_fields( 'questionnaire_compare_settings-page' );
    do_settings_sections( 'questionnaire_compare_settings-page' );
    submit_button();
    ?>
    </form>
    <?php
}

add_action( 'admin_init', 'questionnaire_compare_settings_init' );

function questionnaire_compare_settings_init() {
    add_settings_section(
        'compare_products_a_setting_section',
        __( 'Compare Products A', 'my-textdomain' ),
        'setting_section_callback_function',
        'questionnaire_compare_settings-page'
    );

    // Editor For Column 1
    add_settings_field(
        'comparepage_regulated_savings_column_1',
        __( 'Regulated Savings (Column 1)', 'my-textdomain' ),
        'editor_setting_markup_callback',
        'questionnaire_compare_settings-page',
        'compare_products_a_setting_section',
        array('name' => 'comparepage_regulated_savings_column_1')
    );
    register_setting( 'questionnaire_compare_settings-page', 'comparepage_regulated_savings_column_1' );

    // Editor For Column 2
    add_settings_field(
        'comparepage_unregulated_savings_column_2',
        __( 'Unregulated Savings (Column 2)', 'my-textdomain' ),
        'editor_setting_markup_callback',
        'questionnaire_compare_settings-page',
        'compare_products_a_setting_section',
        array('name' => 'comparepage_unregulated_savings_column_2')
    );
    register_setting( 'questionnaire_compare_settings-page', 'comparepage_unregulated_savings_column_2' );

    // Editor For Column 3
    add_settings_field(
        'comparepage_high_yield_savings_column_3',
        __( 'High Yield Savings (Column 3)', 'my-textdomain' ),
        'editor_setting_markup_callback',
        'questionnaire_compare_settings-page',
        'compare_products_a_setting_section',
        array('name' => 'comparepage_high_yield_savings_column_3')
    );
    register_setting( 'questionnaire_compare_settings-page', 'comparepage_high_yield_savings_column_3' );
    // End

    /*add_settings_field(
        'regulated_savings',
        __( 'Regulated Savings (Column 1)', 'my-textdomain' ),
        'repeater_setting_markup',
        'questionnaire_compare_settings-page',
        'compare_products_a_setting_section',
        array('name' => 'regulated_savings')
    );

    register_setting( 'questionnaire_compare_settings-page', 'regulated_savings' );

    add_settings_field(
        'unregulated_savings',
        __( 'Unregulated Savings (Column 2)', 'my-textdomain' ),
        'repeater_setting_markup',
        'questionnaire_compare_settings-page',
        'compare_products_a_setting_section',
        array('name' => 'unregulated_savings')
    );

    register_setting( 'questionnaire_compare_settings-page', 'unregulated_savings' );

    add_settings_field(
        'high_yield_savings',
        __( 'High Yield Savings (Column 3)', 'my-textdomain' ),
        'repeater_setting_markup',
        'questionnaire_compare_settings-page',
        'compare_products_a_setting_section',
        array('name' => 'high_yield_savings')
    );

    register_setting( 'questionnaire_compare_settings-page', 'high_yield_savings' );*/

    

    add_settings_section(
        'compare_products_b_setting_section',
        __( 'Compare Products B', 'my-textdomain' ),
        'setting_section_callback_function',
        'questionnaire_compare_settings-page'
    );

     // Editor For Column 1
    add_settings_field(
        'comparepage_regulated_return_column_1',
        __( 'Regulated Return (Column 1)', 'my-textdomain' ),
        'editor_setting_markup_callback',
        'questionnaire_compare_settings-page',
        'compare_products_b_setting_section',
        array('name' => 'comparepage_regulated_return_column_1')
    );
    register_setting( 'questionnaire_compare_settings-page', 'comparepage_regulated_return_column_1' );


    add_settings_field(
        'comparepage_credebt_guarantee_column_2',
        __( 'Credebt® Guarantee (Column 2)', 'my-textdomain' ),
        'editor_setting_markup_callback',
        'questionnaire_compare_settings-page',
        'compare_products_b_setting_section',
        array('name' => 'comparepage_credebt_guarantee_column_2')
    );
    register_setting( 'questionnaire_compare_settings-page', 'comparepage_credebt_guarantee_column_2' );

    add_settings_field(
        'comparepage_high_yield_return_column_3',
        __( 'High Yield Return (Column 3)', 'my-textdomain' ),
        'editor_setting_markup_callback',
        'questionnaire_compare_settings-page',
        'compare_products_b_setting_section',
        array('name' => 'comparepage_high_yield_return_column_3')
    );
    register_setting( 'questionnaire_compare_settings-page', 'comparepage_high_yield_return_column_3' );
    // End

    /*add_settings_field(
        'regulated_return',
        __( 'Regulated Return (Column 1)', 'my-textdomain' ),
        'repeater_setting_markup',
        'questionnaire_compare_settings-page',
        'compare_products_b_setting_section',
        array('name' => 'regulated_return')
    );

    register_setting( 'questionnaire_compare_settings-page', 'regulated_return' );

    add_settings_field(
        'credebt_guarantee',
        __( 'Credebt® Guarantee (Column 2)', 'my-textdomain' ),
        'repeater_setting_markup',
        'questionnaire_compare_settings-page',
        'compare_products_b_setting_section',
        array('name' => 'credebt_guarantee')
    );

    register_setting( 'questionnaire_compare_settings-page', 'credebt_guarantee' );

    add_settings_field(
        'high_yield_return',
        __( 'High Yield Return (Column 3)', 'my-textdomain' ),
        'repeater_setting_markup',
        'questionnaire_compare_settings-page',
        'compare_products_b_setting_section',
        array('name' => 'high_yield_return')
    );

    register_setting( 'questionnaire_compare_settings-page', 'high_yield_return' );*/
    
}

function repeater_setting_markup($args) {
    echo '<div class="container">
        <button type="button" class="'.$args['name'].'-add">Add</button>
        
        <div class="'.$args['name'].'-fields">';
            $data = get_option( $args['name'] );
            foreach($data as $value) {
                echo '<div class="field-group">
                    <input type="text" id="'.$args['name'].'" name="'.$args['name'].'[]" value="'.$value.'">
                    <button type="button" class="'.$args['name'].'-remove">Remove</button>
                </div>';
            }
        echo '</div>
    </div>

    <!-- Template -->
    <script type="text/html" id="tmpl-'.$args['name'].'-group">
        <div class="field-group">
            <input type="text" id="'.$args['name'].'" name="'.$args['name'].'[]" value="">
            <button type="button" class="'.$args['name'].'-remove">Remove</button>
        </div>
    </script>
    <!-- End Template -->';
}

add_shortcode('compare_products', 'compare_products_callback');
function compare_products_callback( $atts ) {
    $atts = shortcode_atts( array(
        'form_page_slug' => 'questionnaire',
    ), $atts );

    ob_start();
    $form_page_slug = $atts['form_page_slug'];

    $is_gform_element = '';
    if( isset( $_COOKIE['investabill_is_gform_element'] ) && !empty( $_COOKIE['investabill_is_gform_element'] ) ) {
        $is_gform_element = $_COOKIE['investabill_is_gform_element'];
    }

    $is_explode = [];
    if( !empty( $is_gform_element ) ) {
        $is_explode = explode('_', $is_gform_element);
    }

    $previous_url = $_SERVER['HTTP_REFERER'];
    $previous_url_arr = [];
    if( !empty( $previous_url )  ) {
        $previous_url_arr = explode('/', $previous_url);
    }
    
    $back_button_html = '<a class="is-form-page-back-btn" href="'.site_url().'/'.$form_page_slug.'"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 32 32" id="Слой_1" version="1.1" viewBox="0 0 32 32" xml:space="preserve"><path clip-rule="evenodd" d="M11.262,16.714l9.002,8.999  c0.395,0.394,1.035,0.394,1.431,0c0.395-0.394,0.395-1.034,0-1.428L13.407,16l8.287-8.285c0.395-0.394,0.395-1.034,0-1.429  c-0.395-0.394-1.036-0.394-1.431,0l-9.002,8.999C10.872,15.675,10.872,16.325,11.262,16.714z" fill="currentcolor" fill-rule="evenodd" id="Chevron_Right"/><g/><g/><g/><g/><g/><g/></svg> Back</a>';

    if( isset( $is_explode[1] ) && $is_explode[1] == '14' && in_array( $form_page_slug, $previous_url_arr) ) {
        echo $back_button_html;
        echo investabill_is_form_b_compare_content();
        echo $back_button_html;

    } elseif( isset( $is_explode[1] ) && $is_explode[1] == '13' && in_array( $form_page_slug, $previous_url_arr) ) {
        echo $back_button_html;
        echo investabill_is_form_a_compare_content();
        echo $back_button_html;
    } else {
        echo '<div class="invest-now-container">';
            echo '<div class="invest-now-button">';
                echo '<a class="is-form-page-back-btn" href="'.site_url().'/'.$form_page_slug.'">Invest Now</a>';
            echo '</div>';
            $rand_form_id = rand( 13, 14 );
            if( $rand_form_id == 13 ) {
                echo investabill_is_form_a_compare_content();
            } elseif( $rand_form_id == 14 ) {
                echo investabill_is_form_b_compare_content();
            }
        echo '</div>';
    }
    return ob_get_clean();
}

// Form ID (Questionnaire Text Control A) 13 Copare Page Content
function investabill_is_form_a_compare_content() {
    ob_start();
    $first_field_arr = GFAPI::get_field( 13, 1 );
    $field_options = ( ( isset( $first_field_arr->choices ) && !empty( $first_field_arr->choices ) ) ? $first_field_arr->choices : [] );
    
    $first_col_label    = ( ( isset( $field_options[0]['text'] ) && !empty( $field_options[0]['text'] ) ) ? $field_options[0]['text'] : 'Regulated Savings' );
    $second_col_label   = ( ( isset( $field_options[1]['text'] ) && !empty( $field_options[1]['text'] ) ) ? $field_options[1]['text'] : 'Unregulated Savings' );
    $third_col_label    = ( ( isset( $field_options[2]['text'] ) && !empty( $field_options[2]['text'] ) ) ? $field_options[2]['text'] : 'High Yield Savings' );


    echo '<strong class="compare-heading" style="display:none">This is the table that should be shown for Compare Products on all A buttons:</strong>';

    echo '<div class="row margin-set compare-products">
        <div class="col-lg-4"><div class="box-wrap">
            <div class="title-section"><strong>'.$first_col_label.' '.get_option( 'fixed_regulated' ).'%</strong></div><div class="listing-span">';
            echo get_option( 'comparepage_regulated_savings_column_1' );
        echo '</div></div></div>
        <div class="col-lg-4"><div class="box-wrap">
            <div class="title-section"><strong>'.$second_col_label.''.get_option( 'fixed_credebt' ).'%</strong></div><div class="listing-span">';
            echo get_option( 'comparepage_unregulated_savings_column_2' );
        echo '</div></div></div>
        <div class="col-lg-4"><div class="box-wrap">
            <div class="title-section"><strong>'.$third_col_label.''.get_option( 'fixed_high_risk' ).'%</strong></div><div class="listing-span">';
            echo get_option( 'comparepage_high_yield_savings_column_3' );
        echo '</div></div></div>
    </div>';
    $html = ob_get_contents(); ob_get_clean();
    return $html;
}

// Form ID (Questionnaire Text Control B) 14 Copare Page Content
function investabill_is_form_b_compare_content() {
    ob_start();
    $first_field_arr = GFAPI::get_field( 14, 1 );
    $field_options = ( ( isset( $first_field_arr->choices ) && !empty( $first_field_arr->choices ) ) ? $first_field_arr->choices : [] );
    
    $first_col_label    = ( ( isset( $field_options[0]['text'] ) && !empty( $field_options[0]['text'] ) ) ? $field_options[0]['text'] : 'Regulated Return' );
    $second_col_label   = ( ( isset( $field_options[1]['text'] ) && !empty( $field_options[1]['text'] ) ) ? $field_options[1]['text'] : 'Regulated Return' );
    $third_col_label    = ( ( isset( $field_options[2]['text'] ) && !empty( $field_options[2]['text'] ) ) ? $field_options[2]['text'] : 'Regulated Return' );
    echo '<strong class="compare-heading" style="display:none">This is the table that should be shown for Compare Products on all B buttons:</strong>';

    echo '<div class="row margin-set compare-products">
        <div class="col-lg-4"><div class="box-wrap">
            <div class="title-section"><strong>'.$first_col_label.' '.get_option( 'fixed_regulated' ).'%</strong></div><div class="listing-span">';
            echo get_option( 'comparepage_regulated_return_column_1' );
        echo '</div></div></div>
        <div class="col-lg-4"><div class="box-wrap">
            <div class="title-section"><strong>'.$second_col_label.''.get_option( 'fixed_credebt' ).'%</strong></div><div class="listing-span">';
            echo get_option( 'comparepage_credebt_guarantee_column_2' );
        echo '</div></div></div>
        <div class="col-lg-4"><div class="box-wrap">
            <div class="title-section"><strong>'.$third_col_label.''.get_option( 'fixed_high_risk' ).'%</strong></div><div class="listing-span">';
            echo get_option( 'comparepage_high_yield_return_column_3' );
        echo '</div></div></div>
    </div>';
    $html = ob_get_contents(); ob_get_clean();
    return $html;
}

function editor_setting_markup_callback($args) {
    echo '<div style="width: 50%;">';
    $editor_args = array(
        'tinymce'       => array(
            'toolbar1'      => 'bold,italic,bullist,link,unlink',
        ),
        'media_buttons' => false,
        'quicktags' => false
    );
    $content = get_option( $args['name'] );
    $editor_id = $args['name'];
    wp_editor( $content, $editor_id, $editor_args );
    echo '</div>';
}

function investabill_slider_custom_post_type() {
    register_post_type('home-banner-slider',
        array(
            'labels'      => array(
                'name'          => __( 'Banner Slider', 'investabill' ),
                'singular_name' => __( 'Banner Slider', 'investabill' ),
            ),
            'public'      => true,
            'has_archive' => true,
            'publicly_queryable'  => false,
            'supports'  => [ 'title','excerpt' ],
            'rewrite'     => array( 'slug' => 'banner-slider' ), // my custom slug
        )
    );
}
add_action('init', 'investabill_slider_custom_post_type');


add_shortcode( 'home_page_slider', 'home_page_slider_callback' );
function home_page_slider_callback() {
    ob_start();
    ?>
    <style type="text/css">
        .home-banner-slider{padding: 30px 0; justify-content: center; }
        .home-banner-slider .slide{text-align: center; }
        .home-banner-slider .slide h1{font-family: 'Roboto Slab'; color: #fff; font-size: 225%; text-shadow: none; line-height: 1.5; font-weight: normal; font-style: normal; text-decoration: none; text-align: inherit; letter-spacing: normal; word-spacing: normal; text-transform: none; font-weight: 700; }
    </style>
    
    <div class="pageWrap home-banner-slider">
        <div class="sliderOute">
            <?php
                $postArgs = [
                    'post_type' => 'home-banner-slider',
                    'post_status' => 'publilsh',
                    'orderby' => 'date',
                    'order' => 'DESC',
                ];
                $postData = get_posts($postArgs);
                if( !empty( $postData ) ) {
                    foreach( $postData as $post ) {
                        ?>
                        <div class="slide">
                            <h1><?php echo $post->post_excerpt; ?></h1>
                        </div>            
                        <?php
                    }
                }
            ?>
            <?php /*<div class="slide">
                <h1><span style="color:#CF8A00">Real Returns</span> on Secure, Liquid Investment</h1>
            </div>
            <div class="slide">
                <h1>Attractive, Secure Returns on <span style="color:#CF8A00">Your Investment</span></h1>
            </div>
            <div class="slide">
                <h1>Invest in <span style="color:#CF8A00">Global Business'</span> Performance</h1>
            </div>
            <div class="slide">
                <h1><span style="color:#CF8A00">Higher Returns</span> Than Bank Deposits</h1>
            </div>
            <div class="slide">
                <h1><span style="color:#CF8A00">Fairer</span> Finance for Flourishing Companies</h1>
            </div>
            <div class="slide">
                <h1>Real Finance for <span style="color:#CF8A00">Potential</span></h1>
            </div>
            <div class="slide">
                <h1>Finance that <span style="color:#CF8A00">Fuels</span> Growth & Success</h1>
            </div>
            <div class="slide">
                <h1><span style="color:#CF8A00">Intelligent</span> Finance with Integrity</h1>
            </div>*/?>
        </div>
    </div>
    <?php
    $html = ob_get_contents(); ob_get_clean();
    return $html;
}

// For JS & CSS Defer Functions
// add_filter( 'script_loader_tag', 'investabill_script_loader_tag_callback', 999, 3 );
function investabill_script_loader_tag_callback( $tag, $handle, $src ) {
    if ( is_admin() ) {
        return $tag;
    } //don't break WP Admin
    if ( false === strpos( $tag, '.js' ) ) {
        return $tag;
    }
    if ( strpos( $tag, 'jquery.js' ) || strpos( $tag, 'jquery.min.js') || strpos( $tag, 'i18n.min.js' ) ||  strpos( $tag, 'jquery-migrate' )) {
        return $tag;
    }
    //In case the website is broken please try uncommenting the line below
    return str_replace( ' src', ' async defer src', $tag );
}

// add_filter( 'style_loader_tag', 'investabill_style_loader_tag_callback', 999, 4 );
function investabill_style_loader_tag_callback( $html, $handle, $href, $media ) {
    // if you experience Cumulative Layout Shift or other ugly loading issue try uncommenting the following:
    // avoid applying the hook on admin panel
    if ( is_admin() ) {
        return $html;
    }
    $html = <<<EOT
<link rel='preload' as='style' onload="this.onload=null;this.rel='stylesheet'" id='$handle' href='$href' type='text/css' media='all' />
<noscript><link rel='stylesheet' id='$handle' href='$href'></noscript>\n\n
EOT;

    return $html;
}

/**
 * Allow SVG Uploads
 *
 * @param array $mimes Mime types keyed by the file extension regex corresponding to those types.
 *
 * @return mixed
 */
add_filter( 'upload_mimes', 'wp_upload_mimes_callback' );
function wp_upload_mimes_callback( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';

    return $mimes;
}