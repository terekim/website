<?php
/**
 * The file for displaying the portfolio meta.
 *
 * @package York Lite
 * @author  Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<?php york_portfolio_categories(); ?>

		</div>

	</header>

	<?php york_post_thumbnail(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

</article>
