<aside <?php hybrid_attr( 'sidebar', 'primary' ); ?>>
	<?php 
	if( 2 == peliyn_option('opt-layout')) {
	   $sclass = "col-md-pull-8";
	}
	else {
	  $sclass = "";
	}
	?>
	<div class="col-md-4 <?php echo $sclass;?>">
	<?php if ( is_active_sidebar( 'primary' ) ) : ?>

		<?php dynamic_sidebar( 'primary' );?>

	<?php else : ?>

		<?php the_widget(
			'WP_Widget_Text',
			array(
				'title'  => __( 'Example Widget', 'peliyn' ),
				'text'   => sprintf( __( 'This is an example widget to show how the Primary sidebar looks by default. You can add custom widgets from the %swidgets screen%s in the admin.', 'peliyn' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
				'filter' => true,
			),
			array(
				'before_widget' => '<section class="widget widget_text">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>'
			)
		); ?>

	<?php endif; // End widgets check. ?>
	</div>
</aside><!-- #sidebar-primary -->
