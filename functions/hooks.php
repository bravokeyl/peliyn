<?php
add_action('peliyn_before_header' , 'peliyn_outer_wrapper_open'  , 0 );
add_action('peliyn_after_footer'  , 'peliyn_outer_wrapper_close' , 0 );

function peliyn_outer_wrapper_open() {
	//echo '<div class="container">';

}
function peliyn_outer_wrapper_close() {
	//echo '</div>';
}