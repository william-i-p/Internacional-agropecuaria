<?php

namespace HTSliderPro;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Assest Management
*/
if(!class_exists('Assets_Management')){
    class Assets_Management{
        
        private static $instance = null;
        public static function instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        function __construct(){
            $this->init();
        }

        public function init() {

            // Register Scripts
            add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
            // Frontend Scripts
            add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ] );
            add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'widgets_editor_controls' ] );

        }

        // conditions fields add
        public function widgets_editor_controls(){
            wp_enqueue_script( 'eidtor-contorls', HTSLIDER_PRO_PL_ASSETS . '/js/editor-controls.js',array('jquery'), HTSLIDER_PRO_VERSION, TRUE );
        }

        // Register frontend scripts
        public function register_scripts(){
            // Register Css file
            wp_register_style(
                'htslider-widgets',
                HTSLIDER_PRO_PL_ASSETS . 'css/htslider-widgets.css',
                array(),
                HTSLIDER_PRO_VERSION
            );

            // Register JS file
            wp_register_script(
                'slick',
                HTSLIDER_PRO_PL_ASSETS . 'js/slick.min.js',
                array('jquery'),
                HTSLIDER_PRO_VERSION,
                TRUE
            );
            wp_register_script(
                'htsliderpro-widgets-scripts',
                HTSLIDER_PRO_PL_ASSETS . 'js/htslider-widgets.js',
                array('jquery'),
                HTSLIDER_PRO_VERSION,
                TRUE
            );

        }

        // Enqueue frontend scripts
        public function enqueue_frontend_scripts() {
            wp_register_style( 'slick', HTSLIDER_PRO_PL_ASSETS . 'css/slick.min.css', array(), HTSLIDER_PRO_VERSION );
            // CSS File
            wp_enqueue_style( 'htslider-widgets' );
            wp_enqueue_style( 'htslider-animate', HTSLIDER_PRO_PL_ASSETS . 'css/animate.css', HTSLIDER_PRO_VERSION );

        }
     

    }

    Assets_Management::instance();
}