<?php
/**
 * Fuego FM - AJAX Endpoints & Handlers
 * Handles real-time song voting, shoutout submission, song requests, and likes.
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. AJAX Vote for Ranking Track
function fuego_ajax_vote_track() {
    check_ajax_referer('fuego_ajax_nonce', 'nonce');

    $track_id = isset($_POST['track_id']) ? sanitize_text_field($_POST['track_id']) : '';

    if (empty($track_id)) {
        wp_send_json_error(array('message' => 'ID de tema no especificado'));
    }

    // If it's a numeric post ID
    if (is_numeric($track_id)) {
        $current_votes = (int) get_post_meta((int)$track_id, '_fuego_track_votes', true);
        if ($current_votes <= 0) {
            $current_votes = 50000;
        }
        $new_votes = $current_votes + 1;
        update_post_meta((int)$track_id, '_fuego_track_votes', $new_votes);

        wp_send_json_success(array('new_votes' => $new_votes));
    } else {
        // Fallback for default seed items (e.g. rank-1, rank-2)
        $option_key = 'fuego_votes_' . sanitize_key($track_id);
        $current_votes = (int) get_option($option_key, 84120);
        $new_votes = $current_votes + 1;
        update_option($option_key, $new_votes);

        wp_send_json_success(array('new_votes' => $new_votes));
    }
}
add_action('wp_ajax_fuego_vote_track', 'fuego_ajax_vote_track');
add_action('wp_ajax_nopriv_fuego_vote_track', 'fuego_ajax_vote_track');

// 2. AJAX Send Listener Shoutout
function fuego_ajax_send_shoutout() {
    check_ajax_referer('fuego_ajax_nonce', 'nonce');

    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

    if (empty($message)) {
        wp_send_json_error(array('message' => 'El mensaje no puede estar vacío'));
    }

    $post_data = array(
        'post_title'   => __('Oyente en Vivo', 'fuego-fm'),
        'post_content' => $message,
        'post_status'  => 'publish',
        'post_type'    => 'fuego_shoutout',
    );

    $post_id = wp_insert_post($post_data);

    if ($post_id && !is_wp_error($post_id)) {
        update_post_meta($post_id, '_fuego_shoutout_city', __('Online Feed 🌐', 'fuego-fm'));
        update_post_meta($post_id, '_fuego_shoutout_likes', 1);

        wp_send_json_success(array(
            'post_id' => $post_id,
            'message' => __('Saludo enviado exitosamente.', 'fuego-fm'),
        ));
    } else {
        wp_send_json_error(array('message' => 'Error al guardar el saludo'));
    }
}
add_action('wp_ajax_fuego_send_shoutout', 'fuego_ajax_send_shoutout');
add_action('wp_ajax_nopriv_fuego_send_shoutout', 'fuego_ajax_send_shoutout');

// 3. AJAX Song Request
function fuego_ajax_request_song() {
    check_ajax_referer('fuego_ajax_nonce', 'nonce');

    $name    = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : __('Anónimo', 'fuego-fm');
    $artist  = isset($_POST['artist']) ? sanitize_text_field($_POST['artist']) : '';
    $song    = isset($_POST['song']) ? sanitize_text_field($_POST['song']) : '';
    $message = isset($_POST['dedication']) ? sanitize_textarea_field($_POST['dedication']) : '';
    $phone   = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';

    $title = sprintf(__('%s - %s (Pedido por %s)', 'fuego-fm'), $song, $artist, $name);
    $content = sprintf(
        "Canción: %s\nArtista: %s\nSolicitado por: %s\nTeléfono/WhatsApp: %s\nDedicatoria: %s",
        $song, $artist, $name, $phone, $message
    );

    // Save as private post or shoutout for cabin DJs to review
    $request_id = wp_insert_post(array(
        'post_title'   => $title,
        'post_content' => $content,
        'post_status'  => 'draft',
        'post_type'    => 'fuego_shoutout',
    ));

    wp_send_json_success(array(
        'request_id' => $request_id,
        'message'    => __('Tu pedido ha sido recibido en cabina.', 'fuego-fm'),
    ));
}
add_action('wp_ajax_fuego_request_song', 'fuego_ajax_request_song');
add_action('wp_ajax_nopriv_fuego_request_song', 'fuego_ajax_request_song');

// 4. AJAX Get Now Playing Song & Real-time Listeners (ShoutCast v2 & Icecast)
function fuego_ajax_get_nowplaying() {
    $stats_url = get_theme_mod('fuego_stats_url', 'https://srv1.streamingradio.ar:8380/stats?json=1');
    $cache_key = 'fuego_nowplaying_' . md5($stats_url);
    $cached = get_transient($cache_key);

    if ($cached !== false) {
        wp_send_json_success($cached);
    }

    $response = wp_remote_get($stats_url, array(
        'timeout'    => 4,
        'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) FuegoRadio/1.0',
        'sslverify'  => false,
    ));

    if (is_wp_error($response)) {
        wp_send_json_error(array('message' => $response->get_error_message()));
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!$data || !isset($data['songtitle'])) {
        wp_send_json_error(array('message' => 'No metadata found'));
    }

    $raw_title = html_entity_decode($data['songtitle'], ENT_QUOTES, 'UTF-8');
    // Normalize string
    $raw_title = trim(preg_replace('/[\x00-\x1F\x7F]/u', '', $raw_title));

    // Split "Artist - Title"
    $parts = explode(' - ', $raw_title, 2);
    if (count($parts) === 2) {
        $artist = trim($parts[0]);
        $title  = trim($parts[1]);
    } else {
        $artist = 'KLK Radio 47';
        $title  = $raw_title ?: 'Música Latina en Vivo';
    }

    $listeners = isset($data['currentlisteners']) ? (int)$data['currentlisteners'] : 0;
    $bitrate   = isset($data['bitrate']) ? $data['bitrate'] . 'K' : '128K';

    // Fetch album cover artwork from iTunes Search API
    $cover = '';
    $cover_cache_key = 'fuego_cover_' . md5($raw_title);
    $cached_cover = get_transient($cover_cache_key);

    if ($cached_cover !== false) {
        $cover = $cached_cover;
    } elseif (!empty($raw_title)) {
        $search_query = rawurlencode($artist . ' ' . $title);
        $itunes_res = wp_remote_get("https://itunes.apple.com/search?term={$search_query}&media=music&limit=1", array(
            'timeout'   => 3,
            'sslverify' => false,
        ));
        if (!is_wp_error($itunes_res)) {
            $itunes_data = json_decode(wp_remote_retrieve_body($itunes_res), true);
            if (!empty($itunes_data['results'][0]['artworkUrl100'])) {
                $cover = str_replace('100x100bb.jpg', '600x600bb.jpg', $itunes_data['results'][0]['artworkUrl100']);
                set_transient($cover_cache_key, $cover, DAY_IN_SECONDS);
            }
        }
    }

    $result = array(
        'raw_title'     => $raw_title,
        'artist'        => $artist,
        'title'         => $title,
        'listeners'     => $listeners,
        'bitrate'       => $bitrate,
        'cover'         => $cover,
        'recent_tracks' => fuego_get_recent_tracks(),
    );

    set_transient($cache_key, $result, 8); // Cache for 8 seconds
    wp_send_json_success($result);
}
add_action('wp_ajax_fuego_get_nowplaying', 'fuego_ajax_get_nowplaying');
add_action('wp_ajax_nopriv_fuego_get_nowplaying', 'fuego_ajax_get_nowplaying');

