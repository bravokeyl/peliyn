<?php 
add_action('peliyn_do_popular','peliyn_do_popular',10);
function peliyn_do_popular() {
?>
<section id="popular" class="module">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="module-header wow fadeInUp animated" style="visibility: visible; -webkit-animation: fadeInUp;">
					<h2 class="module-title"><?php echo peliyn_option('opt-pmenuheadline'); ?></h2>
					<h3 class="module-subtitle"><?php echo peliyn_option('opt-pmenusubhead'); ?></h3>
			</div>
		</div><!-- .row -->
		<div class="container">
				<?php 
				  $pop_dish = peliyn_option('opt-pmenucat');
				  $args = array(
								'post_type' => 'p_dishes',
								'posts_per_page' => 10,
								'post__in'       => $pop_dish
							 );
				  $dishes = new WP_Query($args);
				  if($dishes->have_posts()) :
				  $c=1;
				  while($dishes->have_posts()) :
			  		$dishes->the_post();
			  		if($c%2==1) {
			  			echo '<div class="row">';
			  		}
				?>
				<div class="col-sm-6">
				<div class="dish-menu">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="dish-menu-title"><a href="<?php echo esc_url(get_permalink(get_the_ID()));?>"><?php the_title();?></a></h4>
							<div class="dish-menu-detail">
								<?php hybrid_post_terms( array( 'taxonomy' => 'dishtag', 'text' => __( '  %s', 'peliyn' ), 'before' => '' , 'sep' => ' / ' ) ); ?>
							</div>
						</div>
						<div class="col-sm-4 dish-menu-price-detail">
							<h4 class="dish-menu-price"><?php echo get_post_meta( get_the_ID(), '_peliyn_dish_item_cost', true );?></h4>
							<?php $label = get_post_meta( get_the_ID(), '_peliyn_dish_item_label', true );
							if(isset($label) && $label!='') { ?>
							<div class="dish-menu-label"><?php echo $label;?></div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div> <!-- .col-sm-6 -->
			<?php 
			if($c%2==0) {
			  	echo '</div>';
			  }
			$c++; endwhile; wp_reset_postdata(); endif; ?>
		</div><!-- .row -->

		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 mart-60 text-center">
				<a href="<?php echo peliyn_option('opt-pmenuurl');?>" class="btn btn-custom-1"><?php printf('%s',peliyn_option('opt-pmenumore'));?></a>
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="divider">
					<img src="<?php echo THEME_URI;?>/images/divider-down.svg" alt="">
				</div>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</section>
<?php  } 
do_action('peliyn_do_popular');
do_action('peliyn_after_popular');
?>