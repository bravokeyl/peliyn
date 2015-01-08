<?php 
add_action('peliyn_do_slider','peliyn_do_slider',10);
function peliyn_do_slider() {
?>
<section id="home" class="intro-module module-image heightfull" style="height: 667px;">
	<div class="intro">
		<div class="intro-slider owl-carousel owl-theme" style="opacity: 1; display: block;">
		<?php 
		$stext = peliyn_option('opt-slider-text');
		$siz  = sizeof($stext);
		if($siz>0) { 
			for($ip=0;$ip<$siz;$ip++) {
			?>
			<div class="owl-item" >
				<h1 class="intro-title"><?php  if(isset($stext[$ip])) echo $stext[$ip];?></h1>
			</div>
		<?php  
			}
		} ?>
		</div><!-- .intro-slider -->
	</div><!-- .intro -->
	<a href="#about" class="wheelscroll" style='display:block;'>
	<div class="mouse-icon">
		<div class="wheel"></div>
	</div>
	</a>
</section>
<?php  } 
do_action('peliyn_do_slider');
do_action('peliyn_after_slider');
?>