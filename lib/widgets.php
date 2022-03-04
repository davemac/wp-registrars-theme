<?php

add_action( 'widgets_init', 'dmc_register_sidebars' );
function dmc_register_sidebars() {

	register_sidebar(
		array(
			'name'          => 'Homepage sidebar',
			'id'            => 'sidebar-home',
			'description'   => 'Widgets placed here will appear on the homepage',
			'before_widget' => '<article id="%1$s" class="panel widget %2$s">',
			'after_widget'  => '</article>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'About sidebar',
			'id'            => 'sidebar-about',
			'description'   => 'Widgets placed here will appear in the sidebar on the About page',
			'before_widget' => '<article id="%1$s" class="panel widget %2$s">',
			'after_widget'  => '</article>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Events sidebar',
			'id'            => 'sidebar-events',
			'description'   => 'Widgets placed here will appear in the sidebar on Events pages',
			'before_widget' => '<section id="%1$s" class="panel widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'News sidebar',
			'id'            => 'sidebar-news',
			'description'   => 'Widgets placed here will appear in the sidebar on News pages',
			'before_widget' => '<section id="%1$s" class="panel widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Contact sidebar',
			'id'            => 'sidebar-contact',
			'description'   => 'Widgets placed here will appear in the sidebar on the Contact page',
			'before_widget' => '<article id="%1$s" class="panel widget %2$s">',
			'after_widget'  => '</article>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Footer widgets',
			'id'            => 'sidebar-footer',
			'description'   => 'Widgets placed here will appear in the footer area',
			'before_widget' => '<article id="%1$s" class="panel widget %2$s">',
			'after_widget'  => '</article>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

}
