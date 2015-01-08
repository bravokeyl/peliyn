<?php
$peliyn_dir = trailingslashit( get_template_directory() );
require_once( $peliyn_dir . 'lib/hybrid.php' );
new Hybrid();
require_once( $peliyn_dir . 'admin/admin-init.php' );
require_once( $peliyn_dir . 'functions/peliyn.php' );
require_once( $peliyn_dir . 'functions/hooks.php' );
add_action( 'after_setup_theme', 'peliyn_theme_setup', 5 );
function peliyn_theme_setup() {
	require_once( trailingslashit( get_template_directory() ) . 'functions/setup.php' );

	/* Load stylesheets. */
	add_theme_support(
		'hybrid-core-styles',
		array(  'gallery', 'parent', 'style' )
	);

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Breadcrumbs. Yay! */
	add_theme_support( 'breadcrumb-trail' );

	/* Pagination. */
	add_theme_support( 'loop-pagination' );

	/* Nicer [gallery] shortcode implementation. */
	add_theme_support( 'cleaner-gallery' );

	/* Better captions for themes to style. */
	add_theme_support( 'cleaner-caption' );

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );
	
	/* Whistles plugin. */
	add_theme_support( 'whistles', array( 'styles' => true ) );

}
