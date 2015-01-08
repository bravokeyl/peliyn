<?php if ( is_active_sidebar( 'footer-one' )||is_active_sidebar( 'footer-two' )||is_active_sidebar( 'footer-three' )||is_active_sidebar( 'footer-four' ) ) : ?>
<aside <?php hybrid_attr( 'sidebar', 'footer' ); ?>>
	<div class="container">
		<div class="col-md-3">
		<?php if ( is_active_sidebar( 'footer-one' ) ) : ?>

			<?php dynamic_sidebar( 'footer-one' );?>

		<?php else : ?>

		<?php endif;?>
		</div>
		<div class="col-md-3">
		<?php if ( is_active_sidebar( 'footer-two' ) ) : ?>

			<?php dynamic_sidebar( 'footer-two' );?>

		<?php else : ?>

		<?php endif;?>
		</div>
		<div class="col-md-3">
		<?php if ( is_active_sidebar( 'footer-three' ) ) : ?>

			<?php dynamic_sidebar( 'footer-three' );?>

		<?php else : ?>

		<?php endif;?>
		</div>
		<div class="col-md-3">
		<?php if ( is_active_sidebar( 'footer-four' ) ) : ?>

			<?php dynamic_sidebar( 'footer-four' );?>

		<?php else : ?>

		<?php endif;?>
		</div>
	</div>
</aside>
<?php endif;?>
