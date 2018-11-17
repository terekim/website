<?php
/*
 * Retreive Portfolio items for AJAX
 */
function olivo_lite_load_portfolio_items(){

	if( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['action'] )) {

		//Comprabar que tenga un token correcto para evitar abuso
		if( isset( $_POST['token'] ) && wp_verify_nonce( sanitize_key( $_POST['token'] ), 'quemalabs-secret' ) ){

			if ( isset( $_POST['category'] ) ) {
			    $category = sanitize_text_field( wp_unslash( $_POST['category'] ) );
			}
			if ( isset( $_POST['portfolio_type'] ) ) {
			    $portfolio_type = sanitize_text_field( wp_unslash( $_POST['portfolio_type'] ) );
			}
			if ( isset( $_POST['post_type'] ) ) {
			    $post_type = sanitize_text_field( wp_unslash( $_POST['post_type'] ) );
			}
			if ( isset( $_POST['offset'] ) ) {
			    $offset = intval( wp_unslash( $_POST['offset'] ) );
			}
			$product_amout = get_theme_mod( 'olivo_lite_portfolio_items_amount', 12 );
			$args = array(
				'posts_per_page' => $product_amout,
				'post_type' => $post_type,
				'post_status' => 'publish'
			);
			if ( 'all' != $category ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $post_type . '_category',
						'field'    => 'slug',
						'terms'    => $category,
					),
				);
			}
			if ( $offset ) {
				$args['offset'] = $offset;
				$args['posts_per_page'] = 3;
			}
			// The Query
			$the_query = new WP_Query( $args );



			// The Loop
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					if( 'thirds' == $portfolio_type ){
						get_template_part( 'template-parts/content-portfolio', 'thirds' );
					}else{
						get_template_part( 'template-parts/content-portfolio', 'portfolio' );	
					}
				}
			} else {
				// no posts found
			}
			/* Restore original Post Data */
			wp_reset_postdata();
			wp_die();


		}else{

			wp_send_json_error( 'Ivalid nonce' ); //This do not render to the front-end

		}//end token

	} // end IF

}// olivo_lite_load_portfolio_items()

add_action( 'wp_ajax_nopriv_olivo_lite_load_portfolio_items', 'olivo_lite_load_portfolio_items' );
add_action( 'wp_ajax_olivo_lite_load_portfolio_items', 'olivo_lite_load_portfolio_items' );
