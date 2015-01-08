<?php 
add_action('peliyn_do_dishes','peliyn_do_dishes',10);
function peliyn_do_dishes() {
?>
<section id="dishes" class="module">
		<div class="container">

			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<div class="module-header wow fadeInUp animated" style="visibility: visible; -webkit-animation: fadeInUp;">
						<h2 class="module-title"><?php echo peliyn_option('opt-dishheadline');?></h2>
						<h3 class="module-subtitle"><?php echo peliyn_option('opt-dishsubhead');?></h3>
					</div>
				</div>
			</div><!-- .row -->
		<!-- 	<div class="row"> -->
			<?php 
			  $args = array(
							'post_type' => 'p_dishes',
							'posts_per_page' => 6
						 );
			  $dishes = new WP_Query($args);
			  if($dishes->have_posts()) :
			  	//$i=1;
			  while($dishes->have_posts()) :
		  		$dishes->the_post();
			?>
				<div class="col-sm-4">
					<div class="dish-menu-classic">
						<figure class="overlay">
							<?php echo get_the_post_thumbnail();?>
							<figcaption>
								<a href="<?php echo esc_url(get_permalink());?>"></a>
								<div class="caption-inner">
									<!-- <div class="overlay-icon">
										<i class="fa fa-eye fa-lg"></i>
									</div> -->
									<div class="overlay-icon">
										<i class="fa fa-chain fa-lg"></i>
									</div>
								</div>
							</figcaption>
						</figure>
						<div class="dish-menu">
							<div class="row">
								<div class="col-sm-9">
									<h4 class="dish-menu-title"><a href="<?php echo esc_url(get_permalink(get_the_ID()));?>"><?php the_title();?></a></h4>
									<div class="dish-menu-detail">
										<?php hybrid_post_terms( array( 'taxonomy' => 'dishtag', 'text' => __( '  %s', 'peliyn' ), 'before' => '' , 'sep' => ' / ' ) ); ?>
									</div>
								</div>
								<div class="col-sm-3 dish-menu-price-detail">
									<h4 class="dish-menu-price"><?php echo get_post_meta( get_the_ID(), '_peliyn_dish_item_cost', true );?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php //if($i%3==0){ echo '</div><div class="row">';} $i++;  ?>
			<?php endwhile; wp_reset_postdata(); endif; ?>
		</div><!-- .container -->
</section>
<?php  } 
do_action('peliyn_do_dishes');
?>