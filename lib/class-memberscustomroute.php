<?php

class MembersCustomRoute {
	public $regex     = '([0-9a-zA-Z-_]+)';
	public $tag       = 'dmc_user_id';
	public $base      = 'member';
	public $templates = array( 'lib/member-directory/member-profile.php' );
	public function init() {
		add_action( 'init', array( $this, 'add_rewrites' ) );
		add_action( 'template_redirect', array( $this, 'load_template' ) );
	}

	public function add_rewrites() {
		add_rewrite_tag( "%$this->tag%", $this->regex );
		add_rewrite_rule( "^$this->base/$this->regex/?", array( $this->tag => '$matches[1]' ), 'top' );
	}

	public function load_template() {
		if ( get_query_var( $this->tag ) ) {
			locate_template( $this->templates, true );
			die();
		}
	}
}
$route = new MembersCustomRoute();
$route->init();
