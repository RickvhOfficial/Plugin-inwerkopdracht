<?php
if ( !defined('ABSPATH')) exit; /* voorkomt toegang vanaf browser */

class Shortcode_ACF_Tabel {

    public function __construct() {
        add_shortcode( 'acf_tabel', [ $this, 'render' ]);
    }

    public function render( $atts ) {

        $atts = shortcode_atts([
            'post_id' => 0,
            'velden' => '',
            'layout' => 'tabel'
        ], $atts, 'acf_tabel' );

        $post_id = intval($atts['post_id']);

        if( ! $post_id || ! get_post( $post_id ) ) {
            return 'error: ongeldig post id';
        }

        $velden = explode(',', $atts['velden']); /* explode maakt een array van de velden*/

        if( empty( $velden ) ) {
            return 'error: geen velden geselecteerd';
        }

        $output = $atts['layout'] === 'tabel'
            ? '<table class="w-full border border-gray-200 text-sm">'
            : '<dl class="border border-gray-200 divide-y divide-gray-200 text-sm">';

        foreach( $velden as $veld ) {

            $veld = trim($veld);

            $field_object = get_field_object($veld, $post_id);

            if( ! $field_object ) {
                continue; /* slaat niet bestaande velden over*/
            }

            
            $label = ucfirst(str_replace('_', ' ', $veld));
            $value = $field_object['value'];
            $type = $field_object['type'];

            if( empty( $value ) ) {
                $value = '<span class="text-gray-400">Niet ingevuld</span>';
            } else {
                switch( $type ) {
                    case 'true_false':
                        $value = $value ? 'Ja' : 'Nee';
                        break;
                    case 'checkbox':
                        $value = implode(', ', (array) $value); /* implode maakt een string van de array*/
                        break;
                    case 'image':
                        $image_id = is_array($value) ? $value['ID'] : $value;
                        $value = wp_get_attachment_image($image_id, 'medium', false, ['class'=>'rounded']);
                        break;
                    default:
                        $value = esc_html($value);
                }
            }

            if ( $atts['layout'] === 'tabel' ) {
                $output .= '<tr class="border-b border-gray-200 even:bg-gray-50">';
                $output .= '<th class="text-left font-semibold text-gray-600 px-4 py-2 w-1/3">' . esc_html($label) . '</th>';
                $output .= '<td class="px-4 py-2 text-gray-800">' . $value . '</td>';
                $output .= '</tr>';
            } else {
                $output .= '<div class="flex gap-4 px-4 py-2">';
                $output .= '<dt class="font-semibold text-gray-600 w-1/3">' . esc_html($label) . '</dt>';
                $output .= '<dd class="text-gray-800">' . $value . '</dd>';
                /* dt is de description terms */
                /* dd is de description description/details */
                $output .= '</div>';
            }
        }

        $output .= $atts['layout'] === 'tabel' ? '</table>' : '</dl>';

        
        return $output;
    }
}