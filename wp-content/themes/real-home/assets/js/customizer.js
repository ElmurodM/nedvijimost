/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 */

/**
 * Customizer control active callback function JS
 *
 * @param active_setting
 * @param settings
 * @param compare
 */
const real_home_active_callback = ( active_setting, settings, compare ) => {

	wp.customize.bind( 'ready', function() {

		wp.customize( active_setting, function( value ) {

			let controlSelectors = function( control ) {

				let active = function() {

					let objVal = value.get();

					if ( ( typeof objVal === 'string' || objVal instanceof String ) &&  ( jQuery.inArray( objVal, compare ) !== -1 ) ) {
						control.container.removeClass('hidden');
					}
					else if ( ( objVal.desktop !== undefined && ( jQuery.inArray( objVal.desktop, compare ) !== -1 ) ) || ( objVal.tablet !== undefined && ( jQuery.inArray( objVal.tablet, compare ) !== -1 ) ) || ( objVal.mobile !== undefined && ( jQuery.inArray( objVal.mobile, compare ) !== -1 ) ) ) {
						control.container.removeClass('hidden');
					} else {
						control.container.addClass('hidden');
					}
				};

				// Set initial active state.
				active();

				// Update activate state whenever the setting is changed.
				value.bind( active );
			};

			// Trigger Selected Controls
			jQuery.each( settings, function( index, id ) {
				wp.customize.control( id, controlSelectors );
			} );

		} );

	} );
}

/**
 * Customizer control active callback function JS for empty or black value
 *
 * @param active_setting
 * @param settings
 */
const real_home_active_callback_blank = ( active_setting, settings ) => {

	wp.customize.bind( 'ready', function() {

		wp.customize( active_setting, function( value ) {

			let controlSelectors = function( control ) {

				let active = function() {

					let val = value.get();

					if ( val && val !== '' ) {
						control.container.removeClass('hidden');
					}
					else {
						control.container.addClass('hidden');
					}
				};

				// Set initial active state.
				active();

				// Update activate state whenever the setting is changed.
				value.bind( active );
			};

			// Trigger Selected Controls
			jQuery.each( settings, function( index, id ) {
				wp.customize.control( id, controlSelectors );
			} );

		} );

	} );
}

/**
 * Customizer inline css
 *
 * @param control string
 * @param inheritColor object
 */
const real_home_inline_css = ( control, inheritColors ) => {

	wp.customize( control, function ( value ) {

		value.bind( function ( objectVal ) {

			if ( objectVal !== undefined ) {

				// Assign variables
				let properties = '', output = '';

				// remove inline style fist
				jQuery( 'style#' + control ).remove();

				// Initial objectVal
				Object.keys( objectVal ).forEach( function ( key, index ) {
					if ( inheritColors[key] !== undefined ) {
						properties += inheritColors[key] + ':' + objectVal[key] + ';';
					}
				});

				// Concat properties in root
				output += ( properties !== '' ) ? ":root {" + properties + "}" : '';
				// Concat and append new <style>.
				jQuery( 'head' ).append(
					'<style id="' + control + '">' + output + '</style>'
				);
			}
		});
	});

}

( function( $, api ) {
	'use strict';

	// Blog Posts Layout
	real_home_active_callback(
		'real_home_blog_posts_layout',
		[
			'real_home_blog_posts_col_img_overlay_color'
		],
		['layout-4']
	);

	// About Page: Agents
	real_home_active_callback(
		'real_home_about_page_agents_type',
		[
			'real_home_about_page_agents_pages'
		],
		['new']
	);

	// Header : Custom Header Height
	real_home_active_callback(
		'real_home_header_height_type',
		[
			'real_home_header_custom_height'
		],
		['custom']
	);

	// Site Identify -> site title
	real_home_active_callback(
		'real_home_header_site_title_enable',
		[
			'blogname',
			'real_home_header_site_title_typo',
			'real_home_header_site_identify_note_two'
		],
		['true']
	);
	// Site Identify -> tagline
	real_home_active_callback(
		'real_home_header_site_tagline_enable',
		[
			'blogdescription',
			'real_home_header_site_tagline_typo',
			'real_home_header_site_identify_note_two'
		],
		['true']
	);


	/**
	 * Color Inherit Patterns
	 */
	// Accent Colors
	real_home_inline_css(
		'real_home_accent_color',
		{ color_1: '--color-accent', color_2: '--color-accent-secondary'}
	);
	// Heading H1-H6 Color
	real_home_inline_css(
		'real_home_heading_color',
		{ color_1: '--color-heading'}
	);
	// Text Color
	real_home_inline_css(
		'real_home_text_color',
		{ color_2: '--color-2'}
	);
	// Link Color
	real_home_inline_css(
		'real_home_link_color',
		{ color_1: '--color-link', color_2: '--color-link-hover', color_3: '--color-link-visited'}
	);
	// Background Color
	real_home_inline_css(
		'real_home_background_color',
		{ color_1: '--color-bg'}
	);

	// Bind customizer focus target link
	api.bind( 'ready', function() {
		$('.customizer-focus').on('click', function (e) {
			e.preventDefault();

			let type 	= $(this).data('type'),
				id		= $(this).data('id');

			if ( ! id || ! type ) {
				return;
			}
			api[type]( id, function( instance ) {
				instance.deferred.embedded.done( function() {
					api.previewer.deferred.active.done( function() {
						instance.focus();
					});
				});
			});

		});
	});

}) ( jQuery, wp.customize );
