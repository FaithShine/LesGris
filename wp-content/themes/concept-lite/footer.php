<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package Concept
 */
?>
</div>

<div id="footer">

	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
  		<div id="footerinner">
    		<div id="footerwidgets">
      			<?php dynamic_sidebar( 'sidebar-3' ); ?>
    		</div>
  		</div>
  	<?php endif ?>
  	<div id="copyinfo">
    	&copy; <?php echo date("Y"); ?>
  		<?php bloginfo('name'); ?>.
        <a href="<?php echo esc_url( esc_html__( 'http://wordpress.org/', 'concept-lite' ) ); ?>">
			<?php printf( esc_html__( 'Powered by %s.', 'concept-lite' ), 'WordPress' ); ?>
        </a>
		<?php printf( esc_html__( 'Theme by %1$s.', 'concept-lite' ), '<a href="http://www.vivathemes.com/" rel="designer">Viva Themes</a>' ); ?>
   </div>

</div>
</div>
<?php wp_footer(); ?>
</body>
</html>