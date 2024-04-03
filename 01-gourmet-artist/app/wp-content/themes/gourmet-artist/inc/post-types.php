<?php
add_action( 'init', 'crear_post_type_receta', 0 );

function crear_post_type_receta() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Recetas', 'Post Type General Name', 'gourmet-artist' ),
		'singular_name'       => _x( 'Receta', 'Post Type Singular Name', 'gourmet-artist' ),
		'menu_name'           => __( 'Recetas', 'gourmet-artist' ),
		'parent_item_colon'   => __( 'Receta Padre', 'gourmet-artist' ),
		'all_items'           => __( 'Todas las Recetas', 'gourmet-artist' ),
		'view_item'           => __( 'Ver Receta', 'gourmet-artist' ),
		'add_new_item'        => __( 'Agregar Nueva Receta', 'gourmet-artist' ),
		'add_new'             => __( 'Agregar Nueva Receta', 'gourmet-artist' ),
		'edit_item'           => __( 'Editar Receta', 'gourmet-artist' ),
		'update_item'         => __( 'Actualizar Receta', 'gourmet-artist' ),
		'search_items'        => __( 'Buscar Receta', 'gourmet-artist' ),
		'not_found'           => __( 'No encontrado', 'gourmet-artist' ),
		'not_found_in_trash'  => __( 'No encontrado en la papelera', 'gourmet-artist' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'recetas', 'gourmet-artist' ),
		'description'         => __( 'Receta news and reviews', 'gourmet-artist' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
    'menu_icon'           => 'dashicons-admin-page',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'recetas', $args );

}
