<?php
namespace HTSliderPro;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
* Base
*/
class Base {

    const MINIMUM_ELEMENTOR_VERSION = '2.5.0';
    const MINIMUM_PHP_VERSION = '7.0';
    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    public function __construct() {
        if ( ! function_exists('is_plugin_active')){ include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); }
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
        add_filter( 'single_template', [ $this,'htslider_canvas_template'] );
        add_action( 'admin_menu', [ $this, 'admin_menu' ], 225 );
    }
    public function i18n() {
        load_plugin_textdomain( 'htslider-pro', false, dirname( plugin_basename( HTSLIDER_PRO_PL_ROOT ) ) . '/languages/' );

    }
     public function init() {

        // ht slider for elementor Plugin
        if( is_plugin_active('ht-slider-for-elementor/ht-slider-for-elementor.php') ){
            add_action( 'admin_init', [ $this, 'plugins_deactivate' ] );
            add_action( 'admin_notices', [ $this, 'htslider_pro_notice' ] );
            return;
        }


        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }
        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        // Plugins Required File
        $this->include_files();

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }
        
        // Plugins Setting Page
        add_filter('plugin_action_links_'.HTSLIDER_PRO_PLUGIN_BASE, [ $this, 'plugins_setting_links' ] );

    }


    /*
    * Check Plugins is Installed or not
    */
    public function is_plugins_active( $pl_file_path = NULL ){
        $installed_plugins_list = get_plugins();
        return isset( $installed_plugins_list[$pl_file_path] );
    }

    /**
     * Admin notice.
     * For missing elementor.
     */
    public function admin_notice_missing_main_plugin() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $elementor = 'elementor/elementor.php';
        if( $this->is_plugins_active( $elementor ) ) {
            if( ! current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );
            $message = sprintf( esc_html__( '%1$sHT Slider Addons for Elementor%2$s requires %1$s"Elementor"%2$s plugin to be active. Please activate Elementor to continue.', 'htslider-pro' ), '<strong>', '</strong>' );
            $button_text = esc_html__( 'Activate Elementor', 'htslider-pro' );
        } else {
            if( ! current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
            $message = sprintf( esc_html__( '%1$sHT Slider Addons for Elementor%2$s requires %1$s"Elementor"%2$s plugin to be installed and activated. Please install Elementor to continue.', 'htslider-pro' ), '<strong>', '</strong>' );
            $button_text = esc_html__( 'Install Elementor', 'htslider-pro' );
        }
        $button = '<p><a href="' . $activation_url . '" class="button-primary">' . $button_text . '</a></p>';
        printf( '<div class="error"><p>%1$s</p>%2$s</div>', $message, $button );
    }

    /**
     * Admin notice.
     * For elementor version.
     */

    public function admin_notice_minimum_elementor_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'htslider-pro' ),
            '<strong>' . esc_html__( 'HT Slider Addons for Elementor', 'htslider-pro' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'htslider-pro' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    /**
     * Admin notice.
     * For php version.
     */

    public function admin_notice_minimum_php_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'htslider-pro' ),
            '<strong>' . esc_html__( 'HT Slider Addons', 'htslider-pro' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'htslider-pro' ) . '</strong>',
             self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    // ht slider Lite Notice
    public function htslider_pro_notice() {
        echo '<div class="notice notice-warning"><p>' . esc_html__( 'Please deactivate HT Slider for elementor before activating HT htslider.', 'htslider-pro' ) . '</p></div>';
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }

    // Plugins Deactive
    public function plugins_deactivate() {
        deactivate_plugins( 'ht-slider-for-elementor/ht-slider-for-elementor.php' );
    }


    /* 
    * Add settings link on plugin page.
    */
    public function plugins_setting_links( $links ) {
        $settings_link = '<a href="'.admin_url('edit.php?post_type=htslider_slider').'">'.esc_html__( 'Settings', 'htslider-pro' ).'</a>'; 
        array_unshift( $links, $settings_link );
        return $links; 
    }



    //Slider Post template
    public function htslider_canvas_template( $single_template ) {
        global $post;
        if ( 'htslider_slider' == $post->post_type ) {
            $elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';
            if ( file_exists( $elementor_2_0_canvas ) ) {
                return $elementor_2_0_canvas;
            } else {
                return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
            }
        }
        return $single_template;
    }


    /*
    *admin menu
    */
    public function admin_menu(){
        $menu = 'add_menu_' . 'page';
        $menu(
            'htslider_panel',
            esc_html__( 'HT Slider Pro', 'htslider-pro' ),
            'read',
            'htslider_page',
            NULL,
            'dashicons-welcome-view-site',
            90
        );
    }




    public function include_files() {
        require( HTSLIDER_PRO_PL_INCLUDE.'helpers_function.php' );
        require( HTSLIDER_PRO_PL_PATH.'classes/class.assest_management.php' );
        require( HTSLIDER_PRO_PL_PATH.'classes/class.widgets_control.php' );
        include( HTSLIDER_PRO_PL_INCLUDE.'class.htslider-icon-manager.php' );
        include( HTSLIDER_PRO_PL_INCLUDE.'custom-post-type.php' );
        include( HTSLIDER_PRO_PL_INCLUDE.'/admin/template-library.php' );
        
        include( HTSLIDER_PRO_PL_INCLUDE.'/licence/HTSliderPro.php' );

    }

}
Base::instance();
