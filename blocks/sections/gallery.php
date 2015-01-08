<?php 
add_action('peliyn_do_gallery','peliyn_do_gallery',10);
function peliyn_do_gallery() {
?>
<!-- Gallery start -->
<section id="gallery">
	<div class="row position-relative margin-0">
		<div class="col-xs-12 col-md-4 side-image">
			<div class="vertical-body">
				<div class="vertical">
					<div class="module-header wow fadeInUp">
						<h2 class="module-title"><?php echo peliyn_option('opt-gheadline'); ?></h2>
						<h3 class="module-subtitle"><?php echo peliyn_option('opt-gsubhead'); ?></h3>
					</div>
					<div class="desc-gal">
						<p><?php echo peliyn_option('opt-gdesc'); ?></p>
					</div>
					<a href="<?php echo peliyn_option('opt-gurl');?>" class="btn btn-custom-1"><?php printf('%s',peliyn_option('opt-gmore'));?></a>
				</div>
			</div>
		</div>
	<div class="col-xs-12 col-md-8 col-md-offset-4 gallery-no-padding">
		<div class="row">
			<?php 
				$gal_id = peliyn_option('opt-gallery'); 
				$gal_arr = explode(',',$gal_id);
				for($i=0;$i<sizeof($gal_arr);$i++) {
					$gals = $gal_arr[$i];
				$img_full_src = wp_get_attachment_image_src( $gals , 'full')[0];
				$img_thumb_src = wp_get_attachment_image_src( $gals,'post_thumbnail')[0];
				$img_title= wp_prepare_attachment_for_js($gals)['title'];
				$img_alt= wp_prepare_attachment_for_js($gals)['alt'];
			 ?>
			<div class="col-sm-4">
				<div class="gallery-item">
					<figure class="overlay">
						<img src="<?php echo $img_thumb_src;?>" alt="<?php echo $img_alt;?>">
						<figcaption>
							<a href="<?php echo $img_full_src;?>" class="gallery" title="<?php echo $img_title;?>"></a>
							<div class="caption-inner">
								<div class="overlay-icon">
									<i class="fa fa-eye fa-lg"></i>
								</div>
							</div>
						</figcaption>
					</figure>
				</div>
			</div>
		<?php } ?>
		</div><!-- .row -->
		</div><!-- .gallery-no-padding -->
	</div><!-- .row -->
</section>
<!-- Gallery end -->
<?php  } 
do_action('peliyn_do_gallery');
do_action('peliyn_after_gallery');
?>