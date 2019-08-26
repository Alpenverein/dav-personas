<?php
/*
Plugin Name:  DAV Personas
Plugin URI:   https://template.alpenverein.de/index.php/faq/personas/
Description:  Dieses Plugin erzeugt den CustomPostType "Personas". In diesem sollen Mitarbeiter, Tourenleiter und andere Verantwortungsträger im Verein in die Website eingetragen werden. Es existiert eine Verbindung zu DAV-Touren. Damit ist es möglich, Touren mit Personas zu verknüpfen.
Version:      1.0.5
Author:       Deutscher Alpenverein
Author URI:   https://template.alpenverein.de/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

require 'update/plugin-update-checker.php';
$MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://template.alpenverein.de/updates/?action=get_metadata&slug=dav-personas', //Metadata URL.
    __FILE__, //Full path to the main plugin file.
    'dav-personas' //Plugin slug. Usually it's the same as the name of the directory.
);

require_once ('add_posttype.php');
require_once ('add_metabox.php');
require_once ('add_shortcodes.php');
require_once ('add_taxonomy.php');


//add new columns to persona-list
function personalist_columns( $columns ) {
    $columns["id"] = "ID";
    $columns["slug"] = "SLUG (für Persona-Box)";
    return $columns;
}
add_filter('manage_edit-personas_columns', 'personalist_columns');


//In neuer Spalte "SliderID" die SeitenID der Seite abbilden
function personalist_column_content( $column_name, $post_id ) {
    if ( $column_name == 'id'){
        echo $post_id;
    }
    if ( $column_name == 'slug'){
        echo basename(get_permalink($post_id));
    }
}
add_action('manage_personas_posts_custom_column', 'personalist_column_content', 10, 2);


//new image-size
add_image_size( 'persona-thumb', 450, 450, array( 'center', 'top' ) );
