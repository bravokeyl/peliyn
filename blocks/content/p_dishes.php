<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

			<div class="entry-byline">
				<?php //comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<span <?php hybrid_attr( 'entry-author' ); ?>><i class="fa fa-user">&nbsp;<?php the_author_posts_link(); ?></i></span>
			<!-- <time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time> -->
			<?php hybrid_post_terms( array( 'taxonomy' => 'dishtax', 'text' => __( '<i class="fa fa-folder-open"></i> %s ', 'peliyn' ), 'before' => ''  ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'dishtag', 'text' => __( '<i class="fa fa-tags"></i> %s', 'peliyn' ), 'before' => '' ) ); ?>
		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<?php get_the_image( array( 'size' => 'peliyn-full', 'order' => array( 'featured', 'attachment' ) ) ); ?>

		<header class="entry-header">

			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

			<div class="entry-byline">
				<!-- <span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span> -->
				<!-- <time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time> -->
				<?php //comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?>
				<?php //edit_post_link(); ?>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->