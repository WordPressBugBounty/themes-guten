<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Guten
 */

/**
 * Adds custom classes to the array of body classes
 *
 * @param array $classes Classes for the body element
 * @return array
 */
function guten_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'guten_body_classes' );

/**
 * Enqueue Google Fonts for Blocks Editor
 */
function customizer_guten_editor_fonts() {

	// Font options
	$fonts = array(
		get_theme_mod( 'guten-body-font', customizer_library_get_default( 'guten-body-font' ) ),
		get_theme_mod( 'guten-heading-font', customizer_library_get_default( 'guten-heading-font' ) )
	);

	$font_uri = customizer_library_get_google_font_uri( $fonts );

	// Load Google Fonts
	if ( !get_theme_mod( 'guten-disable-google-font', customizer_library_get_default( 'guten-disable-google-font' ) ) ) {
		wp_enqueue_style( 'customizer_guten_editor_fonts', $font_uri, array(), null, 'screen' );
	}

}
add_action( 'enqueue_block_editor_assets', 'customizer_guten_editor_fonts' );

if ( ! function_exists( 'customizer_library_guten_editor_styles' ) ) :
/**
 * Generates the fonts selected in the Customizer and enqueues it to the Blocks Editor
 */
function customizer_library_guten_editor_styles() {
	$websafe = ( get_theme_mod( 'guten-disable-google-font', customizer_library_get_default( 'guten-disable-google-font' ) ) == 1 ) ? '-websafe' : '';

	$body_font_size = get_theme_mod( 'guten-body-fonts-size', customizer_library_get_default( 'guten-body-fonts-size' ) );
	switch ( $body_font_size ) {
		case '1':
			$body_font_size = '13';
			break;
		case '2':
			$body_font_size = '';
			break;
		case '3':
			$body_font_size = '16';
			break;
		case '4':
			$body_font_size = '18';
			break;
		case '5':
			$body_font_size = '20';
			break;
	}
	$heading_font_size = esc_attr( get_theme_mod( 'guten-heading-fonts-size', customizer_library_get_default( 'guten-heading-fonts-size' ) ) );
	switch ( $heading_font_size ) {
		case '1':
			$heading_font_size = '.editor-styles-wrapper h1.wp-block { font-size: 28px; }
                                .editor-styles-wrapper h2.wp-block { font-size: 24px; }
                                .editor-styles-wrapper h3.wp-block { font-size: 20px; }
                                .editor-styles-wrapper h4.wp-block { font-size: 18px; }
                                .editor-styles-wrapper h5.wp-block { font-size: 16px; }
                                .editor-styles-wrapper h6.wp-block { font-size: 14px; }';
			break;
		case '2':
			$heading_font_size = '.editor-styles-wrapper h1.wp-block { font-size: 35px; }
                                .editor-styles-wrapper h2.wp-block  { font-size: 30px; }
                                .editor-styles-wrapper h3.wp-block  { font-size: 26px; }
                                .editor-styles-wrapper h4.wp-block  { font-size: 22px; }
                                .editor-styles-wrapper h5.wp-block  { font-size: 18px; }
                                .editor-styles-wrapper h6.wp-block  { font-size: 16px; }';
			break;
		case '3':
			$heading_font_size = '.editor-styles-wrapper h1.wp-block { font-size: 42px; }
                                .editor-styles-wrapper h2.wp-block  { font-size: 38px; }
                                .editor-styles-wrapper h3.wp-block  { font-size: 35px; }
                                .editor-styles-wrapper h4.wp-block  { font-size: 30px; }
                                .editor-styles-wrapper h5.wp-block  { font-size: 26px; }
                                .editor-styles-wrapper h6.wp-block  { font-size: 21px; }';
			break;
		case '4':
			$heading_font_size = '.editor-styles-wrapper h1.wp-block  { font-size: 50px; }
                                .editor-styles-wrapper h2.wp-block  { font-size: 45px; }
                                .editor-styles-wrapper h3.wp-block  { font-size: 41px; }
                                .editor-styles-wrapper h4.wp-block  { font-size: 38px; }
                                .editor-styles-wrapper h5.wp-block  { font-size: 35px; }
                                .editor-styles-wrapper h6.wp-block  { font-size: 32px; }';
			break;
	}

	$editor_css = '.editor-styles-wrapper .wp-block,
                .editor-styles-wrapper p.wp-block {
					font-family: "' . esc_attr( get_theme_mod( 'guten-body-font'.$websafe, customizer_library_get_default( 'guten-body-font'.$websafe ) ) ) . '", sans-serif;
					color: ' . sanitize_hex_color( get_theme_mod( 'guten-body-font-color', customizer_library_get_default( 'guten-body-font-color' ) ) ) . ';
				}
				.wp-block.editor-post-title,
				.editor-styles-wrapper h1.wp-block,
				.editor-styles-wrapper h2.wp-block,
				.editor-styles-wrapper h3.wp-block,
				.editor-styles-wrapper h4.wp-block,
				.editor-styles-wrapper h5.wp-block,
				.editor-styles-wrapper h6.wp-block {
					font-family: "' . esc_attr( get_theme_mod( 'guten-heading-font'.$websafe, customizer_library_get_default( 'guten-heading-font'.$websafe ) ) ) . '", sans-serif;
					color: ' . sanitize_hex_color( get_theme_mod( 'guten-heading-font-color', customizer_library_get_default( 'guten-heading-font-color' ) ) ) . ';
				}
				.editor-styles-wrapper .wp-block,
				.editor-styles-wrapper p.wp-block {
					font-size: ' . esc_attr( $body_font_size ) . 'px;
				}
				.wp-block-quote:not(.is-large),
				.wp-block-quote:not(.is-style-large) {
					border-left-color: ' . sanitize_hex_color( get_theme_mod( 'guten-primary-color', customizer_library_get_default( 'guten-primary-color' ) ) ) . ' !important;
				}';
	$editor_css .= $heading_font_size;

	if ( ! empty( $editor_css ) ) {
		wp_register_style( 'guten-custom-editor-css', false );
		wp_enqueue_style( 'guten-custom-editor-css' );
		wp_add_inline_style( 'guten-custom-editor-css', $editor_css );
	}
}
endif;
add_action( 'enqueue_block_editor_assets', 'customizer_library_guten_editor_styles', 11 );