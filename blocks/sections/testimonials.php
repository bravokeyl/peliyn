<?php 
add_action('peliyn_do_testimonials','peliyn_do_testimonials',10);
function peliyn_do_testimonials() {
?>
<section id="callout-three" class="callout testimonials-w">
		<div class="container">

			<div class="row">

				<div class="col-sm-10 col-sm-offset-1">
					<div class="testimonials-slider">
					<?php $args = array('post_type' => 'p_testimonials');
						  $testimonials = new WP_Query($args);
						  if($testimonials->have_posts()) :
						  	while($testimonials->have_posts()) :
						  		$testimonials->the_post();
					?>
						<!-- Slide 1 -->
						<div class="owl-item">
							<blockquote><?php the_title(); ?></blockquote>
							<div class="testimonial-author">
								<div class="row">
									<div class="col-sm-6 testimonial-avatar">
										<?php echo get_the_post_thumbnail();?>
									</div>
									<div class="col-sm-6 testimonial-info">
										<h4 class="reviewer-name"><?php echo get_post_meta( get_the_ID(), '_peliyn_reviewer_name', true );?> </h4>
										<div class="stars">
										<?php 
											$stars = get_post_meta( get_the_ID(), '_peliyn_star_rev', true );
											for($i=0;$i<$stars; $i++) {
												echo '<i class="fa fa-star"></i>';
											} 
											for($i=0;$i< 5-$stars;$i++) {
												echo '<i class="fa fa-star star-off"></i>';
											}
										?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); endif; ?>
						<!-- Slide 2 -->
						
					</div><!-- .testimonials-slider -->
				</div><!-- .col-sm-10 -->

			</div><!-- .row -->

		</div><!-- .container -->
</section>
<?php  } 
do_action('peliyn_do_testimonials');
do_action('peliyn_after_testimonials');
?>