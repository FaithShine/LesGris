<?php
/**
 * Theme Customizer
 *
 * @package Concept
 */
function concept_customize_register($wp_customize){
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action('customize_register', 'concept_customize_register');

function concept_customizer_css() {
    ?>
    <style type="text/css">
        h1.page-title span, h1.entry-title span { background-color: #<?php background_color(); ?>; }
    </style>
    <?php
}
add_action( 'wp_head', 'concept_customizer_css' );