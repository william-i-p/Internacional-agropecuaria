<?php /** @noinspection PhpUndefinedClassInspection */
/**
 * Taber for Elementor
 * Tabs for Elementor editor
 * Exclusively on https://1.envato.market/taber-elementor
 *
 * @encoding        UTF-8
 * @version         1.0.2
 * @copyright       (C) 2018 - 2021 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Nemirovskiy Vitaliy (nemirovskiyvitaliy@gmail.com), Cherviakov Vlad (vladchervjakov@gmail.com), Dmitry Merkulov (dmitry@merkulov.design)
 * @support         help@merkulov.design
 **/

namespace Merkulove\TaberElementor;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

use Elementor\Icons_Manager;
use Exception;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Merkulove\TaberElementor\Unity\Plugin as UnityPlugin;

/** @noinspection PhpUnused */
/**
 * Taber - Custom Elementor Widget.
 **/
class taber_elementor extends Widget_Base {

    /**
     * Use this to sort widgets.
     * A smaller value means earlier initialization of the widget.
     * Can take negative values.
     * Default widgets and widgets from 3rd party developers have 0 $mdp_order
     **/
    public $mdp_order = 1;

    /**
     * Widget base constructor.
     * Initializing the widget base class.
     *
     * @access public
     * @throws Exception If arguments are missing when initializing a full widget instance.
     * @param array      $data Widget data. Default is an empty array.
     * @param array|null $args Optional. Widget default arguments. Default is null.
     *
     * @return void
     **/
    public function __construct( $data = [], $args = null ) {

        parent::__construct( $data, $args );

        wp_register_style( 'mdp-taber-elementor-admin', UnityPlugin::get_url() . 'src/Merkulove/Unity/assets/css/elementor-admin' . UnityPlugin::get_suffix() . '.css', [], UnityPlugin::get_version() );
        wp_register_style( 'mdp-taber-elementor', UnityPlugin::get_url() . 'css/taber-elementor' . UnityPlugin::get_suffix() . '.css', [], UnityPlugin::get_version() );
        wp_register_script( 'mdp-taber-elementor', UnityPlugin::get_url() . 'js/taber-elementor' . UnityPlugin::get_suffix() . '.js', [ 'elementor-frontend' ], UnityPlugin::get_version(), true );

    }

    /**
     * Return a widget name.
     *
     * @return string
     **/
    public function get_name() {

        return 'mdp-taber-elementor';

    }

    /**
     * Return the widget title that will be displayed as the widget label.
     *
     * @return string
     **/
    public function get_title() {

        return esc_html__( 'Taber', 'taber-elementor' );

    }

    /**
     * Set the widget icon.
     *
     * @return string
     */
    public function get_icon() {

        return 'mdp-taber-elementor-widget-icon';

    }

    /**
     * Set the category of the widget.
     *
     * @return array with category names
     **/
    public function get_categories() {

        return [ 'general' ];

    }

    /**
     * Get widget keywords. Retrieve the list of keywords the widget belongs to.
     *
     * @access public
     *
     * @return array Widget keywords.
     **/
    public function get_keywords() {

        return [ 'Merkulove', 'Taber', 'tab', 'expand', 'reveal' ];

    }

    /**
     * Get style dependencies.
     * Retrieve the list of style dependencies the widget requires.
     *
     * @access public
     *
     * @return array Widget styles dependencies.
     **/
    public function get_style_depends() {

        return [ 'mdp-taber-elementor', 'mdp-taber-elementor-admin' ];
    }

	/**
	 * Get script dependencies.
	 * Retrieve the list of script dependencies the element requires.
	 *
	 * @access public
     *
	 * @return array Element scripts dependencies.
	 **/
	public function get_script_depends() {

		return [ 'mdp-taber-elementor' ];

    }

    /**
     * Add the widget controls.
     *
     * @access protected
     * @return void with category names
     **/
    protected function _register_controls() {

        /** Content Tab. */
        $this->tab_content();

        /** Style Tab. */
        $this->tab_style();

    }

    /**
     * Add widget controls on Content tab.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function tab_content() {

        /** Content -> Content Settings Section. */
        $this->section_content_settings();

        /** Content -> General Content Settings Section. */
        $this->section_content_general_settings();
    }

    /**
     * Add widget controls on Style tab.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function tab_style() {

        /** Style -> Section Tab Navigation Style. */
        $this->section_tab_items_style();

        /** Style -> Section Tab Content Style. */
        $this->section_tab_content_style();

        /** Style -> Section Tab Arrow Style. */
        $this->section_tab_arrow_style();

    }

    /**
     * Add widget controls: Content -> Settings Content Section.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_content_settings() {

        $this->start_controls_section( 'section_content_example', [
            'label' => esc_html__( 'Content settings', 'taber-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT
        ] );

	    $this->add_control(
		    'initial_tab',
		    [
			    'label' => esc_html__( 'Initial tab number', 'taber-elementor' ),
			    'type' => Controls_Manager::NUMBER,
			    'min' => 1,
			    'max' => 10,
			    'step' => 1,
			    'default' => 1,
		    ]
	    );

	    $repeater = new Repeater();

        $repeater->start_controls_tabs( 'control_tabs' );

        $repeater->start_controls_tab( 'tab', ['label' => esc_html__( 'TAB', 'taber-elementor' )] );

        $repeater->add_control('tab_title', [
            'label' => esc_html__( 'Title', 'taber-elementor' ),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'dynamic' => [
	            'active' => true,
            ],
            'default' => esc_html__( 'Tab', 'taber-elementor'),
            'placeholder' => esc_html__('Type your title', 'taber-elementor')
        ]);

        $repeater->add_control('icon_type', [
            'label' => esc_html__( 'Icon type', 'taber-elementor' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'none' => [
                    'title' => esc_html__( 'None', 'taber-elementor' ),
                    'icon' => 'fa fa-ban',
                ],
                'icon' => [
                    'title' => esc_html__( 'Icon', 'taber-elementor' ),
                    'icon' => 'fa fa-paint-brush',
                ],
                'image' => [
                    'title' => esc_html__( 'Image', 'taber-elementor' ),
                    'icon' => 'fa fa-image',
                ],
            ],
            'default' => 'none',
            'toggle' => true,
        ]);

        $repeater->add_responsive_control('tab_title_alignment', [
            'label' => esc_html__( 'Alignment', 'taber-elementor' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__( 'Left', 'taber-elementor' ),
                    'icon' => 'fa fa-align-left',
                ],
                'center' => [
                    'title' => esc_html__( 'Center', 'taber-elementor' ),
                    'icon' => 'fa fa-align-center',
                ],
                'flex-end' => [
                    'title' => esc_html__( 'Right', 'taber-elementor' ),
                    'icon' => 'fa fa-align-right',
                ],
            ],
            'selectors' => [
                    '{{WRAPPER}} .mdp-tab-nav-taber{{CURRENT_ITEM}}' => 'justify-content: {{VALUE}};'
            ],
            'default' => 'center',
            'toggle' => true,
        ]);

        $repeater->add_control('tab_icon', [
            'label' => esc_html__( 'Title icon', 'taber-elementor'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-star',
                'library' => 'solid'
            ],
            'condition' => [
                'icon_type' => 'icon'
            ]
        ]);

        $repeater->add_control('tab_image', [
            'label' => esc_html__('Tab image', 'taber-elementor'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'condition' => [
                'icon_type' => 'image'
            ]
        ]);

        $repeater->end_controls_tab();

        $repeater->start_controls_tab('content', ['label' => esc_html__('CONTENT', 'taber-elementor')]);

        $repeater->add_control(
            'tab_content',
            [
                'label' => esc_html__( 'Tab Content', 'taber-elementor' ),
                'dynamic' => [
	                'active' => true,
                ],
                'type' => Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__( 'Type content of your tab here', 'taber-elementor' ),
            ]
        );

        $repeater->end_controls_tabs();

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Tab content', 'taber-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_title' => esc_html__( 'Tab', 'taber-elementor' ),
                        'tab_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'taber-elementor' ),
                    ],
                    [
                        'tab_title' => esc_html__( 'Tab', 'taber-elementor' ),
                        'tab_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'taber-elementor' ),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Add widget controls: Content ->  General Settings Content Section.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_content_general_settings() {

        $this->start_controls_section( 'section_general_controls', [
            'label' => esc_html__( 'General settings', 'taber-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT
        ] );

        $this->add_control(
            'tabs_nav_layout',
            [
                'label' => esc_html__( 'Layout', 'taber-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'mdp-top-nav-tabs mdp-top-left-nav-tabs',
                'options' => [
                    'mdp-top-nav-tabs mdp-top-left-nav-tabs'  => esc_html__( 'Top left', 'taber-elementor' ),
                    'mdp-top-nav-tabs mdp-top-center-nav-tabs'  => esc_html__( 'Top center', 'taber-elementor' ),
                    'mdp-top-nav-tabs mdp-top-right-nav-tabs'  => esc_html__( 'Top right', 'taber-elementor' ),
                    'mdp-bottom-nav-tabs mdp-bottom-left-nav-tabs' => esc_html__( 'Bottom left', 'taber-elementor' ),
                    'mdp-bottom-nav-tabs mdp-bottom-center-nav-tabs' => esc_html__( 'Bottom center', 'taber-elementor' ),
                    'mdp-bottom-nav-tabs mdp-bottom-right-nav-tabs' => esc_html__( 'Bottom right', 'taber-elementor' ),
                    'mdp-left-nav-tabs' => esc_html__( 'Left', 'taber-elementor' ),
                    'mdp-right-nav-tabs' => esc_html__( 'Right', 'taber-elementor' ),
                    'mdp-custom-nav-tabs' => esc_html__( 'Custom', 'taber-elementor' )
                ],
            ]
        );

	    $this->add_responsive_control(
		    'tabs_nav_offset-width',
		    [
			    'label' => esc_html__( 'Tabs width', 'taber-elementor' ),
			    'type' => Controls_Manager::SLIDER,
			    'size_units' => [ 'px', '%' ],
			    'range' => [
				    'px' => [
					    'min' => -500,
					    'max' => 500,
					    'step' => 1,
				    ],
			    ],
			    'default' => [
				    'unit' => '%',
				    'size' => 100,
			    ],
			    'condition' => [
				    'tabs_nav_layout' => 'mdp-custom-nav-tabs'
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .mdp-tabs-nav-taber.mdp-custom-nav-tabs' => 'width: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'tabs_nav_offset-x',
		    [
			    'label' => esc_html__( 'Offset X', 'taber-elementor' ),
			    'type' => Controls_Manager::SLIDER,
			    'size_units' => [ 'px', '%', 'vw' ],
			    'range' => [
				    'px' => [
					    'min' => -500,
					    'max' => 500,
					    'step' => 1,
				    ],
				    '%' => [
					    'min' => -100,
					    'max' => 100,
					    'step' => 1,
				    ],
			    ],
			    'default' => [
				    'unit' => 'px',
				    'size' => 0,
			    ],
			    'condition' => [
				    'tabs_nav_layout' => 'mdp-custom-nav-tabs'
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .mdp-tabs-nav-taber.mdp-custom-nav-tabs' => 'left: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'tabs_nav_offset-y',
		    [
			    'label' => esc_html__( 'Offset Y', 'taber-elementor' ),
			    'type' => Controls_Manager::SLIDER,
			    'size_units' => [ 'px', '%', 'vh' ],
			    'range' => [
				    'px' => [
					    'min' => -500,
					    'max' => 500,
					    'step' => 1,
				    ],
				    '%' => [
					    'min' => -100,
					    'max' => 100,
					    'step' => 1,
				    ],
			    ],
			    'default' => [
				    'unit' => 'px',
				    'size' => 0,
			    ],
			    'condition' => [
				    'tabs_nav_layout' => 'mdp-custom-nav-tabs'
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .mdp-tabs-nav-taber.mdp-custom-nav-tabs' => 'top: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_control(
		    'show_content',
		    [
			    'label' => esc_html__( 'Show content on load', 'taber-elementor' ),
			    'type' => Controls_Manager::SWITCHER,
			    'label_on' => esc_html__( 'Show', 'taber-elementor' ),
			    'label_off' => esc_html__( 'Hide', 'taber-elementor' ),
			    'return_value' => 'yes',
			    'default' => 'yes',
		    ]
	    );

	    $this->add_control(
		    'toggle',
		    [
			    'label' => esc_html__( 'Toggle tabs', 'taber-elementor' ),
			    'type' => Controls_Manager::SWITCHER,
			    'label_on' => esc_html__( 'On', 'taber-elementor' ),
			    'label_off' => esc_html__( 'Off', 'taber-elementor' ),
			    'return_value' => 'on',
			    'default' => '',
		    ]
	    );

        $this->add_control(
            'show_nav_arrow',
            [
                'label' => esc_html__( 'Show arrow', 'taber-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'taber-elementor' ),
                'label_off' => esc_html__( 'Hide', 'taber-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_animation',
            [
                'label' => esc_html__( 'Show animation', 'taber-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'taber-elementor' ),
                'label_off' => esc_html__( 'No', 'taber-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'animationDuration',
            [
                'label' => esc_html__( 'Animation duration', 'taber-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 1,
                ],
                'condition' => [
                    'show_animation' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-content-taber' => 'animation: fade_in_show {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tabs_navigation_one_column_on_mobile',
            [
                'label' => esc_html__( 'One column navigation on mobile', 'taber-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'taber-elementor' ),
                'label_off' => esc_html__( 'No', 'taber-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Add widget controls: Style -> Section Tab Navigation Style.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_tab_items_style() {

        $this->start_controls_section( 'section_tab_style_items', [
            'label' => esc_html__( 'Tab items', 'taber-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE
        ] );

        $this->add_responsive_control(
            'tab_items_margin',
            [
                'label' => esc_html__( 'Margin', 'taber-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-nav-taber' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'tab_items_padding',
            [
                'label' => esc_html__( 'Padding', 'taber-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-nav-taber' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

	    $this->add_control(
		    'separate_margin_bar_bg_section',
		    [
			    'type' => Controls_Manager::DIVIDER,
		    ]
	    );

	    $this->add_control(
		    'bg_heading',
		    [
			    'label' => esc_html__( 'Tabs bar styles', 'taber-elementor' ),
			    'type' => Controls_Manager::HEADING,
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
			    'name' => 'tab_navs_background',
			    'label' => esc_html__( 'Tabs bar background', 'taber-elementor' ),
			    'show_label' => false,
			    'types' => [ 'classic', 'gradient', 'video' ],
			    'selector' => '{{WRAPPER}} .mdp-tabs-nav-taber',
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'tab_navs_border',
			    'label' => esc_html__( 'Tabs bar border', 'taber-elementor' ),
			    'selector' => '{{WRAPPER}} .mdp-tabs-nav-taber',
		    ]
	    );

	    $this->add_responsive_control(
		    'tab_navs_tab_nav_border_radius',
		    [
			    'label' => esc_html__( 'Tabs bar border radius', 'taber-elementor' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%', 'em' ],
			    'selectors' => [
				    '{{WRAPPER}} .mdp-tabs-nav-taber' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

			    ],
		    ]
	    );


	    $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'tab_navs_box',
			    'label' => esc_html__( 'Box Shadow', 'taber-elementor' ),
			    'selector' => '{{WRAPPER}} .mdp-tabs-nav-taber',
		    ]
	    );

	    $this->add_control(
		    'separate_margin_padding_section',
		    [
			    'type' => Controls_Manager::DIVIDER,
		    ]
	    );

	    $this->add_control(
		    'icons_heading',
		    [
			    'label' => esc_html__( 'Icon styles', 'taber-elementor' ),
			    'type' => Controls_Manager::HEADING,
		    ]
	    );

	    $this->add_control(
		    'nav_icon_position',
		    [
			    'label' => esc_html__( 'Icon position', 'taber-elementor' ),
			    'type' => Controls_Manager::SELECT,
			    'default' => 'mdp-left-icon-tabs',
			    'options' => [
				    'mdp-left-icon-tabs'  => esc_html__( 'Left', 'taber-elementor' ),
				    'mdp-right-icon-tabs' => esc_html__('Right', 'taber-elementor'),
				    'mdp-top-left-icon-tabs' => esc_html__( 'Top - Left', 'taber-elementor' ),
				    'mdp-top-center-icon-tabs' => esc_html__( 'Top - Center', 'taber-elementor' ),
				    'mdp-top-right-icon-tabs' => esc_html__( 'Top - Right', 'taber-elementor' ),
				    'mdp-bottom-left-icon-tabs' => esc_html__( 'Bottom - Left', 'taber-elementor' ),
				    'mdp-bottom-center-icon-tabs' => esc_html__( 'Bottom - Center', 'taber-elementor' ),
				    'mdp-bottom-right-icon-tabs' => esc_html__( 'Bottom - Right', 'taber-elementor' ),
			    ],
		    ]
	    );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon size', 'taber-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                        'step' => 1,
                    ],
                    '%' => [
                         'min' => 0,
                         'max' => 100
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-icon-taber' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-nav-img' => 'width: {{SIZE}}{{UNIT}}; object-fit: contain;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_icons_padding',
            [
                'label' => esc_html__( 'Icon padding', 'taber-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-icon-taber' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-nav-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_control(
            'separate_icon_sizing_settings',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

	    $this->add_control(
		    'single_tab_heading',
		    [
			    'label' => esc_html__( 'Single tab styles', 'taber-elementor' ),
			    'type' => Controls_Manager::HEADING,
		    ]
	    );

	    $this->add_responsive_control(
		    'tab_navs_size',
		    [
			    'label' => esc_html__( 'Tab width', 'taber-elementor' ),
			    'type' => Controls_Manager::SLIDER,
			    'size_units' => [ 'px', '%' ],
			    'range' => [
				    'px' => [
					    'min' => 1,
					    'max' => 500,
					    'step' => 1,
				    ],
				    '%' => [
					    'min' => 1,
					    'max' => 100,
					    'step' => 1
				    ]
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .mdp-custom-nav-tabs .mdp-tab-nav-taber' => 'flex-basis: {{SIZE}}{{UNIT}}; flex-grow: 0; flex-shrink: 0;',
				    '{{WRAPPER}} .mdp-top-nav-tabs .mdp-tab-nav-taber, {{WRAPPER}} .mdp-bottom-nav-tabs .mdp-tab-nav-taber' => 'flex-basis: {{SIZE}}{{UNIT}}; flex-grow: 0; flex-shrink: 0;',
				    '{{WRAPPER}} .mdp-left-nav-tabs .mdp-tabs-nav-taber, {{WRAPPER}} .mdp-right-nav-tabs .mdp-tabs-nav-taber' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'taber-elementor' ),
                'scheme' =>  Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .mdp-tab-title-taber',
            ]
        );

	    $this->add_control(
		    'title_nowrap',
		    [
			    'label' => esc_html__( 'Line break', 'taber-elementor' ),
			    'type' => Controls_Manager::SWITCHER,
			    'label_on' => esc_html__( 'On', 'taber-elementor' ),
			    'label_off' => esc_html__( 'Off', 'taber-elementor' ),
			    'return_value' => 'mdp-taber-line-break',
			    'default' => '',
		    ]
	    );

        $this->start_controls_tabs('control_style_tabs');

        $this->start_controls_tab( 'normal_style_tab', ['label' => esc_html__( 'NORMAL', 'taber-elementor' )] );

        $this->add_control(
            'tabs_nav_text_color',
            [
                'label' => esc_html__( 'Color', 'taber-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-title-taber' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mdp-tab-nav-taber .mdp-tab-icon-taber' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background type', 'taber-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .mdp-tab-nav-taber',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_nav_item_normal',
                'label' => esc_html__( 'Border Type', 'taber-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-tab-nav-taber',
            ]
        );

        $this->add_responsive_control(
            'tab_nav_border_radius_normal',
            [
                'label' => esc_html__( 'Border radius', 'taber-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-nav-taber' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_tabs_box_shadow_normal',
                'label' => esc_html__( 'Box Shadow', 'taber-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-tab-nav-taber',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover_style_tab', ['label' => esc_html__( 'HOVER', 'taber-elementor' )] );

        $this->add_control(
            'tabs_nav_text_color_hover',
            [
                'label' => esc_html__( 'Color', 'taber-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-nav-taber:hover > .mdp-tab-title-taber, 
                    {{WRAPPER}} .mdp-tab-nav-taber:hover .mdp-tab-icon-taber' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover',
                'label' => esc_html__( 'Background type', 'taber-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .mdp-tab-nav-taber:hover',
            ]
        );

        $this->add_control(
            'hover_transition',
            [
                'label' => esc_html__( 'Hover transition', 'taber-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-nav-taber' => 'transition: background {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-tab-nav-taber > .mdp-tab-title-taber, 
                     {{WRAPPER}} .mdp-tab-nav-taber:hover .mdp-tab-icon-taber' => 'transition: color {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_nav_item_hover',
                'label' => esc_html__( 'Border Type', 'taber-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-tab-nav-taber:hover',
            ]
        );

        $this->add_responsive_control(
            'tab_nav_border_radius_hover',
            [
                'label' => esc_html__( 'Border radius', 'taber-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-nav-taber:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_tabs_box_shadow_hover',
                'label' => esc_html__( 'Box Shadow', 'taber-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-tab-nav-taber:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('active_style_tab', ['label' => esc_html__('ACTIVE', 'taber-elementor')]);

        $this->add_control(
            'tabs_nav_text_color_active',
            [
                'label' => esc_html__( 'Color', 'taber-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-nav-taber.is-active .mdp-tab-title-taber, {{WRAPPER}} 
                            .mdp-tab-nav-taber.is-active .mdp-tab-icon-taber' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_active',
                'label' => esc_html__( 'Background type', 'taber-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .mdp-tab-nav-taber.is-active',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_nav_item_active',
                'label' => esc_html__( 'Border Type', 'taber-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-tab-nav-taber.is-active',
            ]
        );

        $this->add_responsive_control(
            'tab_nav_border_radius_active',
            [
                'label' => esc_html__( 'Border radius', 'taber-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-nav-taber.is-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_tabs_box_shadow_active',
                'label' => esc_html__( 'Box Shadow', 'taber-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-tab-nav-taber.is-active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

    }

    /**
     * Add widget controls: Style -> Section Tab Content Style.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_tab_content_style() {
        $this->start_controls_section( 'section_tab_style_content', [
            'label' => esc_html__( 'Tab content', 'taber-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE
        ] );

        $this->add_responsive_control(
            'tab_content_margin',
            [
                'label' => esc_html__( 'Margin', 'taber-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-content-taber' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'tab_content_padding',
            [
                'label' => esc_html__( 'Padding', 'taber-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-content-taber' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

	    $this->add_control(
		    'separate_tab_content_margin_padding',
		    [
			    'type' => Controls_Manager::DIVIDER,
		    ]
	    );

	    $this->add_responsive_control(
		    'min_height',
		    [
			    'label' => esc_html__( 'Minimal height', 'taber-elementor' ),
			    'type' => Controls_Manager::SLIDER,
			    'size_units' => [ 'px', 'vh' ],
			    'range' => [
				    'px' => [
					    'min' => 0,
					    'max' => 800,
					    'step' => 10,
				    ],
				    'vh' => [
					    'min' => 0,
					    'max' => 100,
					    'step' => 1,
				    ],
			    ],
			    'default' => [
				    'unit' => 'px',
				    'size' => 0,
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .mdp-tabs-content-taber' => 'min-height: {{SIZE}}{{UNIT}};',
			    ],
			    'condition' => [
				    'equal_height!' => 'yes'
			    ],
		    ]
	    );

	    $this->add_control(
		    'equal_height',
		    [
			    'label' => esc_html__( 'Height at maximum content', 'taber-elementor' ),
			    'type' => Controls_Manager::SWITCHER,
			    'label_on' => esc_html__( 'Yes', 'taber-elementor' ),
			    'label_off' => esc_html__( 'No', 'taber-elementor' ),
			    'return_value' => 'yes',
			    'default' => 'no',
		    ]
	    );

        $this->add_control(
            'separate_tab_content_height',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'tabs_content_text_color',
            [
                'label' => esc_html__( 'Color', 'taber-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-content-taber' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Typography', 'taber-elementor' ),
                'scheme' =>  Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .mdp-tab-content-taber, {{WRAPPER}} .mdp-tab-content-taber p',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_content',
                'label' => esc_html__( 'Background type', 'taber-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .mdp-tab-content-taber',
            ]
        );

        $this->add_control(
            'separate_tab_content_color_background',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_content',
                'label' => esc_html__( 'Border Type', 'taber-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-tab-content-taber',
            ]
        );

        $this->add_responsive_control(
            'tab_content_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'taber-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-tab-content-taber' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_tabs_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'taber-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-tab-content-taber',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Add widget controls: Style -> Section Tab Arrow Style.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_tab_arrow_style() {
        $this->start_controls_section( 'section_arrow_style', [
            'label' => esc_html__( 'Arrow', 'taber-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_nav_arrow' => 'yes'
            ]
        ] );

        $this->add_responsive_control(
            'arrow_size',
            [
                'label' => esc_html__( 'Arrow size', 'taber-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-left-nav-tabs .mdp-arrow' => 'border-width: {{SIZE}}{{UNIT}} !important; 
                                                                    right: -{{SIZE}}{{UNIT}}; 
                                                                    top: calc(50% - {{SIZE}}{{UNIT}}) !important;',
                    '{{WRAPPER}} .mdp-right-nav-tabs .mdp-arrow' => 'border-width: {{SIZE}}{{UNIT}} !important; 
                                                                    left: -{{SIZE}}{{UNIT}}; 
                                                                    top: calc(50% - {{SIZE}}{{UNIT}}) !important;',
                    '{{WRAPPER}} .mdp-top-nav-tabs .mdp-arrow' => 'border-width: {{SIZE}}{{UNIT}} !important;  
                                                                    bottom: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-bottom-nav-tabs .mdp-arrow' => 'border-width: {{SIZE}}{{UNIT}} !important; 
                                                                      top: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-custom-nav-tabs .mdp-arrow' => 'border-width: {{SIZE}}{{UNIT}} !important; bottom: -{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .mdp-custom-nav-tabs .mdp-tabs-nav-taber' => 'padding-bottom: calc({{SIZE}}{{UNIT}} + var(--arrow-spacing));',
                    '{{WRAPPER}} .mdp-top-nav-tabs .mdp-tabs-nav-taber' => 'padding-bottom: calc({{SIZE}}{{UNIT}} + var(--arrow-spacing));',
                    '{{WRAPPER}} .mdp-bottom-nav-tabs .mdp-tabs-nav-taber' => 'padding-top: calc({{SIZE}}{{UNIT}} + var(--arrow-spacing));',
                    '{{WRAPPER}} .mdp-left-nav-tabs .mdp-tabs-nav-taber' => 'margin-right: calc({{SIZE}}{{UNIT}} + var(--arrow-spacing));',
                    '{{WRAPPER}} .mdp-right-nav-tabs .mdp-tabs-nav-taber' => 'margin-left: calc({{SIZE}}{{UNIT}} + var(--arrow-spacing));',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_spacing',
            [
                'label' => esc_html__( 'Arrow spacing', 'taber-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-custom-nav-tabs .mdp-arrow' => 'transform: translate(0, {{SIZE}}{{UNIT}})',
                    '{{WRAPPER}} .mdp-top-nav-tabs .mdp-arrow' => 'transform: translate(-50%, {{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .mdp-bottom-nav-tabs .mdp-arrow' => 'transform: translate(-50%, -{{SIZE}}{{UNIT}})',
                    '{{WRAPPER}} .mdp-left-nav-tabs .mdp-arrow' => 'transform: translate({{SIZE}}{{UNIT}}, 0px);',
                    '{{WRAPPER}} .mdp-right-nav-tabs .mdp-arrow' => 'transform: translate(-{{SIZE}}{{UNIT}}, 0px)',
                    '{{WRAPPER}} .mdp-tabs-nav-taber' => '--arrow-spacing: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'tabs_arrow_color',
            [
                'label' => esc_html__( 'Arrow Color', 'taber-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-custom-nav-tabs .mdp-tab-nav-taber .mdp-arrow' => 'border-top-color: {{VALUE}}',
                    '{{WRAPPER}} .mdp-left-nav-tabs .mdp-tab-nav-taber .mdp-arrow' => 'border-left-color: {{VALUE}}',
                    '{{WRAPPER}} .mdp-right-nav-tabs .mdp-tab-nav-taber .mdp-arrow' => 'border-right-color: {{VALUE}}',
                    '{{WRAPPER}} .mdp-top-nav-tabs .mdp-tab-nav-taber .mdp-arrow' => 'border-top-color: {{VALUE}}',
                    '{{WRAPPER}} .mdp-bottom-nav-tabs .mdp-tab-nav-taber .mdp-arrow' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Tabs navigation block.
     *
     * @access private
     *
     * @param $settings
     * @return void
     */
    private function tabsNavigationRender( $settings ) {
        ?>
        <div class="mdp-tabs-nav-taber <?php esc_attr_e( $settings['tabs_nav_layout'] ) ?> <?php esc_attr_e( $settings['title_nowrap'] );?>">
            <?php if ( $settings['list'] ): ?>
            <div class="mdp-taber-scroll <?php if ( $settings['tabs_navigation_one_column_on_mobile'] === 'yes' ) esc_attr_e( 'mdp-tabs-nav-taber-mobile-one-column' ); ?>">
                <?php foreach ( $settings['list'] as $item ): ?>
                    <div class="mdp-tab-nav-taber elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?> <?php if ( $settings['tabs_navigation_one_column_on_mobile'] === 'yes' ) esc_attr_e( 'mdp-tabs-nav-taber-item-mobile-one-column' ); ?>">
                        <div class="mdp-tab-title-taber <?php echo esc_attr( $settings['nav_icon_position'] ) ?>">
                            <?php if( $item['icon_type'] === 'icon' ): ?>
                            <div class="mdp-tab-icon-taber"><?php Icons_Manager::render_icon( $item['tab_icon'], ['aria-hidden' => true] ) ?></div>
                            <?php endif; ?>
                            <?php if( $item['icon_type'] === 'image' ): ?>
                                <img class="mdp-nav-img" src="<?php echo esc_url( $item['tab_image']['url'] ) ?>" alt="">
                            <?php endif; ?>
                            <span><?php esc_html_e( $item['tab_title'] ) ?></span>
                        </div>
                        <?php if( $settings['show_nav_arrow'] === 'yes' ): ?>
                            <div class="mdp-arrow"></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Tabs content block.
     *
     * @access private
     *
     * @param $settings
     * @return void
     */
    private function tabsContentRender( $settings ) {
        ?>
        <div class="mdp-tabs-content-taber  <?php echo esc_attr( $settings['tabs_nav_layout'] ) ?>">
            <?php if ( $settings['list'] ): ?>

                <?php foreach ( $settings['list'] as $item ): ?>
                    <div class="mdp-tab-content-taber" >
                        <?php echo wp_kses_post( $item['tab_content'] ) ?>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Tabs navigation block for JS Render.
     *
     * @access private
     *
     * @return void
     */
    private function tabsNavigationFrontendRender() {
        ?>
        <div class="mdp-tabs-nav-taber {{{ settings.tabs_nav_layout }}} {{{ settings.title_nowrap }}}">
            <# if ( settings.list ) { #>
            <div class="mdp-taber-scroll <# if ( settings.tabs_navigation_one_column_on_mobile === 'yes' ) { #> mdp-tabs-nav-taber-mobile-one-column <# } #>">
            <# _.each( settings.list, function(item, index) {
            #>
                <div class="mdp-tab-nav-taber elementor-repeater-item-{{{ item._id }}} <# if ( settings.tabs_navigation_one_column_on_mobile === 'yes' ) { #> mdp-tabs-nav-taber-item-mobile-one-column <# } #>">
                    <div class="mdp-tab-title-taber {{{ settings.nav_icon_position }}}">
                        <# if( item.icon_type === 'icon' ) { #>
                        <div class="mdp-tab-icon-taber">
                            <i class="{{{ item.tab_icon.value }}}"></i>
                        </div>
                        <# } #>
                        <# if( item.icon_type === 'image' ) { #>
                        <!--suppress HtmlUnknownTarget -->
                        <img class="mdp-nav-img" src="{{{ item.tab_image.url }}}" alt="">
                        <# } #>
                        <span>{{{ item.tab_title }}}</span>
                    </div>
                    <# if ( settings.show_nav_arrow === 'yes' ) { #>
                    <div class="mdp-arrow"></div>
                    <# } #>
                </div>
            <# }) #>
            </div>
            <# } #>
        </div>
        <?php
    }

    /**
     * Tabs content block for JS Render.
     *
     * @access private
     *
     * @return void
     */
    private function tabsContentFrontendRender() {
        ?>
            <div class="mdp-tabs-content-taber {{{ settings.tabs_nav_layout }}}">
            <# if ( settings.list ) {
            _.each( settings.list, function(item, index) {
            #>
            <div class="mdp-tab-content-taber" >
                {{{ item.tab_content }}}
            </div>
            <# }) #>
            <# } #>
        </div>
        <?php
    }

    /**
     * Render Frontend Output. Generate the final HTML on the frontend.
     *
     * @access protected
     *
     * @return void
     **/
    protected function render() {
        $settings = $this->get_settings_for_display();
        $data_open = $settings[ 'show_content' ] === 'yes' ? $settings['initial_tab'] : '0';
        ?>
        <!-- Start Taber for Elementor WordPress Plugin -->
        <div class="mdp-taber-elementor-box">
            <div class="mdp-tabs-wrapper-taber <?php esc_attr_e( $settings[ 'tabs_nav_layout' ] ) ?>"
                 data-open="<?php esc_attr_e( $data_open ); ?>" data-toggle="<?php esc_attr_e( $settings[ 'toggle' ] ); ?>">
               <?php $this->tabsNavigationRender( $settings ) ?>
               <?php $this->tabsContentRender( $settings ) ?>
            </div>
        </div>
        <!-- End Taber for Elementor WordPress Plugin -->
	    <?php

        if ( is_admin() ) {
	        $widget_hash = substr( hash( 'ripemd160', date('l jS \of F Y h:i:s A') ), rand( 0 , 20 ), 3 ) . rand( 11 , 99 );
        ?>
        <!--suppress JSUnresolvedFunction -->
        <script>
            try {
                taberReady<?php esc_attr_e( $widget_hash ); ?>( mdpTaber.addTabs.bind( mdpTaber ) );
            } catch ( msg ) {
                const taberReady<?php esc_attr_e( $widget_hash ); ?> = ( callback ) => {
                    'loading' !== document.readyState ?
                        callback() :
                        document.addEventListener( 'DOMContentLoaded', callback );
                };
                taberReady<?php esc_attr_e( $widget_hash ); ?>( mdpTaber.addTabs.bind( mdpTaber ) );
            }
        </script>
        <?php
        }

    }

    /**
     * JS Render.
     *
     * @access protected
     *
     * @return void
     **/
    protected function _content_template() {
        ?>
        <div class="mdp-taber-elementor-box">
            <div class="mdp-tabs-wrapper-taber {{{ settings.tabs_nav_layout }}}" data-open="{{{ settings.initial_tab }}}" data-toggle="{{{ settings.toggle }}}">
                <?php $this->tabsNavigationFrontendRender() ?>
                <?php $this->tabsContentFrontendRender() ?>
            </div>
        </div>
        <?php
        if ( is_admin() ) {
	        $widget_hash = substr( hash( 'ripemd160', date('l jS \of F Y h:i:s A') ), rand( 0 , 20 ), 3 ) . rand( 11 , 99 );
        ?>
        <!--suppress JSUnresolvedFunction -->
        <script>
            try {
                taberReady<?php esc_attr_e( $widget_hash ); ?>( mdpTaber.addTabs.bind( mdpTaber ) );
            } catch ( msg ) {
                const taberReady<?php esc_attr_e( $widget_hash ); ?> = ( callback ) => {
                    'loading' !== document.readyState ?
                        callback() :
                        document.addEventListener( 'DOMContentLoaded', callback );
                };
                taberReady<?php esc_attr_e( $widget_hash ); ?>( mdpTaber.addTabs.bind( mdpTaber ) );
            }
        </script>
        <?php
        }
    }

    /**
     * Return link for documentation
     * Used to add stuff after widget
     *
     * @access public
     *
     * @return string
     **/
    public function get_custom_help_url() {

        return 'https://docs.merkulov.design/tag/taber';

    }

}
