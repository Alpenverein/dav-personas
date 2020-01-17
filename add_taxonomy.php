<?php


// Register Custom Taxonomy
function personarole_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Positionen', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Position', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Positionen', 'text_domain' ),
        'all_items'                  => __( 'Alle Positionen', 'text_domain' ),
        'parent_item'                => __( 'Eltern Position', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'Name der Position', 'text_domain' ),
        'add_new_item'               => __( 'Neue Position anlegen', 'text_domain' ),
        'edit_item'                  => __( 'Position bearbeiten', 'text_domain' ),
        'update_item'                => __( 'Position updaten', 'text_domain' ),
        'view_item'                  => __( 'Position anschauen', 'text_domain' ),
        'separate_items_with_commas' => __( 'Mehrere Positionen mit Komma trennen', 'text_domain' ),
        'add_or_remove_items'        => __( 'Hinzufügen oder entfernen', 'text_domain' ),
        'choose_from_most_used'      => __( 'Meistbenutzte auswählen', 'text_domain' ),
        'popular_items'              => __( 'Meistbenutzte Funktion', 'text_domain' ),
        'search_items'               => __( 'Positionen durchsuchen', 'text_domain' ),
        'not_found'                  => __( 'Nicht gefunden', 'text_domain' ),
        'no_terms'                   => __( 'Keine Positionen vorhanden', 'text_domain' ),
        'items_list'                 => __( 'Positionenliste', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => false,
        'rewrite'                    => false,
        'capabilities'               => array('assign_terms' => 'edit_personas'),
    );
    register_taxonomy( 'personarole', array( 'personas' ), $args );

}
add_action( 'init', 'personarole_taxonomy', 0 );


