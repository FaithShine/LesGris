<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Concept
 */

get_header(); ?>

<div id="contentwrapper">
  	<h1 class="entry-title">
    	<span>
			<?php esc_html_e( 'Oops! That page can&rsquo;t be found', 'concept-lite' ); ?>
    	</span>
    </h1>

    <div id="content">
    	<?php get_search_form(); ?>
  	</div>
  	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
