<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Concept
 */

get_header(); ?>

<div id="contentwrapper">
  	<h1 class="entry-title">
    	<span>
    		<?php the_title(); ?>
    	</span>
    </h1>

  	<div id="content">
    	<?php while ( have_posts() ) : the_post(); ?>
    		<div <?php post_class(); ?>>
      			<div class="entry">
        			<?php the_content(); ?>
        			<?php wp_link_pages(array('before' => '<p><strong>'. esc_html__( 'Pages:', 'concept-lite' ) .'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        			<?php edit_post_link(); ?>
        			<?php echo get_the_tag_list('<p class="singletags">',' ','</p>'); ?>
        			<?php the_post_navigation(array(
            			'prev_text'                  => ( '' ),
            			'next_text'                  => ( '' )
        			) ); ?>
        			<?php comments_template(); ?>
      			</div>
    		</div>
    	<?php endwhile; // end of the loop. ?>
  	</div>
  	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
