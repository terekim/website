<?php
add_filter( 'rwmb_meta_boxes', 'olivo_lite_meta_boxes' );

function olivo_lite_meta_boxes( $meta_boxes ) {

    $prefix = 'olivo_lite_';
	
	if( ! is_wp_error( olivo_lite_get_portfolios_options() ) ){

	    $meta_boxes[] = array(
			'title' => __( 'Select Portfolio to display', 'olivo-lite' ),
	        'post_types' => 'page',
			'fields' => array(
				array(
					'name'    => esc_html__( 'Select', 'olivo-lite' ),
					'id'      => "{$prefix}portfolio_display",
					'type'    => 'select',
					'options' => olivo_lite_get_portfolios_options(),
				),
				array(
					'name'    => esc_html__( 'Columns', 'olivo-lite' ),
					'id'      => "{$prefix}portfolio_columns",
					'type'    => 'select',
					'std'     => '3',
					'placeholder' => esc_attr( 'Select columns...', 'olivo-lite' ),
					'options' => array(
						'1' => '1 Column',
						'2' => '2 Columns',
						'3' => '3 Columns',
						'4' => '4 Columns',
						)
				),
			),
		);

	}

	if( ! is_wp_error( olivo_lite_get_portfolios_slug() ) ){

	    $meta_boxes[] = array(
			'title' => __( 'Portfolio Item Options', 'olivo-lite' ),
	        'post_types' => olivo_lite_get_portfolios_slug(),
			'fields' => array(
				array(
					'name'    => esc_html__( 'Select layout', 'olivo-lite' ),
	                'desc'  => esc_html__( 'Portrait images will automatically set as portrait items.', 'olivo-lite' ),
					'id'      => "{$prefix}portfolio_item_layout",
					'type'    => 'select',
					'options' => array(
	                    'landscape'     => esc_html__( 'Landscape', 'olivo-lite' ),
	                    'landscape-big' => esc_html__( 'Landscape Big', 'olivo-lite' ),
	                ),
	            ),
	        ),
		);
		
	}


    return $meta_boxes;
}
