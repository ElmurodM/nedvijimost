( function ( $ ) {
    // Menu fixes
    function onResizeMenuLayout() {
        if ( $( window ).width() > 767 ) {
            $( ".dropdown" ).hover(
                function () {
                    $( this ).addClass( 'open' )
                },
                function () {
                    $( this ).removeClass( 'open' )
                }
            );
            $( ".dropdown" ).focusin(
                function () {
                    $( this ).addClass( 'open' )
                }
            );
            $( ".dropdown" ).focusout(
                function () {
                    $( this ).removeClass( 'open' )
                }
            );

        } else {
            $( ".dropdown" ).hover(
                function () {
                    $( this ).removeClass( 'open' )
                }
            );
        }
    }
    ;
    // initial state
    onResizeMenuLayout();
    // on resize
    $( window ).on( 'resize', onResizeMenuLayout );

    $( window ).load( function () {
        if ( $( window ).width() < 768 ) {
            $( "div#my-menu" ).show();
        }
    } );

    $( '.navbar .dropdown-toggle' ).hover( function () {
        $( this ).addClass( 'disabled' );
    } );
    $( '.navbar .dropdown-toggle' ).focus( function () {
        $( this ).addClass( 'disabled' );
    } );

    $( window ).scroll( function () {
        var header = $( '.site-header' ).outerHeight();
        var mainmenu = $( '.main-menu' ).outerHeight();
        if ( $( window ).scrollTop() > ( header + mainmenu + 30 ) ) {
            $( '.header-cart' ).addClass( 'float-cart' );
            $( '.header-my-account' ).addClass( 'float-login' );
            $( '.header-wishlist' ).addClass( 'float-wishlist' );
        } else {
            $( '.header-cart' ).removeClass( 'float-cart' );
            $( '.header-my-account' ).removeClass( 'float-login' );
            $( '.header-wishlist' ).removeClass( 'float-wishlist' );
        }
    } );

    var $myDiv = $( '#my-menu' );

    $( document ).ready( function () {
        if ( $myDiv.length ) {
            mmenu = mmlight( document.querySelector( "#my-menu" ) );
            mmenu.create( "(max-width: 767px)" );
            mmenu.init( "selected" );
            $( "#main-menu-panel" ).click( function ( e ) {
                e.preventDefault();
                if ( $( "#my-menu" ).hasClass( "mm--open" ) ) {
                    mmenu.close();
                } else {
                    mmenu.open();
                    $( "a.dropdown-toggle" ).focusin(
                        function () {
                            $( '.dropdown' ).addClass( 'open' )
                        }
                    );
                    $( "#my-menu li:last" ).focusout(
                        function () {
                            mmenu.close();
                        }
                    );
                    $( "#main-menu-panel" ).focusin(
                        function () {
                            mmenu.close();
                        }
                    );
                    $( "#main-menu-panel" ).on( 'keydown blur', function ( e ) {
                        if ( e.shiftKey && e.keyCode === 9 ) {
                            mmenu.close();
                        }
                    } );
                }
                e.stopPropagation();
            } );
        }
    } );

    $( 'form.cart' ).on( 'click', 'button.plus, button.minus', function () {

        // Get current quantity values
        var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
        var val = parseFloat( qty.val() );
        var max = parseFloat( qty.attr( 'max' ) );
        var min = parseFloat( qty.attr( 'min' ) );
        var step = parseFloat( qty.attr( 'step' ) );

        // Change the value if plus or minus
        if ( $( this ).is( '.plus' ) ) {
            if ( max && ( max <= val ) ) {
                qty.val( max );
            } else {
                qty.val( val + step );
            }
        } else {
            if ( min && ( min >= val ) ) {
                qty.val( min );
            } else if ( val > 1 ) {
                qty.val( val - step );
            }
        }

    } );

} )( jQuery );