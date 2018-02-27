<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package plum
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'plum' ); ?></a>
	<div id="jumbosearch">
		<span class="fa fa-remove closeicon"></span>
		<div class="form">
			<?php get_search_form(); ?>
		</div>
	</div>	

	<header id="masthead" class="site-header single" role="banner">	
		<div class="layer">			
		<div class="container masthead-container">
			<div class="masthead-inner">	

				<div class="site-branding col-md-6 col-sm-6 col-xs-12">
					<?php if ( plum_has_logo() ) : ?>
					<div id="site-logo">
						<?php plum_logo(); ?>
					</div>
					<?php else : ?>
					
					<div id="text-title-desc">
					<h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					</div>
					<?php endif; ?>
				</div>
				
				<div class="social-icons col-md-6 col-sm-6 col-xs-12">
					<?php get_template_part('social', 'fa'); ?>	

				</div>				
			</div>								
			<?php if(is_single()) : ?>
				<div class="in-header-title">
					<?php the_title( '<h1 class="entry-title title-font">', '</h1>' ); ?>
				</div>	
			<?php endif; ?>
			
		</div>	
		
		<div id="mobile-search">
			<?php get_search_form(); ?>
		</div>

		</div>
	</header><!-- #masthead -->
	
	<div id="slickmenu"></div>
		<nav id="site-navigation" class="main-navigation single" role="navigation">
			<div class="container">
				<?php 
				if (has_nav_menu(  'primary' ) && !get_theme_mod('plum_disable_nav_desc', true) ) :
					$walker = new Plum_Menu_With_Description; 
				elseif( !has_nav_menu(  'primary' ) ):
					$walker = '';
				else :
					$walker = new Plum_Menu_With_Icon;
				endif;
					wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => $walker ) );  ?>
			</div>
		</nav><!-- #site-navigation -->
	
	
	
	<div class="mega-container">
		
		<?php if( class_exists('rt_slider') ) {
		 rt_slider::render('slider', 'swiper' ); 
	} ?>	
			
		<div id="content" class="site-content container">