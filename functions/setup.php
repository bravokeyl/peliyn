<?php

/* Register custom image sizes. */
add_action( 'init', 'peliyn_register_image_sizes', 5 );

/* Register custom menus. */
add_action( 'init', 'peliyn_register_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'peliyn_register_sidebars', 5 );

/* Add custom scripts. */
add_action( 'wp_enqueue_scripts', 'peliyn_enqueue_scripts' );

/* Register custom styles. */
add_action( 'wp_enqueue_scripts',    'peliyn_register_styles', 0 );
add_action( 'admin_enqueue_scripts', 'peliyn_admin_register_styles', 0 );

/* Excerpt-related filters. */
add_filter( 'excerpt_length', 'peliyn_excerpt_length' );

/* Modifies the theme layout. */
add_filter( 'theme_mod_theme_layout', 'peliyn_mod_theme_layout', 15 );

/* Appends comments link to status posts. */
add_filter( 'the_content', 'peliyn_status_content', 9 ); // run before wpautop()

/* Modifies the framework's infinity symbol. */
add_filter( 'hybrid_aside_infinity', 'peliyn_aside_infinity' );

/* Filters the calendar output. */
add_filter( 'get_calendar', 'peliyn_get_calendar' );

/* Filters the [audio] shortcode. */
add_filter( 'wp_audio_shortcode', 'peliyn_audio_shortcode', 10, 4 );

/* Filters the [video] shortcode. */
add_filter( 'wp_video_shortcode', 'peliyn_video_shortcode', 10, 3 );

/* Filter the [video] shortcode attributes. */
add_filter( 'shortcode_atts_video', 'peliyn_video_atts' );

function peliyn_register_image_sizes() {

	set_post_thumbnail_size( 350, 9999, false );
	add_image_size('peliyn-full', 1000 , 9999, false);
}

function peliyn_register_menus() {
	register_nav_menu( 'primary',   _x( 'Primary',   'nav menu location', 'peliyn' ) );
}

function peliyn_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => _x( 'Primary', 'sidebar', 'peliyn' ),
			'description' => __( 'The primary sidebar.', 'peliyn' )
		)
	);
	hybrid_register_sidebar(
		array(
			'id'          => 'footer-one',
			'name'        => _x( 'Footer One', 'sidebar', 'peliyn' ),
			'description' => __( '', 'peliyn' )
		)
	);
	hybrid_register_sidebar(
		array(
			'id'          => 'footer-two',
			'name'        => _x( 'Footer Two', 'sidebar', 'peliyn' ),
			'description' => __( '', 'peliyn' )
		)
	);
	hybrid_register_sidebar(
		array(
			'id'          => 'footer-three',
			'name'        => _x( 'Footer Three', 'sidebar', 'peliyn' ),
			'description' => __( '', 'peliyn' )
		)
	);
	hybrid_register_sidebar(
		array(
			'id'          => 'footer-four',
			'name'        => _x( 'Footer Four', 'sidebar', 'peliyn' ),
			'description' => __( '', 'peliyn' )
		)
	);
}

function peliyn_enqueue_scripts() {

	$suffix = hybrid_get_min_suffix();
	wp_register_script( 'p-boot', trailingslashit( get_template_directory_uri() ) . "inc/boot/js/bootstrap.min.js", array( 'jquery' ), null, true );
	wp_register_script( 'p-owl-js', trailingslashit( get_template_directory_uri() ) . "js/owl/owl-carousel.min.js", array( 'jquery' ), null, true );
	wp_register_script( 'p-sscroll', trailingslashit( get_template_directory_uri() ) . "js/smoothscroll.js", array( 'jquery' ), null, true );
	wp_register_script( 'peliyn', trailingslashit( get_template_directory_uri() ) . "js/peliyn.js", array( 'jquery' ), null, true );
	wp_register_script( 'p-mgp', trailingslashit( get_template_directory_uri() ) . "js/jquery.magnific-popup.min.js", array( 'jquery' ), null, true );
	wp_register_script( 'p-wow', trailingslashit( get_template_directory_uri() ) . "js/wow.min.js", array( 'jquery' ), null, true );

	wp_enqueue_script( 'p-boot' );
	wp_enqueue_script( 'p-sscroll' );
	//if(is_page_template('peliyn-front.php')) {
		wp_enqueue_script( 'p-owl-js' );
		wp_enqueue_script( 'p-mgp' );
		wp_enqueue_script( 'p-wow' );
	//}
	wp_enqueue_script( 'peliyn' );
}

function peliyn_register_styles() {
	wp_register_style( 'p-fonts', '//fonts.googleapis.com/css?family=Crimson+Text:400,700|Dancing+Script:400,700' );
	wp_register_style( 'p-boot-css', trailingslashit( get_template_directory_uri() ) . 'inc/boot/css/bootstrap.min.css' );
	wp_register_style( 'p-owl-theme', trailingslashit( get_template_directory_uri() ) . 'css/owl/owl-theme.css' );
	wp_register_style( 'p-owl-car', trailingslashit( get_template_directory_uri() ) . 'css/owl/owl-carousel.css' );
	wp_register_style( 'peliyn-css', trailingslashit( get_template_directory_uri() ) . 'css/peliyn.css' ,array('p-boot-css') );
	wp_register_style( 'p-fa', trailingslashit( get_template_directory_uri() ).'fonts/fa/css/font-awesome.min.css' );
	wp_register_style( 'p-mfp-css', trailingslashit( get_template_directory_uri() ).'css/magnific-popup.css' );
	wp_register_style( 'p-animate', trailingslashit( get_template_directory_uri() ).'css/animate.css' );
	
	wp_enqueue_style('p-boot-css');
	wp_enqueue_style('p-fonts');
	wp_enqueue_style('p-fa');
	wp_enqueue_style('peliyn-css');
	wp_enqueue_style('p-mfp-css');
	wp_enqueue_style('p-owl-car');
	wp_enqueue_style('p-animate');
	wp_enqueue_style('p-owl-theme');
	
	
}

function peliyn_admin_register_styles() {
	// wp_register_style( 'p-fonts', '//fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic|Open+Sans:300,400,600,700' );
	wp_register_style( 'p-admin', trailingslashit( get_template_directory_uri() ) . 'css/admin.css' );

	wp_enqueue_style('p-admin');
}

/**
 * Callback function for adding editor styles.  Use along with the add_editor_style() function.
 */
function peliyn_get_editor_styles() {

	/* Set up an array for the styles. */
	$editor_styles = array();

	/* Add the theme's editor styles. */
	$editor_styles[] = trailingslashit( get_template_directory_uri() ) . 'css/editor-style.css';

	/* If a child theme, add its editor styles. Note: WP checks whether the file exists before using it. */
	if ( is_child_theme() && file_exists( trailingslashit( get_stylesheet_directory() ) . 'css/editor-style.css' ) )
		$editor_styles[] = trailingslashit( get_stylesheet_directory_uri() ) . 'css/editor-style.css';

	/* Add the locale stylesheet. */
	$editor_styles[] = get_locale_stylesheet_uri();

	/* Uses Ajax to display custom theme styles added via the Theme Mods API. */
	$editor_styles[] = add_query_arg( 'action', 'peliyn_editor_styles', admin_url( 'admin-ajax.php' ) );

	/* Return the styles. */
	return $editor_styles;
}

function peliyn_status_content( $content ) {

	if ( !is_singular() && has_post_format( 'status' ) && in_the_loop() && ( have_comments() || comments_open() ) )
		$content .= ' <a class="comments-link" href="' . get_permalink() . '">' . number_format_i18n( get_comments_number() ) . '</a>';

	return $content;
}

function peliyn_aside_infinity( $html ) {

	if ( have_comments() || comments_open() )
		$html = ' <a class="comments-link" href="' . get_permalink() . '">' . number_format_i18n( get_comments_number() ) . '</a>';

	return $html;
}

function peliyn_excerpt_length( $length ) {
	return 30;
}

function peliyn_get_calendar( $calendar ) {
	return preg_replace( '/id=([\'"].*?[\'"])/i', 'class=$1', $calendar );
}

/**
 * Adds a featured image (if one exists) next to the audio player.  Also adds a section below the player to 
 * display the audio file information (toggled by custom JS).
 */
function peliyn_audio_shortcode( $html, $atts, $audio, $post_id ) {

	/* Don't show in the admin. */
	if ( is_admin() )
		return $html;

	/* If we have an actual attachment to work with, use the ID. */
	if ( is_object( $audio ) ) {
		$attachment_id = $audio->ID;
	}

	/* Else, get the ID via the file URL. */
	else {
		$extensions = join( '|', wp_get_audio_extensions() );

		preg_match(
			'/(src|' . $extensions . ')=[\'"](.+?)[\'"]/i', 
			preg_replace( '/(\?_=[0-9])/i', '', $html ),
			$matches
		);

		if ( !empty( $matches ) )
			$attachment_id = hybrid_get_attachment_id_from_url( $matches[2] );
	}

	/* If an attachment ID was found. */
	if ( !empty( $attachment_id ) ) {

		/* Get the attachment's featured image. */
		$image = get_the_image( 
			array( 
				'post_id'      => $attachment_id,  
				'image_class'  => 'audio-image',
				'link_to_post' => is_attachment() ? false : true, 
				'echo'         => false 
			) 
		);

		/* If there's no attachment featured image, see if there's one for the post. */
		if ( empty( $image ) && !empty( $post_id ) )
			$image = get_the_image( array( 'image_class' => 'audio-image', 'link_to_post' => false, 'echo' => false ) );

		/* Add a wrapper for the audio element and image. */
		if ( !empty( $image ) ) {
			$image = preg_replace( array( '/width=[\'"].+?[\'"]/i', '/height=[\'"].+?[\'"]/i' ), '', $image );
			$html = '<div class="audio-shortcode-wrap">' . $image . $html . '</div>';
		}

		/* If not viewing an attachment page, add the media info section. */
		if ( !is_attachment() ) {
			$html .= '<div class="media-shortcode-extend">';
			$html .= '<div class="media-info audio-info">';
			$html .= hybrid_media_meta( array( 'post_id' => $attachment_id, 'echo' => false ) );
			$html .= '</div>';
			$html .= '<button class="media-info-toggle">' . __( 'Audio Info', 'peliyn' ) . '</button>';
			$html .= '</div>';
		}
	}

	return $html;
}

/**
 * Adds a section below the player to  display the video file information (toggled by custom JS).
 */
function peliyn_video_shortcode( $html, $atts, $video ) {

	/* Don't show on single attachment pages or in the admin. */
	if ( is_attachment() || is_admin() )
		return $html;

	/* If we have an actual attachment to work with, use the ID. */
	if ( is_object( $video ) ) {
		$attachment_id = $video->ID;
	}

	/* Else, get the ID via the file URL. */
	else {
		$extensions = join( '|', wp_get_video_extensions() );

		preg_match(
			'/(src|' . $extensions . ')=[\'"](.+?)[\'"]/i', 
			preg_replace( '/(\?_=[0-9])/i', '', $html ),
			$matches
		);

		if ( !empty( $matches ) )
			$attachment_id = hybrid_get_attachment_id_from_url( $matches[2] );
	}

	/* If an attachment ID was found, add the media info section. */
	if ( !empty( $attachment_id ) ) {

		$html .= '<div class="media-shortcode-extend">';
		$html .= '<div class="media-info video-info">';
		$html .= hybrid_media_meta( array( 'post_id' => $attachment_id, 'echo' => false ) );
		$html .= '</div>';
		$html .= '<button class="media-info-toggle">' . __( 'Video Info', 'peliyn' ) . '</button>';
		$html .= '</div>';
	}

	return $html;
}

/**
 * Featured image for self-hosted videos.  Checks the video attachment for sub-attachment images.  If 
 * none exist, checks the current post (if in The Loop) for its featured image.  If an image is found, 
 * it's used as the "poster" attribute in the [video] shortcode.
 */
function peliyn_video_atts( $out ) {

	/* Don't show in the admin. */
	if ( is_admin() )
		return $out;

	/* Only run if the user didn't set a 'poster' image. */
	if ( empty( $out['poster'] ) ) {

		/* Check the 'src' attribute for an attachment file. */
		if ( !empty( $out['src'] ) )
			$attachment_id = hybrid_get_attachment_id_from_url( $out['src'] );

		/* If we couldn't get an attachment from the 'src' attribute, check other supported file extensions. */
		if ( empty( $attachment_id ) ) {

			$default_types = wp_get_video_extensions();

			foreach ( $default_types as $type ) {

				if ( !empty( $out[ $type ] ) ) {
					$attachment_id = hybrid_get_attachment_id_from_url( $out[ $type ] );

					if ( !empty( $attachment_id ) )
						break;
				}
			}
		}

		/* If there's an attachment ID at this point. */
		if ( !empty( $attachment_id ) ) {

			/* Get the attachment's featured image. */
			$image = get_the_image( 
				array( 
					'post_id'      => $attachment_id, 
					'size'         => 'full',
					'format'       => 'array',
					'echo'         => false
				) 
			);
		}

		/* If no image has been found and we're in the post loop, see if the current post has a featured image. */
		if ( empty( $image ) && get_post() )
			$image = get_the_image( array( 'size' => 'full', 'format' => 'array', 'echo' => false ) );

		/* Set the 'poster' attribute if we have an image at this point. */
		if ( !empty( $image ) )
			$out['poster'] = $image['src'];
	}

	return $out;
}
