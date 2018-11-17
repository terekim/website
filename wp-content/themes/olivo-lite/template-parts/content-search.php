<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Olivo Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-image">
            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
            	<?php 
            	$olivo_lite_thumbnail_size = 'olivo_lite_post';
            	$olivo_lite_blog_layout = get_theme_mod( 'olivo_lite_blog_layout', 'layout-1' );
            	if ( isset( $_GET[ 'blog_layout' ] ) && 'layout-4' == $_GET[ 'blog_layout' ] || 'layout-4' == $olivo_lite_blog_layout ) {
			        $olivo_lite_thumbnail_size = 'olivo_lite_post_wide';
			    }
            	?>
                <?php the_post_thumbnail( $olivo_lite_thumbnail_size ); ?>
            </a>
        </div><!-- /post-image -->
        <?php endif; ?>

        <div class="post-content">

			<header class="entry-header">
        		<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        	</header><!-- .entry-header -->

        	<div class="entry-content">
				<?php
					the_excerpt();
				?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'olivo-lite' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<?php if ( 'post' === get_post_type() ) : ?>
			<footer class="entry-footer">
				<div class="metadata">
	                <?php olivo_lite_metadata(); ?>
	                <div class="clearfix"></div>
	            </div><!-- /metadata -->
            </footer><!-- .entry-footer -->
            <?php endif; ?>

			<div class="clearfix"></div>

		</div><!-- /post_content -->
</article><!-- #post-## -->
