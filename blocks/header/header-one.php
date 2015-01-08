<header <?php hybrid_attr( 'header' ); ?>>
	<nav <?php hybrid_attr( 'menu', 'primary' ); ?> role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse">
					<span class="sr-only"><?php _e('Toggle navigation','peliyn');?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php if(peliyn_option('opt-logo','','url')) {
					$logo_src = peliyn_option('opt-logo' ,'','url');
					echo '<a href="'.esc_url( home_url() ).'" class="logo-brand" rel="home"><img src="'.$logo_src.'" alt="'.get_bloginfo('name').' Logo" style="max-height:50px;"/></a>';
				} else{
					hybrid_site_title();
				} ?>
			</div>
			<div class="collapse navbar-collapse" id="custom-collapse">
			<?php peliyn_get_menu( 'primary' ); ?>
			</div>
		</div><!-- .container -->
	</nav>
</header><!-- #header -->

