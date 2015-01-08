<?php
/**
 * @category Peliyn
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */
if ( file_exists(  __DIR__ . '/cmb2/init.php' ) ) {
	require_once  __DIR__ . '/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
	require_once  __DIR__ . '/CMB2/init.php';
}

add_filter( 'cmb2_meta_boxes', 'peliyn_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function peliyn_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_peliyn_';

	/*TO DO */
	// $meta_boxes['layout_meta'] = array(
	// 'id'            => 'layout_meta',
	// 'title'         => __( 'Layout', 'peliyn' ),
	// 'object_types'  => array( 'page','post' ), // Post type
	// 'context'       => 'side',
	// 'priority'      => 'low',
	// 'show_names'    => true, // Show field names on the left
	// // 'cmb_styles' => false, // false to disable the CMB stylesheet
	// 'fields'        => array(
	// 	array(
	// 			'name'    => __( '', 'peliyn' ),
	// 			'desc'    => __( 'Select required layout,if it is not set then global option is used.', 'peliyn' ),
	// 			'id'      => $prefix . 'layout_col',
	// 			'type'    => 'radio',
	// 			'options' => array(
	// 				'option1' => __( 'Full Width', 'peliyn' ),
	// 				'option2' => __( 'Right Sidebar', 'peliyn' ),
	// 				'option3' => __( 'Left Sidebar', 'peliyn' ),
	// 			),
	// 		),
	// 	)
	// );

	// $meta_boxes['catimage'] = array(
	// 'id'            => 'catimage',
	// 'title'         => __( 'Category Image', 'peliyn' ),
	// 'object_types'  => array( 'cat','post_tag' ), // Post type
	// //'context'       => 'side',
	// //'priority'      => 'low',
	// 'show_names'    => true, // Show field names on the left
	// // 'cmb_styles' => false, // false to disable the CMB stylesheet
	// 'fields'        => array(
	// 	array(
	// 			'name'    => __( '', 'peliyn' ),
	// 			'desc'    => __( 'Select required layout,if it is not set then global option is used.', 'peliyn' ),
	// 			'id'      => $prefix . 'layout_col',
	// 			'type'    => 'radio',
	// 			'options' => array(
	// 				'option1' => __( 'Full Width', 'peliyn' ),
	// 				'option2' => __( 'Right Sidebar', 'peliyn' ),
	// 				'option3' => __( 'Left Sidebar', 'peliyn' ),
	// 			),
	// 		),
	// 	)
	// );

	$meta_boxes['testimonials'] = array(
	'id'            => 'review',
	'title'         => __( 'Review', 'peliyn' ),
	'object_types'  => array( 'p_testimonials' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
	// 'cmb_styles' => false, // false to disable the CMB stylesheet
	'fields'        => array(
		array(
				'name'    => __( 'Reviewer Name', 'peliyn' ),
				'desc'    => __( '', 'peliyn' ),
				'id'      => $prefix . 'reviewer_name',
				'type'    => 'text',
			),
		array(
				'name'    => __( 'How many stars ?', 'peliyn' ),
				'desc'    => __( '', 'peliyn' ),
				'id'      => $prefix . 'star_rev',
				'type'    => 'radio_inline',
				'options' => array(
					'1' => __( '1 star', 'peliyn' ),
					'2' => __( '2 star', 'peliyn' ),
					'3' => __( '3 star', 'peliyn' ),
					'4' => __( '4 star', 'peliyn' ),
					'5' => __( '5 star', 'peliyn' ),
				),
			),
		)
	);
	$meta_boxes['item_costw'] = array(
	'id'            => 'item_cost',
	'title'         => __( 'Dish Details', 'peliyn' ),
	'object_types'  => array( 'p_dishes' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
	// 'cmb_styles' => false, // false to disable the CMB stylesheet
	'fields'        => array(
		array(
				'name'    => __( 'Item Cost', 'peliyn' ),
				'id'      => $prefix . 'dish_item_cost',
				'type'    => 'text_small',
			),
		array(
				'name'    => __( 'Item label', 'peliyn' ),
				'id'      => $prefix . 'dish_item_label',
				'type'    => 'text_small',
				'desc'    => __( ' eg:  New , Recommended , On Sale (optional)', 'peliyn' ),
			),
		)
	);
	return $meta_boxes;
}
