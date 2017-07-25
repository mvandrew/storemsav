<?php
/**
 * Customizing elements.
 *
 * @author      Andrey Mishchenko
 * @since       2.2.4.1
 * @package     storemsav
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !function_exists('storemsav_customize_register') ) {
	/**
	 * Added additional parameters and the counters IDs of the analytical systems.
	 *
	 * @see storemsav_checkbox_sanitize()
	 *
	 * @param WP_Customize_Manager $wp_customize The Customizer object.
	 */
	function storemsav_customize_register( $wp_customize ) {

		//
		// Start of the Additional Options
		//
		$panel = 'storemsav_additional_options';
		$wp_customize->add_panel(   $panel, array(
			'capability'            => 'edit_theme_options',
			'description'           => __( 'Change the Additional Options from here as you want', 'storemsav' ),
			'priority'              => 515,
			'title'                 => __( 'Additional Options', 'storemsav' )
		));


		//
		// Display Settings
		//
		$section = 'storemsav_display_settings';
		$wp_customize->add_section( $section, array(
			'priority'              => 1,
			'title'                 => __( 'Display Settings', 'storemsav' ),
			'panel'                 => $panel
		));

		// Hide post author
		$name = 'storemsav_hide_post_author';
		$wp_customize->add_setting( $name, array(
			'default'               => 0,
			'capability'            => 'edit_theme_options',
			'sanitize_callback'     => 'storemsav_checkbox_sanitize'
		));
		$wp_customize->add_control( $name, array(
			'type'                  => 'checkbox',
			'label'                 => __('Hide post author', 'storemsav'),
			'section'               => $section,
			'settings'              => $name
		));

		// Hide powered link
		$name = 'storemsav_hide_powered_link';
		$wp_customize->add_setting( $name, array(
			'default'               => 0,
			'capability'            => 'edit_theme_options',
			'sanitize_callback'     => 'storemsav_checkbox_sanitize'
		));
		$wp_customize->add_control( $name, array(
			'type'                  => 'checkbox',
			'label'                 => __('Hide powered link', 'storemsav'),
			'section'               => $section,
			'settings'              => $name
		));


		//
		// Design Site Link
		//
		$section = 'storemsav_design_site_settings';
		$wp_customize->add_section( $section, array(
			'priority'              => 2,
			'title'                 => __( 'Design Site Link', 'storemsav' ),
			'panel'                 => $panel
		));

		// Show design site link
		$name = 'storemsav_show_design_site_link';
		$wp_customize->add_setting( $name, array(
			'default'               => 0,
			'capability'            => 'edit_theme_options',
			'sanitize_callback'     => 'storemsav_checkbox_sanitize'
		));
		$wp_customize->add_control( $name, array(
			'type'                  => 'checkbox',
			'label'                 => __('Show design site link', 'storemsav'),
			'section'               => $section,
			'settings'              => $name
		));

		// Design site link text
		$name = 'storemsav_design_site_label';
		$wp_customize->add_setting( $name, array(
			'default'               => '',
			'capability'            => 'edit_theme_options'
		));
		$wp_customize->add_control( $name, array(
			'type'                  => 'text',
			'label'                 => __('Design site link text', 'storemsav'),
			'section'               => $section,
			'settings'              => $name
		));

		// Design site link URL
		$name = 'storemsav_design_site_url';
		$wp_customize->add_setting( $name, array(
			'default'               => '',
			'capability'            => 'edit_theme_options'
		));
		$wp_customize->add_control( $name, array(
			'type'                  => 'url',
			'label'                 => __('Design site link URL', 'storemsav'),
			'section'               => $section,
			'settings'              => $name
		));

		// Design site link alias
		$name = 'storemsav_design_site_alias';
		$wp_customize->add_setting( $name, array(
			'default'               => '',
			'capability'            => 'edit_theme_options'
		));
		$wp_customize->add_control( $name, array(
			'type'                  => 'text',
			'label'                 => __('Design site link alias', 'storemsav'),
			'section'               => $section,
			'settings'              => $name
		));


		//
		// Copyright Info
		//
		$section = 'storemsav_copyright_settings';
		$wp_customize->add_section( $section, array(
			'priority'              => 3,
			'title'                 => __( 'Copyright Info', 'storemsav' ),
			'panel'                 => $panel
		));

		// Show Copyright Info
		$name = 'storemsav_show_copyright';
		$wp_customize->add_setting( $name, array(
			'default'               => 0,
			'capability'            => 'edit_theme_options',
			'sanitize_callback'     => 'storemsav_checkbox_sanitize'
		));
		$wp_customize->add_control( $name, array(
			'type'                  => 'checkbox',
			'label'                 => __('Show Copyright Info', 'storemsav'),
			'section'               => $section,
			'settings'              => $name
		));

		// Copyright Owner
		$name = 'storemsav_copyright_owner';
		$wp_customize->add_setting( $name, array(
			'default'               => '',
			'capability'            => 'edit_theme_options'
		));
		$wp_customize->add_control( $name, array(
			'type'                  => 'text',
			'label'                 => __('Copyright Owner', 'storemsav'),
			'section'               => $section,
			'settings'              => $name
		));

		// First Copyright Year
		$name = 'storemsav_copyright_year';
		$wp_customize->add_setting( $name, array(
			'default'               => '',
			'capability'            => 'edit_theme_options'
		));
		$wp_customize->add_control( $name, array(
			'type'                  => 'number',
			'label'                 => __('First Copyright Year', 'storemsav'),
			'section'               => $section,
			'settings'              => $name
		));


		//
		// Counters IDs
		//
		StoreMsavCounters::get_instance()->customize_register( $wp_customize, $panel );

		// storemsav_customize_register
	}
}