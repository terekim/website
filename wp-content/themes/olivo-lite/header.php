<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Olivo Lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- WP_Head -->
<?php wp_head(); ?>
<!-- End WP_Head -->

</head>

<body <?php body_class(); ?>>
<div class="olivo-preloader"><div class="olivo-folding-cube"><div class="olivo-cube1 olivo-cube"></div><div class="olivo-cube2 olivo-cube"></div><div class="olivo-cube4 olivo-cube"></div><div class="olivo-cube3 olivo-cube"></div></div></div>
    <?php 
    $olivo_lite_site_layout = get_theme_mod( 'olivo_lite_site_layout', 'default' );
    if ( isset( $_GET[ 'site_layout' ] ) ) {
        $olivo_lite_site_layout = sanitize_text_field( wp_unslash( $_GET[ 'site_layout' ] ) );
    }
    ?>

    <div class="olivo-site-wrap">
    
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
        <a href="#" id="olivo-sidebar-btn"><i class="olivo-icon-arrow-left"></i><i class="olivo-icon-arrow-right"></i></a>
        <?php } ?>
    
                
                <?php
                $olivo_lite_header_classes = '';
                $olivo_lite_logo_container_classes = 'col-md-2 col-md-push-2 col-sm-12 col-xs-12';

                $header_image = "";
                if ( get_header_image() ){
                    $header_image = get_header_image();
                }
                ?>
                <header id="header" class="site-header <?php echo esc_attr( $olivo_lite_header_classes ); ?>" <?php echo ( $header_image ) ? 'style="background-image: url(' . esc_url( $header_image ) . ');"' : ''; ?>>

                        <div class="container">
                            <div class="row">
                    

                            <div class="logo_container <?php echo esc_attr( $olivo_lite_logo_container_classes ); ?>">
                                <?php
                                $logo = '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home" class="ql_logo">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
                                if ( has_custom_logo() ){
                                    $logo = get_custom_logo();
                                }
                                ?>
                                <?php if ( is_front_page() ) : ?>
                                    <h1 class="site-title"><?php echo wp_kses_post( $logo ); ?>&nbsp;</h1>
                                <?php else : ?>
                                    <p class="site-title"><?php echo wp_kses_post( $logo ); ?></p>
                                <?php endif; ?>

                                <button id="ql_nav_btn" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ql_nav_collapse" aria-expanded="false">
                                    <i class="fa fa-navicon"></i>
                                </button>

                            </div><!-- /logo_container -->

                            <div class="col-md-6 col-md-push-2">
                            
                                <div class="collapse navbar-collapse" id="ql_nav_collapse">
                                    <nav id="jqueryslidemenu" class="jqueryslidemenu navbar " >
                                        <?php
                                        wp_nav_menu( array(
                                            'theme_location'  => 'primary',
                                            'menu_id' => 'primary-menu',
                                            'depth'             => 3,
                                            'menu_class'        => 'nav',
                                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                            'walker'            => new wp_bootstrap_navwalker()
                                        ));
                                        ?>
                                    </nav>

                                </div><!-- /ql_nav_collapse -->

                            </div><!-- col-md-6 -->

                            <div class="clearfix"></div>

                        </div><!-- row-->
                    </div><!-- /container -->

                </header>


        <div id="container" class="container">

            <main id="main" class="site-main row">


    
