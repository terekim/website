<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gusto-photography
 */

?>

	

	<footer id="colophon" class="site-footer col-1-1" role="contentinfo">
	<div class="grid-wide">
		<div class="site-info">
			<?php if( get_theme_mod('footer_text') ):

			echo esc_html(get_theme_mod('footer_text')); 

			 else: ?>

			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( ' %1$s by %2$s.', 'gusto-photography' ), 'Gusto Photography', '<a href="https://aperturewp.com/">Aperture WP</a>' );
			endif;?>
		</div><!-- .site-info -->
	</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
</div><!-- #content -->


<?php wp_footer(); ?>

</body>
</html>
