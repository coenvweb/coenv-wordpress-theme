<?php
/**
 * Register staff
 */
add_action( 'init', 'coenv_register_student_ambassadors' );

function coenv_register_student_ambassadors() {

	$labels = array(
		'name' => __( 'Student Ambassadors' ),
		'singular_name' => __( 'Student Ambassador' ),
		'add_new' => __( 'Add New Student Ambassador' ),
		'edit_item' => __( 'Edit Student Ambassador' ),
		'add_new_item' => __( 'New Student Ambassador' ),
		'view_item' => __( 'View Student Ambassador' ),
		'search_items' => __( 'Search Student Ambassadors' ),
		'not_found' => __( 'No Student Ambassadors found' ),
		'not_found_in_trash' => __( 'No Student Ambassadors found in Trash' )
	);

	$rewrite = array(
		'slug' => 'student-ambassadors',
		'with_front' => false
	);

	$args = array(
		'labels' => $labels,
		'menu_position' => null,
		'supports' => array('title','editor','page-attributes'),
		'public' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
		'has_archive' => false,
		'hierarchical' => false,
		'menu_icon' => 'dashicons-smiley',
		'capability_type' => 'post',
		'rewrite' => $rewrite,
        'capabilities' => array(
            'publish_posts' => 'publish_student_ambassadors',
            'delete_others_posts' => 'delete_others_student_ambassadors',
            'delete_post' => 'delete_student_ambassadors',
            'delete_posts' => 'delete_student_ambassadors',
            'delete_private_posts' => 'delete_private_student_ambassadors',
            'delete_published_posts' => 'delete_published_student_ambassadors',
            'edit_others_posts' => 'edit_others_student_ambassadors',
            'edit_post' => 'edit_student_ambassadors',
            'edit_posts' => 'edit_student_ambassadors',
            'edit_private_posts' => 'edit_private_student_ambassadors',
            'edit_published_posts' => 'edit_published_student_ambassadors',
            'read_post' => 'read_student_ambassadors',
            'read_private_posts' => 'read_private_student_ambassadors',
        ),

	);

	register_post_type( 'student_ambassadors', $args );
}



function taxonomy_student_tag() {

	$labels = array(
		'name'                       => _x( 'Student Tags', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Student Tag', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Student Tags', 'text_domain' ),
		'all_items'                  => __( 'All Student Tags', 'text_domain' ),
		'parent_item'                => __( 'Parent Student Tag', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Student Tag:', 'text_domain' ),
		'new_item_name'              => __( 'New Student Tag Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Student Tag', 'text_domain' ),
		'edit_item'                  => __( 'Edit Student Tag', 'text_domain' ),
		'update_item'                => __( 'Update Student Tag', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Student Tags with commas', 'text_domain' ),
		'search_items'               => __( 'Search Student Tags', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Student Tags', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used Student Tags', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
        
        'capabilities' => array(
			'assign_terms' => 'publish_student_ambassadors',
	        'edit_terms' => 'publish_student_ambassadors',
			'manage_terms' => 'publish_student_ambassadors',
			'delete_terms' => 'publish_student_ambassadors',
		),
	);
	register_taxonomy( 'student_tag', array( 'student_ambassadors' ), $args );

}
add_action( 'init', 'taxonomy_student_tag', 0 );