<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://vander-web.com/
 * @since      1.0.0
 *
 * @package    Vanderweb_Bs4_Accordion
 * @subpackage Vanderweb_Bs4_Accordion/includes
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
 * @package    Vanderweb_Bs4_Accordion
 * @subpackage Vanderweb_Bs4_Accordion/includes
 * @author     Ulrik Vander <ulrik@vanderweb.com>
 */

class Vanderweb_Accordion_Post_Types {
	////////////////////////////////////////////////////////////////////
	// Adds Custom Post Type.
	////////////////////////////////////////////////////////////////////
	public function vw_accordion_post_types() {
		$labels = array(
			'name'               => __( 'Accordions', 'vanderweb-bs4-accordion' ),
			'singular_name'      => __( 'Accordions', 'vanderweb-bs4-accordion' ),
			'menu_name'          => __( 'Accordions', 'vanderweb-bs4-accordion' ),
			'name_admin_bar'     => __( 'Accordions', 'vanderweb-bs4-accordion' ),
			'add_new'            => __( 'Add new', 'vanderweb-bs4-accordion' ),
			'add_new_item'       => __( 'Add new accordion item', 'vanderweb-bs4-accordion' ),
			'new_item'           => __( 'New accordion item', 'vanderweb-bs4-accordion' ),
			'edit_item'          => __( 'Edit accordion item', 'vanderweb-bs4-accordion' ),
			'view_item'          => __( 'Show', 'vanderweb-bs4-accordion' ),
			'all_items'          => __( 'Accordion items', 'vanderweb-bs4-accordion' ),
			'search_items'       => __( 'Search accordion item', 'vanderweb-bs4-accordion' ),
			'parent_item_colon'  => __( 'Parent accordion item:', 'vanderweb-bs4-accordion' ),
			'not_found'          => __( 'No accordion items found.', 'vanderweb-bs4-accordion' ),
			'not_found_in_trash' => __( 'No trashed accordion items found.', 'vanderweb-bs4-accordion' )
		);

		$args = array( 
			'public'      => false, 
			'labels'      => $labels,
			'has_archive' => false,
			'description' => __( 'Accordions', 'vanderweb-bs4-accordion' ),
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
			'name'                           => __( 'Accordion - Sections', 'vanderweb-bs4-accordion' ),
			'singular_name'                  => __( 'Accordion - Sections', 'vanderweb-bs4-accordion' ),
			'search_items'                   => __( 'Search Sections', 'vanderweb-bs4-accordion' ),
			'all_items'                      => __( 'All Sections', 'vanderweb-bs4-accordion' ),
			'edit_item'                      => __( 'Edit Section', 'vanderweb-bs4-accordion' ),
			'update_item'                    => __( 'Update Section', 'vanderweb-bs4-accordion' ),
			'add_new_item'                   => __( 'Add new Section', 'vanderweb-bs4-accordion' ),
			'new_item_name'                  => __( 'New Section Name', 'vanderweb-bs4-accordion' ),
			'menu_name'                      => __( 'Sections', 'vanderweb-bs4-accordion' ),
			'view_item'                      => __( 'Show Section', 'vanderweb-bs4-accordion' ),
			'popular_items'                  => __( 'Popular Sections', 'vanderweb-bs4-accordion' ),
			'separate_items_with_commas'     => __( 'Seperate Sections with commas', 'vanderweb-bs4-accordion' ),
			'add_or_remove_items'            => __( 'Add or Remove Sections', 'vanderweb-bs4-accordion' ),
			'choose_from_most_used'          => __( 'Select from the most used Sections', 'vanderweb-bs4-accordion' ),
			'not_found'                      => __( 'No Sections found', 'vanderweb-bs4-accordion' )
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