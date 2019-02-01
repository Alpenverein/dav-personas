<?php


function persona_daten_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function persona_daten_add_meta_box() {
    add_meta_box(
        'persona_daten-persona-daten',
        __( 'Zusätzliche Daten', 'persona_daten' ),
        'persona_daten_html',
        'personas',
        'side',
        'core'
    );
}
add_action( 'add_meta_boxes', 'persona_daten_add_meta_box' );

function persona_daten_html( $post) {
    wp_nonce_field( '_persona_daten_nonce', 'persona_daten_nonce' ); ?>

    <p>Bitte Daten wie Telefon und E-Mail in die vorgesehenen Felder eintragen</p>

    <p>
        <label for="persona_daten_telefon"><?php _e( 'Telefon', 'persona_daten' ); ?></label><br>
        <input type="text" name="persona_daten_telefon" id="persona_daten_telefon" value="<?php echo persona_daten_get_meta( 'persona_daten_telefon' ); ?>">
    </p>	<p>
    <label for="persona_daten_e_mail"><?php _e( 'E-Mail', 'persona_daten' ); ?></label><br>
    <input type="text" name="persona_daten_e_mail" id="persona_daten_e_mail" value="<?php echo persona_daten_get_meta( 'persona_daten_e_mail' ); ?>">
    </p>
    <label for="persona_daten_funktion"><?php _e( 'Funktion', 'persona_daten' ); ?></label><br>
    <input type="text" name="persona_daten_funktion" id="persona_daten_funktion" value="<?php echo persona_daten_get_meta( 'persona_daten_funktion' ); ?>">
    </p><?php
}

function persona_daten_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['persona_daten_nonce'] ) || ! wp_verify_nonce( $_POST['persona_daten_nonce'], '_persona_daten_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['persona_daten_telefon'] ) )
        update_post_meta( $post_id, 'persona_daten_telefon', esc_attr( $_POST['persona_daten_telefon'] ) );
    if ( isset( $_POST['persona_daten_e_mail'] ) )
        update_post_meta( $post_id, 'persona_daten_e_mail', esc_attr( $_POST['persona_daten_e_mail'] ) );
    if ( isset( $_POST['persona_daten_funktion'] ) )
        update_post_meta( $post_id, 'persona_daten_funktion', esc_attr( $_POST['persona_daten_funktion'] ) );
}
add_action( 'save_post', 'persona_daten_save' );

/*
	Usage: persona_daten_get_meta( 'persona_daten_telefon' )
	Usage: persona_daten_get_meta( 'persona_daten_e_mail' )
*/



