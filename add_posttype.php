<?php



// Register Custom Post Type
function cpt_personas() {

    $labels = array(
        'name'                  => _x( 'Personas', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Persona', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Personas', 'text_domain' ),
        'name_admin_bar'        => __( 'Personas', 'text_domain' ),
        'archives'              => __( 'Persona Archiv', 'text_domain' ),
        'attributes'            => __( 'Persona Eigenschaften', 'text_domain' ),
        'parent_item_colon'     => __( 'Eltern-Persona', 'text_domain' ),
        'all_items'             => __( 'Alle Personas', 'text_domain' ),
        'add_new_item'          => __( 'Neue Persona anlegen', 'text_domain' ),
        'add_new'               => __( 'Neu anlegen', 'text_domain' ),
        'new_item'              => __( 'Neue Persona', 'text_domain' ),
        'edit_item'             => __( 'Persona bearbeiten', 'text_domain' ),
        'update_item'           => __( 'Persona aktualisieren', 'text_domain' ),
        'view_item'             => __( 'Persona ansehen', 'text_domain' ),
        'view_items'            => __( 'Personas ansehen', 'text_domain' ),
        'search_items'          => __( 'Persona suchen', 'text_domain' ),
        'not_found'             => __( 'Nicht gefunden', 'text_domain' ),
        'not_found_in_trash'    => __( 'Im Papierkorb nicht gefunden', 'text_domain' ),
        'featured_image'        => __( 'Personafoto', 'text_domain' ),
        'set_featured_image'    => __( 'Personafoto festlegen', 'text_domain' ),
        'remove_featured_image' => __( 'Personafoto entfernen', 'text_domain' ),
        'use_featured_image'    => __( 'Als Personafoto verwenden', 'text_domain' ),
        'insert_into_item'      => __( 'In Persona einsetzen', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Zu Persona hochladen', 'text_domain' ),
        'items_list'            => __( 'Persona Liste', 'text_domain' ),
        'items_list_navigation' => __( 'Persona List Navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Personas filtern', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                  => 'personas',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Persona', 'text_domain' ),
        'description'           => __( 'Dieser CPT soll die Personen der Sektion erfassen.', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail'),
        'taxonomies'            => array( 'personarole' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-admin-users',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'show_in_rest'          => false,
    );
    register_post_type( 'personas', $args );

}
add_action( 'init', 'cpt_personas', 0 );