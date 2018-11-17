<?php get_template_part( 'template-parts/portfolio-filters' ); ?>

<?php
$posts_per_page = get_theme_mod( 'olivo_lite_portfolio_items_amount', 12 );
global $the_query; //For Pagination to work

if ( get_query_var( 'paged' ) ) :
    $paged = get_query_var( 'paged' );
elseif ( get_query_var( 'page' ) ) :
    $paged = get_query_var( 'page' );
else :
    $paged = 1;
endif;

$olivo_lite_portfolio_display = rwmb_meta( 'olivo_lite_portfolio_display' );
if ( $olivo_lite_portfolio_display == '' ) {
    $olivo_lite_portfolio_display = 'portfolio';
}

$olivo_lite_portfolio_columns = rwmb_meta( 'olivo_lite_portfolio_columns' );
if ( $olivo_lite_portfolio_columns == '' ) {
    $olivo_lite_portfolio_columns = '3';
}
if ( isset( $_GET[ 'portfolio_columns' ] ) ) {
    $olivo_lite_portfolio_columns = sanitize_text_field( wp_unslash( $_GET[ 'portfolio_columns' ] ) );
}

$args = array(
    'post_type'      => $olivo_lite_portfolio_display,
    'paged'          => $paged,
    'posts_per_page' => $posts_per_page,
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {

    echo "<div class='portfolio-container masonry " . 'olivo-' . esc_attr( $olivo_lite_portfolio_columns ) . '-columns' . "' data-post-type='" . esc_attr( $olivo_lite_portfolio_display ) . "'>\n\n";

            while ( $the_query->have_posts() ) { $the_query->the_post();

                get_template_part( 'template-parts/content-portfolio', 'portfolio' );

            }//while

    echo "</div><!-- .portfolio_container -->\n\n";

    $olivo_lite_portfolio_infinitescroll_enable = get_theme_mod( 'olivo_lite_portfolio_infinitescroll_enable', true );
    $count_posts = wp_count_posts( $olivo_lite_portfolio_display );

    if ( $olivo_lite_portfolio_infinitescroll_enable && $count_posts->publish > $posts_per_page ) {
        echo '<div class="portfolio-load-wrapper">';
            echo '<a href="#" class="portfolio-load-more">' . esc_html__( 'Load More', 'olivo-lite' ) . '<span class="olivo-spinner"><span class="olivo-double-bounce1"></span><span class="olivo-double-bounce2"></span></span></a>';
        echo '</div>';
    }else{
        get_template_part( 'template-parts/pagination', 'portfolio' );
    }

}// if have posts
wp_reset_postdata();
?>
