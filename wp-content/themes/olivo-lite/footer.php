<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Olivo Lite
 */

?>

            </main><!-- #main -->

        </div><!-- /#container -->

    <div class="footer-wrap">

    	<div class="sub-footer">
            <?php
                echo '<div class="container">';
            ?>
                <div class="row">
                <?php 
                $olivo_lite_sub_footer_class = 'col-md-5 col-sm-6 col-md-push-2';
                $olivo_lite_sub_footer_social_class = 'col-md-3 col-sm-6 col-md-push-2';
                ?>

                    <div class="<?php echo esc_attr( $olivo_lite_sub_footer_class ); ?>">

                        <p><?php esc_html_e( '&copy; Copyright', 'olivo-lite' ); ?> <?php echo esc_html( date('Y') ); ?> <a rel="nofollow" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( bloginfo( 'name' ) ); ?></a></p>

                        <?php
                        if ( has_nav_menu( 'footer-menu' ) ) {
                            wp_nav_menu(
                                array(
                                    'theme_location'  => 'footer-menu',
                                    'container'       => 'div',
                                    'container_id'    => 'footer-menu',
                                    'container_class' => 'menu',
                                    'menu_id'         => 'menu-footer-items',
                                    'menu_class'      => 'menu-items',
                                    'depth'           => 1,
                                    'fallback_cb'     => '',
                                )
                            );
                        }
                        ?>
                    </div>
                    <div class="<?php echo esc_attr( $olivo_lite_sub_footer_social_class ); ?>">
                        <?php get_template_part( '/template-parts/social-menu', 'footer' ); ?>
                    </div>

                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .sub-footer -->
    </div><!-- .footer-wrap -->

</div><!-- /olivo-site-wrap -->

<div class="sidebar-wrap">

    <?php get_sidebar(); ?>
    
</div><!-- /sidebar-wrap -->

<?php wp_footer(); ?>

</body>
</html>
