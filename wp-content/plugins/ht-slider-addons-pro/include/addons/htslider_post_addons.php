<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class HTSlider_Elementor_Widget_Post_Slider extends Widget_Base {

    public function get_name() {
        return 'htslider-postslider-addons';
    }
    
    public function get_title() {
        return esc_html__( 'HT: Slider Post Slider', 'htslider-pro' );
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return [ 'htslider-pro' ];
    }

    public function get_script_depends() {
        return [
            'slick',
            'htsliderpro-widgets-scripts',
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'post_slider_content',
            [
                'label' => esc_html__( 'Post Slider', 'htslider-pro' ),
            ]
        );

            $this->add_control(
                'post_slider_layout',
                [
                    'label'   => esc_html__( 'Layout', 'htslider-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1'   => esc_html__( 'Layout One', 'htslider-pro' ),
                        '2'   => esc_html__( 'Layout Two', 'htslider-pro' ),
                        '3'   => esc_html__( 'Layout Three', 'htslider-pro' ),
                        '4'   => esc_html__( 'Layout Four', 'htslider-pro' ),
                        '5'   => esc_html__( 'Layout Five', 'htslider-pro' ),
                    ],
                ]
            );
            
        $this->end_controls_section();

        // Post Option Start
        $this->start_controls_section(
            'post_content_option',
            [
                'label' => esc_html__( 'Post Option', 'htslider-pro' ),
            ]
        );
            
            $this->add_control(
                'slider_post_type',
                [
                    'label'         => esc_html__( 'Content Sourse', 'htslider-pro' ),
                    'type'          => Controls_Manager::SELECT2,
                    'label_block'   => false,
                    'options'       => htslider_get_post_types(),
                ]
            );

            $this->add_control(
                'slider_categories',
                [
                    'label'                => esc_html__( 'Categories', 'htslider-pro' ),
                    'type'                 => Controls_Manager::SELECT2,
                    'label_block'          => true,
                    'multiple'             => true,
                    'options'              => htslider_get_taxonomies(),
                    'condition'            =>[
                        'slider_post_type' => 'post',
                    ]
                ]
            );

            $this->add_control(
                'slider_prod_categories',
                [
                    'label'                => esc_html__( 'Categories', 'htslider-pro' ),
                    'type'                 => Controls_Manager::SELECT2,
                    'label_block'          => true,
                    'multiple'             => true,
                    'options'              => htslider_get_taxonomies('product_cat'),
                    'condition'            =>[
                        'slider_post_type' => 'product',
                    ]
                ]
            );

            $this->add_control(
                'post_limit',
                [
                    'label'         => esc_html__('Limit', 'htslider-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'default'       => 5,
                    'separator'     =>'before',
                ]
            );

            $this->add_control(
                'custom_order',
                [
                    'label'         => esc_html__( 'Custom order', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'no',
                ]
            );

            $this->add_control(
                'postorder',
                [
                    'label'             => esc_html__( 'Order', 'htslider-pro' ),
                    'type'              => Controls_Manager::SELECT,
                    'default'           => 'DESC',
                    'options'           => [
                        'DESC'          => esc_html__('Descending','htslider-pro'),
                        'ASC'           => esc_html__('Ascending','htslider-pro'),
                    ],
                    'condition'         => [
                        'custom_order!' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'orderby',
                [
                    'label'     => esc_html__( 'Orderby', 'htslider-pro' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'none',
                    'options'   => [
                        'none'          => esc_html__('None','htslider-pro'),
                        'ID'            => esc_html__('ID','htslider-pro'),
                        'date'          => esc_html__('Date','htslider-pro'),
                        'name'          => esc_html__('Name','htslider-pro'),
                        'title'         => esc_html__('Title','htslider-pro'),
                        'comment_count' => esc_html__('Comment count','htslider-pro'),
                        'rand'          => esc_html__('Random','htslider-pro'),
                    ],
                    'condition'         => [
                        'custom_order'  => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_title',
                [
                    'label'         => esc_html__( 'Title', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'yes',
                    'separator'     =>'before',
                ]
            );

            $this->add_control(
                'title_length',
                [
                    'label'          => esc_html__( 'Title Length', 'htslider-pro' ),
                    'type'           => Controls_Manager::NUMBER,
                    'step'           => 1,
                    'default'        => 5,
                    'condition'      =>[
                        'show_title' =>'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_content',
                [
                    'label'         => esc_html__( 'Content', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'yes',
                ]
            );

            $this->add_control(
                'content_length',
                [
                    'label'             => esc_html__( 'Content Length', 'htslider-pro' ),
                    'type'              => Controls_Manager::NUMBER,
                    'step'              => 1,
                    'default'           => 20,
                    'condition'         =>[
                        'show_content'  =>'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_read_more_btn',
                [
                    'label'         => esc_html__( 'Read More', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'yes',
                ]
            );

            $this->add_control(
                'read_more_txt',
                [
                    'label'                 => esc_html__( 'Read More button text', 'htslider-pro' ),
                    'type'                  => Controls_Manager::TEXT,
                    'default'               => esc_html__( 'Read More', 'htslider-pro' ),
                    'placeholder'           => esc_html__( 'Read More', 'htslider-pro' ),
                    'condition'             =>[
                        'show_read_more_btn'=>'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_category',
                [
                    'label'         => esc_html__( 'Category', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'yes',
                ]
            );

            $this->add_control(
                'show_author',
                [
                    'label'         => esc_html__( 'Author', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'yes',
                ]
            );

            $this->add_control(
                'show_date',
                [
                    'label'         => esc_html__( 'Date', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'yes',
                    'separator'     =>'after',
                ]
            );

            $this->add_control(
                'slider_on',
                [
                    'label'         => esc_html__( 'Slider', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => esc_html__( 'On', 'htslider-pro' ),
                    'label_off'     => esc_html__( 'Off', 'htslider-pro' ),
                    'return_value'  => 'yes',
                    'default'       => 'yes',
                ]
            );

        $this->end_controls_section(); // Content Option End

        // Slider setting
        $this->start_controls_section(
            'slider_option',
            [
                'label'         => esc_html__( 'Slider Option', 'htslider-pro' ),
                'condition'     => [
                    'slider_on' => 'yes',
                ]
            ]
        );

            $this->add_control(
                'slitems',
                [
                    'label'         => esc_html__( 'Slider Items', 'htslider-pro' ),
                    'type'          => Controls_Manager::NUMBER,
                    'min'           => 1,
                    'max'           => 20,
                    'step'          => 1,
                    'default'       => 1,
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slarrows',
                [
                    'label'         => esc_html__( 'Slider Arrow', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'yes',
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slprevicon',
                [
                    'label'         => esc_html__( 'Previous icon', 'htslider-pro' ),
                    'type'          => Controls_Manager::ICONS,
                    'default'       => [
                        'value'     => 'fas fa-angle-left',
                        'library'   => 'solid',
                    ],
                    'condition'     => [
                        'slider_on' => 'yes',
                        'slarrows'  => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slnexticon',
                [
                    'label'         => esc_html__( 'Next icon', 'htslider-pro' ),
                    'type'          => Controls_Manager::ICONS,
                    'default'       => [
                        'value'     => 'fas fa-angle-right',
                        'library'   => 'solid',
                    ],
                    'condition'     => [
                        'slider_on' => 'yes',
                        'slarrows'  => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sldots',
                [
                    'label'         => esc_html__( 'Slider dots', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'no',
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slpagination',
                [
                    'label'         => esc_html__( 'Slider Pagination', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'no',
                    'condition'     => [
                        'sldots'    => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slpause_on_hover',
                [
                    'type'              => Controls_Manager::SWITCHER,
                    'label_off'         => esc_html__('No', 'htslider-pro'),
                    'label_on'          => esc_html__('Yes', 'htslider-pro'),
                    'return_value'      => 'yes',
                    'default'           => 'yes',
                    'label'             => esc_html__('Pause on Hover?', 'htslider-pro'),
                    'condition'         => [
                        'slider_on'     => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcentermode',
                [
                    'label'         => esc_html__( 'Center Mode', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'default'       => 'no',
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcenterpadding',
                [
                    'label'             => esc_html__( 'Center padding', 'htslider-pro' ),
                    'type'              => Controls_Manager::NUMBER,
                    'min'               => 0,
                    'max'               => 500,
                    'step'              => 1,
                    'default'           => 50,
                    'condition'         => [
                        'slider_on'     => 'yes',
                        'slcentermode'  => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautolay',
                [
                    'label'         => esc_html__( 'Slider auto play', 'htslider-pro' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'yes',
                    'separator'     => 'before',
                    'default'       => 'no',
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautoplay_speed',
                [
                    'label'         => esc_html__('Autoplay speed', 'htslider-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'default'       => 3000,
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );


            $this->add_control(
                'slanimation_speed',
                [
                    'label'         => esc_html__('Autoplay animation speed', 'htslider-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'default'       => 300,
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slscroll_columns',
                [
                    'label'         => esc_html__('Slider item to scroll', 'htslider-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'min'           => 1,
                    'max'           => 10,
                    'step'          => 1,
                    'default'       => 1,
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_tablet',
                [
                    'label'         => esc_html__( 'Tablet', 'htslider-pro' ),
                    'type'          => Controls_Manager::HEADING,
                    'separator'     => 'after',
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_display_columns',
                [
                    'label'         => esc_html__('Slider Items', 'htslider-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'min'           => 1,
                    'max'           => 8,
                    'step'          => 1,
                    'default'       => 1,
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_scroll_columns',
                [
                    'label'         => esc_html__('Slider item to scroll', 'htslider-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'min'           => 1,
                    'max'           => 8,
                    'step'          => 1,
                    'default'       => 1,
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_width',
                [
                    'label'         => esc_html__('Tablet Resolution', 'htslider-pro'),
                    'description'   => esc_html__('The resolution to tablet.', 'htslider-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'default'       => 750,
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_mobile',
                [
                    'label'         => esc_html__( 'Mobile Phone', 'htslider-pro' ),
                    'type'          => Controls_Manager::HEADING,
                    'separator'     => 'after',
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_display_columns',
                [
                    'label'         => esc_html__('Slider Items', 'htslider-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'min'           => 1,
                    'max'           => 4,
                    'step'          => 1,
                    'default'       => 1,
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_scroll_columns',
                [
                    'label'         => esc_html__('Slider item to scroll', 'htslider-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'min'           => 1,
                    'max'           => 4,
                    'step'          => 1,
                    'default'       => 1,
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_width',
                [
                    'label'         => esc_html__('Mobile Resolution', 'htslider-pro'),
                    'description'   => esc_html__('The resolution to mobile.', 'htslider-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'default'       => 480,
                    'condition'     => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

        $this->end_controls_section(); // Slider Option end

        //content area
        $this->start_controls_section(
            'post_slider_content_area_style_section',
            [
                'label'     => esc_html__( 'Content Area', 'htslider-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'post_slider_layout'=> array( '1', '4'),
                ]
            ]
        );

            $this->add_control(
                'content_area',
                [
                    'label'     => esc_html__( 'Background', 'htslider-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htslider-postslider-layout-1 .content .post-inner' => 'background: {{VALUE}}',
                        '{{WRAPPER}} .htslider-postslider-layout-4 .content .post-inner' => 'background: {{VALUE}}',
                    ],
                ]
            );


            $this->add_responsive_control(
                'content1_position',
                [
                    'label'     => esc_html__( 'Content Postion', 'htslider-pro' ),
                    'type'      => Controls_Manager::SLIDER,
                    'condition' => [
                    'post_slider_layout'=> '1',
                    ],
                    'size_units' => [ 'px', '%' ],
                    'default'    => [
                        'size'   => 0,
                        'unit'   => '%',
                    ],
                    'range'  => [
                        'px' => [
                            'min' => 0,
                            'max' => 670,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 60,
                        ],
                    ],
                    'selectors' => [
                         '{{WRAPPER}} .htslider-postslider-layout-1 .content' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

              //contetn postition
            $this->add_control(
                'content4_position',
                [
                    'label'     => esc_html__( 'Content Postion', 'htslider-pro' ),
                    'type'      => Controls_Manager::POPOVER_TOGGLE,
                    'condition' =>[
                        'post_slider_layout'=> '4',
                    ]
                ]
            );
            $this->start_popover();
                $this->add_responsive_control(
                    'content4_x_position',
                    [
                        'label' => esc_html__( 'Horizontal Postion', 'htslider-pro' ),
                        'type'  => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'default'  => [
                            'size' => 0,
                            'unit' => '%',
                        ],
                        'range'  => [
                            'px' => [
                                'min' => 0,
                                'max' => 450,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 40,
                            ],
                        ],
                        'selectors' => [
                             '{{WRAPPER}} .htslider-postslider-layout-4 .content' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'content4_y_position',
                    [
                        'label' => esc_html__( 'Vertical Postion', 'htslider-pro' ),
                        'type'  => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'default'  => [
                            'size' => 0,
                            'unit' => '%',
                        ],
                        'range'   => [
                             'px' => [
                                'min' => 0,
                                'max' => 240,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 50,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .htslider-postslider-layout-4 .content' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

            $this->end_popover();

        $this->end_controls_section();

        // Style Title tab section
        $this->start_controls_section(
            'post_slider_title_style_section',
            [
                'label'         => esc_html__( 'Title', 'htslider-pro' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     =>[
                    'show_title'=>'yes',
                ]
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label'     => esc_html__( 'Color', 'htslider-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   =>'#18012c',
                    'selectors' => [
                        '{{WRAPPER}} .htslider-single-post-slide .content .post-inner h2 a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'title_typography',
                    'label'     => esc_html__( 'Typography', 'htslider-pro' ),
                    'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'  => '{{WRAPPER}} .htslider-single-post-slide .content .post-inner h2',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label'         => esc_html__( 'Margin', 'htslider-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', '%', 'em' ],
                    'selectors'     => [
                        '{{WRAPPER}} .htslider-single-post-slide .content .post-inner h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label'         => esc_html__( 'Padding', 'htslider-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', '%', 'em' ],
                    'selectors'     => [
                        '{{WRAPPER}} .htslider-single-post-slide .content .post-inner h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_align',
                [
                    'label'     => esc_html__( 'Alignment', 'htslider-pro' ),
                    'type'      => Controls_Manager::CHOOSE,
                    'options'   => [
                        'left'  => [
                            'title' => esc_html__( 'Left', 'htslider-pro' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'htslider-pro' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'htslider-pro' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => esc_html__( 'Justified', 'htslider-pro' ),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htslider-single-post-slide .content .post-inner h2' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Content tab section
        $this->start_controls_section(
            'post_slider_content_style_section',
            [
                'label' => esc_html__( 'Content', 'htslider-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_content'=>'yes',
                ]
            ]
        );
            $this->add_control(
                'content_color',
                [
                    'label'         => esc_html__( 'Color', 'htslider-pro' ),
                    'type'          => Controls_Manager::COLOR,
                    'default'       =>'#18012c',
                    'selectors'     => [
                        '{{WRAPPER}} .htslider-single-post-slide .content .post-inner p' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'content_typography',
                    'label'     => esc_html__( 'Typography', 'htslider-pro' ),
                    'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'  => '{{WRAPPER}} .htslider-single-post-slide .content .post-inner p',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label'         => esc_html__( 'Margin', 'htslider-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', '%', 'em' ],
                    'selectors'     => [
                        '{{WRAPPER}} .htslider-single-post-slide .content .post-inner p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label'         => esc_html__( 'Padding', 'htslider-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', '%', 'em' ],
                    'selectors'     => [
                        '{{WRAPPER}} .htslider-single-post-slide .content .post-inner p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_align',
                [
                    'label'     => esc_html__( 'Alignment', 'htslider-pro' ),
                    'type'      => Controls_Manager::CHOOSE,
                    'options'   => [
                        'left'  => [
                            'title' => esc_html__( 'Left', 'htslider-pro' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'htslider-pro' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'htslider-pro' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => esc_html__( 'Justified', 'htslider-pro' ),
                            'icon'  => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htslider-single-post-slide .content .post-inner p' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Category tab section
        $this->start_controls_section(
            'post_slider_category_style_section',
            [
                'label'             => esc_html__( 'Category', 'htslider-pro' ),
                'tab'               => Controls_Manager::TAB_STYLE,
                'condition'         =>[
                    'show_category' =>'yes',
                ]
            ]
        );
            
            $this->start_controls_tabs('category_style_tabs');

                $this->start_controls_tab(
                    'category_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'htslider-pro' ),
                    ]
                );

                    $this->add_control(
                        'category_color',
                        [
                            'label'     => esc_html__( 'Color', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   =>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .htslider-single-post-slide .content ul.post-category li a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name'      => 'category_typography',
                            'label'     => esc_html__( 'Typography', 'htslider-pro' ),
                            'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .htslider-single-post-slide .content ul.post-category li a',
                        ]
                    );

                    $this->add_responsive_control(
                        'category_margin',
                        [
                            'label' => esc_html__( 'Margin', 'htslider-pro' ),
                            'type'  => Controls_Manager::DIMENSIONS,
                            'size_units'    => [ 'px', '%', 'em' ],
                            'selectors'     => [
                                '{{WRAPPER}} .htslider-single-post-slide .content ul.post-category li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'category_padding',
                        [
                            'label'         => __( 'Padding', 'htslider-pro' ),
                            'type'          => Controls_Manager::DIMENSIONS,
                            'size_units'    => [ 'px', '%', 'em' ],
                            'selectors'     => [
                                '{{WRAPPER}} .htslider-single-post-slide .content ul.post-category li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'category_background',
                            'label'     => __( 'Background', 'htslider-pro' ),
                            'types'     => [ 'classic', 'gradient' ],
                            'selector'  => '{{WRAPPER}} .htslider-single-post-slide .content ul.post-category li a',
                        ]
                    );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'category_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'htslider-pro' ),
                    ]
                );
                    $this->add_control(
                        'category_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'htslider-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .htslider-single-post-slide .content ul.post-category li a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'category_hover_background',
                            'label' => esc_html__( 'Background', 'htslider-pro' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htslider-single-post-slide .content ul.post-category li a:hover',
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Meta tab section
        $this->start_controls_section(
            'post_meta_style_section',
            [
                'label' => esc_html__( 'Meta', 'htslider-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'meta_color',
                [
                    'label' => esc_html__( 'Color', 'htslider-pro' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#18012c',
                    'selectors' => [
                        '{{WRAPPER}} .htslider-single-post-slide ul.meta' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .htslider-single-post-slide .content .post-inner ul.meta li a' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .htslider-postslider-layout-3 .content .post-inner ul.meta li' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .htslider-postslider-layout-4 .content .post-inner ul.meta li' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'meta_typography',
                    'label' => esc_html__( 'Typography', 'htslider-pro' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htslider-single-post-slide ul.meta',
                ]
            );

            $this->add_responsive_control(
                'meta_margin',
                [
                    'label' => esc_html__( 'Margin', 'htslider-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htslider-single-post-slide ul.meta li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_padding',
                [
                    'label' => esc_html__( 'Padding', 'htslider-pro' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htslider-single-post-slide ul.meta li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_align',
                [
                    'label' => esc_html__( 'Alignment', 'htslider-pro' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Left', 'htslider-pro' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'htslider-pro' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Right', 'htslider-pro' ),
                            'icon' => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => esc_html__( 'Justified', 'htslider-pro' ),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htslider-single-post-slide ul.meta' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Read More button tab section
        $this->start_controls_section(
            'post_slider_readmore_style_section',
            [
                'label' => esc_html__( 'Read More', 'htslider-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_read_more_btn'=>'yes',
                    'read_more_txt!'=>'',
                ]
            ]
        );
            
            $this->start_controls_tabs('readmore_style_tabs');

                $this->start_controls_tab(
                    'readmore_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'htslider-pro' ),
                    ]
                );

                    $this->add_control(
                        'readmore_color',
                        [
                            'label' => esc_html__( 'Color', 'htslider-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#464545',
                            'selectors' => [
                                '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'readmore_typography',
                            'label' => esc_html__( 'Typography', 'htslider-pro' ),
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_margin',
                        [
                            'label' => esc_html__( 'Margin', 'htslider-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_padding',
                        [
                            'label' => esc_html__( 'Padding', 'htslider-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'readmore_background',
                            'label' => esc_html__( 'Background', 'htslider-pro' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'readmore_border',
                            'label' => esc_html__( 'Border', 'htslider-pro' ),
                            'selector' => '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'htslider-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'readmore_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'htslider-pro' ),
                    ]
                );
                    $this->add_control(
                        'readmore_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'htslider-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'readmore_hover_background',
                            'label' => esc_html__( 'Background', 'htslider-pro' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'readmore_hover_border',
                            'label' => esc_html__( 'Border', 'htslider-pro' ),
                            'selector' => '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'htslider-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Slider arrow style start
        $this->start_controls_section(
            'slider_arrow_style',
            [
                'label'         => esc_html__( 'Arrow', 'htslider-pro' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     =>[
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
            ]
        );
            
            $this->add_control(
                'post_slider_arrow_style',
                [
                    'label'     => esc_html__( 'Style', 'htslider-pro' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => '1',
                    'options'   => [
                        '1'     => esc_html__( 'Style One', 'htslider-pro' ),
                        '2'     => esc_html__( 'Style Two', 'htslider-pro' ),
                        '3'     => esc_html__( 'Style Three', 'htslider-pro' ),
                        '4'     => esc_html__( 'Custom Position', 'htslider-pro' ),
                    ],
                ]
            );

             //arrow left postition
            $this->add_control(
                'arrow_left_position',
                [
                    'label' => esc_html__( 'Arrow Left Postion', 'htslider-pro' ),
                    'type'  => Controls_Manager::POPOVER_TOGGLE,
                    'condition'=>[
                        'post_slider_arrow_style'=>'4',
                    ]
                ]
            );
            $this->start_popover();
                $this->add_responsive_control(
                    'arrow_left_x_position',
                    [
                        'label' => esc_html__( 'Horizontal Postion', 'htslider-pro' ),
                        'type'  => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'default' => [
                            'size' => 0,
                            'unit' => '%',
                        ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 1550,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                             '{{WRAPPER}} .htslider-arrow-4.htslider-postslider-area button.htslider-carosul-prev.slick-arrow' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'arrow_left_y_position',
                    [
                        'label' => esc_html__( 'Vertical Postion', 'htslider-pro' ),
                        'type'  => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'default'  => [
                            'size' => 50,
                            'unit' => '%',
                        ],
                        'range'   => [
                             'px' => [
                                'min' => 0,
                                'max' => 1550,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .htslider-arrow-4.htslider-postslider-area button.htslider-carosul-prev.slick-arrow' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

            $this->end_popover();

            //end left position

             //arrow right postition
            $this->add_control(
                'arrow_right_position',
                [
                    'label' => esc_html__( 'Arrow Right Postion', 'htslider-pro' ),
                    'type'  => Controls_Manager::POPOVER_TOGGLE,

                    'condition'=>[
                        'post_slider_arrow_style'=>'4',
                    ]
                ]
            );
            $this->start_popover();
                $this->add_responsive_control(
                    'arrow_right_x_position',
                    [
                        'label' => esc_html__( 'Horizontal Postion', 'htslider-pro' ),
                        'type'  => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'default' => [
                            'size' => 0,
                            'unit' => '%',
                        ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 1550,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                             '{{WRAPPER}} .htslider-arrow-4.htslider-postslider-area button.htslider-carosul-next.slick-arrow' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'arrow_right_y_position',
                    [
                        'label' => esc_html__( 'Vertical Postion', 'htslider-pro' ),
                        'type'  => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'default'  => [
                            'size' => 50,
                            'unit' => '%',
                        ],
                        'range'   => [
                             'px' => [
                                'min' => 0,
                                'max' => 1550,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .htslider-arrow-4.htslider-postslider-area button.htslider-carosul-next.slick-arrow' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

            $this->end_popover();

            //end right position

            $this->start_controls_tabs( 'slider_arrow_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'slider_arrow_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'htslider-pro' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_color',
                        [
                            'label' => esc_html__( 'Color', 'htslider-pro' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#00282a',
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area button.slick-arrow' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_fontsize',
                        [
                            'label' => esc_html__( 'Font Size', 'htslider-pro' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 20,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area button.slick-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'slider_arrow_background',
                            'label' => esc_html__( 'Background', 'htslider-pro' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htslider-postslider-area button.slick-arrow',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'slider_arrow_border',
                            'label' => esc_html__( 'Border', 'htslider-pro' ),
                            'selector' => '{{WRAPPER}} .htslider-postslider-area button.slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'htslider-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area button.slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_height',
                        [
                            'label' => esc_html__( 'Height', 'htslider-pro' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 46,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area button.slick-arrow' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_width',
                        [
                            'label' => esc_html__( 'Width', 'htslider-pro' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 46,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area button.slick-arrow' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_padding',
                        [
                            'label'         => esc_html__( 'Padding', 'htslider-pro' ),
                            'type'          => Controls_Manager::DIMENSIONS,
                            'size_units'    => [ 'px', '%', 'em' ],
                            'selectors'     => [
                                '{{WRAPPER}} .htslider-postslider-area button.slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'slider_arrow_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'htslider-pro' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_hover_color',
                        [
                            'label'     => esc_html__( 'Color', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '#00282a',
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area button.slick-arrow:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'slider_arrow_hover_background',
                            'label'     => esc_html__( 'Background', 'htslider-pro' ),
                            'types'     => [ 'classic', 'gradient' ],
                            'selector'  => '{{WRAPPER}} .htslider-postslider-area button.slick-arrow:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'      => 'slider_arrow_hover_border',
                            'label'     => esc_html__( 'Border', 'htslider-pro' ),
                            'selector'  => '{{WRAPPER}} .htslider-postslider-area button.slick-arrow:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'htslider-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area button.slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Style Slider arrow style end

        // Style Pagination button tab section
        $this->start_controls_section(
            'post_slider_pagination_style_section',
            [
                'label' => esc_html__( 'Pagination', 'htslider-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'slider_on' => 'yes',
                    'sldots'=>'yes',
                    'post_slider_layout!'=>'4',
                ]
            ]
        );
            
            $this->start_controls_tabs('pagination_style_tabs');

                $this->start_controls_tab(
                    'pagination_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'htslider-pro' ),
                    ]
                );

                    $this->add_responsive_control(
                        'slider_pagination_height',
                        [
                            'label' => esc_html__( 'Height', 'htslider-pro' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area ul.slick-dots li' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_pagination_width',
                        [
                            'label'     => esc_html__( 'Width', 'htslider-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px'     => [
                                    'min'   => 0,
                                    'max'   => 1000,
                                    'step'  => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default'   => [
                                'unit'  => 'px',
                                'size'  => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area ul.slick-dots li' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    //pagination postition

                    $this->add_control(
                        'pagination_position',
                        [
                            'label' => esc_html__( 'Pagination Postion', 'htslider-pro' ),
                            'type'  => Controls_Manager::POPOVER_TOGGLE,
                        ]
                    );
                    $this->start_popover();
                        $this->add_responsive_control(
                            'pagination_x_position',
                            [
                                'label' => esc_html__( 'Horizontal Postion', 'htslider-pro' ),
                                'type'  => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'default' => [
                                    'size' => 50,
                                    'unit' => '%',
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],

                                'selectors' => [
                                    '{{WRAPPER}} .htslider-postslider-area ul.slick-dots' => 'left: {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );

                        $this->add_responsive_control(
                            'pagination_y_position',
                            [
                                'label'     => esc_html__( 'Vertical Postion', 'htslider-pro' ),
                                'type'      => Controls_Manager::SLIDER,
                                'size_units'=> [ 'px', '%' ],
                                'default'   => [
                                    'size'  => 100,
                                    'unit'  => '%',
                                ],
                                'range'     => [
                                     'px'   => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .htslider-postslider-area ul.slick-dots' => 'top: {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );

                    $this->end_popover();

                    //end title position


                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'pagination_background',
                            'label'     => esc_html__( 'Background', 'htslider-pro' ),
                            'types'     => [ 'classic', 'gradient' ],
                            'selector'  => '{{WRAPPER}} .htslider-postslider-area ul.slick-dots li button',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'htslider-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .htslider-postslider-area .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'      => 'pagination_border',
                            'label'     => esc_html__( 'Border', 'htslider-pro' ),
                            'selector'  => '{{WRAPPER}} .htslider-postslider-area ul.slick-dots li button',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'htslider-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area ul.slick-dots li button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'pagination_style_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'htslider-pro' ),
                    ]
                );
                    
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'pagination_hover_background',
                            'label'     => esc_html__( 'Background', 'htslider-pro' ),
                            'types'     => [ 'classic', 'gradient' ],
                            'selector'  => '{{WRAPPER}} .htslider-postslider-area ul.slick-dots li button:hover, {{WRAPPER}} .htslider-postslider-area .slick-dots li.slick-active button',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'      => 'pagination_hover_border',
                            'label'     => esc_html__( 'Border', 'htslider-pro' ),
                            'selector'  => '{{WRAPPER}} .htslider-postslider-area ul.slick-dots li button:hover, {{WRAPPER}} .htslider-postslider-area .slick-dots li.slick-active',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'htslider-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area .slick-dots li.slick-active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .htslider-postslider-area .slick-dots li:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $custom_order_ck    = $this->get_settings_for_display('custom_order');
        $orderby            = $this->get_settings_for_display('orderby');
        $postorder          = $this->get_settings_for_display('postorder');




        if ( $settings['slpagination']=='yes' ) {

        $this->add_render_attribute( 'htslider_post_slider_attr', 'class', 'htslider-postslider-area pagination htslider-postslider-style-'.$settings['post_slider_layout'] );
        }else{
            $this->add_render_attribute( 'htslider_post_slider_attr', 'class', 'htslider-postslider-area htslider-postslider-style-'.$settings['post_slider_layout'] );
        }

        $this->add_render_attribute( 'htslider_post_slider_item_attr', 'class', 'htslider-data-title htslider-single-post-slide htslider-postslider-layout-'.$settings['post_slider_layout'] );

        // Slider options
        if( $settings['slider_on'] == 'yes' ){

            $this->add_render_attribute( 'htslider_post_slider_attr', 'class', 'htslider-carousel-activation htslider-arrow-'.$settings['post_slider_arrow_style'] );

            $slider_settings = [
                'arrows' => ('yes' === $settings['slarrows']),
                'arrow_prev_txt' => HTSlider_Icon_manager::render_icon( $settings['slprevicon'], [ 'aria-hidden' => 'true' ] ),
                'arrow_next_txt' => HTSlider_Icon_manager::render_icon( $settings['slnexticon'], [ 'aria-hidden' => 'true' ] ),
                'dots' => ('yes' === $settings['sldots']),
                'autoplay' => ('yes' === $settings['slautolay']),
                'autoplay_speed' => absint($settings['slautoplay_speed']),
                'animation_speed' => absint($settings['slanimation_speed']),
                'pause_on_hover' => ('yes' === $settings['slpause_on_hover']),
                'center_mode' => ( 'yes' === $settings['slcentermode']),
                'center_padding' => absint($settings['slcenterpadding']),
                'carousel_style_ck' => absint( $settings['post_slider_layout'] ),
            ];

            $slider_responsive_settings = [
                'display_columns' => $settings['slitems'],
                'scroll_columns' => $settings['slscroll_columns'],
                'tablet_width' => $settings['sltablet_width'],
                'tablet_display_columns' => $settings['sltablet_display_columns'],
                'tablet_scroll_columns' => $settings['sltablet_scroll_columns'],
                'mobile_width' => $settings['slmobile_width'],
                'mobile_display_columns' => $settings['slmobile_display_columns'],
                'mobile_scroll_columns' => $settings['slmobile_scroll_columns'],

            ];

            $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );

            $this->add_render_attribute( 'htslider_post_slider_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }

        // Query
        $args = array(
            'post_type'             => !empty( $settings['slider_post_type'] ) ? $settings['slider_post_type'] : 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => !empty( $settings['post_limit'] ) ? $settings['post_limit'] : 3,
            'order'                 => $postorder
        );

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby']    = $orderby;
        }

        if( !empty($settings['slider_prod_categories']) ){
            $get_categories = $settings['slider_prod_categories'];
        }else{
            $get_categories = $settings['slider_categories'];
        }

        $slider_cats = str_replace(' ', '', $get_categories);

        if (  !empty( $get_categories ) ) {
            if( is_array($slider_cats) && count($slider_cats) > 0 ){
                $field_name = is_numeric( $slider_cats[0] ) ? 'term_id' : 'slug';
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => ( $settings['slider_post_type'] == 'product' ) ? 'product_cat' : 'category',
                        'terms' => $slider_cats,
                        'field' => $field_name,
                        'include_children' => false
                    )
                );
            }
        }

        $slider_post = new \WP_Query( $args );

        ?>
            <div <?php echo $this->get_render_attribute_string( 'htslider_post_slider_attr' ); ?>>

                <?php
                    if( $slider_post->have_posts() ):
                    while( $slider_post->have_posts() ): $slider_post->the_post();
                ?>
                    <div <?php echo $this->get_render_attribute_string( 'htslider_post_slider_item_attr' ); ?> data-title="<?php echo wp_trim_words( get_the_title(), 10, '' ); ?>">

                        <?php if( $settings['post_slider_layout'] == 2 ): ?>
                            <div class="htb-row htb-align-items-center">
                                <div class="htb-col-lg-6">
                                    <div class="thumb">
                                        <a href="<?php the_permalink();?>"><?php $this->htslider_render_loop_thumbnail( 'htliser_size_396x360' ); ?></a>
                                    </div>
                                </div>
                                <div class="htb-col-lg-6">
                                    <?php $this->htslider_render_loop_content(); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="thumb">
                                <a href="<?php the_permalink();?>"><?php $this->htslider_render_loop_thumbnail('htslider_size_1170x536'); ?></a>
                            </div>
                            <?php $this->htslider_render_loop_content(); ?>
                        <?php endif;?>

                    </div>

                <?php endwhile; wp_reset_postdata(); wp_reset_query(); endif; ?>

            </div>

        <?php

    }

    // Loop Content
    public function htslider_render_loop_content(){
        $settings   = $this->get_settings_for_display();
        ?>
            <div class="content">
                <div class="post-inner">
                    <?php if( $settings['show_category'] == 'yes' ): ?>
                        <ul class="post-category">
                            <?php
                                foreach ( get_the_category() as $category ) {
                                    $term_link = get_term_link( $category );
                                    ?>
                                        <li><a href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a></li>
                                    <?php
                                }
                            ?>
                        </ul>
                    <?php endif;?>
                    <?php if( $settings['show_title'] == 'yes' ):?>
                        <h2><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $settings['title_length'], '' ); ?></a></h2>
                    <?php endif; if( $settings['show_author'] == 'yes' || $settings['show_date'] == 'yes'): ?>
                        <ul class="meta">
                            <?php if( $settings['show_author'] == 'yes' ): ?>
                                <li><i class="fa fa-user-circle"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author();?></a></li>
                            <?php endif; if( $settings['show_date'] == 'yes' ):?>
                                <li><i class="fa fa-clock-o"></i><?php the_time(esc_html__('d F Y','htslider-pro'));?></li>
                            <?php endif; ?>
                        </ul>
                    <?php endif;?>
                    <?php
                        if( $settings['show_content'] == 'yes' ){
                            echo '<p>'.wp_trim_words( get_the_content(), $settings['content_length'], '' ).'</p>'; 
                        }
                        if( $settings['show_read_more_btn'] == 'yes' ):
                    ?>
                        <div class="post-btn">
                            <a class="readmore-btn" href="<?php the_permalink();?>"><?php echo esc_html__( $settings['read_more_txt'], 'htslider-pro' );?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php
    }

    // Loop Thumbnails
    public function htslider_render_loop_thumbnail( $thumbnails_size = 'full' ){
        
        if ( has_post_thumbnail() ){
            the_post_thumbnail( $thumbnails_size );
        }else{
            echo '<img src="'.HTSLIDER_PRO_PL_URL.'/assets/images/image-placeholder.png" alt="'.get_the_title().'" />';
        }

    }

}
Plugin::instance()->widgets_manager->register_widget_type( new HTSlider_Elementor_Widget_Post_Slider() );
