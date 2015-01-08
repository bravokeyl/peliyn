<?php 
add_action('peliyn_after_story','peliyn_do_callout_dishes',10);
function peliyn_do_callout_dishes() {
?>
<section id="callout-one" class="callout callout-dishes">
	<div class="container">
		<div class="row">
			<div class="col-sm-2 col-sm-offset-5 text-center long-down">
				<img src="<?php echo THEME_URI ; ?>/images/divider-top.svg" alt="">
			</div>
		</div><!-- .row -->
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<h2 class="callout-text"><?php echo peliyn_option('opt-septxtdishes');?></h2>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</section>
<?php 
} 
do_action('peliyn_after_story');
?>