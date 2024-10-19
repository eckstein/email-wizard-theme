<?php
function email_wizard_customize_register( $wp_customize ) {
	// Site Logo
	$wp_customize->add_setting( 'emailwizard_site_logo', array(
		'default' => '',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'emailwizard_site_logo', array(
		'label' => __( 'Site Logo', 'emailwizard_theme' ),
		'section' => 'title_tagline',
		'settings' => 'emailwizard_site_logo',
	) ) );
}
add_action( 'customize_register', 'email_wizard_customize_register' );