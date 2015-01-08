<?php 
	$terms = get_terms('dishtax');
	 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		 foreach ( $terms as $term ) {
		   $slug[] = $term->slug;
		 }
	}
	for($i=0;$i<sizeof($slug);$i++) {
		$slugg = $slug[$i];
	 $args = array(
				'post_type' => 'p_dishes',
				'posts_per_page' => -1,
				'tax_query' => array(
								'taxonomy' => 'dishtax',
								'terms'    => $slugg,
									),
				 );
	  $varities = new WP_Query($args);
	  if($varities->have_posts()) : ?>
	  <section id="callout-<?php echo $i; ?>" class="callout">
		<div class="container">

			<div class="row">
				<div class="col-sm-2 col-sm-offset-5 text-center long-down">
					<img src="<?php echo THEME_URI;?>/images/divider-top.svg" alt="">
				</div>
			</div><!-- .row -->

			<div class="row">
				<div class="col-sm-12">
					<h2 class="callout-text"><?php echo $slugg;?></h2>
				</div>
			</div><!-- .row -->

		</div><!-- .container -->
	</section>

	  		<!-- Callout section end -->
	<!-- Menu start -->
	<section class="module">
		<div class="container">
			<div class="row">	
	 <?php  $j=1;while($varities->have_posts()) :
  		$varities->the_post();
?>
		<div class="col-sm-4">
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
		</div> <!-- .col-sm-4 -->
		<?php if($j%3==0) { echo '<div class="clearfix"></div>';} ?>
	<!-- Menu end -->
<?php $j++ ;endwhile; wp_reset_postdata(); ?>
		</div><!-- .row -->
		</div><!-- .container -->
	</section>
<?php endif; } ?>
	</div><!-- .container -->
</section>