<?php
/**
 * The template for displaying posts on index view
 *
 * @package Concept
 */
?>

<div <?php post_class(); ?>>

  	<?php concept_post_thumbnail(); ?>
  	<div class="entry">
    	<h2 class="entry-title" id="post-<?php the_ID(); ?>">
        	<a href="<?php the_permalink(); ?>" rel="bookmark">
      			<?php the_title(); ?>
      		</a>
        </h2>
    	<div class="postdata">
      		<?php esc_html_e( 'Posted on', 'concept-lite' ); ?>
      		<?php echo get_the_date(); ?>
        </div>
    	<?php the_excerpt(); ?>
  	</div>

</div>
