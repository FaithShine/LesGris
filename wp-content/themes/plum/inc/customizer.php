<?php
/**
 * plum Theme Customizer
 *
 * @package plum
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function plum_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';		
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'plum' ),
	    'priority'   => 30,
	) );
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override plum_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('plum_site_titlecolor', array(
	    'default'     => '#FFFFFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'plum_site_titlecolor', array(
			'label' => __('Site Title Color','plum'),
			'section' => 'colors',
			'settings' => 'plum_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('plum_header_desccolor', array(
	    'default'     => '#FFFFFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'plum_header_desccolor', array(
			'label' => __('Site Tagline Color','plum'),
			'section' => 'colors',
			'settings' => 'plum_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	
	
	//Extra Panel for Users, who dont have WooCommerce
	
	// CREATE THE fcp PANEL
	$wp_customize->add_panel( 'plum_a_fcp_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Featured Content Areas',
	    'description'    => '',
	) );
	
	
	//SQUARE BOXES
	$wp_customize->add_section(
	    'plum_a_fc_boxes',
	    array(
	        'title'     => __('Featured Posts','plum'),
	        'priority'  => 10,
	        'panel'     => 'plum_a_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'plum_a_box_enable',
		array( 'sanitize_callback' => 'plum_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'plum_a_box_enable', array(
		    'settings' => 'plum_a_box_enable',
		    'label'    => __( 'Enable Featured Posts', 'plum' ),
		    'section'  => 'plum_a_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
	
 
	$wp_customize->add_setting(
		'plum_a_box_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'plum_a_box_title', array(
		    'settings' => 'plum_a_box_title',
		    'label'    => __( 'Title','plum' ),
		    'section'  => 'plum_a_fc_boxes',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'plum_a_box_cat',
	    array( 'sanitize_callback' => 'plum_sanitize_category' )
	);
	
	$wp_customize->add_control(
	    new Plum_WP_Customize_Category_Control(
	        $wp_customize,
	        'plum_a_box_cat',
	        array(
	            'label'    => __('Posts Category.','plum'),
	            'settings' => 'plum_a_box_cat',
	            'section'  => 'plum_a_fc_boxes'
	        )
	    )
	);
	
		
	//SQUARE BOXES 2
	$wp_customize->add_section(
	    'plum_a_fc2_boxes',
	    array(
	        'title'     => __('Featured Posts 2','plum'),
	        'priority'  => 10,
	        'panel'     => 'plum_a_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'plum_a_box2_enable',
		array( 'sanitize_callback' => 'plum_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'plum_a_box2_enable', array(
		    'settings' => 'plum_a_box2_enable',
		    'label'    => __( 'Enable Featured Posts', 'plum' ),
		    'section'  => 'plum_a_fc2_boxes',
		    'type'     => 'checkbox',
		)
	);
	
 
	$wp_customize->add_setting(
		'plum_a_box2_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'plum_a_box2_title', array(
		    'settings' => 'plum_a_box2_title',
		    'label'    => __( 'Title','plum' ),
		    'section'  => 'plum_a_fc2_boxes',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'plum_a_box2_cat',
	    array( 'sanitize_callback' => 'plum_sanitize_category' )
	);
	
	$wp_customize->add_control(
	    new Plum_WP_Customize_Category_Control(
	        $wp_customize,
	        'plum_a_box2_cat',
	        array(
	            'label'    => __('Posts Category.','plum'),
	            'settings' => 'plum_a_box2_cat',
	            'section'  => 'plum_a_fc2_boxes'
	        )
	    )
	);	
	
	
	
	// Layout and Design
	$wp_customize->add_panel( 'plum_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','plum'),
	) );
	
	$wp_customize->add_section(
	    'plum_design_options',
	    array(
	        'title'     => __('Blog Layout','plum'),
	        'priority'  => 0,
	        'panel'     => 'plum_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'plum_blog_layout',
		array( 'sanitize_callback' => 'plum_sanitize_blog_layout' )
	);
	
	function plum_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','grid_2_column','plum','plum_3_column') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'plum_blog_layout',array(
				'label' => __('Select Layout','plum'),
				'description' => __('Use 3 Column Layouts, only after disabling sidebar for the page.','plum'),
				'settings' => 'plum_blog_layout',
				'section'  => 'plum_design_options',
				'type' => 'select',
				'choices' => array(
						'grid' => __('Standard Blog Layout','plum'),
						'plum' => __('Plum Theme Layout','plum'),
						'plum_3_column' => __('Plum Theme Layout (3 Columns)','plum'),
						'grid_2_column' => __('Grid - 2 Column','plum'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'plum_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','plum'),
	        'priority'  => 0,
	        'panel'     => 'plum_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'plum_disable_sidebar',
		array( 'sanitize_callback' => 'plum_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'plum_disable_sidebar', array(
		    'settings' => 'plum_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','plum' ),
		    'section'  => 'plum_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'plum_disable_sidebar_home',
		array( 'sanitize_callback' => 'plum_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'plum_disable_sidebar_home', array(
		    'settings' => 'plum_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','plum' ),
		    'section'  => 'plum_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'plum_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'plum_disable_sidebar_front',
		array( 'sanitize_callback' => 'plum_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'plum_disable_sidebar_front', array(
		    'settings' => 'plum_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','plum' ),
		    'section'  => 'plum_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'plum_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'plum_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'plum_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'plum_sidebar_width', array(
		    'settings' => 'plum_sidebar_width',
		    'label'    => __( 'Sidebar Width','plum' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','plum'),
		    'section'  => 'plum_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'plum_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	/* Active Callback Function */
	function plum_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('plum_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	function plum_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	
	$wp_customize-> add_section(
    'plum_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','plum'),
    	'description'	=> __('Enter your Own Copyright Text.','plum'),
    	'priority'		=> 11,
    	'panel'			=> 'plum_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'plum_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'plum_footer_text',
	        array(
	            'section' => 'plum_custom_footer',
	            'settings' => 'plum_footer_text',
	            'type' => 'text'
	        )
	);	
	
	$wp_customize->get_section('colors')->title = __('Theme Skin & Colors','plum');
	
	$wp_customize->add_setting(
		'plum_skin',
		array(
			'default'=> 'default',
			'sanitize_callback' => 'plum_sanitize_skin' 
			)
	);
	
	$skins = array( 'default' => __('Default(Plum)','plum'),
					'orange' =>  __('Orange','plum'),
					'green' => __('Green','plum'),
					);
	
	$wp_customize->add_control(
		'plum_skin',array(
				'settings' => 'plum_skin',
				'section'  => 'colors',
				'label' => __('Choose Skin','plum'),
				'description' => __('Free Version of Plum Supports 3 Different Skin Colors.','plum'),
				'type' => 'select',
				'choices' => $skins,
			)
	);
	
	function plum_sanitize_skin( $input ) {
		if ( in_array($input, array('default','orange','green') ) )
			return $input;
		else
			return '';
	}
	
	
	//Fonts
	$wp_customize->add_section(
	    'plum_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','plum'),
	        'priority'  => 41,
	        'description' => __('Defaults: Droid Serif, Ubuntu.','plum')
	    )
	);
	
	$font_array = array('Arvo','Source Sans Pro','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting(
		'plum_title_font',
		array(
			'default'=> 'Arvo',
			'sanitize_callback' => 'plum_sanitize_gfont' 
			)
	);
	
	function plum_sanitize_gfont( $input ) {
		if ( in_array($input, array('Arvo','Source Sans Pro','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora',) ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
		'plum_title_font',array(
				'label' => __('Title','plum'),
				'settings' => 'plum_title_font',
				'section'  => 'plum_typo_options',
				'type' => 'select',
				'choices' => $fonts,
			)
	);
	
	$wp_customize->add_setting(
		'plum_body_font',
			array(	'default'=> 'Source Sans Pro',
					'sanitize_callback' => 'plum_sanitize_gfont' )
	);
	
	$wp_customize->add_control(
		'plum_body_font',array(
				'label' => __('Body','plum'),
				'settings' => 'plum_body_font',
				'section'  => 'plum_typo_options',
				'type' => 'select',
				'choices' => $fonts
			)
	);
	
	$wp_customize->add_section(
	    'plum_sec_pro',
	    array(
	        'title'     => __('-> Make Plum Better!!','plum'),
	        'priority'  => 10,
	    )
	);
	
	$wp_customize->add_setting(
			'plum_pro',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new Plum_WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'plum_pro',
	        array(
	            'label' => __('Feature Requests','plum'),
	            'description' => __('<a href="https://inkhive.com/contact-us/">Contact Us</a> and help us make Plum a better theme with Feature Requests, Bug Reports or any other ideas you have to help us make this theme better. <br /> <br /> We Will Reward everyone who helps us with a 30% Discount when Plum Plus Releases. ','plum'),
	            'section' => 'plum_sec_pro',
	            'settings' => 'plum_pro',			       
	        )
		)
	);
	
	// Social Icons
	$wp_customize->add_section('plum_social_section', array(
			'title' => __('Social Icons','plum'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','plum'),
					'facebook' => __('Facebook','plum'),
					'twitter' => __('Twitter','plum'),
					'google-plus' => __('Google Plus','plum'),
					'instagram' => __('Instagram','plum'),
					'rss' => __('RSS Feeds','plum'),
					'vine' => __('Vine','plum'),
					'vimeo-square' => __('Vimeo','plum'),
					'youtube' => __('Youtube','plum'),
					'flickr' => __('Flickr','plum'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'plum_social_'.$x, array(
				'sanitize_callback' => 'plum_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'plum_social_'.$x, array(
					'settings' => 'plum_social_'.$x,
					'label' => __('Icon ','plum').$x,
					'section' => 'plum_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'plum_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'plum_social_url'.$x, array(
					'settings' => 'plum_social_url'.$x,
					'description' => __('Icon ','plum').$x.__(' Url','plum'),
					'section' => 'plum_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function plum_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function plum_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function plum_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function plum_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
	
	function plum_sanitize_product_category( $input ) {
		if ( get_term( $input, 'product_cat' ) )
			return $input;
		else 
			return '';	
	}
	
	
}
add_action( 'customize_register', 'plum_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function plum_customize_preview_js() {
	wp_enqueue_script( 'plum_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'plum_customize_preview_js' );
