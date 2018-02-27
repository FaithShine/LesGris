<?php
/**
 * The Header for our theme.
 *
 *
 * @package Concept
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=2.0, user-scalable=yes" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="container">
	<?php if ( has_nav_menu( 'social' ) ) {
					wp_nav_menu(
						array(
							'theme_location'  => 'social',
							'container'       => 'div',
							'container_id'    => 'menu-social',
							'container_class' => 'menu',
							'menu_id'         => 'menu-social-items',
							'menu_class'      => 'menu-items',
							'depth'           => 1,
							'link_before'     => '<span class="screen-reader-text">',
							'link_after'      => '</span>',
							'fallback_cb'     => '',
						)
					);
	} ?>

	<div id="header">

        <div id="logo">
    		<?php the_custom_logo(); ?>
    		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
    			<h1 class="site-title">
      				<?php bloginfo( 'name' ); ?>
    			</h1>
    		</a>
    		<h2 class="site-description">
      			<?php bloginfo( 'description' ); ?>
    		</h2>
  		</div>

  		<?php if ( has_nav_menu( 'main-menu' ) ) {
    				wp_nav_menu( 
						array( 
							'theme_location' => 'main-menu', 
							'container_id'   => 'mainmenu',
							'menu_class' 	 => 'superfish sf-menu',
							'fallback_cb'	 => false
						)
					);

					wp_nav_menu(
						array(
							'theme_location' => 'main-menu',
							'container_class'   => 'mmenu',
							'menu_class' 	 => 'navmenu',
							'fallback_cb'	 => false
					)
			);
  		} ?>

  		<?php if (is_front_page()) : ?>
  			<?php
  				$args = array(
   					'posts_per_page' =>-1,
					'post_type' => 'any',
	  				'post__not_in' => get_option( 'sticky_posts' ),
					'meta_key' => '_thumbnail_id',
      				'meta_query' => array(
         			array(
            			'key' => 'slider',
            			'value' => 'yes'
         			)
      			)
   				);
  				$slider_posts = new WP_Query($args);
			?>

  			<?php if($slider_posts->have_posts()) : ?>
  				<div class="owl-carousel">
    				<?php while($slider_posts->have_posts()) : $slider_posts->the_post() ?>

                        <a href="
							<?php if(get_post_meta($post->ID, 'slidelink', true)): ?>
								<?php echo esc_html(get_post_meta($post->ID, 'slidelink', true)); ?> 
        					<?php else : ?>
								<?php the_permalink(); ?>
                			<?php endif; ?>
            			">

							<?php if(get_post_meta($post->ID, 'slideimage', true)): ?>
    							<img src="<?php echo esc_html(get_post_meta($post->ID, 'slideimage', true)); ?>" />
    						<?php else : ?>
    							<?php the_post_thumbnail('concept-slideimage'); ?>
    						<?php endif; ?>
    					</a>

					<?php endwhile ?>
  				</div>
  			<?php wp_reset_postdata(); ?>
  			<?php endif ?>
  		<?php endif; ?>

    </div>

	<div id="wrapper">
		<?php if ( is_front_page () && is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div id="frontwidget">
  				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
		<?php endif ?>
