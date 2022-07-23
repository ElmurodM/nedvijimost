/**
 * Customizer Controls
 *
 * @package Real_Home
 */

/* global wp, jQuery */

( function( $, api ) {

    // Assign dimensions sides object
    const width_sides = {side_1:"Top", side_2:"Right", side_3:"Bottom", side_4:"Left"};

    /**
     * Utility function that linked sides.
     *
     * @param control id
     * @param key target class
     */
    const real_home_linked = ( id, key ) => {

        let holder = $('.customize-control .control-wrap.' + key );

        holder.find('.dimensions').addClass( 'linked' ).removeClass( 'unlinked' );
        holder.find('.dimensions .dimension').each( function() {
            $( this ).find('input[type="number"]').addClass( 'linked' ).attr( 'data-element',id );
        });

        holder.find('.link-dimensions-wrap .link-dimensions').removeClass( 'unlinked' );
        holder.find('.link-dimensions-wrap .link-dimensions input[type="hidden"]').val( 'on' );
    }

    /**
     * Utility function that unlinked sides.
     *
     * @param key target class
     */
    const real_home_unlinked = ( key ) => {

        let holder = $('.customize-control .control-wrap.' + key );

        holder.find('.dimensions').addClass( 'unlinked' ).removeClass( 'linked' );
        holder.find('.dimensions .dimension').each( function() {
            $( this ).find('input[type="number"]').removeClass( 'linked' ).attr( 'data-element','' );
        });

        holder.find('.link-dimensions-wrap .link-dimensions').addClass( 'unlinked' );
        holder.find('.link-dimensions-wrap .link-dimensions input[type="hidden"]').val( 'off' );
    }

    // Group Settings
    /**
     * Utility function that hides all the controls in the panel except the tabs control.
     *
     * @param customizerSection
     * @param customizerTab
     */
    const real_home_hide_controls = ( customizerSection , customizerTab ) => {

        let newControls = [];

        $(customizerSection).find( '#'+ customizerTab +' .customizer-tab' ).each( function() {

            let input_wrap = $(this).find('input'),
                input_controls = input_wrap.data('controls');

            $.merge( newControls, input_controls.split(','));
        });

        $.each( newControls, function( i, val ) {

            $( customizerSection ).children( 'li#customize-control-'+val ).removeClass( 'group-control-wrap' ).css( 'display', 'none' );
            // $( customizerSection ).children( 'li#customize-control-'+val ).css( 'display', 'none' );
        });
    }

    /**
     * Handles showing the controls when the tab is clicked.
     *
     * @param customizerSection
     * @param controlsToShowArray
     */
    const real_home_show_controls = ( customizerSection, controlsToShowArray ) => {

        $.each( controlsToShowArray, function ( index, controlId ) {

            let parentSection = customizerSection[0];

            if ( controlId === 'widgets' ) {
                $( parentSection ).children( 'li[class*="widget"]' ).css( 'display', 'list-item' );
                return true;
            }

            let controlWrap = $( '#customize-control-' + controlId ),
                controlClass = '';


            if ( ( controlsToShowArray.length === 1 ) && ( index === 0 ) ) {
                controlClass = 'first-child last-child';
            } else if ( index === 0 ) {
                controlClass = 'first-child';
            } else if ( index === ( controlsToShowArray.length - 1 ) ) {
                controlClass = 'last-child';
            }

            controlWrap.addClass( 'group-control-wrap' + ' ' + controlClass ).css( 'display', 'list-item' );
        });
    }

    /**
     * Icon options
     *
     * @param icon
     * @return string
     */
    const real_home_format_Text = ( icon ) => {
        return $('<span><i class="fa ' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
    }

    /**
     * Add color pick custom class
     */
    $(window).on("load", function() {
        $('html').addClass('color-picker-ready');
    });

    /**
     * Document Ready jQuery
     */
    $( document ).ready( function() {
        'use strict';

        // Disconnected button
        $( '.control-wrap .link-dimensions .unlinked' ).on( 'click', function() {
            let holder 	= $( this ).closest( '.control-wrap'),
                element = $( this ).data('element');

            holder.find('ul.dimensions').addClass('linked').removeClass('unlinked');

            holder.find('.link-dimensions-wrap .link-dimensions input[type="hidden"]').val('on').trigger( 'change' );
            holder.find('.link-dimensions-wrap .link-dimensions').removeClass('unlinked');
            holder.find('.dimensions li.dimension').each( function() {
                $( this ).find('input[type="number"]').addClass( 'linked' ).attr( 'data-element', element );
            });
        } );

        // Connected button
        $( '.control-wrap .link-dimensions .linked' ).on( 'click', function() {
            let holder  = $( this ).closest( '.control-wrap');

            holder.find('ul.dimensions').addClass('unlinked').removeClass('linked');
            holder.find('.link-dimensions-wrap .link-dimensions input[type="hidden"]').val('off').trigger( 'change' );
            holder.find('.link-dimensions-wrap .link-dimensions').addClass('unlinked');
            holder.find('.dimensions li.dimension').each( function() {
                $( this ).find('input[type="number"]').removeClass( 'linked' ).attr( 'data-element','' );
            });

        } );

        // Values linked inputs
        $( '.control-wrap .dimensions' ).on( 'input', '.dimension-input', function() {

            let dataElement 	  = $(this).attr( 'data-element' ),
                currentFieldValue = $(this).val();

            if ( dataElement !== '' ) {
                $(this).closest('.control-wrap').find('.dimension .linked[ data-element="' + dataElement + '" ]').each(function() {
                    $(this).val( currentFieldValue ).change();
                } );
            }
            else {
                $(this).val( currentFieldValue ).change();
            }
        } );

        // Units select
        $( '.units-wrap .units .single-unit' ).on( 'click', function() {

            let $this	= $(this);

            if ( $this.hasClass('active') ) {
                return false;
            }
            $this.siblings().removeClass('active');
            $this.addClass('active');

        } );

        // Range slide
        $( '.control-wrap' ).on( 'input change', 'input[type="range"].range', function() {
            let input_number    = $( this ).closest( '.control-wrap' ).find( '.range-input input[type="number"]' ),
                value           = $( this ).val();
            input_number.val( value );
            input_number.trigger( 'change' );
        });
        // $( '.control-wrap' ).on( 'input change', 'input[type="number"].range-input', function() {
        // 	let input_slide    = $( this ).closest( '.control-wrap' ).find( 'input[type="range"].range' ),
        // 		value          = $( this ).val();
        // 	input_slide.val( value );
        // 	input_slide.trigger( 'change' );
        // });

        // Toggle
        $( '.custom-toggle-btn-wrap input[type="checkbox"]' ).on( 'click', function() {
            let toggle    	= $( this ).closest( '.control-wrap.active' ).find( '.custom-toggle-btn-wrap .custom-toggle-btn' ),
                value     	= $( this ).is(':checked') ? true : false;
            toggle.val( value ).trigger( 'change' );
        } );

        // Buttonset
        // $( '.buttonset-control input[type="radio"]' ).on( 'click', function() {
        //
        //     let buttonset	= $( this ).closest( '.control-wrap.active' ).find( '.buttonset' ),
        //         value     	= $( this ).val();
        //     buttonset.prop( 'checked', true );
        //     buttonset.val( value ).trigger( 'change' );
        // } );

        // Icon Picker Preview
        $( '.fa-icons-list li' ).on( 'click', function() {
            $(this).parents('.fa-icons-list').find('li').removeClass();
            $(this).addClass('selected');
            var iconVal = $(this).parents('.icons-list-wrapper').find('li.selected').children('i').attr('class');
            var inpiconVal = iconVal.split(' ');
            $(this).parents( '.fa-icons-list' ).find('.ap-icon-value').val(inpiconVal[1]);
            $(this).parents( '.fa-icons-list' ).find('.selected-icon-preview').html('<i class="' + iconVal + '"></i>');
            $('.ap-icon-value').trigger('change');
        });

        // Radio image label dynamic active class to label
        $( 'label.radio-image-label' ).on( 'click', function() {
            $(this).closest( '.control-wrap').find( 'label.radio-image-label' ).each( function () {
                $(this).removeClass('radio-image-label-on');
            });
            $(this).addClass('radio-image-label-on');
        });

        // Buttonset label dynamic active class to label
        $( 'label.buttonset-label' ).on( 'click', function() {
            $(this).closest( '.control-wrap').find( 'label.buttonset-label' ).each( function () {
                $(this).removeClass('buttonset-label-on');
            });
            $(this).addClass('buttonset-label-on');
        });

    });

    /**
     * Responsive Device Toggle Active Class
     */
    $( document ).ready( function() {

        $( '.responsive-devices button' ).on( 'click', function( event ) {

            // Set up variables
            let $this 		= $( this ),
                $devices 	= $( '.responsive-devices' ),
                $device 	= $( event.currentTarget ).data( 'device' ),
                $control 	= $( '.has-responsive-switcher' ),
                $body 		= $( '.wp-full-overlay' ),
                $customizer_builder = $( '.customize-builder' ),
                $footer_devices 	= $( '.wp-full-overlay-footer' );

            // Button class
            $devices.find( 'button' ).removeClass( 'active' );
            $devices.find( 'button.preview-' + $device ).addClass( 'active' );

            // Control class
            $control.find( '.control-wrap' ).removeClass( 'active' );
            $control.find( '.control-wrap.' + $device ).addClass( 'active' );
            $control.removeClass( 'control-device-desktop control-device-tablet control-device-mobile' ).addClass( 'control-device-' + $device );

            // Wrapper class
            $body.removeClass( 'preview-desktop preview-tablet preview-mobile' ).addClass( 'preview-' + $device );

            // Panel footer buttons
            $footer_devices.find( 'button' ).removeClass( 'active' ).attr( 'aria-pressed', false );
            $footer_devices.find( 'button.preview-' + $device  ).addClass( 'active' ).attr( 'aria-pressed', true );

            // Customizer builder
            $customizer_builder.find( '.cb-devices-switcher a' ).removeClass( 'tab-active' ).attr( 'aria-pressed', false );
            $customizer_builder.find( '.cb-devices-switcher a.switch-to-' + $device ).addClass( 'tab-active' ).attr( 'aria-pressed', true );

        } );

        // If panel footer buttons clicked
        $( '.wp-full-overlay-footer .devices button' ).on( 'click', function( event ) {

            // Set up variables
            let $this 		= $( this ),
                $devices 	= $( '.responsive-devices' ),
                $device 	= $( event.currentTarget ).data( 'device' ),
                $control 	= $( '.has-responsive-switcher' ),
                $body 		= $( '.wp-full-overlay' ),
                $footer_devices = $( '.wp-full-overlay-footer' );

            // Button class
            $devices.find( 'button' ).removeClass( 'active' );
            $devices.find( 'button.preview-' + $device ).addClass( 'active' );

            // Control class
            $control.find( '.control-wrap' ).removeClass( 'active' );
            $control.find( '.control-wrap.' + $device ).addClass( 'active' );
            $control.removeClass( 'control-device-desktop control-device-tablet control-device-mobile' ).addClass( 'control-device-' + $device );

            // Wrapper class
            $body.removeClass( 'preview-desktop preview-tablet preview-mobile' ).addClass( 'preview-' + $device );

            // Panel footer buttons
            $footer_devices.find( 'button' ).removeClass( 'active' ).attr( 'aria-pressed', false );
            $footer_devices.find( 'button.preview-' + $device ).addClass( 'active' ).attr( 'aria-pressed', true );
        } );
    } );

	/**
	 * Group control to hide on document ready
	 *
	 */
	$( document ).ready( function() {
		// Hide all controls
		$( '.customizer-group-control' ).each( function () {
			let customizerSection   = $( this ).closest( '.accordion-section' ),
				customizerTab       = $(this).closest('.customize-control-real_home_group').attr('id'),
				shownCtrls          = $(this).find( '.customizer-tab > .active' ).data( 'controls' );

			// Hide all controls in section.
			real_home_hide_controls( customizerSection, customizerTab );

			// Show controls under first radio button.
			real_home_show_controls( customizerSection, shownCtrls.split(',') );

		} );
	} );

    api.sectionConstructor['real_home_custom_section'] = api.Section.extend( {

        // No events for this type of section.
        attachEvents: function() {
        },

        // Always make the section active.
        isContextuallyActive: function() {
            return true
        }
    });

    /**
     * Customizer Control: real_home_background
     */
    api.controlConstructor['real_home_background'] = api.Control.extend( {

        ready: function() {

            let control = this;

            // Set Values
            control.setValues();

            // Save values
            control.container.on( 'change keyup paste', 'select, input', function() {
                control.saveValues();
            });

            // Reset Data
            control.resetValues();

            // Upload Image
            control.container.on( 'click', '.background-image .attachment-media-view .upload-button', function( e ) {

                let $this       = $(this),
                    url_field   = $this.closest( '.background-image').find( '.background-image-url' );

                let image = wp.media({ multiple: false }).open().on( 'select', function() {

                    // This will return the selected image from the Media Uploader, the result is an object.
                    let uploadedImage = image.state().get( 'selection' ).first(),
                        previewImage   = uploadedImage.toJSON().sizes.full.url,
                        imageUrl,
                        // imageID,
                        // imageWidth,
                        // imageHeight,
                        preview;

                    if ( ! _.isUndefined( uploadedImage.toJSON().sizes.medium ) ) {
                        previewImage = uploadedImage.toJSON().sizes.medium.url;
                    } else if ( ! _.isUndefined( uploadedImage.toJSON().sizes.thumbnail ) ) {
                        previewImage = uploadedImage.toJSON().sizes.thumbnail.url;
                    }

                    imageUrl    = uploadedImage.toJSON().sizes.full.url;
                    // imageID     = uploadedImage.toJSON().id;
                    // imageWidth  = uploadedImage.toJSON().width;
                    // imageHeight = uploadedImage.toJSON().height;

                    url_field.val(imageUrl).trigger( 'change' );

                    preview = control.container.find( '.background-image .attachment-media-view' );

                    if ( preview.length ) {

                        preview.addClass( 'attachment-media-view-image landscape' ).html( '<div class="thumbnail thumbnail-image"><img class="attachment-thumb" src="' + previewImage + '" alt="" /></div><div class="actions"><button type="button" class="button remove-button">Remove</button><button type="button" class="button upload-button control-focus">Change image</button></div>' );
                    }

                });

                e.preventDefault();

            });

            // Remove Image
            control.container.on( 'click', '.background-image .attachment-media-view .actions .remove-button', function( e ) {

                e.preventDefault();

                let $this = $(this);

                $this.closest( '.background-image').find( '.background-image-url' ).val( '' ).trigger( 'change' );
                $this.closest( '.background-image').find( '.attachment-media-view' ).removeClass( 'attachment-media-view-image landscape' ).html( '<button type="button" class="upload-button button-add-media">Select Image</button>' );

            });
        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this;

            const colors = control.params.colors;

            if ( control.params.value.length <= 0 ) {

                // Initial color picker
                Object.keys( colors ).forEach( function ( key ) {
                    $('.background-colors .color-picker .' + key, control.container).wpColorPicker({
                        change: function(event, ui) {
                            if ( $('html').hasClass('color-picker-ready') ) {
                                setTimeout( function() {
                                    // Save value on change
                                    control.saveValues();
                                }, 100 );
                            }
                        }
                    });
                });

                ['color_1', 'color_2'].forEach( function ( key ) {
                    $('.background-gradient .color-picker .' + key, control.container).wpColorPicker({
                        change: function(event, ui) {
                            if ( $('html').hasClass('color-picker-ready') ) {
                                setTimeout( function() {
                                    // Save value on change
                                    control.saveValues();
                                }, 100 );
                            }
                        }
                    });
                });

                return ;
            }

            // Assign constant variables
            const fields = control.params.fields,
                values = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            // Dynamic loop to set values with related fields
            Object.keys( fields ).forEach( function ( item ) {

                // for gradient
                if ( item === 'gradient' ) {
                    ['color_1','color_2'].forEach( ( key ) => {
                        let v = values[item] !== undefined ? values[item][key] : '';
                        $('.background-gradient .color-picker .' + key, control.container).val(v);
                        $('.background-gradient .color-picker .' + key, control.container).wpColorPicker({
                            change: function(event, ui) {
                                if ( $('html').hasClass('color-picker-ready') ) {
                                    setTimeout( function() {
                                        // Save value on change
                                        control.saveValues();
                                    }, 100 );
                                }
                            }
                        });
                    });
                }

                // for background
                else if ( item === 'background' ) {

                    $( '.background', control.container ).find( 'input.buttonset' ).each( function() {
                        let choiceID = $( this).attr("id"),
                            targetID = control.id + '-' + values[item];

                        if ( choiceID === targetID ) {
                            $( this ).attr( 'checked', 'checked' );
                            $( this ).next('label').addClass('buttonset-label-on');
                        }
                        else {
                            $( this ).next('label').removeClass('buttonset-label-on');
                        }
                    });
                }

                // for image
                else if ( item === 'image' && values[item] ) {

                    $('.background-image .attachment-media-view', control.container).addClass( 'attachment-media-view-image landscape' ).html( '<div class="thumbnail thumbnail-image"><img class="attachment-thumb" src="' + values[item] + '" alt="" /></div><div class="actions"><button type="button" class="button remove-button">Remove</button><button type="button" class="button upload-button control-focus">Change image</button></div>' );

                    $('.control-wrap .background-' + item + '-url', control.container).val( values[item] );

                }
                // for colors
                else if ( item === 'colors' ) {
                    Object.keys( colors ).forEach( ( key ) => {
                        let v = values[item] !== undefined ? values[item][key] : '';
                        $('.background-colors .color-picker .' + key, control.container).val(v);
                        $('.background-colors .color-picker .' + key, control.container).wpColorPicker({
                            change: function(event, ui) {
                                if ( $('html').hasClass('color-picker-ready') ) {
                                    setTimeout( function() {
                                        // Save value on change
                                        control.saveValues();
                                    }, 100 );
                                }
                            }
                        });
                    });
                }
                else {

                    $('.control-wrap .background-' + item + '-select', control.container).find('option[value="' + values[item]  + '"]').attr('selected', 'selected');
                }

            });
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this, v,
                css     = {};

            // Assign constant variables
            const fields = control.params.fields;

            const colors = control.params.colors;

            // Dynamic loop to set values with related fields
            Object.keys( fields ).forEach( function ( item ) {

                // for background type
                if ( item === 'background' ) {

                    $( '.background', control.container ).find( 'input.buttonset' ).each( function() {
                        let choice  = $( this ),
                            v       = choice.val();
                        if( choice.is(':checked') ) {
                            css[item] = v;
                        }
                    });
                }
                // for image
                else if ( item === 'image' ) {

                    v = $('.control-wrap .background-' + item + '-url', control.container).val();

                    if ( v ) {
                        css[item] = v;
                    }
                }
                // for colors
                else if ( item === 'colors' ) {

                    let color_values = {};

                    Object.keys( colors ).forEach( ( key ) => {
                        v = $('.background-colors .color-picker .' + key, control.container).val();
                        if ( v ) {
                            color_values[key] = v;
                        }
                    });
                    css[item] = color_values;
                }
                // for gradient
                else if ( item === 'gradient' ) {

                    let gradient_values = {};

                    ['color_1','color_2'].forEach( ( key ) => {
                        v = $('.background-gradient .color-picker .' + key, control.container).val();
                        if ( v ) {
                            gradient_values[key] = v;
                        }
                    });
                    css[item] = gradient_values;
                }
                else {

                    v = $('.control-wrap .background-' + item + '-select', control.container).val();

                    if ( v ) {
                        css[item] = v;
                    }
                }

            });
            control.settings['default'].set( css );
        },

        /**
         * Reset values
         */
        resetValues: function(){

            let control = this, v, r;

            control.container.on( 'click', '.reset-value', function() {

                const holder = $( this ).closest('.customize-control-real_home_background',control.container);

                Object.keys( control.params.fields ).forEach( function ( item ) {

                    // for image
                    if ( item === 'image' ) {

                        holder.find( '.background-' + item + ' input[type="hidden"]' ).each( function() {
                            r = $( this ).data('reset');

                            if ( r === '' ) {
                                holder.find('.background-image .attachment-media-view').removeClass( 'attachment-media-view-image landscape' ).html( '<button type="button" class="upload-button button-add-media">Select Image</button>' );
                            }
                            else {
                                holder.find('.background-image .attachment-media-view').addClass( 'attachment-media-view-image landscape' ).html( '<div class="thumbnail thumbnail-image"><img class="attachment-thumb" src="' + r + '" alt="" /></div><div class="actions"><button type="button" class="button remove-button">Remove</button><button type="button" class="button upload-button control-focus">Change image</button></div>' );
                            }
                            $( this ).val( r ).trigger( 'change' );
                        });
                    }

                    // for colors
                    else if ( item === 'colors' ) {
                        holder.find( '.background-colors .color-picker' ).each( function() {
                            let colors  = $( this ).find('.wp-picker-container .alpha-color-control'),
                                r       = colors.data( 'reset' );
                            colors.val(r).trigger( 'change' );
                        });
                    }

                    // for gradient
                    else if ( item === 'gradient' ) {
                        holder.find( '.background-gradient .color-picker' ).each( function() {
                            let colors  = $( this ).find('.wp-picker-container .alpha-color-control'),
                                r       = colors.data( 'reset' );

                            colors.val(r).trigger( 'change' );
                        });
                    }

                    // for background type
                    else if ( item === 'background' ) {

                        holder.find( '.background input.buttonset' ).each( function() {

                            r = $( this ).data( 'reset' );
                            r = ( '' !== r ) ? r : 'color';
                            let choiceID = $( this).attr("id"),
                                targetID = $( this).attr("name") + '-' + r;

                            if ( choiceID === targetID ) {
                                $( this ).prop( 'checked', true );
                                $( this ).next('label').addClass('buttonset-label-on');
                            }
                            else {
                                $( this ).prop( 'checked', false );
                                $( this ).next('label').removeClass('buttonset-label-on');
                            }
                        });
                    }

                    // for select
                    else {

                        holder.find( '.background-' + item + ' .background-' + item + '-select' ).each( function() {
                            r = $( this ).data( 'reset' );
                            v = $( this ).find( 'option:selected' ).val();

                            if ( r !== v ) {
                                // remove attr
                                $( this ).find('option').removeAttr('selected' );
                                // add attr
                                $( this ).find( 'option[value="' + r + '"]' ).attr('selected', 'selected').trigger( 'change' );
                            }
                        });
                    }

                });

                control.settings['default'].set( control.params.default );
            });
        }
    } );

    /**
     * Customizer Control: real_home_border
     */
    api.controlConstructor['real_home_border'] = api.Control.extend( {

        ready: function() {

            let control = this;

            // Set Values
            control.setValues();

            // Save values
            control.container.on( 'change keyup paste', 'select, input', function() {
                control.saveValues();
            });

            // Reset Data
            control.resetValues();
        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this,v,u;

            const colors = control.params.colors;

            if ( control.params.value.length <= 0 ) {

                // Initial color picker
                Object.keys( colors ).forEach( function ( key ) {
                    $('.border-colors .color-picker .' + key, control.container).wpColorPicker({
                        change: function(event, ui) {
                            if ( $('html').hasClass('color-picker-ready') ) {
                                setTimeout( function() {
                                    // Save value on change
                                    control.saveValues();
                                }, 100 );
                            }
                        }
                    });
                });

                return ;
            }

            // Assign constant variables
            const fields = control.params.fields,
                values = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            // Units
            const units = control.params.units;

            // Dynamic loop to set values with related fields
            Object.keys( fields ).forEach( function ( item ) {

                // for colors
                if ( item === 'colors' ) {
                    Object.keys( colors ).forEach( ( key ) => {
                        let v = values[item] !== undefined ? values[item][key] : '';
                        $('.border-colors .color-picker .' + key, control.container).val(v);
                        $('.border-colors .color-picker .' + key, control.container).wpColorPicker({
                            change: function(event, ui) {
                                if ( $('html').hasClass('color-picker-ready') ) {
                                    setTimeout( function() {
                                        // Save value on change
                                        control.saveValues();
                                    }, 100 );
                                }
                            }
                        });
                    });
                }
                // for Style
                if ( item === 'style' ) {
                    $('.control-wrap .border-' + item + '-select', control.container).find('option[value="' + values[item]  + '"]').attr('selected', 'selected');
                }
                // for Width
                if ( item === 'width' ) {

                    // Sides
                    Object.keys( width_sides ).forEach( ( side, index ) => {
                        if ( values[item] !== undefined && values[item][side] !== undefined ) {
                            v = isNaN( parseFloat( values[item][side] ) ) ? '' : parseFloat( values[item][side] );
                            u = ( values[item][side] && !$.isNumeric(values[item][side] ) ) ? values[item][side].replace(v,'') : units[0];
                            $('.border-' + item + ' .border-width-' + side + ' input[type="number"].on-field', control.container).val( v );
                        }
                    });

                    // Active unit
                    $('.units-wrap .units', control.container).find('.single-unit').siblings().removeClass('active');
                    $('.units-wrap .units', control.container).find('.single-unit[data-unit="' + u + '"]').addClass('active');

                    // Linked
                    if ( values[item] !== undefined && values[item]['linked'] !== undefined ) {

                        if ( values[item]['linked'] === 'on' ) {
                            real_home_linked( control.id, 'border-control' );
                        }
                        else {
                            real_home_unlinked( 'border-control' );
                        }
                    }
                }
                // for radius
                if ( item === 'radius' ) {
                    v = isNaN( parseFloat( values[item] ) ) ? '' : parseFloat( values[item] );
                    u = ( values[item] && !$.isNumeric(values[item] ) ) ? values[item].replace(v,'') : units[0];

                    $('.border-' + item + ' input[type="range"]', control.container).val( v );
                    $('.border-' + item + ' input[type="number"]', control.container).val( v );
                    // Active unit
                    $('.border-' + item + ' .units-wrap .units', control.container).find('.single-unit').siblings().removeClass('active');
                    $('.border-' + item + ' .units-wrap .units', control.container).find('.single-unit[data-unit="' + u + '"]').addClass('active');
                }

            });
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this, v,u,
                css     = {};

            // Assign constant variables
            const fields = control.params.fields;

            const colors = control.params.colors;

            // Dynamic loop to set values with related fields
            Object.keys( fields ).forEach( function ( item ) {

                // for colors
                if ( item === 'colors' ) {

                    let color_values = {};

                    Object.keys( colors ).forEach( ( key ) => {
                        v = $('.border-colors .color-picker .' + key, control.container).val();
                        if ( v ) {
                            color_values[key] = v;
                        }
                    });
                    css[item] = color_values;
                }
                // for widths
                if ( item === 'width' ) {

                    let sides = {};

                    Object.keys( width_sides ).forEach( ( side, index ) => {
                        v = $('.border-' + item + ' .border-width-'+ side +' input[type="number"].on-field', control.container).val();
                        u = $('.units-wrap .units', control.container ).find('.single-unit.active').data('unit');
                        if ( v ) {
                            sides[side] = v + u;
                        }
                    });

                    // linked
                    sides['linked'] = $('.border-linked .link-dimensions input[type="hidden"]', control.container).val();

                    css[item] = sides;
                }
                // for style
                if ( item === 'style' ) {

                    v = $('.control-wrap .border-' + item + '-select', control.container).val();

                    if ( v ) {
                        css[item] = v;
                    }
                }
                // for radius
                if ( item === 'radius' ) {

                    v = $('.border-' + item + ' input[type="number"]', control.container).val();
                    u = $('.border-' + item + ' .units-wrap .units', control.container).find('.single-unit.active').data('unit');
                    if ( v ) {
                        css[item] = v + u ;
                    }
                }

            });
            control.settings['default'].set( css );
        },

        /**
         * Reset values
         */
        resetValues: function(){

            let control = this, v, r, u;

            // Units
            const units = control.params.units;

            control.container.on( 'click', '.reset-value', function() {

                const holder = $( this ).closest('.customize-control-real_home_border',control.container);

                Object.keys( control.params.fields ).forEach( function ( item ) {

                    // for colors
                    if ( item === 'colors' ) {
                        holder.find( '.border-colors .color-picker' ).each( function() {
                            let colors  = $( this ).find('.wp-picker-container .alpha-color-control'),
                                r       = colors.data( 'reset' );
                            colors.val(r).trigger( 'change' );
                        });
                    }

                    // for select
                    if ( item === 'style' ) {

                        holder.find( '.border-' + item + ' .border-' + item + '-select' ).each( function() {
                            r = $( this ).data( 'reset' );
                            v = $( this ).find( 'option:selected' ).val();

                            if ( r !== v ) {
                                // remove attr
                                $( this ).find('option').removeAttr('selected' );
                                // add attr
                                $( this ).find( 'option[value="' + r + '"]' ).attr('selected', 'selected').trigger( 'change' );
                            }
                        });
                    }

                    // for radius
                    if ( item === 'radius' ) {

                        // sides
                        holder.find( '.border-' + item + ' input[type="number"]' ).each( function() {
                            r = $( this ).data( 'reset' );
                            v = isNaN( parseFloat( r ) ) ? '' : parseFloat( r );
                            u = ( r && !$.isNumeric( r ) ) ? r.replace(v,'') : units[0];
                            $(this).val(v).trigger( 'change' );
                        });

                        // unit
                        holder.find('.border-' + item + ' .units li.single-unit').removeClass('active');
                        holder.find('.border-' + item + ' .units li.single-unit[data-unit="' + u + '"]').addClass('active').trigger( 'change' );
                    }

                    // for  Width
                    if ( item === 'width' ) {

                        // sides
                        holder.find( '.border-' + item + ' .dimension input[type="number"].on-field' ).each( function() {
                            r = $( this ).data( 'reset' );
                            v = isNaN( parseFloat( r ) ) ? '' : parseFloat( r );
                            u = ( r && !$.isNumeric( r ) ) ? r.replace(v,'') : units[0];
                            $(this).val(v).trigger( 'change' );
                        });

                        // unit
                        holder.find('.units li.single-unit').removeClass('active');
                        holder.find('.units li.single-unit[data-unit="' + u + '"]').addClass('active').trigger( 'change' );

                        // Linked
                        holder.find( '.border-linked .link-dimensions input[type="hidden"]' ).each( function() {

                            r = $( this ).data('reset')
                            r = r === '' ? 'on' : r;

                            if ( r === 'on' ) {
                                real_home_linked( control.id, 'border-control' );
                            }
                            else {
                                real_home_unlinked( 'border-control' );
                            }
                        });
                    }

                });

                control.settings['default'].set( control.params.default );
            });
        }
    } );

    /**
     * Customizer Control: real_home_box_shadow
     */
    api.controlConstructor['real_home_box_shadow'] = api.Control.extend( {

        ready: function() {

            let control = this;

            // Set Values
            control.setValues();

            // Save values
            control.container.on( 'change keyup paste', 'select, input', function() {
                control.saveValues();
            });

            // Reset Data
            control.resetValues();
        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this,v,u;

            const colors = control.params.colors;

            if ( control.params.value.length <= 0 ) {

                // Initial color picker
                Object.keys( colors ).forEach( function ( key ) {
                    $('.box-shadow-colors .color-picker .' + key, control.container).wpColorPicker({
                        change: function(event, ui) {
                            if ( $('html').hasClass('color-picker-ready') ) {
                                setTimeout( function() {
                                    // Save value on change
                                    control.saveValues();
                                }, 100 );
                            }
                        }
                    });
                });

                return ;
            }

            // Assign constant variables
            const fields = control.params.fields,
                values = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            // Units
            const units = control.params.units;

            // Dynamic loop to set values with related fields
            Object.keys( fields ).forEach( function ( item ) {

                // for colors
                if ( item === 'colors' ) {
                    Object.keys( colors ).forEach( ( key ) => {
                        let v = values[item] !== undefined ? values[item][key] : '';
                        $('.box-shadow-colors .color-picker .' + key, control.container).val(v);
                        $('.box-shadow-colors .color-picker .' + key, control.container).wpColorPicker({
                            change: function(event, ui) {
                                if ( $('html').hasClass('color-picker-ready') ) {
                                    setTimeout( function() {
                                        // Save value on change
                                        control.saveValues();
                                    }, 100 );
                                }
                            }
                        });
                    });
                }
                // for toggle
                else if ( item === 'inset' && values['inset'] !== undefined ) {

                    $('.box-shadow-' + item + ' .custom-toggle-btn-wrap input[type="checkbox"]', control.container).prop( 'checked', true );
                }
                // for sliders
                else {
                    v = isNaN( parseFloat( values[item] ) ) ? '' : parseFloat( values[item] );
                    u = ( values[item] && !$.isNumeric(values[item] ) ) ? values[item].replace(v,'') : units[0];

                    $('.box-shadow-' + item + ' input[type="range"]', control.container).val( v );
                    $('.box-shadow-' + item + ' input[type="number"]', control.container).val( v );
                    // Active unit
                    $('.box-shadow-' + item + ' .units-wrap .units', control.container).find('.single-unit').siblings().removeClass('active');
                    $('.box-shadow-' + item + ' .units-wrap .units', control.container).find('.single-unit[data-unit="' + u + '"]').addClass('active');
                }
            });
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this, v,u,
                css     = {};

            // Assign constant variables
            const fields = control.params.fields;

            const colors = control.params.colors;

            // Dynamic loop to set values with related fields
            Object.keys( fields ).forEach( function ( item ) {

                // for colors
                if ( item === 'colors' ) {
                    let color_values = {};
                    Object.keys( colors ).forEach( ( key ) => {
                        v = $('.box-shadow-colors .color-picker .' + key, control.container).val();
                        if ( v ) {
                            color_values[key] = v;
                        }
                    });
                    css[item] = color_values;
                }

                // for toggle
                else if ( item === 'inset' ) {

                    $( '.box-shadow-' + item, control.container ).find( '.custom-toggle-btn-wrap input[type="checkbox"]' ).each( function() {
                        let toggle  = $( this );
                            v       = toggle.val();
                        if( toggle.is(':checked') ) {
                            css[item] = v;
                        }
                    });
                }
                // for range fields
                else {
                    v = $('.box-shadow-' + item + ' input[type="number"]', control.container).val();
                    u = $('.box-shadow-' + item + ' .units-wrap .units', control.container).find('.single-unit.active').data('unit');
                    if ( v ) {
                        css[item] = v + u ;
                    }
                }

            });
            control.settings['default'].set( css );
        },

        /**
         * Reset values
         */
        resetValues: function(){

            let control = this, v, r, u;

            // Units
            const units = control.params.units;

            control.container.on( 'click', '.reset-value', function() {

                const holder = $( this ).closest('.customize-control-real_home_box_shadow',control.container);

                Object.keys( control.params.fields ).forEach( function ( item ) {

                    // for colors
                    if ( item === 'colors' ) {
                        holder.find( '.box-shadow-colors .color-picker' ).each( function() {
                            let colors  = $( this ).find('.wp-picker-container .alpha-color-control'),
                                r       = colors.data( 'reset' );

                            colors.val(r).trigger( 'change' );
                        });
                    }
                    // for toggle
                    else if ( item === 'inset' ) {

                        holder.find('.box-shadow-' + item + ' .custom-toggle-btn-wrap input[type="checkbox"]' ).each( function() {

                            r = $( this ).data( 'reset' );

                            if ( r !== '' ) {

                                $( this ).prop( 'checked', true );
                            }
                            else {
                                $( this ).prop( 'checked', false );
                            }

                        });
                    }

                    // for slides
                    else {
                        holder.find( '.box-shadow-' + item + ' input[type="number"]' ).each( function() {
                            r = $( this ).data( 'reset' );
                            v = isNaN( parseFloat( r ) ) ? '' : parseFloat( r );
                            u = ( r && !$.isNumeric( r ) ) ? r.replace(v,'') : units[0];
                            $(this).val(v).trigger( 'change' );
                        });

                        // unit
                        holder.find('.box-shadow-' + item + ' .units li.single-unit').removeClass('active');
                        holder.find('.box-shadow-' + item + ' .units li.single-unit[data-unit="' + u + '"]').addClass('active').trigger( 'change' );
                    }
                });

                control.settings['default'].set( control.params.default );
            });
        }
    } );

	/**
	 * Customizer Control: real_home_typography
	 */
	api.controlConstructor['real_home_typography'] = api.Control.extend( {

		ready: function() {

			let control = this;

			// Font Options
			control.selectFontOptions( window.realHomeAllFonts['allFonts'] );
			$( '.typography-font_family select', control.container).html( window.fontFamiliesOptions );

			// Font variants
			control.setFontVariants('');
			control.container.on( 'change', '.typography-font_family select', function() {
				let v = $( this ).val();
				control.setFontVariants( v );
			});

			// Set Values
			control.setValues();

			// Save values
			control.container.on( 'change keyup paste', 'select, input', function() {
				control.saveValues();
			});

			// Reset Data
			control.resetValues();
		},

		/**
		 * Setup values
		 */
		setValues: function(){

			let control = this,v,u,id;

			const colors = control.params.colors;

			if ( control.params.value.length <= 0 ) {

				// Initial color picker
				Object.keys( colors ).forEach( function ( key ) {
					$('.typography-colors .color-picker .' + key, control.container).wpColorPicker({
						change: function(event, ui) {
							if ( $('html').hasClass('color-picker-ready') ) {
								setTimeout( function() {
									// Save value on change
									control.saveValues();
								}, 100 );
							}
						}
					});
				});

				return ;
			}

			// Assign constant variables
			const fields = control.params.fields,
				values = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

			// Units
			const units = control.params.units;

			const devices = control.params.responsive;

			// Dynamic loop to set values with related fields
			Object.keys( fields ).forEach( function ( item ) {

				// for colors
				if ( item === 'colors' ) {
					Object.keys( colors ).forEach( ( key ) => {
						let v = values[item] !== undefined ? values[item][key] : '';
						$('.typography-colors .color-picker .' + key, control.container).val(v);
						$('.typography-colors .color-picker .' + key, control.container).wpColorPicker({
							change: function(event, ui) {
								if ( $('html').hasClass('color-picker-ready') ) {
									setTimeout( function() {
										// Save value on change
										control.saveValues();
									}, 100 );
								}
							}
						});
					});
				}
				// for font family
				if ( item === 'font_family' ) {
					// Get font id
					id = control.getFontId( values[item] );
					$('.typography-' + item + ' select', control.container).find('option[value="' + ( id ) + '"]').attr('selected', 'selected');
				}
				// for variant, text transform. text decoration
				if ( item === 'font_variant' ) {
					control.setFontVariants( id );
					$('.typography-' + item + ' select', control.container).find('option[value="' + ( values[item] ) + '"]').attr('selected', 'selected');
				}

				// for text transform and text decoration
				if ( item === 'text_transform' || item === 'text_decoration' ) {
					$('.typography-' + item + ' select', control.container).find('option[value="' + ( values[item] ) + '"]').attr('selected', 'selected');
				}

				// for font size, line height, letter spacing
				if ( item === 'font_size' || item === 'letter_spacing' || item === 'line_height' ) {

					( devices ).forEach( ( key ) => {

						if ( values[item] !== undefined ) {
							v = isNaN( parseFloat( values[item][key] ) ) ? '' : parseFloat( values[item][key] );
							u = ( values[item][key] && !$.isNumeric(values[item][key] ) ) ? values[item][key].replace(v,'') : units[0];

							$('.typography-' + item + ' .control-wrap.' + key + ' input[type="range"]', control.container).val( v );
							$('.typography-' + item + ' .control-wrap.' + key + ' input[type="number"]', control.container).val( v );
							// Active unit
							$('.typography-' + item + ' .control-wrap.' + key + ' .units', control.container).find('.single-unit').siblings().removeClass('active');
							$('.typography-' + item + ' .control-wrap.' + key + ' .units', control.container).find('.single-unit[data-unit="' + u + '"]').addClass('active');
						}

					});
				}
			});
		},

		/**
		 * Save Values
		 */
		saveValues: function(){

			let control = this, v,u,id,
				css     = {};

			// Assign constant variables
			const fields = control.params.fields;

			const colors = control.params.colors;

			const devices = control.params.responsive;

			// Dynamic loop to set values with related fields
			Object.keys( fields ).forEach( function ( item ) {

				// for colors
				if ( item === 'colors' ) {
					let color_values = {};
					Object.keys( colors ).forEach( ( key ) => {
						v = $('.typography-colors .color-picker .' + key, control.container).val();
						if ( v ) {
							color_values[key] = v;
						}
					});
					css[item] = color_values;
				}

				// for slides
				if ( item === 'line_height' || item === 'letter_spacing' || item === 'font_size' ) {
					let object = {};
					( devices ).forEach( ( key ) => {
						v = $('.typography-' + item + ' .control-wrap.' + key + ' input[type="number"]', control.container).val();
						u = $('.typography-' + item + ' .control-wrap.' + key + ' .units', control.container).find('.single-unit.active').data('unit');
						if ( v ) {
							object[key] = v + u ;
						}
					});
					css[item] = object;
				}

				// for text transform and text decoration
				if ( item === 'text_transform' || item === 'text_decoration' ) {
					v = $('.typography-' + item + ' select', control.container).val();
					if ( v ) {
						css[item] = v;
					}
				}

				// for font family
				if ( item === 'font_family' ) {
					v = $('.typography-' + item + ' select', control.container).val();
					if ( v ) {
						id = control.getFontId( v );
						if ( typeof id !== 'undefined') {
							if ( typeof window.realHomeAllFonts['allFonts'][id] !== 'undefined') {
								let font = window.realHomeAllFonts['allFonts'][id];
								css[item] = font.name;
							}
						}
					}
				}

				// for font variant
				if ( item === 'font_variant' ) {
					v = $('.typography-' + item + ' select', control.container).val();
					if ( v ) {
						let style, weight = parseInt(v);
						if (isNaN(weight)) {
							weight = '400';
							if (v !== 'regular') {
								style = v;
							}
						} else {
							style = v.slice(weight.toString().length);
						}

						css[item] = v;

						if ( style !== '') {
							css['style'] = style;
						}

						if ( weight !== '' ) {
							css['weight'] = weight;
						}

					}
				}


			});
			control.settings['default'].set( css );
		},

		/**
		 * Reset values
		 */
		resetValues: function(){

			let control = this, v, r, u;

			// Units
			const units = control.params.units;

			control.container.on( 'click', '.reset-value', function() {

				const holder = $( this ).closest('.customize-control-real_home_typography',control.container);

				Object.keys( control.params.fields ).forEach( function ( item ) {

					// for colors
					if ( item === 'colors' ) {
						holder.find( '.typography-colors .color-picker' ).each( function() {
							let colors  = $( this ).find('.wp-picker-container .alpha-color-control'),
								r       = colors.data( 'reset' );
							colors.val(r).trigger( 'change' );
						});
					}

					// for select options
					else if ( item === 'font_family' || item === 'font_variant' || item === 'text_transform' || item === 'text_decoration' ) {

						holder.find( '.typography-' + item + ' select' ).each( function() {
							r = $( this ).data( 'reset' );
							v = $( this ).find( 'option:selected' ).val();

							if ( r !== v ) {
								// remove attr
								$( this ).find('option').removeAttr('selected' );
								// add attr
								$( this ).find( 'option[value="' + r + '"]' ).attr('selected', 'selected').trigger( 'change' );
							}
						});

					}

					// for slides
					else {
						holder.find( '.typography-' + item + ' input[type="number"]' ).each( function() {
							r = $( this ).data( 'reset' );
							v = isNaN( parseFloat( r ) ) ? '' : parseFloat( r );
							u = ( r && !$.isNumeric( r ) ) ? r.replace(v,'') : units[0];
							$(this).val(v).trigger( 'change' );
						});

						// unit
						holder.find('.typography-' + item + ' .units li.single-unit').removeClass('active');
						holder.find('.typography-' + item + ' .units li.single-unit[data-unit="' + u + '"]').addClass('active').trigger( 'change' );
					}
				});

				control.settings['default'].set( control.params.default );
			});
		},

		/**
		 * Load font options
		 */
		selectFontOptions: function( fonts ){
			let control = this;

			if ( typeof window.fontFamiliesOptions === "undefined" ) {
				let fontOptions = {};

				_.each( fonts, function (font, id) {

					let html = '<option value="' + id + '">' + font.name + '</option>';

					if (typeof ( font.font_type ) === "undefined" || font.font_type === '') {
						font.font_type = 'standard-fonts';
					}

					if (typeof fontOptions[font.font_type] === "undefined") {
						fontOptions[font.font_type] = {};
					}
					fontOptions[font.font_type][id] = html;

				});

				let optionsSelect = '';

				_.each(fontOptions, function (v, id ) {
					if (typeof v !== 'string') {

						if ( id === 'google_font' ) {
							optionsSelect += '<optgroup class="lv-1" label="' + id.replace( '-', ' ' ) + '"></optgroup>';
						} else {
							optionsSelect += '<optgroup class="lv-1" label="' + id.replace( '-', ' ' ) + '">';
						}

						_.each(v, function (v2, id2) {
							if (typeof v2 !== 'string') {
								optionsSelect += '<optgroup class="lv-2" label="' + id2 + '">';
								_.each(v2, function (v3, id3) {
									if (typeof v3 === 'string') {
										optionsSelect += v3;
									}
								});
								optionsSelect += '</optgroup>';

							} else {
								optionsSelect += v2;
							}

						});

						if ( id === 'google_font' ) {

						} else {
							optionsSelect += '</optgroup>';
						}


					} else {
						optionsSelect += v;
					}
				});
				window.fontFamiliesOptions = '<option value="">' + control.params.l10n.option_default +'</option>'+optionsSelect;
			}
		},

		/**
		 * Set font variants
		 */
		setFontVariants: function( font_id ){
			// font_variant
			let control = this, output = '';

			output += '<option value="">' + control.params.l10n.option_default + '</option>';

			if ( typeof window.realHomeAllFonts['allFonts'][ font_id ] !== 'undefined' && font_id !== '' ) {

				_.each( window.realHomeAllFonts['allFonts'][ font_id ]['font_variants'], function (value, id) {
					output += '<option value="' + value + '">' + value + '</option>'
				});

				if (window.realHomeAllFonts['allFonts'][font_id]['font_variants'].length <= 1) {
					output += '<option value="italic">italic</option>'
					output += '<option value="700">700</option>'
					output += '<option value="700italic">700italic</option>'
				}
			}
			else {
				_.each( window.realHomeAllFonts['variants'], function (value, id) {
					output += '<option value="' + id + '">' + value + '</option>'
				});
			}

			$('.typography-font_variant select', control.container ).html( output  );

		},

		/**
		 * Get font id
		 */
		getFontId: function( fontName ){

			if ( fontName !== undefined ) {
				let font_id = fontName.toLowerCase();
				return font_id.replace(/ /g, '_');
			}
		},
	} );

    /**
     * Customizer Control: real_home_sortable
     */
    api.controlConstructor['real_home_sortable'] = api.Control.extend( {

        ready: function() {

            let control = this;

            // Set the sortable container.
            control.sortableContainer = control.container.find( 'ul.sortable' ).first();

            // Init sortable.
            control.sortableContainer.sortable({

                // Update value when we stop sorting.
                stop: function() {
                    // Update value on sortable stop.
                    control.updateInputValue();
                    control.saveValues();
                }
            });

            // visibility changes.
            control.container.on( 'click', '.sortable-item i.visibility', function() {

                $( this ).toggleClass( 'dashicons-hidden' ).parents( 'li:eq(0)' ).toggleClass( 'invisible' );

                // Update value on click.
                control.updateInputValue();
                control.saveValues();
            });

            // Set values
            control.setValues();

            // Reset Data
            control.resetValues();
        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this;

			// terminate process if value not set or black is given
			if ( control.params.value.length <= 0 || control.params.value === false ) {
				$('.control-wrap', control.container).each( function() {
					$.each( control.params.choices, function ( choiceId, choiceLabel ) {
						$('.control-wrap', control.container).append('<li class="sortable-item ui-sortable-handle invisible" data-value="' + choiceId + '"><i class="dashicons dashicons-menu"></i><i class="dashicons dashicons-visibility visibility"></i>' + choiceLabel + '</li>');
					});
				});
				return ;
			}

            // Assign constant variables
            const values = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            const choices = control.params.choices;

            if ( values ) {

                // show visible option
                $.each( values, function( index, value ) {
                    $('.control-wrap', control.container).append('<li class="sortable-item ui-sortable-handle" data-value="' + value + '"><i class="dashicons dashicons-menu"></i><i class="dashicons dashicons-visibility visibility"></i>' + choices[value] + '</li>');
                });

                // show invisible option
                $.each( choices, function ( choiceId, choiceLabel ) {
                    if ( false === values.includes( choiceId ) ) {
                        $('.control-wrap', control.container).append('<li class="sortable-item ui-sortable-handle invisible" data-value="' + choiceId + '"><i class="dashicons dashicons-menu"></i><i class="dashicons dashicons-visibility visibility"></i>' + choiceLabel + '</li>');
                    }
                });

                $('.control-wrap input[type="hidden"]', control.container).val( values.join());
            }
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this, v,
                css     = {};

            v = $('.control-wrap input[type="hidden"].sortable-field', control.container).val();

            if ( v ) {
                css = v.split(',');
            }
            control.settings['default'].set( css );
        },

        /**
         * Update input value
         */
        updateInputValue: function(){
            let control = this,v;

            v = $('.control-wrap li', control.container).map( function(){
                if ( ! $( this ).is( '.invisible' ) ) {
                    return $( this ).data( 'value' );
                }
            }).get().join();

            $('.control-wrap input[type="hidden"].sortable-field', control.container ).val( v );
        },

        /**
         * Reset values
         */
        resetValues: function(){

            let control = this,v, r;

            control.container.on( 'click', '.reset-value', function() {

                const holder 	= $( this ).closest('.customize-control-real_home_sortable',control.container);

                holder.find('.control-wrap input').each( function() {

                    r = $( this ).data( 'reset' );

                    $(this).closest('.sortable').find('li').each( function() {

                        v = $(this).data('value');

                        if ( r ) {
                            if ( ( r.split(',') ).includes( v ) ) {
                                $(this).removeClass('invisible');
                            }
                            else {
                                $(this).addClass('invisible');
                            }
                        }
                        else {
                            $(this).addClass('invisible');
                        }
                    });
                });

                control.settings['default'].set( control.params.default );
            });
        }
    } );

    /**
     * Customizer Control: real_home_group
     */
    api.controlConstructor['real_home_group'] = api.Control.extend( {

        ready: function() {

            let control = this;

            control.container.on( 'click', '.customizer-tab > label', function() {

                // Customizer Custom Tabs
                $(this).closest('.customizer-group-control').find('input').removeClass('active').addClass('inactive');
                $(this).closest('.customizer-tab').find('input').removeClass('inactive').addClass('active');
            });

            control.container.on( 'click', '.customizer-tab > label', function( e ) {

                let customizerSection   = $(this).closest( '.accordion-section' ),
                    customizerTab       = $(this).closest( '.customize-control-real_home_group' ).attr('id'),
                    controls            = $(this).prev().closest('.customizer-tab').find('input').data( 'controls' );

                // Hide all controls in section
                real_home_hide_controls( customizerSection, customizerTab );
                real_home_show_controls( customizerSection, controls.split(',') );

                e.preventDefault();
            });
        },

    } );

    /**
     * Customizer Control: real_home_toggle
     */
    api.controlConstructor['real_home_toggle'] = api.Control.extend( {

        ready: function() {

            let control = this;

            // Set Values
            control.setValues();

            // Save values
            control.container.on( 'change keyup paste', 'select, input', function() {
                control.saveValues();
            });

            // Reset Data
            control.resetValues();
        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this;

            // terminate process if value not set or black is given
            if ( control.params.value.length <= 0 ) {
                return ;
            }

            // Assign constant variables
            const values = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            const devices = control.params.responsive;

            // Dynamic loop to set values with related fields
            ( devices ).forEach( ( key ) => {

                if ( values[key] !== undefined ) {
                    $('.control-wrap.' + key + ' .custom-toggle-btn-wrap input[type="checkbox"]', control.container).prop( 'checked', true );
                }

            });
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this, css = {};

            // Dynamic loop to set values with related fields
            ( control.params.responsive ).forEach( device => {

                $( '.toggle-control.' + device, control.container ).find( '.custom-toggle-btn-wrap input[type="checkbox"]' ).each( function() {
                    let toggle  = $( this ),
                        v       = toggle.val();
                    if( toggle.is(':checked') ) {
                        css[device] = v;
                    }
                });
            });
            control.settings['default'].set( css );
        },

        /**
         * Reset values
         */
        resetValues: function(){

            let control = this, r;

            control.container.on( 'click', '.reset-value', function() {

                const holder = $( this ).closest('.customize-control-real_home_toggle',control.container);

                holder.find('.toggle-control .custom-toggle-btn-wrap input[type="checkbox"]' ).each( function() {

                    r = $( this ).data( 'reset' );

                    if ( r !== '' ) {

                        $( this ).prop( 'checked', true );
                    }
                    else {
                        $( this ).prop( 'checked', false );
                    }
                });

                control.settings['default'].set( control.params.default );
            });
        }

    } );

    /**
     * Customizer Control: real_home_color
     */
    api.controlConstructor['real_home_color'] = api.Control.extend( {

        ready: function() {

            let control = this;

            // Set Values
            control.setValues();

            // Save values
            control.container.on( 'change keyup paste', 'select, input', function() {
                control.saveValues();
            });

            // Reset Data
            control.resetValues();

        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this;

            const colors = control.params.colors;

            if ( control.params.value.length <= 0 ) {

                // Initial color picker
                Object.keys( colors ).forEach( function ( key ) {
                    $('.color-control .color-picker .' + key, control.container).wpColorPicker({
                        change: function(event, ui) {
                            if ( $('html').hasClass('color-picker-ready') ) {
                                setTimeout( function() {
                                    // Save value on change
                                    control.saveValues();
                                }, 100 );
                            }
                        }
                    });
                });

                return ;
            }

            // Assign constant variables
            const values = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            // for colors
            Object.keys( colors ).forEach( ( key ) => {
                let v = values[key] !== undefined ? values[key] : '';
                $('.color-control .color-picker .' + key, control.container).val(v);
                $('.color-control .color-picker .' + key, control.container).wpColorPicker({
                    change: function(event, ui) {
                        if ( $('html').hasClass('color-picker-ready') ) {
                            setTimeout( function() {
                                // Save value on change
                                control.saveValues();
                            }, 100 );
                        }
                    }
                });
            });
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this, v,
                css     = {};

            // Assign constant variables
            const colors = control.params.colors;

            // Dynamic loop to set values with related fields
            Object.keys( colors ).forEach( ( key ) => {
                v = $('.color-control .color-picker .' + key, control.container).val();
                if ( v ) {
                    css[key] = v;
                }
            });

            control.settings['default'].set( css );
        },

        /**
         * Reset values
         */
        resetValues: function(){

            let control = this;

            control.container.on( 'click', '.reset-value', function() {

                const holder = $( this ).closest('.customize-control-real_home_color',control.container);

                // for colors
                holder.find( '.color-control .color-picker' ).each( function() {
                    let colors  = $( this ).find('.wp-picker-container .alpha-color-control'),
                        r       = colors.data( 'reset' );
                    colors.val(r).trigger( 'change' );
                });

                control.settings['default'].set( control.params.default );
            });
        }
    } );

    /**
     * Customizer Control: real_home_buttonset
     */
    api.controlConstructor['real_home_buttonset'] = api.Control.extend( {

        ready: function() {

            let control = this;

            // Set Values
            control.setValues();

            // Save values
            control.container.on( 'change keyup paste', 'select, input', function() {
                control.saveValues();
            });

            // Reset Data
            control.resetValues();
        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this;

            // terminate process if value not set or black is given
            if ( control.params.value.length <= 0 ) {
                return ;
            }

            // Assign constant variables
            const values = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            const devices = control.params.responsive;

            // Dynamic loop to set values with related fields
            ( devices ).forEach( ( key ) => {

                $( '.buttonset-control.' + key, control.container ).find( 'input.buttonset' ).each( function() {
                    let choiceID = $( this).attr("id"),
                        targetID = key + '-' + control.id + '-' + values[key];

                    if ( choiceID === targetID ) {
                        $( this ).attr( 'checked', 'checked' );
                        $( this ).next('label').addClass('buttonset-label-on');
                    }
                });
            });
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this,css = {};

            // Dynamic loop to set values with related fields
            ( control.params.responsive ).forEach( device => {

                $( '.buttonset-control.' + device, control.container ).find( 'input.buttonset' ).each( function() {
                    let choice  = $( this ),
                        v       = choice.val();
                    if( choice.is(':checked') ) {
                        css[device] = v;
                    }
                });
            });
            control.settings['default'].set( css );

        },

        /**
         * Reset values
         */
        resetValues: function(){

            let control = this, r;

            control.container.on( 'click', '.reset-value', function() {

                const holder = $( this ).closest('.customize-control-real_home_buttonset',control.container)

                holder.find( '.buttonset-control input.buttonset' ).each( function() {

                    r = $( this ).data( 'reset' );

                    let choiceID = $( this).attr("id"),
                        targetID = $( this).attr("name") + '-' + r;

                    if ( choiceID === targetID ) {
                        $( this ).prop( 'checked', true );
                        $( this ).next('label').addClass('buttonset-label-on');
                    }
                    else {
                        $( this ).prop( 'checked', false );
                        $( this ).next('label').removeClass('buttonset-label-on');
                    }
                });

                control.settings['default'].set( control.params.default );
            });
        }

    } );

    /**
     * Customizer Control: real_home_range
     */
    api.controlConstructor['real_home_range'] = api.Control.extend( {

        ready: function() {

            let control = this;

            // Set Values
            control.setValues();

            // Save values
            control.container.on( 'change keyup paste', 'select, input', function() {
                control.saveValues();
            });

            // Reset Data
            control.resetValues();
        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this,v,u;

            // terminate process if value not set or black is given
            if ( control.params.value.length <= 0 ) {
                return ;
            }

            // Assign constant variables
            const values = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            // Responsive Devices
            const devices = control.params.responsive;

            // Units
            const units = control.params.units;

            // Dynamic loop to set values with related fields
            ( devices ).forEach( ( key ) => {

                v = isNaN( parseFloat( values[key] ) ) ? '' : parseFloat( values[key] );
                u = ( values[key] && !$.isNumeric(values[key] ) ) ? values[key].replace(v,'') : units[0];

                $('.range-control.' + key + ' input[type="range"]', control.container).val( v );
                $('.range-control.' + key + ' input[type="number"]', control.container).val( v );
                // Active unit
                $('.range-control.' + key + ' .units-wrap .units', control.container).find('.single-unit').siblings().removeClass('active');
                $('.range-control.' + key + ' .units-wrap .units', control.container).find('.single-unit[data-unit="' + u + '"]').addClass('active');

            });
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this,v,u,css = {};

            // Units
            const units = control.params.units;

            // Dynamic loop to set values with related fields
            ( control.params.responsive ).forEach( device => {

                v = $('.range-control.' + device + ' input[type="number"]', control.container).val();
                u = $('.range-control.' + device + ' .units-wrap .units', control.container).find('.single-unit.active').data('unit');
                if ( v ) {
                    css[device] = ( typeof units != "undefined"
                        && units != null
                        && units.length != null
                        && units.length > 0) ? v + u : v ;
                }
            });
            control.settings['default'].set( css );

        },

        /**
         * Reset values
         */
        resetValues: function(){

            let control = this,r,v,u;

            // Units
            const units = control.params.units;

            control.container.on( 'click', '.reset-value', function() {

                const holder = $( this ).closest('.customize-control-real_home_range',control.container);

                holder.find( '.range-control input[type="number"]' ).each( function() {
                    r = $( this ).data( 'reset' );
                    v = isNaN( parseFloat( r ) ) ? '' : parseFloat( r );
                    u = ( r && !$.isNumeric( r ) ) ? r.replace(v,'') : units[0];
                    $(this).val(v).trigger( 'change' );
                });

                // unit
                holder.find('.range-control .units li.single-unit').removeClass('active');
                holder.find('.range-control .units li.single-unit[data-unit="' + u + '"]').addClass('active').trigger( 'change' );

                control.settings['default'].set( control.params.default );
            });
        }

    } );

    /**
     * Customizer Control: real_home_dimensions
     */
    api.controlConstructor['real_home_dimensions'] = api.Control.extend( {

        ready: function() {

            let control = this;

            // Set Values
            control.setValues();

            // Save values
            control.container.on( 'change keyup paste', 'select, input', function() {
                control.saveValues();
            });

            // Reset Data
            control.resetValues();
        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this,v,u;

            // terminate process if value not set or black is given
            if ( control.params.value.length <= 0 ) {
                return ;
            }

            // Assign constant variables
            const values = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            // Responsive Devices
            const devices = control.params.responsive;

            // Units
            const units = control.params.units;

            // Dynamic loop to set values with related fields
            ( devices ).forEach( ( key ) => {


                if ( values[key] !== undefined ) {
                    // Sides
                    Object.keys( width_sides ).forEach( ( side, index ) => {
                        if ( values[key][side] !== undefined ) {
                            v = isNaN( parseFloat( values[key][side] ) ) ? '' : parseFloat( values[key][side] );
                            u = ( values[key][side] && !$.isNumeric(values[key][side] ) ) ? values[key][side].replace(v,'') : units[0];
                            $('.dimensions-control.' + key + ' .dimension-' + side + ' input[type="number"].on-field', control.container).val( v );
                        }
                    });

                    // Active unit
                    $('.dimensions-control.' + key + ' .units-wrap .units', control.container).find('.single-unit').siblings().removeClass('active');
                    $('.dimensions-control.' + key + ' .units-wrap .units', control.container).find('.single-unit[data-unit="' + u + '"]').addClass('active');

                    // Linked
                    if ( values[key]['linked'] !== undefined ) {

                        if ( values[key]['linked'] === 'on' ) {
                            real_home_linked( control.id, key );
                        }
                        else {
                            real_home_unlinked( key );
                        }
                    }
                }
            });
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this,v,u,css = {};

            // Dynamic loop to set values with related fields
            ( control.params.responsive ).forEach( device => {

                let sides = {};

                Object.keys( width_sides ).forEach( ( side, index ) => {

                    v = $('.dimensions-control.' + device + ' .dimension-'+ side +' input[type="number"].on-field', control.container).val();
                    u = $('.dimensions-control.' + device + ' .units-wrap .units', control.container ).find('.single-unit.active').data('unit');
                    if ( v ) {

                        sides[side] = v + u;

                        // linked
                        sides['linked'] = $('.dimensions-control.' + device + ' .link-dimensions input[type="hidden"]', control.container).val();
                    }
                });

                css[device] = sides;
            });
            control.settings['default'].set( css );

        },

        /**
         * Reset values
         */
        resetValues: function(){

            let control = this,r,v,u;

            // Units
            const units = control.params.units;

            control.container.on( 'click', '.reset-value', function() {

                const holder = $( this ).closest('.customize-control-real_home_dimensions',control.container);

                holder.find( '.dimensions-control input[type="number"]' ).each( function() {
                    r = $( this ).data( 'reset' );
                    v = isNaN( parseFloat( r ) ) ? '' : parseFloat( r );
                    u = ( r && !$.isNumeric( r ) ) ? r.replace(v,'') : units[0];
                    $(this).val(v).trigger( 'change' );
                });

                // unit
                holder.find('.dimensions-control .units li.single-unit').removeClass('active');
                holder.find('.dimensions-control .units li.single-unit[data-unit="' + u + '"]').addClass('active').trigger( 'change' );

                // Linked
                holder.find( '.dimensions-control .link-dimensions input[type="hidden"]' ).each( function() {

                    r = $( this ).data('reset')
                    r = r === '' ? 'on' : r;

                    if ( r === 'on' ) {
                        real_home_linked( control.id, 'dimensions-control' );
                    }
                    else {
                        real_home_unlinked( 'dimensions-control' );
                    }
                });

                control.settings['default'].set( control.params.default );
            });
        }

    } );

    /**
     * Customizer Control: real_home_radio_image
     */
    api.controlConstructor['real_home_radio_image'] = api.Control.extend( {

        ready: function() {

            let control = this;

            // Set Values
            control.setValues();

            // Save values
            control.container.on( 'change keyup paste', 'select, input', function() {
                control.saveValues();
            });

            // Reset Data
            control.resetValues();
        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this,v,u;

            // terminate process if value not set or black is given
            if ( control.params.value.length <= 0 ) {
                return ;
            }

            // Assign constant variables
            const values = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            $( '.radio-image-control', control.container ).find( 'input.radio-image' ).each( function() {
                let choiceID = $( this).attr("id"),
                    targetID = control.id + '-' + values;

                if ( choiceID === targetID ) {
                    $( this ).attr( 'checked', 'checked' );
                    $( this ).next('label').addClass('radio-image-label-on');
                }
            });
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this;

            $( '.radio-image-control', control.container ).find( 'input.radio-image' ).each( function() {
                let choice  = $( this ),
                    v       = choice.val();
                if( choice.is(':checked') ) {
                    control.settings['default'].set( v );
                }
            });
        },

        /**
         * Reset values
         */
        resetValues: function(){

            let control = this,r;

            control.container.on( 'click', '.reset-value', function() {

                const holder = $( this ).closest('.customize-control-real_home_radio_image',control.container);

                holder.find( '.radio-image-control input.radio-image' ).each( function() {

                    r = $( this ).data( 'reset' );

                    let choiceID = $( this).attr("id"),
                        targetID = $( this).attr("name") + '-' + r;

                    if ( choiceID === targetID ) {
                        $( this ).prop( 'checked', true );
                        $( this ).next('label').addClass('radio-image-label-on');
                    }
                    else {
                        $( this ).prop( 'checked', false );
                        $( this ).next('label').removeClass('radio-image-label-on');
                    }

                });

                control.settings['default'].set( control.params.default );
            });
        }

    } );

    /**
     * Customizer Control: real_home_select
     */
    api.controlConstructor['real_home_select'] = api.Control.extend( {

        ready: function() {

            let control  = this,
                element  = $('.select-control', control.container).find( 'select' ),
                select2Options = {
                    escapeMarkup: function( markup ) {
                        return markup;
                    },
                    allowClear: true
                };

            if ( $( element ).hasClass( 'select2-hidden-accessible' ) ) {
                $( element ).select2( 'destroy' );
                $( element ).empty();
            }

            // Set Data
            control.setValues();

            // Save Data
            $( element ).select2( select2Options ).on( 'change', function() {
                control.saveValues();
            });
        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this;

            // terminate process if value not set or black is given
            if ( control.params.value.length <= 0 ) {
                return ;
            }

            // Assign constant variables
            let value = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            $('.select-control select', control.container).find('option[value="' + value  + '"]').attr('selected', 'selected');
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this,v;

            v = $('.select-control select', control.container).val();

            if ( v ) {
                control.settings['default'].set( v );
            }
        }
    } );


    /**
     * Customizer Control: real_home_icon_select
     */
    api.controlConstructor['real_home_icon_select'] = api.Control.extend( {

        ready: function() {

            let control  = this,
                element  = $('.icon-select-control', control.container).find( 'select' ),
                select2Options = {
                    escapeMarkup: function( markup ) {
                        return markup;
                    },
                    allowClear: true,
                    templateSelection: real_home_format_Text,
                    templateResult: real_home_format_Text
                };

            if ( $( element ).hasClass( 'select2-hidden-accessible' ) ) {
                $( element ).select2( 'destroy' );
                $( element ).empty();
            }

            // Set Data
            control.setValues();

            // Save Data
            $( element ).select2( select2Options ).on( 'change', function() {
                control.saveValues();
            });
        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this;

            // terminate process if value not set or black is given
            if ( control.params.value.length <= 0 ) {
                return ;
            }

            // Assign constant variables
            let value = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            $('.icon-select-control select', control.container).find('option[value="' + value  + '"]').attr('selected', 'selected');
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this,v;

            v = $('.icon-select-control select', control.container).val();

            if ( v ) {
                control.settings['default'].set( v );
            }
        }

    } );








    /**
     * Customizer Control: real_home_multi_select
     */
    api.controlConstructor['real_home_multi_select'] = api.Control.extend( {

        ready: function() {

            let control  = this,
                element  = $('.multi-select-control', control.container).find( 'select' ),
                select2Options = {
                    escapeMarkup: function( markup ) {
                        return markup;
                    },
                    allowClear: true
                };

            if ( $( element ).hasClass( 'select2-hidden-accessible' ) ) {
                $( element ).select2( 'destroy' );
                $( element ).empty();
            }

            // Set Data
            control.setValues();

            // Save Data
            $( element ).select2( select2Options ).on( 'change', function() {
                control.saveValues();
            });
        },

        /**
         * Setup values
         */
        setValues: function(){

            let control = this;

            console.log(control.params);

            // terminate process if value not set or black is given
            if ( control.params.value.length <= 0 ) {
                return ;
            }

            // Assign constant variables
            let value = ( control.setting._value !== '' ) ? control.setting._value :  control.params.value;

            let multi_options = value.split(',');

            ( multi_options ).forEach( ( key ) => {
                $('.multi-select-control select', control.container).find('option[value="' + key  + '"]').attr('selected', 'selected');
            });
        },

        /**
         * Save Values
         */
        saveValues: function(){

            let control = this,v;

            v = $('.multi-select-control select', control.container).val();

            if ( v ) {
                control.settings['default'].set( v.join() );
            }
        }

    } );

}( jQuery, wp.customize ) );
