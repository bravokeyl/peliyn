<?php 
add_action('peliyn_do_subscription','peliyn_do_subscription',10);
function peliyn_do_subscription() {
?>
<!-- Subscribe start -->
<section id="subscribe" class="module module-dark">
	<div class="container">

		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="module-header wow fadeInUp">
					<h2 class="module-title"><?php echo peliyn_option('opt-subh');?></h2>
					<h3 class="module-subtitle"><?php echo peliyn_option('opt-subsh');?></h3>
				</div>
			</div>
		</div><!-- .row -->

		<div class="row">

			<div class="col-sm-6 col-sm-offset-3">
				<?php 
				$mcpp = '[mc4wp_form]';
				$mcp = peliyn_option('opt-mcp',$mcpp);
				echo do_shortcode($mcp); 
				?>
			</div>

		</div><!-- .row -->

		<div class="row">
			<div class="col-md-12 text-center long-up">
				<ul class="social-links">
					<li><a href="<?php echo peliyn_option('opt-fb','#');?>" class="wow fadeInUp"><i class="fa fa-facebook"></i></a></li>
					<li><a href="<?php echo peliyn_option('opt-tw','#');?>" class="wow fadeInUp" data-wow-delay=".1s"><i class="fa fa-twitter"></i></a></li>
					<li><a href="<?php echo peliyn_option('opt-gp','#');?>" class="wow fadeInUp" data-wow-delay=".2s"><i class="fa fa-google-plus"></i></a></li>
					<li><a href="<?php echo peliyn_option('opt-ln','#');?>" class="wow fadeInUp" data-wow-delay=".3s"><i class="fa fa-linkedin"></i></a></li>
					<li><a href="<?php echo peliyn_option('opt-pin','#');?>" class="wow fadeInUp" data-wow-delay=".4s"><i class="fa fa-pinterest"></i></a></li>
					<li><a href="<?php echo peliyn_option('opt-yout','#');?>" class="wow fadeInUp" data-wow-delay=".5s"><i class="fa fa-youtube"></i></a></li>
				</ul>
			</div>
		</div><!-- .row -->

	</div><!-- .container -->
</section>
<!-- Subscribe end -->
<?php  } 
do_action('peliyn_do_subscription');
do_action('peliyn_after_subscription');
?>
