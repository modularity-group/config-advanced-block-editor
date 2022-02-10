<?php

remove_theme_support( 'core-block-patterns' );

add_action( 'init', 'config_block_control_patterns_post_type', 0 );
function config_block_control_patterns_post_type() {

	$labels = array(
		'name'                  => _x( 'Block-Patterns', 'Post Type General Name', 'modularity' ),
		'singular_name'         => _x( 'Block-Pattern', 'Post Type Singular Name', 'modularity' ),
		'menu_name'             => __( 'Block-Patterns', 'modularity' ),
		'name_admin_bar'        => __( 'Block-Patterns', 'modularity' ),
		'archives'              => __( 'Item Archives', 'modularity' ),
		'attributes'            => __( 'Item Attributes', 'modularity' ),
		'parent_item_colon'     => __( 'Parent Item:', 'modularity' ),
		'all_items'             => __( 'Block-Patterns', 'modularity' ),
		'add_new_item'          => __( 'Add New Item', 'modularity' ),
		'add_new'               => __( 'Add New', 'modularity' ),
		'new_item'              => __( 'New Item', 'modularity' ),
		'edit_item'             => __( 'Edit Item', 'modularity' ),
		'update_item'           => __( 'Update Item', 'modularity' ),
		'view_item'             => __( 'View Item', 'modularity' ),
		'view_items'            => __( 'View Items', 'modularity' ),
		'search_items'          => __( 'Search Item', 'modularity' ),
		'not_found'             => __( 'Not found', 'modularity' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'modularity' ),
		'featured_image'        => __( 'Featured Image', 'modularity' ),
		'set_featured_image'    => __( 'Set featured image', 'modularity' ),
		'remove_featured_image' => __( 'Remove featured image', 'modularity' ),
		'use_featured_image'    => __( 'Use as featured image', 'modularity' ),
		'insert_into_item'      => __( 'Insert into item', 'modularity' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'modularity' ),
		'items_list'            => __( 'Items list', 'modularity' ),
		'items_list_navigation' => __( 'Items list navigation', 'modularity' ),
		'filter_items_list'     => __( 'Filter items list', 'modularity' ),
	);
	$capabilities = array(
		'edit_post'             => 'edit_block_pattern',
		'read_post'             => 'read_block_pattern',
		'delete_post'           => 'delete_block_pattern',
		'edit_posts'            => 'edit_block_patterns',
		'edit_others_posts'     => 'edit_others_block_patterns',
		'publish_posts'         => 'publish_block_patterns',
		'read_private_posts'    => 'read_private_block_patterns'
	);
	$args = array(
		'label'                 => __( 'Block-Pattern', 'modularity' ),
		'description'           => __( 'Block-Patterns', 'modularity' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => 'themes.php',
		//'position'         => 1,
		'menu_icon'             => 'dashicons-editor-table',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
    'has_archive'           => false,
    //'map_meta_cap'          => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'rewrite'               => false,
		'capabilities'          => $capabilities,
		'show_in_rest'          => true,
	);
	register_post_type( 'block_pattern', $args );

}

add_action( 'admin_init', 'config_block_control_patterns_caps_init' );
function config_block_control_patterns_caps_init() {
	global $wp_roles;
  $wp_roles->add_cap( 'administrator', 'edit_block_pattern' );
  $wp_roles->add_cap( 'administrator', 'read_block_pattern' );
  $wp_roles->add_cap( 'administrator', 'delete_block_pattern' );
  $wp_roles->add_cap( 'administrator', 'edit_block_patterns' );
  $wp_roles->add_cap( 'administrator', 'edit_others_block_patterns' );
  $wp_roles->add_cap( 'administrator', 'publish_block_patterns' );
  $wp_roles->add_cap( 'administrator', 'read_private_block_patterns' );
  $wp_roles->add_cap( 'developer', 'edit_block_pattern' );
  $wp_roles->add_cap( 'developer', 'read_block_pattern' );
  $wp_roles->add_cap( 'developer', 'delete_block_pattern' );
  $wp_roles->add_cap( 'developer', 'edit_block_patterns' );
  $wp_roles->add_cap( 'developer', 'edit_others_block_patterns' );
  $wp_roles->add_cap( 'developer', 'publish_block_patterns' );
  $wp_roles->add_cap( 'developer', 'read_private_block_patterns' );
}

add_action( 'init', function() {
	if ( ! is_admin() ) return;

	register_block_pattern_category(
		'custom',
		array(
			'label' => 'Custom',
    )
	);

	$the_query = new \WP_Query( [
		'post_type'      => 'block_pattern',
		'no_found_rows'  => true,
		'posts_per_page' => -1,
	] );

	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$parts = get_post();

		register_block_pattern(
			'block_pattern/pattern-' . esc_attr( get_the_ID() ),
			array(
				'title'       => esc_html( get_the_title() ),
				'content'     => $parts->post_content,
				'categories'  => ['custom'],
      )
		);
	endwhile;
	wp_reset_postdata();
}, 20 );
