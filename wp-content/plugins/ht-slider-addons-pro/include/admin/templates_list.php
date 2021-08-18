<div class="httemplates-templates-area">
    <div class="httemplate-row">

        <!-- PopUp Content Start -->
        <div id="httemplate-popup-area" style="display: none;">
            <div class="httemplate-popupcontent">
                <div class='htspinner'></div>
                <div class="htmessage" style="display: none;">
                    <p></p>
                    <span class="httemplate-edit"></span>
                </div>
                <div class="htpopupcontent">
                    <div class="htpageimportarea">
                        <p> <?php esc_html_e( 'Create a new slider from this template', 'htslider-pro' ); ?></p>
                        <input id="htpagetitle" type="text" name="htpagetitle" placeholder="<?php echo esc_attr_x( 'Enter a Slider Title', 'placeholder', 'htslider-pro' ); ?>">
                        <span class="htimport-button-dynamic-page"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- PopUp Content End -->

        <!-- Top banner area Start -->
        <div class="httemplate-top-banner-area">
            <div class="htbanner-content">
                <div class="htbanner-desc">
                    <h3><?php esc_html_e( 'HT Slider Template Library', 'htslider-pro' ); ?></h3>
                    <?php
                        $alltemplates = sizeof( HTSlider_Template_Library::instance()->get_templates_info()['templates'] ) ? sizeof( HTSlider_Template_Library::instance()->get_templates_info()['templates'] ) : 0;
                    ?>
                    <?php if( !is_plugin_active('ht-slider-pro/htslider_pro.php') ){ ?>
                        <p><?php esc_html_e( '80 Templates', 'htslider-pro' ); ?></p>
                    <?php } else{ ?>
                        <p><?php esc_html_e( $alltemplates, 'htslider-pro' ); esc_html_e( ' Templates', 'htslider-pro' ); ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Top banner area end -->

        <?php if( HTSlider_Template_Library::instance()->get_templates_info()['templates'] ): ?>
            
            <div class="htmega-topbar">
                <span id="htmegaclose">&larr; <?php esc_html_e( 'Back to Library', 'htslider-pro' ); ?></span>
                <h3 id="htmega-tmp-name"></h3>
            </div>

            <ul id="tp-grid" class="tp-grid">

                <?php foreach ( HTSlider_Template_Library::instance()->get_templates_info()['templates'] as $httemplate ): 
                    
                    $allcat = explode( ' ', $httemplate['category'] );

                    $htimp_btn_atr = [
                        'templpateid' => $httemplate['id'],
                        'templpattitle' => $httemplate['title'],
                        'message' => esc_html__( 'Successfully '.$httemplate['title'].' has been imported.', 'htslider-pro' ),
                        'htbtnlibrary' => esc_html__( 'Import to Library', 'htslider-pro' ),
                        'htbtnpage' => esc_html__( 'Import to Slider', 'htslider-pro' ),
                        'thumbnail' => esc_url( $httemplate['thumbnail'] ),
                        'fullimage' => esc_url( $httemplate['fullimage'] ),
                    ];

                ?>

                    <li data-pile="<?php echo esc_attr( implode(' ', $allcat ) ); ?>">
                        
                        <!-- Preview PopUp Start -->
                        <div id="httemplate-popup-prev-<?php echo $httemplate['id']; ?>" style="display: none;">
                            <img src="<?php echo esc_url( $httemplate['fullimage'] ); ?>" alt="<?php $httemplate['title']; ?>" style="width:100%;"/>
                        </div>
                        <!-- Preview PopUp End -->

                        <div class="htsingle-templates-laibrary">
                            <div class="httemplate-thumbnails">
                                <img data-preview='<?php echo wp_json_encode( $htimp_btn_atr );?>' src="<?php echo esc_url( $httemplate['thumbnail'] ); ?>" alt="<?php echo esc_attr( $httemplate['title'] ); ?>">
                                <div class="httemplate-action">
                                    <?php if( $httemplate['is_pro'] == 1 ):?>
                                        <a href="http://bit.ly/2HObEeB" target="_blank">
                                            <?php esc_html_e( 'Buy Now', 'htslider-pro' ); ?>
                                        </a>
                                    <?php else:?>
                                        <a href="#" class="wltemplateimp" data-templpateopt='<?php echo wp_json_encode( $htimp_btn_atr );?>' >
                                            <?php esc_html_e( 'Import', 'htslider-pro' ); ?>
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?php echo esc_url( $httemplate['demourl'] ); ?>" target="_blank"><?php esc_html_e( 'Preview', 'htslider-pro' ); ?></a>
                                </div>
                            </div>
                            <div class="httemplate-content">
                                <h3><?php echo esc_html__( $httemplate['title'], 'htslider-pro' ); if( $httemplate['is_pro'] == 1 ){ echo ' <span>( '.esc_html__('Pro','htslider-pro').' )</span>'; } ?></h3>
                                <div class="httemplate-tags">
                                    <?php echo implode( ' / ', explode( ',', $httemplate['tags'] ) ); ?>
                                </div>
                            </div>
                        </div>
                    </li>

                <?php endforeach; ?>

            </ul>


            <script type="text/javascript">
                (function($){
                "use strict";

                    var $grid = $( '#tp-grid' ),
                        $name = $( '#htmega-tmp-name' ),
                        $close = $( '#htmegaclose' ),
                        $loaderimg = '<?php echo HTSLIDER_PRO_ADMIN_ASSETS . '/images/ajax-loader.gif'; ?>',
                        $loader = $( '<div class="htmega-loader"><span><img src="'+$loaderimg+'" alt="" /></span></div>' ).insertBefore( $grid ),
                        stapel = $grid.stapel( {
                            onLoad : function() {
                                $loader.remove();
                            },
                            onBeforeOpen : function( pileName ) {
                                $( '.htmega-topbar,.httemplate-action' ).css('display','flex');
                                $( '.httemplate-content span' ).css('display','inline-block');
                                $close.show();
                                $name.html( pileName );
                            },
                            onAfterOpen : function( pileName ) {
                                $close.show();
                            }
                        } );
                    $close.on( 'click', function() {
                        $close.hide();
                        $name.empty();
                        $( '.htmega-topbar,.httemplate-action,.httemplate-content span' ).css('display','none');
                        stapel.closePile();
                    } );

                })(jQuery);

            </script>

        <?php endif; ?>

    </div>
</div>