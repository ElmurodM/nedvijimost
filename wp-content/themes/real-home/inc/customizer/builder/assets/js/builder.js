(function( $, wp_customize ) {
    var $document = $( document );

    var CustomizeBuilder = function( options, id ){

        var Builder = {
            id: id,
            controlId: '',
            cols: 12,
            cellHeight: 45,
            items: [],
            container: null,
            ready: false,
            devices: { desktop: "Desktop", mobile: "Mobile/Tablet" },
            activePanel: 'desktop',
            panels: {},
            activeRow: 'main',
            draggingItem: null,
            getTemplate: _.memoize(
                function () {
                    var control = this;
                    var compiled,
                        /*
                         * Underscore's default ERB-style templates are incompatible with PHP
                         * when asp_tags is enabled, so WordPress uses Mustache-inspired templating syntax.
                         *
                         * @see trac ticket #22344.
                         */
                        options = {
                            evaluate: /<#([\s\S]+?)#>/g,
                            interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
                            escape: /\{\{([^\}]+?)\}\}(?!\})/g,
                            variable: 'data'
                        };

                    return function ( data, id, data_variable_name ) {
                        if (_.isUndefined( id )) {
                            id = 'tmpl-customize-control-' + control.type;
                        }
                        if ( ! _.isUndefined( data_variable_name ) && _.isString( data_variable_name ) ) {
                            options.variable = data_variable_name;
                        } else {
                            options.variable = 'data';
                        }
                        compiled = _.template( $( '#' + id ).html(), null, options );
                        return compiled( data );
                    };
                }
            ),

            drag_drop: function(){
                var that = this;

                $( '.real-home-device-panel', that.container ).each(
                    function(){
                        var panel             = $( this );
                        var device            = panel.data( 'device' );
                        var sortable_ids      = [];
                        that.panels[ device ] = {};
                        $( '.col-items', panel ).each(
                            function( index ){
                                var data_name = $( this ).attr( 'data-id' ) || '';
                                var id;
                                if ( ! data_name ) {
                                    id = '_sid_' + device + index;
                                } else {
                                    id = '_sid_' + device + '-' + data_name;
                                }
                                $( this ).attr( 'id', id );
                                sortable_ids[ index ] = '#' + id;
                            }
                        );
                        $(".col-items, .real-home-available-items", panel).each(function() {
                            $(this).droppable().sortable({
                                placeholder: "sortable-placeholder grid-stack-item",
                                connectWith: ".col-items",
                                update: function(){
                                    that.save();
                                }
                            });
                        });
                    }
                );
            },
            addPanel: function( device ){
                var that        = this;
                var template    = that.getTemplate();
                var template_id = 'tmpl-real-home-panel';
                if (  $( '#' + template_id ).length == 0 ) {
                    return;
                }
                if ( ! _.isObject( options.rows ) ) {
                    options.rows = {};
                }
                if ( ! _.isObject( options.cols ) ) {
                    options.cols = {};
                }
                var html = template(
                    {
                        device: device,
                        id: options.id,
                        rows: options.rows,
                        cols: options.cols
                    },
                    template_id
                );
                return '<div class="real-home-device-panel real-home-vertical-panel real-home-panel-' + device + '" data-device="' + device + '">' + html + '</div>';
            },
            addDevicePanels: function(){
                var that = this;
                _.each(
                    that.devices,
                    function( device_name, device ) {
                        var panelHTML = that.addPanel( device );
                        $( '.real-home-devices-switcher', that.container ).append( '<a href="#" class="switch-to switch-to-' + device + '" data-device="' + device + '">' + device_name + '</a>' );
                        $( '.real-home-body', that.container ).append( panelHTML );
                    }
                );
            },
            addItem: function( node ){
                var that        = this;
                var template    = that.getTemplate();
                var template_id = 'tmpl-real-home-item';
                if (  $( '#' + template_id ).length == 0 ) {
                    return;
                }
                var html = template( node, template_id );
                return $( html );
            },
            addAvailableItems: function(){
                var that = this;

                _.each(
                    that.devices,
                    function(device_name, device ){
                        var $itemWrapper = $( '<div class="real-home-available-items" data-device="' + device + '"></div>' );
                        $( '.real-home-panel-' + device, that.container ).append( $itemWrapper );

                        _.each(
                            that.items,
                            function( node ) {
                                var _d = true;
                                if ( ! _.isUndefined( node.devices ) && ! _.isEmpty( node.devices ) ) {
                                    if ( _.isString( node.devices ) ) {
                                        if ( node.devices != device ) {
                                            _d = false;
                                        }
                                    } else {
                                        var _has_d = false;
                                        _.each(
                                            node.devices,
                                            function( _v ){
                                                if ( device == _v ) {
                                                    _has_d = true;
                                                }}
                                        );
                                        if ( ! _has_d ) {
                                            _d = false;
                                        }
                                    }
                                }

                                if ( _d ) {
                                    var item = that.addItem( node );
                                    $itemWrapper.append( item );
                                }

                            }
                        );
                    }
                );

            },
            switchToDevice: function( device, toggle_button ){
                var that          = this;
                var numberDevices = _.size( that.devices );
                if ( numberDevices > 1 ) {
                    $( '.real-home-devices-switcher a', that.container ).removeClass( 'real-home-tab-active' );
                    $( '.real-home-devices-switcher .switch-to-' + device, that.container ).addClass( 'real-home-tab-active' );
                    $( '.real-home-device-panel', that.container ).addClass( 'real-home-panel-hide' );
                    $( '.real-home-device-panel.real-home-panel-' + device, that.container ).removeClass( 'real-home-panel-hide' );
                    that.activePanel = device;
                } else {
                    $( '.real-home-devices-switcher a', that.container ).addClass( 'real-home-tab-active' );
                }

                if ( _.isUndefined( toggle_button ) || toggle_button ) {
                    if ( device == 'desktop' ) {
                        $( '#customize-footer-actions .preview-desktop' ).trigger( 'click' );
                    } else if ( device == 'mobile' ) {
                        $( '#customize-footer-actions .preview-mobile' ).trigger( 'click' );
                    }
                    /*                 else if ( device == 'all' ) {
                        wp_customize.section( 'real-home-menu-icon-sidebar-section' ).focus();
                    }*/
                }

            },
            addNewWidget: function( device, row_id, col_id, node, index) {

                var that = this;
                var panel, row, col;
                panel = that.container.find(
                    ".real-home-device-panel.real-home-panel-" +device
                );

                row = $( '.real-home-row.real-home-row-'+row_id, panel );
                col = $( '.col-items.'+col_id, row );

                var $item = $( '.real-home-available-items .grid-stack-item[data-id="'+node.id+'"]', panel );

                col.append($item);
            },
            addExistingRowsItems: function(){
                var that = this;

                var data = wp_customize.control( that.controlId ).setting._value;
                if ( ! _.isObject( data ) ) {
                    if (data) {
                        data = JSON.parse( data );
                    } else {
                        data = {};
                    }
                }
                _.each(
                    that.panels,
                    function( $rows,  device ) {
                        var device_data = {};
                        if ( _.isObject( data[ device ] ) ) {
                            device_data = data[ device ];
                        }

                        _.each(device_data, function(cols, row_id) {
                            if (!_.isUndefined(cols)) {

                                _.each(cols, function( items, col_id ) {
                                    _.each( items, function(node, index ){
                                        that.addNewWidget( device, row_id, col_id, node, index );
                                    } );

                                });
                            }
                        });
                    }
                );

                that.ready = true;
            },
            focus: function(){
                this.container.on(
                    'click',
                    '.real-home-item-setting, .real-home-item-name, .item-tooltip',
                    function( e ) {
                        e.preventDefault();
                        var section = $( this ).data( 'section' ) || '';
                        var control = $( this ).attr( 'data-control' ) || '';
                        var did     = false;
                        if ( control ) {
                            if ( ! _.isUndefined( wp_customize.control( control ) ) ) {
                                wp_customize.control( control ).focus();
                                did = true;
                            }
                        }
                        if ( ! did ) {
                            if ( section && ! _.isUndefined( wp_customize.section( section ) ) ) {
                                wp_customize.section( section ).focus();
                                did = true;
                            }
                        }
                    }
                );

                // Focus rows
                this.container.on(
                    'click',
                    '.real-home-row-settings',
                    function( e ){
                        e.preventDefault();
                        var id = $( this ).attr( 'data-id' ) || '';

                        var section = options.id + '_' + id;
                        if ( ! _.isUndefined( wp_customize.section( section ) ) ) {
                            wp_customize.section( section ).focus();
                        }
                    }
                );

            },
            remove: function(){
                var that = this;
                $document.on(
                    'click',
                    '.real-home-device-panel .real-home-item-remove',
                    function ( e ) {
                        e.preventDefault();
                        var item  = $( this ).closest( '.grid-stack-item' );
                        var panel = item.closest( '.real-home-device-panel' );
                        item.removeAttr( 'style' );
                        $( '.real-home-available-items', panel ).append( item );
                        that.save();
                    }
                );

            },
            encodeValue: function( value ){
                return encodeURI( JSON.stringify( value ) )
            },
            decodeValue: function( value ){
                return JSON.parse( decodeURI( value ) );
            },

            save: function() {
                var that = this;
                if (!that.ready) {
                    return;
                }

                var data = {};

                _.each( that.devices, function( device_label, device ){
                    data[ device ] = {};
                    var devicePanel = $( '.real-home-panel-'+device, that.container );
                    $( '.real-home-row', devicePanel ).each( function(){
                        var row = $( this );
                        var row_id = row.attr( 'data-row-id' ) || false;
                        var rowData = { };
                        if ( row_id ) {

                            $( '.col-items', row ).each( function(){
                                var col = $( this );
                                var col_id = col.attr( 'data-id' ) || false;
                                if ( col_id ) {
                                    var colData = _.map(
                                        $(" > .grid-stack-item", col ),
                                        function(el) {
                                            el = $(el);
                                            return {
                                                id: el.data("id") || ""
                                            };
                                        }
                                    );
                                    rowData[ col_id ] = colData;
                                }
                            } );

                            data[ device ][ row_id ] = rowData;
                        }
                    } );
                } );

                wp_customize.control( that.controlId ).setting.set( that.encodeValue( data ) );
            },

            showPanel: function(){
                this.container.removeClass( 'real-home-builder--hide' ).addClass( 'real-home-builder-show' );
                setTimeout(
                    function(){
                        $( '#customize-preview' ).addClass( 'cb--preview-panel-show' );
                    },
                    100
                );
            },
            hidePanel: function(){
                this.container.removeClass( 'real-home-builder-show' );
                cwp_hide_item_panel( this.container.find( '.real-home-available-items' ) );
                $( '#customize-preview' ).removeClass( 'cb--preview-panel-show' ).removeAttr( 'style' );
            },
            togglePanel: function(){
                var that = this;
                wp_customize.state( 'expandedPanel' ).bind(
                    function( paneVisible ) {
                        if ( wp_customize.panel( options.panel ).expanded() ) {
                            $document.trigger( 'real_home_panel_builder_open', [ options.panel ] );
                            top._current_builder_panel = id;
                            that.showPanel();
                        } else {
                            that.hidePanel();
                        }
                    }
                );

                that.container.on(
                    'click',
                    '.real-home-panel-close',
                    function(e){
                        e.preventDefault();
                        that.container.toggleClass( 'real-home-builder--hide' );
                        if ( that.container.hasClass( 'real-home-builder--hide' ) ) {
                            $( '#customize-preview' ).removeClass( 'cb--preview-panel-show' );
                        } else {
                            $( '#customize-preview' ).addClass( 'cb--preview-panel-show' );
                        }
                    }
                );

            },
            panelLayoutCSS: function(){
                var sidebarWidth = $( '#customize-controls' ).width();
                if ( ! wp_customize.state( 'paneVisible' ).get() ) {
                    sidebarWidth = 0;
                }
				this.container.find( '.real-home-inner' ).css( {'margin-left': sidebarWidth } );

            },
            init: function( controlId, items, devices ){
                var that = this;

                var template    = that.getTemplate();
                var template_id = 'tmpl-real-home-builder-panel';
                var html        = template( options , template_id );
                that.container  = $( html );
                $( 'body .wp-full-overlay' ).append( that.container );
                that.controlId = controlId;
                that.items     = items;
                that.devices   = devices;

                if ( options.section ) {
                    wp_customize.section( options.section ).container.addClass( 'real-home-hide' );
                }

                that.addDevicePanels();
                that.switchToDevice( that.activePanel );
                that.addAvailableItems();
                that.switchToDevice( that.activePanel );
                that.drag_drop();
                that.focus();
                that.remove();
                that.addExistingRowsItems();

                if ( wp_customize.panel( options.panel ).expanded() ) {
                    that.showPanel();
                } else {
                    that.hidePanel();
                }

                wp_customize.previewedDevice.bind(
                    function( newDevice ) {
                        if ( newDevice === 'desktop' ) {
                            that.switchToDevice( 'desktop', false );
                        } else {
                            that.switchToDevice( 'mobile', false );
                        }
                    }
                );

                that.togglePanel();
                if ( wp_customize.state( 'paneVisible' ).get() ) {
                    that.panelLayoutCSS();
                }
                wp_customize.state( 'paneVisible' ).bind(
                    function(){
                        that.panelLayoutCSS();
                    }
                );

                $( window ).resize(
                    _.throttle(
                        function(){
                            that.panelLayoutCSS();
                        },
                        100
                    )
                );

                // Switch panel
                that.container.on(
                    'click',
                    '.real-home-devices-switcher a.switch-to',
                    function(e){
                        e.preventDefault();
                        var device = $( this ).data( 'device' );
                        that.switchToDevice( device );
                        $( '.real-home-body' ).find( '.real-home-available-items' ).each(
                            function () {
                                cwp_hide_item_panel( $( this ) );
                            }
                        )
                    }
                );
                $document.trigger( 'real_home_builder_panel_loaded', [ id, that ] );
            },
        };

        Builder.init( options.control_id, options.items, options.devices );
        return Builder;
    };

    wp_customize.bind(
        'ready',
        function( e, b ) {
            _.each(
                Real_Home_Customizer_Builder.builders,
                function( opts, id ){
                    new CustomizeBuilder( opts, id );
                }
            );

            wp_customize.bind(
                'pane-contents-reflowed',
                function(){
                    setTimeout(
                        function(){
                            if ( $( '#sub-accordion-panel-widgets .no-widget-areas-rendered-notice .footer_moved_widgets_text' ).length ) {

                            } else {
                                $( '#sub-accordion-panel-widgets .no-widget-areas-rendered-notice' ).append( '<p class="footer_moved_widgets_text">' + Real_Home_Customizer_Builder.footer_moved_widgets_text + '</p>' );
                            }

                        },
                        1000
                    );
                }
            );

            // When focus section
            wp_customize.state( 'expandedSection' ).bind(
                function( section ) {
                    $( '.real-home-device-panel .grid-stack-item' ).removeClass( 'item-active' );
                    $( '.real-home-row' ).removeClass( 'row-active' );
                    if ( section ) {
                        $( '.real-home-row[data-id="' + section.id + '"]' ).addClass( 'row-active' );
                        $( '.real-home-device-panel .grid-stack-item.for-s-' + section.id ).addClass( 'item-active' );
                    }
                }
            );
        }
    );

    // Focus
    $document.on(
        'click',
        '.focus-section',
        function( e ) {
            e.preventDefault();
            var id = $( this ).attr( 'data-id' ) || '';
            if ( ! id ) {
                id = $( this ).attr( 'href' ) || '';
                id = id.replace( '#','' );
            }

            if ( id ) {
                if ( wp_customize.section( id ) ) {
                    wp_customize.section( id ).focus();
                }
            }
        }
    );

    $document.on(
        'click',
        '.focus-control',
        function( e ) {
            e.preventDefault();
            var id = $( this ).attr( 'data-id' ) || '';
            if ( ! id ) {
                id = $( this ).attr( 'href' ) || '';
                id = id.replace( '#','' );
            }
            if ( id ) {
                if ( wp_customize.control( id ) ) {
                    wp_customize.control( id ).focus();
                }
            }
        }
    );

    $document.on(
        'click',
        '.focus-panel',
        function( e ) {
            e.preventDefault();
            var id = $( this ).attr( 'data-id' ) || '';
            if ( ! id ) {
                id = $( this ).attr( 'href' ) || '';
                id = id.replace( '#','' );
            }
            if ( id ) {

                if ( wp_customize.panel( id ) ) {
                    wp_customize.panel( id ).focus();
                }
            }
        }
    );

    var encodeValue = function( value ){
        return encodeURI( JSON.stringify( value ) )
    };

    $document.on(
        'mouseover',
        '.real-home-row .grid-stack-item',
        function( e ) {
            e.preventDefault();
            var item  = $( this );
            var nameW = $( '.real-home-item-remove',item ).outerWidth() + $( '.real-home-item-setting',item ).outerWidth();
            var itemW = $( '.grid-stack-item-content', item ).innerWidth();
            if ( nameW > itemW - 50 ) {
                item.addClass( 'show-tooltip' );
            }
        }
    );

    $document.on(
        'mouseleave',
        '.real-home-row .grid-stack-item',
        function( e ) {
            e.preventDefault();
            $( this ).removeClass( 'show-tooltip' );
        }
    );

    /*Add a Item*/
    $document.on(
        'click',
        '.real-home-add-new-item',
        function( e ) {
            e.preventDefault();
            var this_add_new = $( this ),
                this_item_wrap   = this_add_new.next( '.real-home-available-items' );
            if ( ! this_item_wrap.length ) {
                this_item_wrap = this_add_new.closest( '.real-home-sidebar' ).next( '.real-home-available-items' );
            }
            if ( this_item_wrap.length ) {
                this_item_wrap.toggleClass( 'real-home-show-items' );
                $( 'body' ).toggleClass( 'real-home-body-overlay' );
                this_add_new.toggleClass( 'real-home-hide-items' );
            }

        }
    );
    function cwp_hide_item_panel(this_item_wrap){

        var this_add_new = this_item_wrap.prev( '.real-home-add-new-item' );
        if ( ! this_add_new.length ) {
            this_add_new = this_add_new.prev( '.real-home-sidebar' ).find( '.real-home-add-new-item' );
        }
        if ( this_item_wrap.length ) {
            this_item_wrap.removeClass( 'real-home-show-items' );
            $( 'body' ).removeClass( 'real-home-body-overlay' );
            this_add_new.removeClass( 'real-home-hide-items' );
        }

    }
    $document.on(
        'click',
        '.real-home-close-item-panel',
        function( e ) {
            e.preventDefault();
            var this_close_item_panel = $( this ),
                this_item_wrap  = this_close_item_panel.closest( '.real-home-available-items' );

            cwp_hide_item_panel( this_item_wrap );

        }
    );

})( jQuery, wp.customize || null );
