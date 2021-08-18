<?php

namespace HTSliderPro;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Widgets Control
*/
if(!class_exists('Widgets_Control')){
    class Widgets_Control{
        
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

            // image size
            add_action( 'after_setup_theme', [ $this, 'control_image_size' ] );
            // Register custom category
            add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
            // Init Widgets
            add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

        }

        //add image size
        public function control_image_size(){
            add_image_size( 'htliser_size_396x360', 396, 360, true );
            add_image_size( 'htslider_size_1170x536', 1170, 536, true );
        }

        // Add custom category.
        public function add_category( $elements_manager ) {
            $elements_manager->add_category(
                'htslider-pro',
                [
                   'title'  => esc_html__( 'HTSlider Pro','htslider-pro'),
                    'icon' => 'font',
                ]
            );
        }

        // Widgets Register
        public function init_widgets(){

            $hsliderpro_element  = array(
                'htslider_post_addons',
                'htslider_addons',
            );

            foreach ( $hsliderpro_element as $element ){
                if ( file_exists( HTSLIDER_PRO_PL_INCLUDE.'addons/'.$element.'.php' ) ){
                    require_once ( HTSLIDER_PRO_PL_INCLUDE.'addons/'.$element.'.php' );
                }
            }

         
            
        }


    }

    Widgets_Control::instance();

}