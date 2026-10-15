<?php
/**
 * Fuego FM / KLK Radio 47 - Template Tags & Custom Helpers
 */

if (!defined('ABSPATH')) {
    exit;
}

function fuego_get_logo_height() {
    return (int) get_theme_mod('fuego_logo_height', 42);
}

function fuego_get_stream_url() {
    return get_theme_mod('fuego_stream_url', 'https://srv1.streamingradio.ar/8380/stream');
}

function fuego_get_bitrate() {
    return get_theme_mod('fuego_stream_bitrate', '128K HD');
}

function fuego_get_listeners_count() {
    return get_theme_mod('fuego_listeners_count', 'EN DIRECTO');
}

function fuego_get_cabin_title() {
    return get_theme_mod('fuego_cabin_title', 'EN CABINA PRINCIPAL');
}

function fuego_get_show_title() {
    return get_theme_mod('fuego_show_title', 'La Batidora Urbana');
}

function fuego_get_hosts_names() {
    return get_theme_mod('fuego_hosts_names', 'Miguel 47');
}

function fuego_get_hosts_time() {
    return get_theme_mod('fuego_hosts_time', '10:00 - 14:00 COT');
}

function fuego_get_hosts_tagline() {
    return get_theme_mod('fuego_hosts_tagline', 'Los reyes de la Salsa');
}

function fuego_get_hosts_ig1() {
    return get_theme_mod('fuego_hosts_ig1', '@klkradio47');
}

function fuego_get_hosts_url1() {
    $custom = get_theme_mod('fuego_hosts_url1', '');
    if (!empty($custom)) {
        return esc_url($custom);
    }
    $handle = fuego_get_hosts_ig1();
    if (empty($handle)) return '#';
    if (strpos($handle, 'http://') === 0 || strpos($handle, 'https://') === 0) {
        return esc_url($handle);
    }
    $clean = ltrim(trim($handle), '@');
    return esc_url('https://instagram.com/' . $clean);
}

function fuego_get_hosts_ig2() {
    return get_theme_mod('fuego_hosts_ig2', '@klkradio47');
}

function fuego_get_hosts_url2() {
    $custom = get_theme_mod('fuego_hosts_url2', '');
    if (!empty($custom)) {
        return esc_url($custom);
    }
    $handle = fuego_get_hosts_ig2();
    if (empty($handle)) return '#';
    if (strpos($handle, 'http://') === 0 || strpos($handle, 'https://') === 0) {
        return esc_url($handle);
    }
    $clean = ltrim(trim($handle), '@');
    return esc_url('https://instagram.com/' . $clean);
}

function fuego_get_hosts_image() {
    $custom = get_theme_mod('fuego_hosts_image', '');
    if (!empty($custom)) {
        return $custom;
    }
    if (file_exists(get_template_directory() . '/assets/images/hosts-miguel.jpg')) {
        return get_template_directory_uri() . '/assets/images/hosts-miguel.jpg';
    }
    return get_template_directory_uri() . '/assets/images/hosts-mateo-sofia.jpg';
}

function fuego_get_voicenote_text() {
    return get_theme_mod('fuego_voicenote_text', 'Grabar nota de voz (15s)');
}

function fuego_get_recent_title() {
    return get_theme_mod('fuego_recent_title', 'RECIÉN SONADAS');
}

function fuego_get_recent_tracks() {
    $cache_key = 'fuego_live_recent_tracks_v2';
    $cached = get_transient($cache_key);
    if ($cached !== false && is_array($cached) && !empty($cached)) {
        return $cached;
    }

    // Connect to live Shoutcast v2 played endpoint
    $stats_url = get_theme_mod('fuego_stats_url', 'https://srv1.streamingradio.ar:8380/stats?json=1');
    $played_url = str_replace('/stats?json=1', '/played?type=json', $stats_url);
    if (strpos($played_url, '/played') === false) {
        $played_url = 'https://srv1.streamingradio.ar:8380/played?type=json';
    }

    $response = wp_remote_get($played_url, array(
        'timeout'    => 3,
        'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) FuegoRadio/1.0',
        'sslverify'  => false,
    ));

    $recent = array();

    if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        if (is_array($data) && !empty($data)) {
            $seen = array();
            $num = 1;
            foreach ($data as $item) {
                $raw_title = isset($item['title']) ? $item['title'] : '';
                if (empty($raw_title)) continue;
                $raw_title = html_entity_decode($raw_title, ENT_QUOTES, 'UTF-8');
                $raw_title = trim(preg_replace('/[\x00-\x1F\x7F]/u', '', $raw_title));

                // Normalize for duplicate check
                $check_key = strtolower($raw_title);
                if (in_array($check_key, $seen, true)) {
                    continue;
                }
                $seen[] = $check_key;

                $parts = explode(' - ', $raw_title, 2);
                if (count($parts) === 2) {
                    $artist = trim($parts[0]);
                    $title  = trim($parts[1]);
                } else {
                    $artist = 'KLK Radio 47';
                    $title  = $raw_title;
                }

                $played_at = isset($item['playedat']) ? (int)$item['playedat'] : 0;
                $time_str = 'Ahora mismo';
                if ($played_at > 0) {
                    $diff = time() - $played_at;
                    $mins = (int) floor($diff / 60);
                    if ($mins <= 1) {
                        $time_str = __('Hace 1m', 'fuego-fm');
                    } elseif ($mins < 60) {
                        $time_str = sprintf(__('Hace %dm', 'fuego-fm'), $mins);
                    } else {
                        $hours = (int) floor($mins / 60);
                        $time_str = sprintf(__('Hace %dh', 'fuego-fm'), $hours);
                    }
                }

                $recent[] = array(
                    'num'    => $num,
                    'title'  => $title,
                    'artist' => $artist,
                    'time'   => $time_str,
                );
                $num++;
                if (count($recent) >= 3) break;
            }
        }
    }

    if (!empty($recent)) {
        set_transient($cache_key, $recent, 15); // Cache for 15 seconds
        return $recent;
    }

    // Graceful fallback if streaming server has no history yet
    return array(
        array(
            'num'    => 1,
            'title'  => get_theme_mod('fuego_recent_1_title', 'Dónde Estás?'),
            'artist' => get_theme_mod('fuego_recent_1_artist', 'Nacho Acero'),
            'time'   => get_theme_mod('fuego_recent_1_time', 'Hace 4m'),
        ),
        array(
            'num'    => 2,
            'title'  => get_theme_mod('fuego_recent_2_title', 'Algo Que Se Quede'),
            'artist' => get_theme_mod('fuego_recent_2_artist', 'Grupo Niche'),
            'time'   => get_theme_mod('fuego_recent_2_time', 'Hace 7m'),
        ),
        array(
            'num'    => 3,
            'title'  => get_theme_mod('fuego_recent_3_title', 'Corazón Guerrero'),
            'artist' => get_theme_mod('fuego_recent_3_artist', 'Maña'),
            'time'   => get_theme_mod('fuego_recent_3_time', 'Hace 11m'),
        ),
    );
}

function fuego_get_signal_text() {
    return get_theme_mod('fuego_signal_text', 'Señal Global Activa');
}

function fuego_get_signal_uptime() {
    return get_theme_mod('fuego_signal_uptime', '99.98% UPTIME');
}

function fuego_get_dials_badge() {
    return get_theme_mod('fuego_dials_badge', 'PRÓXIMOS EVENTOS & FIESTAS LATINAS');
}

function fuego_get_dials_title() {
    return get_theme_mod('fuego_dials_title', 'AGENDA DE EVENTOS & CONCIERTOS');
}

function fuego_get_dials_subtitle() {
    return get_theme_mod('fuego_dials_subtitle', 'Los festivales, noches de baile y conciertos latinos más esperados en Madrid, Bilbao, Barakaldo y Santander.');
}

function fuego_get_wall_badge() {
    return get_theme_mod('fuego_wall_badge', 'INTERACCIÓN DIRECTA');
}

function fuego_get_wall_title() {
    return get_theme_mod('fuego_wall_title', 'MURO DE OYENTES EN VIVO');
}

function fuego_get_wall_subtitle() {
    return get_theme_mod('fuego_wall_subtitle', 'Mensajes leídos al aire cada 15 minutos en cabina principal.');
}

function fuego_get_whatsapp_btn_text() {
    return get_theme_mod('fuego_whatsapp_btn_text', 'Línea Directa WhatsApp');
}

function fuego_get_wall_placeholder() {
    return get_theme_mod('fuego_wall_placeholder', 'Escribe tu saludo o pide una canción para que salga en vivo...');
}

function fuego_get_whatsapp_url() {
    $number = get_theme_mod('fuego_whatsapp_number', '+1234567890');
    $clean_number = preg_replace('/[^0-9]/', '', $number);
    $text = rawurlencode(__('¡Hola KLK Radio 47! Estoy escuchando la transmisión en vivo y quiero enviar un saludo a cabina 🔥', 'fuego-fm'));
    return 'https://wa.me/' . $clean_number . '?text=' . $text;
}

function fuego_get_app_badge() {
    return get_theme_mod('fuego_app_badge', 'APPLE CARPLAY & ANDROID AUTO READY');
}

function fuego_get_app_title() {
    return get_theme_mod('fuego_app_title', 'LLEVA EL FUEGO EN CADA KILÓMETRO');
}

function fuego_get_app_desc() {
    return get_theme_mod('fuego_app_desc', 'Descarga la App oficial. Audio espacial Hi-Res, modo offline para tus rankings preferidos y compatibilidad total con el tablero de tu auto.');
}

function fuego_get_app_store_url() {
    return get_theme_mod('fuego_app_store_url', '#');
}

function fuego_get_google_play_url() {
    return get_theme_mod('fuego_google_play_url', '#');
}

function fuego_get_ranking_badge() {
    return get_theme_mod('fuego_ranking_badge', 'VOTACIÓN EN DIRECTO');
}

function fuego_get_ranking_title() {
    return get_theme_mod('fuego_ranking_title', 'EL TERMÓMETRO LATINO');
}

function fuego_get_ranking_subtitle() {
    return get_theme_mod('fuego_ranking_subtitle', 'Top 5 más votado por la audiencia en las últimas 24 horas.');
}

function fuego_get_about_url() {
    $custom = get_theme_mod('fuego_footer_about_url', '');
    if (!empty($custom)) {
        return $custom;
    }
    $page = get_page_by_path('acerca-de-nosotros', OBJECT, 'page');
    if (!$page) {
        $page = get_page_by_title(__('Acerca de nosotros', 'fuego-fm'), OBJECT, 'page');
    }
    return $page ? get_permalink($page->ID) : home_url('/acerca-de-nosotros/');
}

function fuego_get_contact_url() {
    $custom = get_theme_mod('fuego_footer_contact_url', '');
    if (!empty($custom)) {
        return $custom;
    }
    $page = get_page_by_path('contactenos', OBJECT, 'page');
    if (!$page) {
        $page = get_page_by_path('contacto', OBJECT, 'page');
    }
    if (!$page) {
        $page = get_page_by_title(__('Contáctenos', 'fuego-fm'), OBJECT, 'page');
    }
    if (!$page) {
        $page = get_page_by_title(__('Contacto', 'fuego-fm'), OBJECT, 'page');
    }
    return $page ? get_permalink($page->ID) : home_url('/contactenos/');
}

function fuego_get_privacy_url() {
    $custom = get_theme_mod('fuego_footer_privacy_url', '');
    if (!empty($custom)) {
        return $custom;
    }
    $wp_privacy = get_privacy_policy_url();
    if (!empty($wp_privacy)) {
        return $wp_privacy;
    }
    $page = get_page_by_path('politica-de-privacidad', OBJECT, 'page');
    if (!$page) {
        $page = get_page_by_title(__('Política de privacidad', 'fuego-fm'), OBJECT, 'page');
    }
    return $page ? get_permalink($page->ID) : home_url('/politica-de-privacidad/');
}

function fuego_get_terms_url() {
    $custom = get_theme_mod('fuego_footer_terms_url', '');
    if (!empty($custom)) {
        return $custom;
    }
    $page = get_page_by_path('terminos-del-servicio', OBJECT, 'page');
    if (!$page) {
        $page = get_page_by_title(__('Términos del servicio', 'fuego-fm'), OBJECT, 'page');
    }
    return $page ? get_permalink($page->ID) : home_url('/terminos-del-servicio/');
}

function fuego_get_footer_copyright() {
    $year = date('Y');
    $default = sprintf(__('© %s KLK Radio 47 · Sabor Latino. Todos los derechos reservados.', 'fuego-fm'), $year);
    $text = get_theme_mod('fuego_footer_copyright', $default);
    return str_replace(array('{Y}', '{year}', '{YEAR}'), $year, $text);
}

function fuego_get_dj_name() {
    return fuego_get_hosts_names();
}

function fuego_get_watermark_logo() {
    $custom = get_theme_mod('fuego_player_watermark_logo', '');
    if (!empty($custom)) {
        return $custom;
    }
    if (file_exists(get_template_directory() . '/assets/images/logo.png')) {
        return get_template_directory_uri() . '/assets/images/logo.png';
    }
    return get_template_directory_uri() . '/assets/images/logo-klk.png';
}



