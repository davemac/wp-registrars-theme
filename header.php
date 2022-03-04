<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- RSS Feed -->
	<link rel="alternate" type="application/rss+xml" title="<?php esc_html( bloginfo( 'name' ) ); ?> Feed" href="<?php echo esc_url( home_url() ); ?>/feed/">

	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/apple-touch-icon-152x152-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/apple-touch-icon-120x120-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/apple-touch-icon-76x76-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/apple-touch-icon-60x60-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/apple-touch-icon-144x144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/apple-touch-icon.png">

	<?php wp_head(); ?>

</head>

<body <?php body_class( 'antialiased' ); ?>>

<?php wp_body_open(); ?>

<header class="contain-to-grid" id="header">

	<div class="brand-strip">

		<div class="sitename">
			<a href="#content" class="skiplink hide-for-small-only">
				Skip to main content
			</a>
			<?php
			the_custom_logo();
			?>
		</div>

		<div class="holder">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'additional',
					'container'      => false,
					'depth'          => 1,
					'items_wrap'     => '<ul class="dmc-quicklinks">%3$s</ul>',
					'walker'         => new dmcstarter_walker(
						array(
							'in_top_bar' => true,
							'item_type'  => 'li',
							'menu_type'  => 'quicklinks-menu',
						)
					),
				)
			);
			require_once get_template_directory() . '/searchform.php';
			?>
		</div>

		<nav class="tab-bar show-for-small-only">
			<div class="right-small">
				<a href="#" role="button" aria-expanded="false" class="right-off-canvas-toggle menu-icon">
					<span></span>
				</a>
			</div>
		</nav>

	</div>

	<div class="mainnav">
		<nav class="top-bar hide-for-small-only" data-topbar role="navigation">
			<section class="top-bar-section">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'depth'          => 3,
						'items_wrap'     => '<ul class="main-menu">%3$s</ul>',
						'fallback_cb'    => 'dmcstarter_menu_fallback',
						'walker'         => new dmcstarter_walker(
							array(
								'in_top_bar' => true,
								'item_type'  => 'li',
								'menu_type'  => 'main-menu',
							)
						),
					)
				);
				dmc_woocommerce_show_cart_indicator();
				?>
			</section>
		</nav>
	</div>

</header>

<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">

<div class="container" role="document">
	<div class="row">
		<div class="bg">
