<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WCMS_Base_Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class= "container">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wcms-base' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'wcms-base' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'wcms-base' ), 'wcms-base', '<a href="https://automattic.com/" rel="designer">Fabiola Lau De Karlsson</a>' ); ?>
			</div><!-- .site-info -->
		</div><!--container for the "footer.php" cause "we want" it to be in the middle of the 12 columns even when the page is getting smaller-->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
