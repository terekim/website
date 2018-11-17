<?php
/*
Template Name: Portfolio Thirds
*/
?>
<?php
/**
 * The template for Portfolio Thirds
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Olivo Lite
 */

get_header(); ?>

	<div id="content" class="<?php echo esc_attr( olivo_lite_content_css_class() ); ?>">

		<header class="page-header">
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		</header><!-- .page-header -->

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				$olivo_lite_page_content = get_the_content();
				if ( ! empty( $olivo_lite_page_content ) ) {
				?>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				<?php } ?>

			</article><!-- #post-## -->

		<?php endwhile; // End of the loop. ?>

		<?php get_template_part( 'template-parts/portfolio-container', 'thirds' ); ?>

		<div class="clearfix"></div>

	</div><!-- /content -->

<?php get_footer(); ?>
