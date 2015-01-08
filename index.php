<?php get_header(); ?>
<div class="container">
	<main <?php hybrid_attr( 'content' ); ?>>
		<?php if( 1 == peliyn_option('opt-layout')) {
				$layclass = "col-md-12";
			}
		elseif( 2 == peliyn_option('opt-layout')) {
			   $layclass = "col-md-8 col-md-push-4";
		}
		else {
			 $layclass = "col-md-8";
		}
		?>
		<div class="<?php echo $layclass;?>">
		<?php if ( !is_front_page() && !is_singular() && !is_404() ) : 
			  locate_template( array( 'blocks/loop/loop-meta.php' ), true );
	    ?>
		<?php endif; // End check for multi-post page. ?>
		<?php if ( have_posts() ) : 
				while ( have_posts() ) : 
						the_post(); 
						if ( !is_front_page() && !is_singular() && !is_404() &&  (1 == peliyn_option('opt-layout'))) {
			  				echo '<div class="col-md-6">';
						}
						peliyn_get_content_template();
						if ( !is_front_page() && !is_singular() && !is_404() && (1 == peliyn_option('opt-layout'))) {
			  				echo '</div>';
						}
						if ( is_singular() ) : 
							comments_template( '', true ); 
						endif;
			 	endwhile; ?>

		<?php locate_template( array( 'blocks/loop/loop-nav.php' ), true ); ?> 

		<?php else :  ?>

			<!-- <?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?> -->

		<?php endif; // End check for posts. ?>
		</div>
	</main><!-- #content -->
<?php 
if( 2 == peliyn_option('opt-layout')  || 3 == peliyn_option('opt-layout') ) {
peliyn_get_sidebar( 'primary' ); 
}
?>
</div>
<?php get_footer(); ?>