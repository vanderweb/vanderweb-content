<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://vander.dk/
 * @since      1.0.0
 *
 * @package    Vanderweb_Content
 * @subpackage Vanderweb_Content/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.1
 * @package    Vanderweb_Content
 * @subpackage Vanderweb_Content/includes
 * @author     Ulrik Vander <ulrik@vander.dk>
 */

class Vanderweb_Accordion_Post_Types {
	////////////////////////////////////////////////////////////////////
	// Adds Custom Post Type.
	////////////////////////////////////////////////////////////////////
	public function vw_accordion_post_types() {
		$labels = array(
			'name'               => __( 'Accordions', 'vanderweb-content' ),
			'singular_name'      => __( 'Accordions', 'vanderweb-content' ),
			'menu_name'          => __( 'Accordions', 'vanderweb-content' ),
			'name_admin_bar'     => __( 'Accordions', 'vanderweb-content' ),
			'add_new'            => __( 'Add new', 'vanderweb-content' ),
			'add_new_item'       => __( 'Add new accordion item', 'vanderweb-content' ),
			'new_item'           => __( 'New accordion item', 'vanderweb-content' ),
			'edit_item'          => __( 'Edit accordion item', 'vanderweb-content' ),
			'view_item'          => __( 'Show', 'vanderweb-content' ),
			'all_items'          => __( 'Accordion items', 'vanderweb-content' ),
			'search_items'       => __( 'Search accordion item', 'vanderweb-content' ),
			'parent_item_colon'  => __( 'Parent accordion item:', 'vanderweb-content' ),
			'not_found'          => __( 'No accordion items found.', 'vanderweb-content' ),
			'not_found_in_trash' => __( 'No trashed accordion items found.', 'vanderweb-content' )
		);

		$args = array( 
			'public'      => false, 
			'labels'      => $labels,
			'has_archive' => false,
			'description' => __( 'Accordions', 'vanderweb-content' ),
			'show_ui'	        => true,
			'show_in_admin_bar' => true,
			'menu_position' => 25.2,
			'menu_icon' => 'dashicons-id',
			'taxonomies' => array( 'vanderweb_acc_section' ),
			'exclude_from_search' => true,
			'supports' => array( 'title', 'editor' )
		);
			register_post_type( 'vanderweb_accordions', $args );
	}

	////////////////////////////////////////////////////////////////////
	// Adds Custom Category.
	////////////////////////////////////////////////////////////////////
	public function create_vw_accordion_taxonomy() {
		$labels = array(
			'name'                           => __( 'Accordion - Sections', 'vanderweb-content' ),
			'singular_name'                  => __( 'Accordion - Sections', 'vanderweb-content' ),
			'search_items'                   => __( 'Search Sections', 'vanderweb-content' ),
			'all_items'                      => __( 'All Sections', 'vanderweb-content' ),
			'edit_item'                      => __( 'Edit Section', 'vanderweb-content' ),
			'update_item'                    => __( 'Update Section', 'vanderweb-content' ),
			'add_new_item'                   => __( 'Add new Section', 'vanderweb-content' ),
			'new_item_name'                  => __( 'New Section Name', 'vanderweb-content' ),
			'menu_name'                      => __( 'Sections', 'vanderweb-content' ),
			'view_item'                      => __( 'Show Section', 'vanderweb-content' ),
			'popular_items'                  => __( 'Popular Sections', 'vanderweb-content' ),
			'separate_items_with_commas'     => __( 'Seperate Sections with commas', 'vanderweb-content' ),
			'add_or_remove_items'            => __( 'Add or Remove Sections', 'vanderweb-content' ),
			'choose_from_most_used'          => __( 'Select from the most used Sections', 'vanderweb-content' ),
			'not_found'                      => __( 'No Sections found', 'vanderweb-content' )
		);
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'public' => false,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'show_tagcloud' => false,
			'show_admin_column' => true
		);
		register_taxonomy( 'vanderweb_acc_section', array( 'vanderweb_accordions' ), $args );
	}
}
?>