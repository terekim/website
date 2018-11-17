<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Olivo Lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function olivo_lite_body_classes( $classes ) {

    $olivo_lite_theme_data = wp_get_theme();

    $classes[] = sanitize_title( $olivo_lite_theme_data['Name'] );
    $classes[] = 'v' . $olivo_lite_theme_data['Version'];

    $olivo_lite_slider_fullscreen = get_theme_mod( 'olivo_lite_slider_fullscreen', false );
    if ( class_exists( 'WooCommerce' ) ){
        if ( is_shop() && $olivo_lite_slider_fullscreen || isset( $_GET[ 'fullscreen_slider' ] ) ) {
            $classes[] = 'slider-fullscreen';
        }
    }

    // Add Animations Class
    $olivo_lite_site_animations = get_theme_mod( 'olivo_lite_site_animations', 'true' );
    if ( 'true' == $olivo_lite_site_animations ) {
        $classes[] = 'ql_animations ql_portfolio_animations';
    }


    //Add Single Portfolio classes
    if ( is_single() && olivo_lite_is_portfolio_type( get_post_type() ) ) :

        $classes[] = 'olivo-portfolio-type';

	endif;

    //Add class for Blog Layout
    $olivo_lite_blog_layout = get_theme_mod( 'olivo_lite_blog_layout', 'layout-1' );
    if ( isset( $_GET[ 'blog_layout' ] ) ) {
        $olivo_lite_blog_layout = sanitize_text_field( wp_unslash( $_GET[ 'blog_layout' ] ) );
    }
    $classes[] = 'olivo-blog-' . esc_attr( $olivo_lite_blog_layout );

    //Add class for Site Layout
    $olivo_lite_site_layout = get_theme_mod( 'olivo_lite_site_layout', 'default' );
    if ( isset( $_GET[ 'site_layout' ] ) ) {
        $olivo_lite_site_layout = sanitize_text_field( wp_unslash( $_GET[ 'site_layout' ] ) );
    }
    $classes[] = 'olivo-' . esc_attr( $olivo_lite_site_layout );

    //Add class if there is Sidebar
    if ( is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'olivo-with-sidebar';
    }else{
        $classes[] = 'olivo-with-out-sidebar';
    }

	return $classes;
}
add_filter( 'body_class', 'olivo_lite_body_classes' );


if ( ! function_exists( 'olivo_lite_new_content_more' ) ){
    function olivo_lite_new_content_more($more) {
           global $post;
           return ' <br><a href="' . esc_url( get_permalink() ) . '" class="more-link read-more">' . esc_html__( 'Read more', 'olivo-lite' ) . ' <i class="olivo-icon-arrow-right"></i></a>';
    }
}// end function_exists
    add_filter( 'the_content_more_link', 'olivo_lite_new_content_more' );

/**
 * Convert HEX colors to RGB
 */
function olivo_lite_hex2rgb( $colour ) {
    $colour = str_replace("#", "", $colour);
    if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
            return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Return only slug from all portfolios CPT
 *
 * @return array
 */
 function olivo_lite_get_portfolios_slug(){

    if ( class_exists( 'Multiple_Portfolios' ) ) {

        $olivo_lite_portfolio_types = Multiple_Portfolios::get_post_types();
        $olivo_lite_portfolio_types_slugs = array();
        foreach ( $olivo_lite_portfolio_types as $portfolio ) {
            $olivo_lite_portfolio_types_slugs[] = $portfolio['slug'];
        }
        return $olivo_lite_portfolio_types_slugs;
    }else{
        return new WP_Error( 'plugin_missing', esc_html__( 'Multiple Portfolios plugin not installed', 'olivo-lite' ) );
    }

 }


/**
* Return portfolios as option for Meta Box
*
* @return array
*/
function olivo_lite_get_portfolios_options(){

    if ( class_exists( 'Multiple_Portfolios' ) ) {

        $olivo_lite_portfolio_types = Multiple_Portfolios::get_post_types();
        $olivo_lite_portfolio_types_option = array();
        foreach ( $olivo_lite_portfolio_types as $portfolio ) {
            $olivo_lite_portfolio_types_option[$portfolio['slug']] = $portfolio['name'];
        }
        return $olivo_lite_portfolio_types_option;
    }else{
        return new WP_Error( 'plugin_missing', esc_html__( 'Multiple Portfolios plugin not installed', 'olivo-lite' ) );
    }

}


/**
 * Return only slug from all portfolios CPT
 *
 * @return array
 */
 function olivo_lite_is_portfolio_category( $category ){

    if ( class_exists( 'Multiple_Portfolios' ) ) {

        $olivo_lite_portfolio_types = Multiple_Portfolios::get_post_types();
        $taxonomy_objects = get_object_taxonomies( 'portfolio' );
        foreach ( $olivo_lite_portfolio_types as $portfolio ) {
            $taxonomy_objects = get_object_taxonomies( $portfolio );
            foreach ( $taxonomy_objects as $key => $taxonomy_object ) {
                if ( $category == $taxonomy_object ) {
                    return true;
                }
            }
        }
        return false;
    }else{
        return new WP_Error( 'plugin_missing', esc_html__( 'Multiple Portfolios plugin not installed', 'olivo-lite' ) );
    }

 }
 


/**
* Avoid undefined functions if Meta Box is not activated
*
* @return bool
*/
if ( ! function_exists( 'rwmb_meta' ) ) {
    function rwmb_meta( $key, $args = '', $post_id = null ) {
        return false;
    }
}


/**
* Check if the post type is a Portfolio post type
*
* @return bool
*/
if ( ! function_exists( 'olivo_lite_is_portfolio_type' ) ) {
    function olivo_lite_is_portfolio_type( $post_type ) {

    	$olivo_lite_portfolios_post_types = olivo_lite_get_portfolios_slug();
        if ( ! is_wp_error( $olivo_lite_portfolios_post_types ) ) {
        	if ( in_array( $post_type, $olivo_lite_portfolios_post_types ) ) :
                return true;
            else:
                return false;
            endif;
        }else{
            return false;
        }

    }
}


/**
* Display Portfolio or Post navigation
*
* @return html
*/
if ( ! function_exists( 'olivo_lite_post_navigation' ) ) {
    function olivo_lite_post_navigation() {

        $post_nav_bck = '';
        $post_nav_bck_next = '';
        $prev_post = get_previous_post();
        if ( ! empty( $prev_post ) ):
            $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'olivo_lite_portfolio' );
            if ( ! empty( $portfolio_image ) ) {
                $post_nav_bck = ' style="background-image: url(' . esc_url( $portfolio_image[0] ) . ');"';
            }
        endif;
        $next_post = get_next_post();
        if ( ! empty( $next_post ) ):
            $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'olivo_lite_portfolio' );
            if ( ! empty( $portfolio_image ) ) {
                $post_nav_bck_next = ' style="background-image: url(' . esc_url( $portfolio_image[0] ) . ');"';
            }
        endif;

        if ( ! empty( $prev_post ) || ! empty( $next_post ) ):
        ?>
            <nav class="navigation post-navigation" >
                <div class="nav-links">
                    <?php if ( ! empty( $prev_post ) ): ?>
                    <div class="nav-previous" <?php echo $post_nav_bck; ?>>
                        <?php
                        $prev_text = esc_html__( 'Previous Post', 'olivo-lite' );
                        if ( olivo_lite_is_portfolio_type( get_post_type() ) ) {
                            $prev_text = esc_html__( 'Previous Project', 'olivo-lite' );
                        }
                        ?>
                        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev"><span><?php echo $prev_text; ?></span><?php echo esc_html( $prev_post->post_title ); ?></a>
                    </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $next_post ) ): ?>
                    <div class="nav-next" <?php echo $post_nav_bck_next; ?>>
                        <?php
                        $next_text = esc_html__( 'Next Post', 'olivo-lite' );
                        if ( olivo_lite_is_portfolio_type( get_post_type() ) ) {
                            $next_text = esc_html__( 'Next Project', 'olivo-lite' );
                        }
                        ?>
                        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next"><span><?php echo $next_text; ?></span><?php echo esc_html( $next_post->post_title ); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </nav>
        <?php endif;

    }
}

/**
* Return a darker color in HEX
*
* @return string
*/
function olivo_lite_darken_color( $rgb, $darker = 2 ) {

    $hash = (strpos($rgb, '#') !== false) ? '#' : '';
    $rgb = (strlen($rgb) == 7) ? str_replace('#', '', $rgb) : ((strlen($rgb) == 6) ? $rgb : false);
    if(strlen($rgb) != 6) return $hash.'000000';
    $darker = ($darker > 1) ? $darker : 1;

    list($R16,$G16,$B16) = str_split($rgb,2);

    $R = sprintf("%02X", floor(hexdec($R16)/$darker));
    $G = sprintf("%02X", floor(hexdec($G16)/$darker));
    $B = sprintf("%02X", floor(hexdec($B16)/$darker));

    return $hash.$R.$G.$B;
}


/**
 * Enqueues front-end CSS for retina images of portfolio.
 *
 * @see wp_add_inline_style()
 */
function olivo_lite_portfolio_retina_images() {

    $custom_css = olivo_lite_get_portfolio_retina_css();

    wp_add_inline_style( 'olivo_lite_style', $custom_css );

}
add_action( 'wp_enqueue_scripts', 'olivo_lite_portfolio_retina_images' );


/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors colors.
 * @return string CSS.
 */
function olivo_lite_get_portfolio_retina_css() {


    $olivo_lite_portfolio_display = rwmb_meta( 'olivo_lite_portfolio_display' );
    $olivo_lite_retina_css = '';

    $args = array(
        'post_type'      => $olivo_lite_portfolio_display,
        'posts_per_page' => -1,
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {


        while ( $the_query->have_posts() ) { $the_query->the_post();

            if ( has_post_thumbnail() ) {
                $portfolio_image_2x = wp_get_attachment_image_src( get_post_thumbnail_id(), 'olivo_lite_portfolio_2x' );

                $olivo_lite_retina_css .= "@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {";
                $olivo_lite_retina_css .= "#portfolio-item-" . esc_attr( get_the_ID() ) . "{ background-image: url(" . esc_url( $portfolio_image_2x[0] ) . "); }";
                $olivo_lite_retina_css .=  "}\n";
            }
            
        }//while


    }// if have posts
    wp_reset_postdata();


    $css = <<<CSS

    /*============================================
    // Retina Images
    ============================================*/
    {$olivo_lite_retina_css}
    


CSS;

    return $css;
}




/**
* Return CSS class for #content
*
* @return bool
*/
if ( ! function_exists( 'olivo_lite_content_css_class' ) ) {
    function olivo_lite_content_css_class() {
        $olivo_lite_site_layout = get_theme_mod( 'olivo_lite_site_layout', 'default' );
        if ( isset( $_GET[ 'site_layout' ] ) ) {
            $olivo_lite_site_layout = sanitize_text_field( wp_unslash( $_GET[ 'site_layout' ] ) );
        }

        switch ( $olivo_lite_site_layout ) {
            case 'default':
                return 'col-md-8 col-md-push-2';
                break;

            case 'sidenav':
                return 'col-md-8 col-md-push-1';
                break;

            case 'sidenav-out':
                return 'col-md-10 col-md-push-1';
                break;
            
            default:
                return 'col-md-8 col-md-push-2';
                break;
        }

    }
}


