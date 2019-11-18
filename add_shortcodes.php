<?php
/**
 * Filename: add_shortcodes.php
 */

// Add Shortcode
function persona_shortcode( $atts ) {

    // The output
    $output = "";

    // Attributes
    $sc_persona = shortcode_atts(
        array(
            'persona' => '',
            'farbe' => '',
            'mail' => 'n',
            'telefon' => 'n',
            'rund' => 'n',
            'position' => 'j',
            'funktion' => 'n',
            'text' => 'j',
            'link' => 'n'
        ),$atts);


    if ($sc_persona['persona'] != '') {

        $output .=  '<div class="row">';

        $personas = explode(',', $sc_persona['persona']);

        foreach ($personas as $persona) {

            //check if an ID is given
            if (is_numeric($persona)) {

                //get data of ID
                $persona_data = get_post($persona);

                //check, if the data are from a persona
                if ($persona_data->post_type == 'personas') {

                    //get Metadata
                    $persona_meta = get_post_meta($persona);

                    // set value for color of card
                    switch ($sc_persona['farbe']) {
                        case 'p':
                            $persona_color = 'bg-primary';
                            break;
                        case 'd':
                            $persona_color = 'bg-dark';
                            break;
                        case 's':
                            $persona_color = 'bg-success';
                            break;
                        case 'l':
                            $persona_color = 'bg-light';
                            break;
                        case 't':
                            $persona_color = 'bg-secondary';
                            break;
                        default:
                            $persona_color = '';
                            break;
                    }


                    // set value for phone
                    switch ($sc_persona['telefon']) {
                        case 'j':

                            if($persona_meta['persona_daten_telefon'][0] != '') {
                                $persona_phone = '<span class="persona-phone"><i class="fas fa-phone d-lg-inline"></i> <a href="tel://'.preg_replace ('#\s+#' , '' , $persona_meta['persona_daten_telefon'][0]).'">'. $persona_meta['persona_daten_telefon'][0].'</a></span>';
                            } else {
                                $persona_phone = '';
                            }
                            break;

                        default:
                            $persona_phone = '';
                            break;
                    }

                    // set value for mail
                    switch ($sc_persona['mail']) {
                        case 'j':

                            if($persona_meta['persona_daten_e_mail'][0] != '') {
                                $persona_mail = '<span class="persona-phone"><i class="far fa-envelope d-lg-inline"></i> <a href="mailto:'.$persona_meta['persona_daten_e_mail'][0].'">' . $persona_meta['persona_daten_e_mail'][0].'</a></span>';
                            } else {
                                $persona_mail = '';
                            }
                            break;

                            default:
                            $persona_mail = '';
                            break;
                    }

                    // set value for image-layout
                    switch ($sc_persona['rund']) {
                        case 'j':
                            $persona_image = 'rounded-circle';
                            break;
                        default:
                            $persona_image = '';
                            break;
                    }



                    // set value for position
                    switch ($sc_persona['position']) {
                        case 'j':
                            $persona_position = get_the_term_list($persona,'personarole','',', ');
                            break;
                        case 'n':
                            $persona_position = '';
                            break;
                        default:
                            $persona_position = get_the_term_list($persona,'personarole','',', ');
                            $persona_position = preg_replace('#<a.*?>(.*?)</a>#i', '\1', $persona_position);
                            break;
                    }

                    // set value for position
                    switch ($sc_persona['funktion']) {
                        case 'j':
                            $persona_funktion = $persona_meta['persona_daten_funktion'][0];
                            break;
                        case 'n':
                            $persona_funktion = '';
                            break;
                        default:
                            $persona_funktion = $persona_meta['persona_daten_funktion'][0];
                            break;
                    }


                    // set value for position
                    switch ($sc_persona['text']) {
                        case 'j':
                            $persona_text = '<p>'.$persona_data->post_content.'</p>';
                            break;
                        case 'n':
                            $persona_text = '';
                            break;
                        default:
                            $persona_text = '<p>'.$persona_data->post_content.'</p>';
                            break;
                    }

                    // set value for position
                    switch ($sc_persona['link']) {
                        case 'j':
                            $persona_link = '<a class="btn btn-primary" type="button" href="'.get_permalink($persona_data->ID).'">Mehr zu ' . $persona_data->post_title . '</a>';
                            break;
                        case 'n':
                            $persona_link = '';
                            break;
                        default:
                            $persona_link = '';
                            break;
                    }


                    //get thumnail-image
                    $persona_thumb = get_the_post_thumbnail($persona, 'persona-thumb', array('class' => 'img-fluid ' . $persona_image));

                    if($persona_thumb == '') {

                        if( file_exists (ABSPATH.'wp-content/themes/dav/images/persona_thumb.png')) {
                        $persona_thumb = '<img src="'.get_template_directory_uri().'/images/persona_thumb.png'.'" class="img-fluid  wp-post-image" alt="" data-src="" data-alt="" width="450" height="450">';

                        } else {
                            $persona_thumb = '<img src="'.get_home_url().'/wp-content/plugins/dav-personas/img/persona_thumb.png'.'" class="img-fluid  wp-post-image" alt="" data-src="" data-alt="" width="450" height="450">';
                        }
                    }


                $output .= '
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 pt-4">
                <div class="card card-person ' . $persona_color . '">
                  <div class="row m-3 align-self-stretch">
                    <div class="col-12 col-lg-4 p-0">
                      ' . $persona_thumb . '
                    </div>
                    <div class="col-12 col-lg-8 p-0 pt-3 pt-lg-0 pl-lg-3 text-center text-lg-left">
                        <span class="person-name">' . $persona_data->post_title . '</span>
                        <span class="person-title">' . $persona_position. '</span>
                      <span class="person-title">' . $persona_funktion. '</span>
                      <hr>
                    </div>
                    </div>
                    <div class="row m-3" style="margin-top: 0 !important;">
                    <div class="col-12 p-0 p-lg-0">
                    ' . $persona_phone.
                    $persona_mail.
                    $persona_text.
                    $persona_link.'
                    </div>
                  </div>
                </div>
                </div>';

                }
            }

        }

    $output .= '</div>';
    }


    return $output;

}
add_shortcode( 'persona', 'persona_shortcode' );