<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>
<head>
<?php wp_head();//Le'me in ?>	
</head>
<body <?php hybrid_attr( 'body' ); ?> data-spy="scroll" data-target="#header" >
	<div id="totop"></div>
<?php 
	do_action('peliyn_before_header');
	peliyn_get_header('header-one'); 
?>
