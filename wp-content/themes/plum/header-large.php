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
	
	
	<header id="masthead" class="site-header" role="banner">			
		<div class="container masthead-container">
			<div class="masthead-inner">
				<div class="site-branding col-md-6 col-sm-6 col-xs-12">
					<?php if ( plum_has_logo() ) : ?>
					<div id="site-logo">
						<?php plum_logo(); ?>
					</div>
					<?php else: ?>
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
<style>
.header_btn {
  border-radius: 0px;
  border-color: white;
  border-width: 4px;
  background-color: transparent;
  color: #FFFFFF;
  text-align: center;
  font-family: "Helvetica";
  font-size: 29px;
  width: 32%;
  height: 60px;
  box-shadow: none;
  text-shadow: none;
  align-content: center;
  padding-bottom: 0px;
  padding-top: 0px;
  line-height: 56px;
  top: 72%;
  position: absolute;
}

.header_btn span {
  cursor: pointer;
  transition: 0.5s;
  position: relative;
  display: inline-block;
  padding: 0px;
  text-align: center;
}

.header_btn span:after {
  /*content: '\00bb';*/
  content: "";
  color: white;
  position: relative;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
  box-shadow: none;
  text-shadow: none;
}

.header_btn:hover span {
  padding-right: 25px;
  box-shadow: none;
  text-shadow: none;
}

.header_btn:hover span:after {
  opacity: 1;
  right: 0;
  box-shadow: none;  
}
/**
#search_btn{
	right: 10px;
}
*/
#topten_btn{
	left: 10px;
}
</style>
</div>			

		
		<div id="slickmenu"></div>
<button id="search_btn" class="header_btn" onClick="document.location.href='http://34.208.205.195/wordpress/index.php/searchnew/'"><span>Find Your Community</span></button>

		<nav id="site-navigation" class="main-navigation" role="navigation">
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
		
		<div id="mobile-search">
			<?php get_search_form(); ?>
		</div>
		
	</header><!-- #masthead -->
	
	<?php get_template_part('featured', 'posts'); ?>

	
	<div class="mega-container">
		<?php if( class_exists('rt_slider') ) {
			 rt_slider::render('slider', 'swiper' ); 
		} ?>	
		
		<?php get_template_part('featured', 'posts2'); ?>
			
		<div id="content" class="site-content container">