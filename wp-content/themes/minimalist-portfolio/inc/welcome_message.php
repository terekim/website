<?php

function minimalist_portfolio_welcome_message() {

	if ( ! minimalist_portfolio_should_display_welcome_message() ) {
		return;
	}

	$url_tutorial   = "https://colormelon.com/free-portfolio-website-tutorial/?utm_source=minimalist-portfolio&utm_medium=welcome";
	$url_theme_demo = "http://befree.bycolormelon.com";
	?>
	<div class="notice" style="position: relative; padding: 3rem;">
		<h1><?php esc_html_e( 'Welcome to Minimalist Portfolio', 'minimalist-portfolio' ); ?></h1>
		<p style="font-size: 16px;"><?php esc_html_e(
				'Make the best out of Minimalist Portfolio theme by adding a Portfolio section with Easy Photography Portfolio plugin!',
				'minimalist-portfolio'
			); ?></p>
		<p style="font-size: 16px;">
			<?php
			printf(
				wp_kses(
					__(
						'Have a look at the <strong><a target="_blank" href="%1$s">step-by-step setup tutorial</a></strong> and the <a target="_blank" href="%2$s">Minimalist Portfolio demo</a>',
						'minimalist-portfolio'
					),
					// Kses rules:
					array(
						// Allow links with targets and hrefs
						'a'      => array(
							'href'   => array(),
							'target' => array(),
						),
						'strong' => array(),
					)
				),

				// Pass variables to printf()
				esc_url( $url_tutorial ),
				esc_url( $url_theme_demo )
			);
			?>
		</p>

		<a type="button" class="notice-dismiss" href="<?php echo get_admin_url() ?>?close-welcome-message=1" style="text-decoration: none;">
			<span class="screen-reader-text">Dismiss this notice.</span>
		</a>
	</div>

	<?php
}

function minimalist_portfolio_should_display_welcome_message() {

	$user_id = get_current_user_id();

	return ( 'closed' != get_user_meta( $user_id, 'minimalist_portfolio_welcome_message', true ) );
}

function minimalist_portfolio_close_welcome_message() {

	$user_id = get_current_user_id();

	if ( isset( $_GET['close-welcome-message'] ) && '1' == $_GET['close-welcome-message'] ) {
		add_user_meta( $user_id, 'minimalist_portfolio_welcome_message', 'closed', true );
	}
}


add_action( 'admin_notices', 'minimalist_portfolio_welcome_message' );
add_action( 'admin_init', 'minimalist_portfolio_close_welcome_message' );