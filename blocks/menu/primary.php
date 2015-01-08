<?php if ( has_nav_menu( 'primary' ) ) :  ?>
	<?php wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'container'       => '',
			'container_class' => '',
			'menu_id'         => 'menu-primary-items',
			'menu_class'      => 'nav navbar-nav navbar-right',
			'fallback_cb'     => ''
		)
	); ?>
<?php endif; // End check for menu. ?>
