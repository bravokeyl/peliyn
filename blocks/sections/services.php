<?php 
add_action('peliyn_do_services','peliyn_do_services',10);
function peliyn_do_services() {
?>
<section id="services" class="module">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="module-header wow fadeInUp animated" style="visibility: visible; -webkit-animation: fadeInUp;">
					<h2 class="module-title"><?php echo peliyn_option('opt-sheadline');?></h2>
					<h3 class="module-subtitle"><?php echo peliyn_option('opt-ssubhead');?></h3>
				</div>
			</div>
		</div><!-- .row -->
		<div class="row">
			<div class="col-sm-3">
				<div class="iconbox">
					<div class="iconbox-body equal-height" style="height: 263px;">
						<div class="iconbox-icon"><span class="icon-calendar"></span></div>
						<div class="iconbox-text">
							<h3 class="iconbox-title"><?php echo peliyn_option('opt-sbox1h');?></h3>
							<div class="iconbox-desc">
								<?php echo peliyn_option('opt-sbox1');?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="iconbox">
					<div class="iconbox-body equal-height" style="height: 263px;">
						<div class="iconbox-icon"><span class="icon-directions"></span></div>
						<div class="iconbox-text">
							<h3 class="iconbox-title"><?php echo peliyn_option('opt-sbox2h');?></h3>
							<div class="iconbox-desc">
								<?php echo peliyn_option('opt-sbox2');?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="iconbox">
					<div class="iconbox-body equal-height" style="height: 263px;">
						<div class="iconbox-icon"><span class="icon-map"></span></div>
						<div class="iconbox-text">
							<h3 class="iconbox-title"><?php echo peliyn_option('opt-sbox3h');?></h3>
							<div class="iconbox-desc">
								<?php echo peliyn_option('opt-sbox3');?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="iconbox">
					<div class="iconbox-body equal-height" style="height: 263px;">
						<div class="iconbox-icon"><span class="icon-like"></span></div>
						<div class="iconbox-text">
							<h3 class="iconbox-title"><?php echo peliyn_option('opt-sbox4h');?></h3>
							<div class="iconbox-desc">
								<?php echo peliyn_option('opt-sbox4');?>
							</div>
						</div>
					</div>
				</div>
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
do_action('peliyn_do_services');
do_action('peliyn_after_services');
?>