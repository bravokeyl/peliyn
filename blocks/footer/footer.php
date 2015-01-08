<?php peliyn_get_sidebar('footer'); ?>
<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<p class="copyright">
					<?php  if(peliyn_option('opt-copyright')) {
						echo peliyn_option('opt-copyright');
					} else{ ?>
					&copy; <?php _e('2014','peliyn');?><a href="#"> <?php _e('Peliyn','peliyn');?></a>, <?php _e('All Rights Reserved','peliyan');?>
				<?php } ?>
				</p>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</footer>