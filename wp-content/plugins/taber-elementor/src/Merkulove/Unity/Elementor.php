<?php
/**
 * Taber for Elementor
 * Customizable tabs for Elementor editor
 * Exclusively on https://1.envato.market/taber-elementor
 *
 * @encoding        UTF-8
 * @version         1.0.2
 * @copyright       (C) 2018 - 2021 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Nemirovskiy Vitaliy (nemirovskiyvitaliy@gmail.com), Cherviakov Vlad (vladchervjakov@gmail.com), Dmitry Merkulov (dmitry@merkulov.design)
 * @support         help@merkulov.design
 **/

namespace Merkulove\TaberElementor\Unity;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * Class to implement Elementor Widget.
 *
 * @since 1.0.0
 *
 **/
final class Elementor {

	/**
	 * The one true Elementor.
	 *
	 * @var Elementor
	 **/
	private static $instance;

    /**
     * Setup the Unity.
     *
     * @since  1.0.0
     * @access public
     *
     * @return void
     **/
    public function setup() {

        /** Define hooks that runs on both the front-end as well as the dashboard. */
        $this->both_hooks();

        /** Define public hooks. */
        $this->public_hooks();

        /** Define admin hooks. */
        $this->admin_hooks();

    }

    /**
     * Define hooks that runs on both the front-end as well as the dashboard.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function both_hooks() {

        /** Register Elementor Widgets. */
        $this->register_elementor_widgets();

    }

    /**
     * Registers a Elementor Widget.
     *
     * @return void
     * @access public
     **/
    public function register_elementor_widgets() {

        /** Check for basic requirements. */
        $this->initialization();

        /** Elementor widget Editor CSS. */
        add_action( 'elementor/editor/before_enqueue_styles', [$this, 'editor_styles'] );

    }

    /**
     * Register all of the hooks related to the public-facing functionality.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function public_hooks() {

        /** Work only on frontend area. */
        if ( is_admin() ) { return; }

        /** Public hooks and filters. */

    }

    /**
     * Register all of the hooks related to the admin area functionality.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function admin_hooks() {

        /** Work only in admin area. */
        if ( ! is_admin() ) { return; }

        /** Admin hooks and filters here. */

    }

	/**
	 * Add our css to admin editor.
	 *
	 * @access public
	 **/
	public function editor_styles() {

		wp_enqueue_style( 'mdp-taber-elementor-admin', Plugin::get_url() . 'src/Merkulove/Unity/assets/css/elementor-admin' . Plugin::get_suffix() . '.css', [], Plugin::get_version() );

	}

	/**
	 * The init process check for basic requirements and then then run the plugin logic.
	 *
	 * @access public
	 **/
	public function initialization() {

		/** Check if Elementor installed and activated. */
		if ( ! did_action( 'elementor/loaded' ) ) { return; }

		/** Register custom widgets. */
		add_action( 'elementor/widgets/widgets_registered', [$this, 'register_widgets'] );

	}

	/**
	 * Register new Elementor widgets.
	 *
	 * @access public
     * @since 1.0.0
     *
     * @return void
     **/
	public function register_widgets() {

		/** Load and register Elementor widgets. */
		$path = Plugin::get_path() . 'src/Merkulove/TaberElementor/Elementor/widgets/';

		foreach ( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $path ) ) as $filename ) {

			if ( substr( $filename, -4 ) === '.php' ) {

				/** @noinspection PhpIncludeInspection */
				require_once $filename;

				/** Prepare class name from file. */
				$widget_class = $filename->getBasename( '.php' );
				$widget_class = str_replace( '.', '_', $widget_class );

				/** Add Namespace. */
                $widget_class = 'Merkulove\TaberElementor\\' . $widget_class;

                /** Instantiate widget and register it in Elementor. */
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $widget_class() );

			}

		}

        /** Sort our widgets inside Category. */
        $this->sort_widgets();

	}

    /**
     * Sort our widgets inside Category.
     *
     * @access public
     * @since 1.0.0
     *
     * @return void
     **/
	private function sort_widgets() {

	    /** Get Widget Manager. */
        $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

        /** Retrieve all registered widgets. */
        $widget_types = $widgets_manager->get_widget_types();

        /** Collection of widget classes and initialisation order. */
        $new_order = [];

        foreach ( $widget_types as $key => $widget_type ) {

            /** Get widget class name. */
            $widget_class = get_class( $widget_type );

            /** Skip this widget, it cause warning on reinitialisation */
            if ( 'Elementor\Widget_WordPress' === $widget_class ) { continue; }

            /** Get widget order. */
            /** @noinspection PhpPossiblePolymorphicInvocationInspection */
            $order = property_exists( $widget_type, 'mdp_order' ) ? $widget_type->mdp_order : 0;

            /** Remember class and order. */
            $new_order[$widget_class] = $order;

            /** Unregister all widgets. */
            $widgets_manager->unregister_widget_type( $key );

        }

        /** Sort widgets by mdp_order. */
        asort( $new_order );

        /** Instantiate widgets in correct order. */
        foreach ( $new_order as $class => $o ) {
            $widgets_manager->register_widget_type( new $class );
        }

    }

	/**
	 * Main Elementor Instance.
	 *
	 * Insures that only one instance of Elementor exists in memory at any one time.
	 *
	 * @static
     *
	 * @return Elementor
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

}