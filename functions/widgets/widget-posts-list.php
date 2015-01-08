<?php 
function peliyn_last_posts($numberOfPosts = 5 , $thumb = true){
	global $post;
	$orig_post = $post;
	
	$lastPosts = get_posts('numberposts='.$numberOfPosts);
	foreach($lastPosts as $post): setup_postdata($post);
?>
	<li class="p-li-img">
		<div class="p-img-thumb">	
		<?php if (has_post_thumbnail() && $thumb ) : ?>				
			<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'peliyn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
			<?php the_post_thumbnail(); ?></a>	    
		<?php else: ?>
		<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'peliyn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
		<?php if($thumb){
		echo '<img class="img-responsive" src="'.get_template_directory_uri().'/images/thumb.png">';}endif; ?>
		</a>
		</div>
		<div class="p-cont">
		<p><a href="<?php the_permalink(); ?>"><?php the_title();?></a></p>
		</div>
	</li>
<?php endforeach; 
	$post = $orig_post;
}

function peliyn_popular_posts($pop_posts = 5 , $thumb = true){
	global $wpdb , $post;
	$orig_post = $post;
	
	$popularposts = "SELECT ID,post_title,post_date,post_author,post_content,post_type FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY comment_count DESC LIMIT 0,".$pop_posts;
	$posts = $wpdb->get_results($popularposts);
	if($posts){
		global $post;
		foreach($posts as $post){
		setup_postdata($post);?>
		<li class="p-li-img">
			<div class="p-img-thumb">
				<?php if (has_post_thumbnail() && $thumb ) : ?>			
						<a href="<?php echo get_permalink( $post->ID ); ?>" title="<?php printf( __( 'Permalink to %s', 'peliyn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<?php the_post_thumbnail(); ?></a>
				<?php else: ?>
				<a href="<?php echo get_permalink( $post->ID ); ?>" title="<?php printf( __( 'Permalink to %s', 'peliyn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				<?php if($thumb){
				echo '<img class="img-responsive" src="'.get_template_directory_uri().'/images/thumb.png">';}endif; ?>
				</a>
			</div>
	        <div class="p-cont">
				<a href="<?php echo get_permalink( $post->ID ) ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a>
			</div>
		</li>
	<?php 
		}
	}
	$post = $orig_post;
}

function peliyn_random_posts($numberOfPosts = 5 , $thumb = true){
	global $post;
	$orig_post = $post;

	$lastPosts = get_posts('orderby=rand&numberposts='.$numberOfPosts);
	foreach($lastPosts as $post): setup_postdata($post);
?>
<li class="p-li-img">
<div class="p-img-thumb">	
	<?php if (has_post_thumbnail() && $thumb ) : ?>			
			<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'peliyn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				<?php the_post_thumbnail(); ?></a>
	<?php else: ?>
		<a href="<?php echo the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'peliyn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
		<?php 
		if($thumb){
		echo '<img class="img-responsive" src="'.get_template_directory_uri().'/images/thumb.png">';
		}
	endif; ?>
	</a>
</div>
<div class="p-cont">
	<a href="<?php echo the_permalink() ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a>
</div>
</li>
<?php endforeach;
	$post = $orig_post;

}

add_action( 'widgets_init', 'peliyn_posts_list_widget' );
function peliyn_posts_list_widget() {
	register_widget( 'peliyn_posts_list' );
}

class peliyn_posts_list extends WP_Widget {

	function peliyn_posts_list() {
		$widget_ops = array( 'classname' => 'posts-list'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'posts-list-widget' );
		$this->WP_Widget( 'posts-list-widget','Peliyn Posts list', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_posts = $instance['no_of_posts'];
		$posts_order = $instance['posts_order'];
		$thumb = $instance['thumb'];

		echo $before_widget;
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
				<ul class="peliyn-post-list">
					<?php
					if( $posts_order == 'popular' )
						peliyn_popular_posts($no_of_posts , $thumb);
						
					elseif( $posts_order == 'random' )
						peliyn_random_posts($no_of_posts , $thumb);
						
					else
						peliyn_last_posts($no_of_posts , $thumb)?>	
				</ul>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
		$instance['posts_order'] = strip_tags( $new_instance['posts_order'] );
		$instance['thumb'] = strip_tags( $new_instance['thumb'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Recent Posts' , 'peliyn') , 'no_of_posts' => '5' , 'posts_order' => 'latest', 'thumb' => 'true' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>">Number of posts to show: </label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_order' ); ?>">Posts order : </label>
			<select id="<?php echo $this->get_field_id( 'posts_order' ); ?>" name="<?php echo $this->get_field_name( 'posts_order' ); ?>" >
				<option value="latest" <?php if( $instance['posts_order'] == 'latest' ) echo "selected=\"selected\""; else echo ""; ?>>Most recent</option>
				<option value="random" <?php if( $instance['posts_order'] == 'random' ) echo "selected=\"selected\""; else echo ""; ?>>Random</option>
				<option value="popular" <?php if( $instance['posts_order'] == 'popular' ) echo "selected=\"selected\""; else echo ""; ?>>Popular</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>">Use Thumbnails : </label>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="true" <?php if( $instance['thumb'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

	<?php
	}
}
