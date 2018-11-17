<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Olivo Lite
 */

get_header(); ?>

	<?php

	if ( olivo_lite_is_portfolio_type( get_post_type() ) ) :
	?>
		<div id="content" class="<?php echo esc_attr( olivo_lite_content_css_class() ); ?>">

			<?php get_template_part( 'template-parts/single-portfolio', 'single' ); ?>

		</div><!-- #content -->
	<?php
	else:
	?>

		<div id="content" class="site-content <?php echo esc_attr( olivo_lite_content_css_class() ); ?>" role="content">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'single' ); ?>

				<?php olivo_lite_post_navigation(); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</div><!-- #content -->

	<?php endif; ?>


<?php get_footer(); ?>
