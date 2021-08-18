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

"use strict";

/**
 * Mdp taber main object
 * @type {{addTabs: mdpTaber.addTabs, switchTab: mdpTaber.switchTab}}
 */
const mdpTaber = {

    /**
     * Switching tabs method
     * @param wrapperName
     */
    switchTab: function (wrapperName) {

        // Get tabs navigation and content
        const tabsNav = document.querySelectorAll( `.${wrapperName} .mdp-tab-nav-taber` );
        const tabsContent = document.querySelectorAll( `.${wrapperName} .mdp-tab-content-taber` );
        const openTabNumber = parseInt( document.querySelector( `.${wrapperName} .mdp-tabs-wrapper-taber` ).getAttribute( 'data-open' ) ) - 1;
        const toggle = document.querySelector( `.${wrapperName} .mdp-tabs-wrapper-taber` ).getAttribute( 'data-toggle' ) === 'on';

        const resetActiveTabs = function () {

            tabsContent.forEach(item => {
                item.classList.remove( 'is-active' );
            });

            tabsNav.forEach(item => {
                item.classList.remove( 'is-active' );
            });

        };

        //Resetting active tabs
        resetActiveTabs();

        for( let i = 0; i < tabsNav.length; i++ ) {

            // Set active tab on init
            if ( openTabNumber >= 0 ) {
                tabsNav[ openTabNumber ].classList.add( 'is-active' );
                tabsContent[ openTabNumber ].classList.add( 'is-active' );
            }

            tabsNav[i].addEventListener( 'click', () => {

                const isActive = tabsNav[i].classList.contains( 'is-active' );

                resetActiveTabs(); //resetting active tabs on click

                if ( toggle ) {

                    if ( !isActive ) {

                        tabsNav[i].classList.add( 'is-active' );
                        tabsContent[i].classList.add( 'is-active' );

                    }

                } else {

                    tabsNav[i].classList.add( 'is-active' );
                    tabsContent[i].classList.add( 'is-active' );

                }

            } );

        }

        // Tabs scrolling
        this.scrollTabs( wrapperName );

        // Set equal height
        this.setEqualHeight( wrapperName );

    },

    /**
     * Adding tabs method
     */
    addTabs: function () {

        const taberWrapper = document.querySelectorAll( '.mdp-taber-elementor-box' );

        for ( let i = 0; i < taberWrapper.length; i++ ) {
            taberWrapper[i].classList.add( 'mdp-taber-elementor-box-' + i );
            this.switchTab( 'mdp-taber-elementor-box-' + i );
        }

    },

    /**
     * Tabs scroll throughout dragging
     * @param wrapperName
     */
    scrollTabs: function ( wrapperName ) {

        const $tabsBar = document.querySelector( `.${ wrapperName } .mdp-tabs-nav-taber` );
        const $tabsScroll = document.querySelector( `.${ wrapperName } .mdp-taber-scroll` );
        const tabsBarWidth = $tabsBar.getBoundingClientRect().width;
        const tabsWidth = $tabsBar.scrollWidth;
        let startX = 0;
        let prevTranslate = 0;

        if ( $tabsBar.classList.contains( 'mdp-top-right-nav-tabs' ) || $tabsBar.classList.contains( 'mdp-bottom-right-nav-tabs' ) ) {
            document.querySelector( `.${ wrapperName } .mdp-taber-scroll` ).style.transform = `translateX(${ -(tabsWidth - tabsBarWidth) }px)`
        }

        // Exit if scrolling is unnecessary
        if ( tabsWidth <= tabsBarWidth ) { return; }

        // Bind mouse events
        $tabsBar.addEventListener( 'mousedown', startDragging, false );
        $tabsBar.addEventListener( 'mouseup', stopDragging, false );
        $tabsBar.addEventListener( 'mouseleave', stopDragging, false );

        // Bind touch events
        $tabsBar.addEventListener( 'touchstart', startDragging, false);
        $tabsBar.addEventListener( 'touchend', stopDragging, false);
        $tabsBar.addEventListener( 'touchcancel', stopDragging, false);

        /**
         * Start dragging
         * @param e
         */
        function startDragging( e ) {

            if ( 'touchstart' === e.type ) {

                startX = e.touches[0].clientX;
                $tabsBar.addEventListener( 'touchmove', moveTabs, false);

            } else {

                startX = e.clientX;
                $tabsBar.addEventListener( 'mousemove', moveTabs, false );

            }

        }

        /**
         * Stop dragging
         * @param e
         */
        function stopDragging( e ) {

            // Un-bind move events
            $tabsBar.removeEventListener( 'mousemove', moveTabs, false );
            $tabsBar.removeEventListener( 'touchmove', moveTabs, false );

            prevTranslate = parseInt( $tabsScroll.style.transform.replace( /[()a-zA-Z]/g, "" ) );

        }

        /**
         * Move tabs
         * @param e
         */
        function moveTabs ( e ) {

            const delta = 'touchmove' === e.type ?
                Math.round( startX - e.touches[0].clientX ) :
                startX - e.clientX;

            // Exit if new delta same as old delta
            const prevDelta = parseInt( $tabsScroll.style.transform.replace( /[()a-zA-Z]/g, "" ) );
            if ( delta === Math.abs( prevDelta ) ) { return; }

            // Exit if dragging more than container width
            let newDelta = prevTranslate - delta;

            if ( $tabsBar.classList.contains( 'mdp-top-center-nav-tabs' ) || $tabsBar.classList.contains( 'mdp-bottom-center-nav-tabs' ) ) {
                if ( tabsWidth - tabsBarWidth <= Math.abs( newDelta ) ) { return; }
            } else {
                if ( newDelta > 0 || tabsWidth - tabsBarWidth <= Math.abs( newDelta ) ) { return; }
            }
            // Apply transforms for tabs wrapper
            document.querySelector( `.${ wrapperName } .mdp-taber-scroll` ).style.transform = `translateX(${ newDelta }px)`;

        }

    },

    /**
     * Set height of the max content section for all section
     * @param wrapperName
     */
    setEqualHeight: function ( wrapperName ) {

        const $contentsWrapper = document.querySelector( `.${wrapperName} .mdp-tabs-content-taber` );
        const contents = document.querySelectorAll( `.${wrapperName} .mdp-tab-content-taber` );
        let tabMinHeight = 0;

        // Exit if min-height set in the Elementor
        if ( 'auto' !== window.getComputedStyle( $contentsWrapper ).minHeight ) { return; }

        for ( let singleContent of contents ) {

            // Render for calculate height
            singleContent.classList.add( 'equal-height' );

            // Save height of the longest tab
            if ( tabMinHeight < singleContent.getBoundingClientRect().height ) {

                tabMinHeight = singleContent.getBoundingClientRect().height

            }

            // Hide non-active tabs
            singleContent.classList.remove( 'equal-height' );

        }

        // Set tabs container height equal to longest tab
        document.querySelector( '.mdp-tabs-content-taber' ).style.minHeight = `${tabMinHeight}px`;

    }

};

/**
 * Init for Front-End
 * @param callback
 */
document.addEventListener( 'DOMContentLoaded', mdpTaber.addTabs.bind( mdpTaber ) );