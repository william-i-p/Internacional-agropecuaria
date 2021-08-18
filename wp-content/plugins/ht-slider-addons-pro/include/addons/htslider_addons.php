<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Htsliderpro_Elementor_Widget_Sliders extends Widget_Base {

    public function get_name() {
        return 'htsliderpro-addons';
    }
    
    public function get_title() {
        return esc_html__( 'HT: Slider', 'htslider-pro' );
    }

    public function get_icon() {
        return 'eicon-slideshow';
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
            'htlider_content',
            [
                'label' => esc_html__( 'Slider', 'htslider-pro' ),
            ]
        );

        $this->add_control(
            'content_sourse',
            [
                'label'   => esc_html__( 'Content Sourse', 'htslider-pro' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => esc_html__( 'Custom', 'htslider-pro' ),
                    '2'   => esc_html__( 'Custom Post', 'htslider-pro' ),
                ],
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
        $this->end_controls_section();

        //custom slider option
        $this->start_controls_section(
            'custom_content',
            [
                'label'     => esc_html__( 'Slider Option', 'htslider-pro' ),
                'condition' => [
                    'content_sourse' => '1',
                ]
            ]
        );

        $this->add_control(
            'slider_style',
            [
                'label'   => esc_html__( 'Slider Style', 'htslider-pro' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'   => esc_html__( 'Style 1', 'htslider-pro' ),
                    '2'   => esc_html__( 'Style 2', 'htslider-pro' ),
                ],
            ]
        );

        $this->add_control(
            'image_hidden_item',
            [
                'label' => esc_html__( 'View', 'htslider-pro' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'image_hidden_item',
            ]
        );

            $repeater = new Repeater();

            $repeater->start_controls_tabs('slider_area');

                $repeater->start_controls_tab(
                    'slider_tab',
                    [
                        'label' => esc_html__( 'Content', 'htslider-pro' ),
                    ]
                );

            $repeater->add_control(
                'subtitle',
                [
                    'label'       => esc_html__( 'Sub title (HTML tag supported)', 'htslider-pro' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'default'     => '',
                    'label_block' => 'true',
                ]
            );
            
            $repeater->add_control(
                'title',
                [
                    'label'       => esc_html__( 'Title (HTML tag supported)', 'htslider-pro' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'default'     => '',
                    'label_block' => 'true',
                ]
            );

            $repeater->add_control(
                'desc',
                [
                    'label'       => esc_html__( 'Excerpt', 'htslider-pro' ),
                    'type'        => Controls_Manager::WYSIWYG,
                    'default'     => '',
                    'label_block' => 'true',
                ]
            );

            $repeater->add_control(
                'button_text',
                [
                    'label'         => esc_html__( 'Button Text', 'htslider-pro' ),
                    'type'          => Controls_Manager::TEXT,
                    'default'       => '',
                ]
            );

            $repeater->add_control(
                'button_link',
                [
                    'label'             => esc_html__( 'Link', 'htslider-pro' ),
                    'type'              => Controls_Manager::URL,
                    'placeholder'       => esc_html__( 'https://example.com', 'htslider-pro' ),
                    'show_external'     => true,
                    'default'           => [
                        'url'           => '',
                        'is_external'   => false,
                        'nofollow'      => false,
                    ],
                ]
            );  

            $repeater->add_control(
                'image_position',
                [
                    'label'         => esc_html__( 'Image Position (use style 2)', 'htslider-pro' ),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'left',
                    'options'       => [
                        'left'      => esc_html__( 'Left', 'htslider-pro' ),
                        'right'     => esc_html__( 'Right', 'htslider-pro' ),
                    ],
                ]
            );

            $repeater->add_control(
                'hidden_item_selector',
                [
                    'label' => esc_html__( 'Image Postion', 'htslider-pro' ),
                    'type' => Controls_Manager::HIDDEN,
                    'default' => 'hidden_item_selector',
                ]
            );

            $repeater->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'      => 'background',
                    'label'     => esc_html__( 'Background', 'htslider-pro' ),
                    'types'     => [ 'classic' ],
                    'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}.htslider-item-img',
                ]
            ); 


            $repeater->end_controls_tab(); // Content tab end

                $repeater->start_controls_tab(
                    'slider_rep_style',
                    [
                        'label' => esc_html__( 'Style', 'htslider-pro' ),
                    ]
                );
                    //title
                    $repeater->add_control(
                        'title_heading',
                        [
                            'label'     => esc_html__( 'Title', 'htslider-pro' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after',
                        ]
                    );
                    $repeater->add_control(
                        'title_color',
                        [
                            'label'     => esc_html__( 'Title Color', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.htslider-single-post-slide .content .post-inner h2' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'title_align',
                        [
                            'label'     => esc_html__( 'Alignment', 'htslider-pro' ),
                            'type'      => Controls_Manager::CHOOSE,
                            'options'   => [
                                'left'  => [
                                    'title' => esc_html__( 'Left', 'htslider-pro' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'center'    => [
                                    'title' => esc_html__( 'Center', 'htslider-pro' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'right'     => [
                                    'title' => esc_html__( 'Right', 'htslider-pro' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                            ],
                      
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.htslider-single-post-slide .content .post-inner h2' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );

                    //subtitle
                    $repeater->add_control(
                        'subtitle_heading',
                        [
                            'label'     => esc_html__( ' Sub Title', 'htslider-pro' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after',
                        ]
                    );
                    $repeater->add_control(
                        'subtitle_color',
                        [
                            'label'     => esc_html__( ' Sub Title Color', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.htslider-single-post-slide .content h4' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'subtitle_align',
                        [
                            'label' => esc_html__( 'Alignment', 'htslider-pro' ),
                            'type'  => Controls_Manager::CHOOSE,
                            'options'   => [
                                'left'  => [
                                    'title' => esc_html__( 'Left', 'htslider-pro' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'center'    => [
                                    'title' => esc_html__( 'Center', 'htslider-pro' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'right'     => [
                                    'title' => esc_html__( 'Right', 'htslider-pro' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                            ],
                           
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.htslider-single-post-slide .content h4' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );
                    //content
                    $repeater->add_control(
                        'content_heading',
                        [
                            'label'     => esc_html__( ' Excerpt', 'htslider-pro' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after',
                        ]
                    );
                    $repeater->add_control(
                        'content_color',
                        [
                            'label'     => esc_html__( ' Color', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.htslider-single-post-slide .content .post-inner .htslider-desc' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'content_align',
                        [
                            'label' => esc_html__( 'Alignment', 'htslider-pro' ),
                            'type'  => Controls_Manager::CHOOSE,
                            'options'   => [
                                'left'  => [
                                    'title' => esc_html__( 'Left', 'htslider-pro' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'center'    => [
                                    'title' => esc_html__( 'Center', 'htslider-pro' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'right'     => [
                                    'title' => esc_html__( 'Right', 'htslider-pro' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                            ],
                           
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.htslider-single-post-slide .content .post-inner .htslider-desc' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );

                    //button
                    $repeater->add_control(
                        'button_heading',
                        [
                            'label'     => esc_html__( 'Button', 'htslider-pro' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after',
                        ]
                    );
                    $repeater->add_control(
                        'button_color',
                        [
                            'label'     => esc_html__( 'Button Color', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-area-pro {{CURRENT_ITEM}}.htslider-single-post-slide .post-btn a.readmore-btn' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $repeater->add_control(
                        'border_color',
                        [
                            'label'     => esc_html__( 'Border color', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-area-pro {{CURRENT_ITEM}}.htslider-single-post-slide .post-btn a.readmore-btn' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                    $repeater->add_control(
                        'button_bg_color',
                        [
                            'label'     => esc_html__( 'Button Backgound', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-area-pro {{CURRENT_ITEM}}.htslider-single-post-slide .post-btn a.readmore-btn' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );
                    $repeater->add_control(
                        'button_align',
                        [
                            'label' => esc_html__( 'Alignment', 'htslider-pro' ),
                            'type'  => Controls_Manager::CHOOSE,
                            'options'   => [
                                'left'  => [
                                    'title' => esc_html__( 'Left', 'htslider-pro' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'center'    => [
                                    'title' => esc_html__( 'Center', 'htslider-pro' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'right'     => [
                                    'title' => esc_html__( 'Right', 'htslider-pro' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                            ],
                          
                            'selectors' => [
                                '{{WRAPPER}} .htslider-area-pro {{CURRENT_ITEM}}.htslider-single-post-slide .content .post-inner .post-btn' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );
                    $repeater->add_control(
                        'button_hover_heading',
                        [
                            'label'     => esc_html__( 'Button Hover', 'htslider-pro' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after'
                        ]
                    );


                    $repeater->add_control(
                        'button_hover_color',
                        [
                            'label'     => esc_html__( 'Hover color', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-area-pro {{CURRENT_ITEM}}.htslider-single-post-slide .post-btn a.readmore-btn:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $repeater->add_control(
                        'border_hover_color',
                        [
                            'label'     => esc_html__( 'Border color', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-area-pro {{CURRENT_ITEM}}.htslider-single-post-slide .post-btn a.readmore-btn:hover' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'button_bg_hover_color',
                        [
                            'label'     => esc_html__( 'Background Hover ', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-area-pro {{CURRENT_ITEM}}.htslider-single-post-slide .post-btn a.readmore-btn:hover ' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );
                  
                $repeater->end_controls_tab();// End Style tab

            $repeater->end_controls_tabs();// Repeater Tabs end

            $this->add_control(
                'sliders_list',
                [
                    'label'     => esc_html__( 'Slider Item', 'htslider-pro' ),                         
                    'type'      => Controls_Manager::REPEATER,
                    'fields'    =>  $repeater->get_controls(),
                    'default'   => [
                        [
                            'subtitle'    => esc_html__( 'Sub title item ', 'htslider-pro' ),
                            'title'       => esc_html__( 'Slider Item 1', 'htslider-pro' ),
                            'desc'        => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod consequatur enim corrupti', 'htslider-pro' ),
                            'button_text' => esc_html__( 'Details', 'htslider-pro' ),
                            'button_link' => esc_html__( '#', 'htslider-pro' ),
                        ],
                        [
                            'subtitle'    => esc_html__( 'Sub title item ', 'htslider-pro' ),
                            'title'       => esc_html__( 'Slider Item 2', 'htslider-pro' ),
                            'desc'        => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod consequatur enim corrupti', 'htslider-pro' ),
                            'button_text' => esc_html__( 'Details', 'htslider-pro' ),
                            'button_link' => esc_html__( '#', 'htslider-pro' ),
                        ],
                    ],
                    'slider_title' => esc_html__( 'Single Slide', 'htslider-pro' ),
                ]
            ); 

        $this->end_controls_section();
        //end custom slider option 

        //custom post type
        $this->start_controls_section(
            'post_content',
            [
                'label'     => esc_html__( 'Post Option', 'htslider-pro' ),
                'condition' => [
                    'content_sourse' => '2',
                ]
            ]
        );

        $this->add_control(
                'slider_show_by',
                [
                    'label'     => esc_html__( 'Slider Show By', 'htslider-pro' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'show_bycat',
                    'options'   => [
                        'show_byid'   => esc_html__( 'Show By ID', 'htslider-pro' ),
                        'show_bycat'  => esc_html__( 'Show By Category', 'htslider-pro' ),
                    ],
                ]
            );

            $this->add_control(
                'slider_id',
                [
                    'label'         => esc_html__( 'Select Slider', 'htslider-pro' ),
                    'type'          => Controls_Manager::SELECT2,
                    'label_block'   => true,
                    'multiple'      => true,
                    'options'       => htslider_post_name( 'htslider_slider' ),
                    'condition'     => [
                        'slider_show_by' => 'show_byid',
                    ]
                ]
            );

            $this->add_control(
                'slider_cat',
                [
                    'label'         => esc_html__( 'Select Category', 'htslider-pro' ),
                    'type'          => Controls_Manager::SELECT2,
                    'label_block'   => true,
                    'multiple'      => true,
                    'options'       => htslider_get_taxonomies( 'htslider_category' ),
                    'condition'     => [
                        'slider_show_by' => 'show_bycat',
                    ]
                ]
            );
            
            $this->add_control(
                'slider_limit',
                [
                    'label'     => esc_html__( 'Slider Limit', 'htslider-pro' ),
                    'type'      => Controls_Manager::NUMBER,
                    'step'      => 1,
                    'default'   => 2,
                ]
            );

        $this->end_controls_section();
        //end custop post type

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
                        'sldots' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slpause_on_hover',
                [
                    'type'          => Controls_Manager::SWITCHER,
                    'label_off'     => esc_html__('No', 'htslider-pro'),
                    'label_on'      => esc_html__('Yes', 'htslider-pro'),
                    'return_value'  => 'yes',
                    'default'       => 'yes',
                    'label'         => esc_html__('Pause on Hover?', 'htslider-pro'),
                    'condition'     => [
                        'slider_on' => 'yes',
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
                    'label'             => esc_html__( 'Slider auto play', 'htslider-pro' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'return_value'      => 'yes',
                    'separator'         => 'before',
                    'default'           => 'no',
                    'condition'         => [
                        'slider_on'     => 'yes',
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
                    'label'         => __('Autoplay animation speed', 'htslider-pro'),
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
                    'label'             => esc_html__( 'Tablet', 'htslider-pro' ),
                    'type'              => Controls_Manager::HEADING,
                    'separator'         => 'after',
                    'condition'         => [
                        'slider_on'     => 'yes',
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
                    'label'     => esc_html__('Slider item to scroll', 'htslider-pro'),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 4,
                    'step'      => 1,
                    'default'   => 1,
                    'condition' => [
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

        // Style Slider arrow style start
        $this->start_controls_section(
            'slider_style_control',
            [
                'label'             => esc_html__( 'Style', 'htslider-pro' ),
                'tab'               => Controls_Manager::TAB_STYLE,
                'condition'         =>[
                    'content_sourse' => '1',
                ],
            ]
        );

            $this->add_control(
                'content_color',
                [
                    'label'     => esc_html__( 'Color', 'htslider-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#333333',
                    'selectors' => [
                        '{{WRAPPER}} .htslider-single-post-slide .content h4' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .htslider-single-post-slide .content .post-inner h2' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .htslider-single-post-slide .content .post-inner .htslider-desc' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'bg_color',
                [
                    'label'     => esc_html__( 'Background', 'htslider-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ededed',
                    'selectors' => [
                        '{{WRAPPER}} .htslider-item-img' => 'background: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_responsive_control(
                'slider_seciton_height',
                [
                'label'     => esc_html__( 'Slider Height', 'shieldem' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'max'       => 2000,
                'step'      => 1,
                'default'   =>650,
                'selectors' => [
                '{{WRAPPER}} .htslider-item-img.single-slide-item.htslider-single-post-slide' => 'height: {{VALUE}}px;',
                ],
                ]
            );

        $this->add_control(
            'text_align',
            [
                'label' => esc_html__( 'Alignment', 'htslider-pro' ),
                'type'  => Controls_Manager::CHOOSE,
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
                ],
              
                'selectors' => [
                    '{{WRAPPER}} .single-slide-item.htslider-single-post-slide .content .post-inner' => 'text-align: {{VALUE}};',
                ],
            ]
        );

           $this->start_controls_tabs( 'slider_style_tabs' );

                // title tab Start
                $this->start_controls_tab(
                    'slider_style_title_tab',
                    [
                        'label' => esc_html__( 'Title', 'htslider-pro' ),
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
                $this->add_control(
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

                $this->end_controls_tab(); // title tab end

                // Subtitle tab Start
                $this->start_controls_tab(
                    'slider_style_subtitle_tab',
                    [
                        'label' => esc_html__( 'Sub Title', 'htslider-pro' ),
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'      => 'subtitle_typography',
                        'label'     => esc_html__( 'Typography', 'htslider-pro' ),
                        'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                        'selector'  => '{{WRAPPER}} .htslider-single-post-slide .content h4',
                    ]
                );

                $this->add_control(
                    'subtitle_margin',
                    [
                        'label'         => esc_html__( 'Margin', 'htslider-pro' ),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => [ 'px', '%', 'em' ],
                        'selectors'     => [
                            '{{WRAPPER}} .htslider-single-post-slide .content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->end_controls_tab(); // subtitle tab end

                // excerpt tab Start
                $this->start_controls_tab(
                    'slider_style_excerpt_tab',
                    [
                        'label' => __( 'Excerpt', 'htslider-pro' ),
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'      => 'content_typography',
                        'label'     => esc_html__( 'Typography', 'htslider-pro' ),
                        'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                        'selector'  => '{{WRAPPER}} .htslider-single-post-slide .content .post-inner .htslider-desc,.htslider-single-post-slide .content .post-inner .htslider-desc p, .htslider-single-post-slide .content .post-inner .htslider-desc h1,.htslider-single-post-slide .content .post-inner .htslider-desc h2,.htslider-single-post-slide .content .post-inner .htslider-desc h3,.htslider-single-post-slide .content .post-inner .htslider-desc h4,.htslider-single-post-slide .content .post-inner .htslider-desc h5, .htslider-single-post-slide .content .post-inner .htslider-desc h6',
                    ]
                );

                $this->add_control(
                    'content_margin',
                    [
                        'label'         => esc_html__( 'Margin', 'htslider-pro' ),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => [ 'px', '%', 'em' ],
                        'selectors'     => [
                            '{{WRAPPER}} .htslider-single-post-slide .content .post-inner .htslider-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
 
                $this->end_controls_tab(); // excerpt tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // style Option end

         $this->start_controls_section(
            'slider_style_button_control',
            [
                'label'             => esc_html__( 'Button', 'htslider-pro' ),
                'tab'               => Controls_Manager::TAB_STYLE,
                'condition'         =>[
                    'content_sourse' => '1',
                ],
            ]
        );

            $this->start_controls_tabs( 'slider_button_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'slider_button_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'htslider-pro' ),
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'      => 'button_typography',
                        'label'     => esc_html__( 'Typography', 'htslider-pro' ),
                        'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
                        'selector'  => '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn',
                    ]
                );
                $this->add_control(
                    'slider_button_color',
                    [
                        'label'     => esc_html__( 'Color', 'htslider-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#18012c',
                        'selectors' => [
                            '{{WRAPPER}} .htslider-area-pro .htslider-single-post-slide .post-btn a.readmore-btn' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'slider_button_bg',
                    [
                        'label'     => esc_html__( 'Background ', 'htslider-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .htslider-area-pro .htslider-single-post-slide .post-btn a.readmore-btn' => 'background: {{VALUE}};',
                        ],
                    ]
                );


                $this->add_control(
                    'button_padding',
                    [
                        'label'         => esc_html__( 'Padding', 'htslider-pro' ),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => [ 'px', '%', 'em' ],
                        'selectors'     => [
                            '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_margin',
                    [
                        'label'         => esc_html__( 'Margin', 'htslider-pro' ),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => [ 'px', '%', 'em' ],
                        'selectors'     => [
                            '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                       
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'      => 'slider_button_border',
                            'label'     => esc_html__( 'Border', 'htslider-pro' ),
                            'selector'  => '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_button_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'htslider-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );


                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'slider_button_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'htslider-pro' ),
                    ]
                );

                    $this->add_control(
                        'slider_button_hover_color',
                        [
                            'label'     => esc_html__( 'Color', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '#00282a',
                            'selectors' => [
                                '{{WRAPPER}} .htslider-area-pro .htslider-single-post-slide .post-btn a.readmore-btn:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->add_control(
                    'slider_button_hover_bg',
                    [
                        'label'     => esc_html__( 'Color', 'htslider-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .htslider-area-pro .htslider-single-post-slide .post-btn a.readmore-btn:hover' => 'background: {{VALUE}};',
                        ],
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'      => 'slider_button_hover_border',
                            'label'     => esc_html__( 'Border', 'htslider-pro' ),
                            'selector'  => '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_button_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'htslider-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htslider-single-post-slide .post-btn a.readmore-btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Style Slider arrow style end


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
                    'label'     => esc_html__( 'Arrow Left Postion', 'htslider-pro' ),
                    'type'      => Controls_Manager::POPOVER_TOGGLE,
                    'condition' =>[
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
                            'size' => 1,
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
                                'max' => 650,
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
                            'size' => 1,
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
                                'max' => 650,
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
                            'label'     => esc_html__( 'Color', 'htslider-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '#00282a',
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area button.slick-arrow' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_fontsize',
                        [
                            'label' => esc_html__( 'Font Size', 'htslider-pro' ),
                            'type'  => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min'   => 0,
                                    'max'   => 100,
                                    'step'  => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default'   => [
                                'unit'  => 'px',
                                'size'  => 20,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htslider-postslider-area button.slick-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'      => 'slider_arrow_background',
                            'label'     => esc_html__( 'Background', 'htslider-pro' ),
                            'types'     => [ 'classic', 'gradient' ],
                            'selector'  => '{{WRAPPER}} .htslider-postslider-area button.slick-arrow',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'      => 'slider_arrow_border',
                            'label'     => esc_html__( 'Border', 'htslider-pro' ),
                            'selector'  => '{{WRAPPER}} .htslider-postslider-area button.slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'htslider-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
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
                            'label'      => esc_html__( 'Padding', 'htslider-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
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
                'label'         => esc_html__( 'Pagination', 'htslider-pro' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     =>[
                    'slider_on' => 'yes',
                    'sldots'    =>'yes',
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
                        'slider_pagination_padding',
                        [
                            'label'      => esc_html__( 'Padding', 'htslider-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .htslider-postslider-area ul.slick-dots li button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    //pagination postition

                    $this->add_control(
                        'pagination_position',
                        [
                            'label' => esc_html__( 'Pagination Postion', 'htslider-pro' ),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
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
                                'label' => esc_html__( 'Vertical Postion', 'htslider-pro' ),
                                'type'  => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'default' => [
                                    'size' => 92,
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
                            'label'         => esc_html__( 'Margin', 'htslider-pro' ),
                            'type'          => Controls_Manager::DIMENSIONS,
                            'size_units'    => [ 'px', '%', 'em' ],
                            'selectors'     => [
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
                            'selector'  => '{{WRAPPER}} .htslider-postslider-area ul.slick-dots li button:hover, {{WRAPPER}} .htslider-postslider-area .slick-dots li.slick-active',
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

        $id = $this->get_id();
        $args = array(
            'post_type'             => 'htslider_slider',
            'posts_per_page'        => $settings['slider_limit'],
            'post_status'           => 'publish',
            'order'                 => 'ASC',
        );

        // Fetch By id
        if( $settings['slider_show_by'] == 'show_byid' ){
            $args['post__in'] = $settings['slider_id'];
        }

        // Fetch by category
        if( $settings['slider_show_by'] == 'show_bycat' ){
            // By Category
            $get_slider_categories = $settings['slider_cat'];
            $slider_cats = str_replace(' ', '', $get_slider_categories);
            if ( "0" != $get_slider_categories) {
                if( is_array( $slider_cats ) && count( $slider_cats ) > 0 ){
                    $field_name = is_numeric( $slider_cats[0] )?'term_id':'slug';
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'htslider_category',
                            'terms' => $slider_cats,
                            'field' => $field_name,
                            'include_children' => false
                        )
                    );
                }
            }
        }
        $sliders = new \WP_Query( $args );

        if ( $settings['slpagination']=='yes' ) {
            $this->add_render_attribute( 'htslider_post_slider_attr', 'class', 'htslider-postslider-area htslider-area-pro htslider-postslider-style-1 pagination' );
        }else{
            $this->add_render_attribute( 'htslider_post_slider_attr', 'class', 'htslider-postslider-area htslider-area-pro htslider-postslider-style-1' );
        }

        $this->add_render_attribute( 'htslider_post_slider_item_attr', 'class', 'htslider-data-title htslider-single-post-slide htslider-postslider-layout-1' );

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
                //'carousel_style_ck' => absint( $settings['post_slider_layout'] ),
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

        $sliderpost_ids = array();
        while( $sliders->have_posts() ):$sliders->the_post();
            $sliderpost_ids[] = get_the_ID();
        endwhile;
        wp_reset_postdata(); wp_reset_query();

    ?>

        <div <?php echo $this->get_render_attribute_string( 'htslider_post_slider_attr' ); ?>>
            <?php if( $settings['content_sourse']=='1'): ?>

                <?php foreach ($settings['sliders_list'] as $item ): 

                    $target = $item['button_link']['is_external'] ? ' target="_blank"' : '';
                    $nofollow = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';

                    if( $settings['slider_style']=='1' ):
                ?>

                    <div class="elementor-repeater-item-<?php echo $item['_id']; ?> htslider-item-img single-slide-item htslider-single-post-slide">
                        <div class="htb-container">
                            <div class="content">
                                <div class="post-inner">
                                    <?php 
                                        if( $item['subtitle']  ){
                                            printf('<h4>%s</h4>', wp_kses_post( $item['subtitle'] ) );
                                        }
                                        if(  $item['title']  ){
                                            printf('<h2>%s</h2>', wp_kses_post( $item['title'] ) );
                                        }
                                        if(  $item['desc'] ){
                                            printf('<div class="htslider-desc">%s</div>', wp_kses_post( $item['desc'] ) );
                                        }
                                        
                                        if( !empty($item['button_text']) ){
                                        echo '<div class="post-btn"><a href="'.esc_url( $item['button_link']['url'] ).'" '.$target.' '.$nofollow.' class="readmore-btn" >' . $item['button_text'].'</a></div>';
                                        } 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <?php else: ?>

                <div class="htsldier-item-area2">
                    <div class="htb-row htb-align-items-center <?php echo esc_attr( $item['image_position'] ); ?>">

                        <div class="htb-col-lg-6">
                            <div class="elementor-repeater-item-<?php echo $item['_id']; ?> htslider-item-img single-slide-item htslider-single-post-slide"></div>
                        </div>
                        <div class="htb-col-lg-6">
                            <div class="elementor-repeater-item-<?php echo $item['_id']; ?> single-slide-item htslider-single-post-slide">
                                <div class="content">
                                    <div class="post-inner">
                                        <?php 
                                            if( $item['subtitle']  ){
                                                printf('<h4>%s</h4>', wp_kses_post( $item['subtitle'] ) );
                                            }
                                            if(  $item['title']  ){
                                                printf('<h2>%s</h2>', wp_kses_post( $item['title'] ) );
                                            }
                                            if(  $item['desc'] ){
                                                printf('<div class="htslider-desc">%s</div>', wp_kses_post( $item['desc'] ) );
                                            }
                                            
                                            if( !empty($item['button_text']) ){
                                            echo '<div class="post-btn"><a href="'.esc_url( $item['button_link']['url'] ).'" '.$target.' '.$nofollow.' class="readmore-btn" >' . $item['button_text'].'</a></div>';
                                            } 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   </div>
                <?php endif ?>
            <?php endforeach; ?>
            <?php else: ?>

            <?php foreach( $sliderpost_ids as $slider_item ): ?>
               <div <?php echo $this->get_render_attribute_string( 'htslider_post_slider_item_attr' ); ?> >
                    <?php
                        if ( ! Plugin::instance()->db->is_built_with_elementor( $slider_item ) ) {
                            echo apply_filters( 'the_content', get_post_field( 'post_content', $slider_item ) );
                        }else{
                            echo Plugin::instance()->frontend->get_builder_content_for_display( $slider_item );
                        }                
                    ?>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Htsliderpro_Elementor_Widget_Sliders() );
