<?php 
function ecoiefy_register_cpts() {

	/**
	 * Post Type: Volunteers.
	 */
	$volunteer_labels = array(
		"name" => __( "Volunteer",            "ecoiefy-companion" ),
		"singular_name" => __( "Volunteer",   "ecoiefy-companion" ),
		"menu_name"     => __( "Volunteers",      "ecoiefy-companion" ),
		"all_items"     => __( "All volunteers",  "ecoiefy-companion" ),
		"add_new"       => __( "Add New Volunteer", "ecoiefy-companion" ),
	);

	$volunteer_args = array(
		"label"  => __( "volunteers", "ecoiefy-companion" ),
		"labels" => $volunteer_labels,
		"description" => "",
		"public"      => false,
		"publicly_queryable" => true,
		"show_ui"     => true,
		"delete_with_user" => false,
		"show_in_rest"     => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive"  => false,
		"show_in_menu" => true,
		"show_in_nav_menus"   => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		'menu_icon' => 'dashicons-businessperson',
		"rewrite"   => array( "slug" => "volunteer", "with_front" => true ),
		"query_var" => true,
		"supports"  => array( "title", "editor", "thumbnail",),
	);

	register_post_type( "volunteer", $volunteer_args );


	//Ecoifey Gallery
	$ecoiefy_gallery_labels = array(
		"name" => __( "Gallery", "ecoiefy-companion" ),
		"singular_name" => __( "Gallery", "ecoiefy-companion" ),
		"menu_name" => __( "Gallerys", "ecoiefy-companion" ),
		"all_items" => __( "All Gallerys", "ecoiefy-companion" ),
		"add_new"   => __( "Add New Gallery", "ecoiefy-companion" ),
	);

	$ecoiefy_gallery_args = array(
		"label" => __( "Ecoiefy gallerys", "ecoiefy-companion" ),
		"labels" => $ecoiefy_gallery_labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		'menu_icon' => 'dashicons-format-gallery',
		"rewrite" => array( "slug" => "egs", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "thumbnail",),
	);

	register_post_type( "egs", $ecoiefy_gallery_args );


	/**
	 * Post Type: Events.
	 */
	$volunteer_labels = array(
		"name" => __( "Events",            "ecoiefy-companion" ),
		"singular_name" => __( "Event",   "ecoiefy-companion" ),
		"menu_name"     => __( "Events",      "ecoiefy-companion" ),
		"all_items"     => __( "All Events",  "ecoiefy-companion" ),
		"add_new"       => __( "Add New Event", "ecoiefy-companion" ),
	);

	$volunteer_args = array(
		"label"  => __( "Events", "ecoiefy-companion" ),
		"labels" => $volunteer_labels,
		"description" => "",
		"public"      => false,
		"publicly_queryable" => true,
		"show_ui"     => true,
		"delete_with_user" => false,
		"show_in_rest"     => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive"  => false,
		"show_in_menu" => true,
		"show_in_nav_menus"   => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		'menu_icon' => 'dashicons-calendar-alt',
		"rewrite"   => array( "slug" => "event", "with_front" => true ),
		"query_var" => true,
		"supports"  => array( "title", "editor", "thumbnail",),
	);

	register_post_type( "event", $volunteer_args );

}
add_action( 'init', 'ecoiefy_register_cpts' );


function ecoiefy_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Photo Catgory',    'taxonomy general name', 'ecoiefy-companion' ),
		'singular_name'     => _x( 'Photo Catgory',    'taxonomy singular name', 'ecoiefy-companion' ),
		'search_items'      => __( 'Search Photo',     'ecoiefy-companion' ),
		'all_items'         => __( 'All Photos',       'ecoiefy-companion' ),
		'parent_item'       => __( 'Parent Photo',     'ecoiefy-companion' ),
		'parent_item_colon' => __( 'Parent Photo:',    'ecoiefy-companion' ),
		'edit_item'         => __( 'Edit Photo',       'ecoiefy-companion' ),
		'update_item'       => __( 'Update Photo',     'ecoiefy-companion' ),
		'add_new_item'      => __( 'Add New Photo',    'ecoiefy-companion' ),
		'new_item_name'     => __( 'New Photo Name',   'ecoiefy-companion' ),
		'menu_name'         => __( 'Photo Catgorys', 'ecoiefy-companion' ),
	);

	$args = array(
		'labels'            => $labels,
	);

	register_taxonomy( 'egs_tax', array( 'egs' ), $args );
	
}
add_action( 'init', 'ecoiefy_taxonomies', 0 );