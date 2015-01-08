<?php 
function peliyn_get_header( $name = null ) {

	do_action( 'get_header', $name ); // Core WordPress hook

	$templates = array();

	if ( '' !== $name ) {
		$templates[] = "blocks/header-{$name}.php";
		$templates[] = "blocks/header/{$name}.php";
	}

	$templates[] = 'blocks/header.php';
	$templates[] = 'blocks/header/header.php';

	locate_template( $templates, true );
}


function peliyn_get_menu( $name = null ) {

	$templates = array();

	if ( '' !== $name ) {
		$templates[] = "blocks/menu-{$name}.php";
		$templates[] = "blocks/menu/{$name}.php";
	}

	$templates[] = 'blocks/menu.php';
	$templates[] = 'blocks/menu/menu.php';

	locate_template( $templates, true );
}

function peliyn_get_content_template() {

	/* Set up an empty array and get the post type. */
	$templates = array();
	$post_type = get_post_type();

	/* Assume the theme developer is creating an attachment template. */
	if ( 'attachment' === $post_type ) {
		remove_filter( 'the_content', 'prepend_attachment' );

		$mime_type = get_post_mime_type();

		list( $type, $subtype ) = false !== strpos( $mime_type, '/' ) ? explode( '/', $mime_type ) : array( $mime_type, '' );

		$templates[] = "content-attachment-{$type}.php";
		$templates[] = "blocks/content/attachment-{$type}.php";
	}

	/* If the post type supports 'post-formats', get the template based on the format. */
	if ( post_type_supports( $post_type, 'post-formats' ) ) {

		/* Get the post format. */
		$post_format = get_post_format() ? get_post_format() : 'standard';

		/* Template based off post type and post format. */
		$templates[] = "content-{$post_type}-{$post_format}.php";
		$templates[] = "blocks/content/{$post_type}-{$post_format}.php";

		/* Template based off the post format. */
		$templates[] = "content-{$post_format}.php";
		$templates[] = "blocks/content/{$post_format}.php";
	}

	/* Template based off the post type. */
	$templates[] = "content-{$post_type}.php";
	$templates[] = "blocks/content/{$post_type}.php";

	/* Fallback 'content.php' template. */
	$templates[] = 'content.php';
	$templates[] = 'blocks/content/content.php';

	/* Allow devs to filter the content template hierarchy. */
	$templates = apply_filters( 'hybrid_content_template_hierarchy', $templates );

	/* Apply filters and return the found content template. */
	include( apply_filters( 'hybrid_content_template', locate_template( $templates, false, false ) ) );
}


function peliyn_get_sidebar( $name = null ) {

	do_action( 'get_sidebar', $name ); // Core WordPress hook

	$templates = array();

	if ( '' !== $name ) {
		$templates[] = "sidebar-{$name}.php";
		$templates[] = "blocks/sidebar/{$name}.php";
	}

	$templates[] = 'sidebar.php';
	$templates[] = 'blocks/sidebar/sidebar.php';

	locate_template( $templates, true );
}

function peliyn_get_footer( $name = null ) {

	do_action( 'get_footer', $name ); // Core WordPress hook

	$templates = array();

	if ( '' !== $name ) {
		$templates[] = "footer-{$name}.php";
		$templates[] = "blocks/footer/{$name}.php";
	}

	$templates[] = 'footer.php';
	$templates[] = 'blocks/footer/footer.php';

	locate_template( $templates, true );
}


add_filter( 'hybrid_attr_menu','peliyn_attr_menu', 10, 2 );
function peliyn_attr_menu( $attr, $context ) {
	$attr['class'] = 'navbar navbar-custom ';
	if(peliyn_option('opt-fixmenu')){
		$attr['class'] = 'navbar navbar-custom navbar-fixed-top';
	}
	return $attr;
}

add_filter('hybrid_site_title','peliyn_set_title');
function peliyn_set_title() {
	if ( $title = get_bloginfo( 'name' ) )
		$title = sprintf( '<div %s><a href="%s" class="navbar-brand" rel="home" >%s</a></div>', hybrid_get_attr( 'site-title' ), home_url(), $title );

	return $title;
}

function peliyn_option( $id, $fallback = false, $param = false ) {
	if ( isset( $_GET['peliyn_'.$id] ) ) {
		if ( '-1' == $_GET['peliyn_'.$id] ) {
			return false;
		} else {
			return $_GET['peliyn_'.$id];
		}
	} else {
		global $peliyn_options;
		if ( $fallback == false ) $fallback = '';
		$output = ( isset($peliyn_options[$id]) && $peliyn_options[$id] !== '' ) ? $peliyn_options[$id] : $fallback;
		if ( !empty($peliyn_options[$id]) && $param ) {
			$output = $peliyn_options[$id][$param];
		}
	}
	return $output;
}

add_action( 'wp_head', 'peliyn_favicon', 2 );
function peliyn_favicon() {
	if(peliyn_option('opt-favicon','','url')) {
		printf( '<link rel="shortcut icon" href="%s" type="image/x-icon"  />' . "\n", peliyn_option('opt-favicon','','url') );
		// echo '<link rel="favicon" href="'..'" >';
	}
}

add_filter('loop_pagination_args','peliyn_loop_pagination_args');
function peliyn_loop_pagination_args($args) {
	$args['type'] = 'list';
	$args['before'] = '<nav class="p-pag loop-pagination">';
	return $args;
}

add_filter( 'wpcf7_form_elements', 'peliyn_wpcf7_form_elements' );

function peliyn_wpcf7_form_elements( $form ) {
	$form = do_shortcode( $form );
	return $form;
}

require_once( dirname(__FILE__).'/widgets.php' );