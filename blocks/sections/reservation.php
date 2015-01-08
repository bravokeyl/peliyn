<?php 
add_action('peliyn_do_reservation','peliyn_do_reservation',10);
function peliyn_do_reservation() {
?>
<section id="reservations" class="module">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="module-header wow fadeInUp animated" style="visibility: visible; -webkit-animation: fadeInUp;">
					<h2 class="module-title"><?php echo peliyn_option('opt-resh');?></h2>
					<h3 class="module-subtitle"><?php echo peliyn_option('opt-ressh');?></h3>
				</div>
			</div>
		</div><!-- .row -->
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<?php
				$cf7 = peliyn_option('opt-cf7');
				echo do_shortcode($cf7); ?>
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
do_action('peliyn_do_reservation');
do_action('peliyn_after_reservation');
?>
