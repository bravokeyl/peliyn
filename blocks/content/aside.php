<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

			<div class="entry-byline">
				<?php hybrid_post_format_link(); ?>
				<?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?>
				<?php if ( function_exists( 'ev_post_views' ) ) ev_post_views( array( 'text' => '%s' ) ); ?>
				<?php edit_post_link(); ?>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
			<!-- <time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time> -->
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => __( 'Posted in %s', 'peliyn' ) ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => __( 'Tagged %s', 'peliyn' ), 'before' => '<br />' ) ); ?>
		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
		</div><!-- .entry-content -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->