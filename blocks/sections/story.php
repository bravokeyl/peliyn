<?php 
add_action('peliyn_do_story','peliyn_do_story',10);
function peliyn_do_story() {
?>
<section id="about" class="module">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="module-header wow fadeInUp animated" style="visibility: visible; -webkit-animation: fadeInUp;">
					<h2 class="module-title"><?php echo peliyn_option('opt-storyheadline');?></h2>
					<h3 class="module-subtitle"><?php echo peliyn_option('opt-storysubhead');?></h3>
				</div>
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 text-center">
				<?php echo peliyn_option('opt-storydesc');?>
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="divider">
					<img src="<?php echo THEME_URI; ?>/images/divider-down.svg" alt="">
				</div>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</section>
<?php  } 
do_action('peliyn_do_story');
?>