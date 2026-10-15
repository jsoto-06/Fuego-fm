<?php
/**
 * Fuego FM / KLK Radio 47 - Custom Post Types & Interactive Meta Boxes
 * Allows full admin management of Dials/Sections/Events, Shows, Ranking, and Shoutouts.
 */

if (!defined('ABSPATH')) {
    exit;
}

function fuego_register_post_types() {
    // 1. Diales, Secciones y Eventos
    register_post_type('fuego_dial', array(
        'labels' => array(
            'name'               => __('Eventos & Diales', 'fuego-fm'),
            'singular_name'      => __('Evento / Dial', 'fuego-fm'),
            'add_new'            => __('Añadir Nuevo Evento', 'fuego-fm'),
            'add_new_item'       => __('Añadir Nuevo Evento o Dial', 'fuego-fm'),
            'edit_item'          => __('Editar Evento', 'fuego-fm'),
            'new_item'           => __('Nuevo Evento', 'fuego-fm'),
            'view_item'          => __('Ver Evento', 'fuego-fm'),
            'search_items'       => __('Buscar Eventos/Diales', 'fuego-fm'),
            'not_found'          => __('No se encontraron eventos ni diales', 'fuego-fm'),
            'menu_name'          => __('Eventos & Diales', 'fuego-fm'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-tickets-alt',
        'supports'     => array('title', 'editor', 'thumbnail'),
        'rewrite'      => array('slug' => 'eventos-diales'),
    ));

    // Dial Genre / Category Taxonomy
    register_taxonomy('fuego_genre', 'fuego_dial', array(
        'labels' => array(
            'name'          => __('Categorías y Filtros', 'fuego-fm'),
            'singular_name' => __('Categoría', 'fuego-fm'),
            'search_items'  => __('Buscar Categorías', 'fuego-fm'),
            'all_items'     => __('Todas las Categorías', 'fuego-fm'),
            'edit_item'     => __('Editar Categoría', 'fuego-fm'),
            'add_new_item'  => __('Añadir Nueva Categoría', 'fuego-fm'),
            'menu_name'     => __('Categorías de Eventos', 'fuego-fm'),
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => array('slug' => 'categoria-evento'),
    ));

    // 2. Ranking Musical (El Termómetro Latino)
    register_post_type('fuego_ranking', array(
        'labels' => array(
            'name'          => __('Ranking Latino', 'fuego-fm'),
            'singular_name' => __('Canción en Ranking', 'fuego-fm'),
            'add_new'       => __('Añadir Canción al Ranking', 'fuego-fm'),
            'add_new_item'  => __('Añadir Nueva Canción al Ranking', 'fuego-fm'),
            'edit_item'     => __('Editar Canción', 'fuego-fm'),
            'menu_name'     => __('El Termómetro', 'fuego-fm'),
        ),
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-chart-bar',
        'supports'     => array('title', 'thumbnail'),
    ));

    // 3. Parrilla de Programación (Shows)
    register_post_type('fuego_show', array(
        'labels' => array(
            'name'          => __('Programación', 'fuego-fm'),
            'singular_name' => __('Programa', 'fuego-fm'),
            'add_new'       => __('Añadir Programa', 'fuego-fm'),
            'add_new_item'  => __('Añadir Nuevo Programa', 'fuego-fm'),
            'edit_item'     => __('Editar Programa', 'fuego-fm'),
            'menu_name'     => __('Programas', 'fuego-fm'),
        ),
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-clock',
        'supports'     => array('title', 'editor', 'thumbnail'),
    ));

    // 4. Muro de Oyentes (Shoutouts)
    register_post_type('fuego_shoutout', array(
        'labels' => array(
            'name'          => __('Muro de Oyentes', 'fuego-fm'),
            'singular_name' => __('Saludo / Saludo de Oyente', 'fuego-fm'),
            'add_new'       => __('Añadir Saludo', 'fuego-fm'),
            'add_new_item'  => __('Añadir Nuevo Saludo', 'fuego-fm'),
            'edit_item'     => __('Editar Saludo', 'fuego-fm'),
            'menu_name'     => __('Muro Oyentes', 'fuego-fm'),
        ),
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-testimonial',
        'supports'     => array('title', 'editor'),
    ));
}
add_action('init', 'fuego_register_post_types');


/* ==========================================================================
   META BOXES: CAMPOS PERSONALIZADOS VISIBLES EN PANEL DE WORDPRESS
   ========================================================================== */

function fuego_add_custom_meta_boxes() {
    // Meta box para Diales, Secciones y Eventos
    add_meta_box(
        'fuego_dial_details_box',
        __('Configuración del Evento o Dial', 'fuego-fm'),
        'fuego_dial_details_html',
        'fuego_dial',
        'normal',
        'high'
    );

    // Meta box para Ranking
    add_meta_box(
        'fuego_ranking_details_box',
        __('Datos del Tema en Ranking', 'fuego-fm'),
        'fuego_ranking_details_html',
        'fuego_ranking',
        'normal',
        'high'
    );

    // Meta box para Shows
    add_meta_box(
        'fuego_show_details_box',
        __('Horario y Estado del Programa', 'fuego-fm'),
        'fuego_show_details_html',
        'fuego_show',
        'normal',
        'high'
    );

    // Meta box para Saludos del Muro de Oyentes
    add_meta_box(
        'fuego_shoutout_details_box',
        __('Detalles del Saludo en Vivo', 'fuego-fm'),
        'fuego_shoutout_details_html',
        'fuego_shoutout',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'fuego_add_custom_meta_boxes');

// Enqueue WordPress Media Uploader for Events
function fuego_admin_media_scripts($hook) {
    global $post_type;
    if ($post_type === 'fuego_dial') {
        wp_enqueue_media();
        wp_enqueue_script('fuego-admin-media', get_template_directory_uri() . '/assets/js/admin-media.js', array('jquery'), '1.0.1', true);
    }
}
add_action('admin_enqueue_scripts', 'fuego_admin_media_scripts');

// 1. HTML Meta box Diales & Eventos
function fuego_dial_details_html($post) {
    wp_nonce_field('fuego_save_dial_details', 'fuego_dial_nonce');

    $tag        = get_post_meta($post->ID, '_fuego_dial_number', true);
    $genre      = get_post_meta($post->ID, '_fuego_dial_genre', true);
    $dj         = get_post_meta($post->ID, '_fuego_dial_dj', true);
    $listeners  = get_post_meta($post->ID, '_fuego_dial_listeners', true);
    $image_url  = get_post_meta($post->ID, '_fuego_dial_image', true);
    $btn_text   = get_post_meta($post->ID, '_fuego_dial_btn_text', true) ?: '🎟️ Ver Evento';
    $stream_url = get_post_meta($post->ID, '_fuego_dial_stream_url', true);
    ?>
    <table class="form-table">
        <tr>
            <th scope="row"><label for="fuego_dial_tag"><?php _e('Etiqueta / Badge Superior', 'fuego-fm'); ?></label></th>
            <td>
                <input type="text" id="fuego_dial_tag" name="fuego_dial_tag" value="<?php echo esc_attr($tag); ?>" class="regular-text" placeholder="Ej: REGUETÓN · BARAKALDO o SALSA · BILBAO" />
                <p class="description"><?php _e('Texto que sale en la pastilla de color arriba a la izquierda del evento.', 'fuego-fm'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="fuego_dial_genre"><?php _e('Fecha y Ciudad / Subtítulo', 'fuego-fm'); ?></label></th>
            <td>
                <input type="text" id="fuego_dial_genre" name="fuego_dial_genre" value="<?php echo esc_attr($genre); ?>" class="large-text" placeholder="Ej: 📅 14 de noviembre de 2026 · 📍 Barakaldo" />
                <p class="description"><?php _e('Fecha del evento y ciudad o subtítulo principal.', 'fuego-fm'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="fuego_dial_dj"><?php _e('Lugar / Sala del Evento', 'fuego-fm'); ?></label></th>
            <td>
                <input type="text" id="fuego_dial_dj" name="fuego_dial_dj" value="<?php echo esc_attr($dj); ?>" class="regular-text" placeholder="Ej: Urban Beat Club — Barakaldo" />
                <p class="description"><?php _e('Nombre de la sala, discoteca, recinto o DJ anfitrión.', 'fuego-fm'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="fuego_dial_listeners"><?php _e('Horario del Evento', 'fuego-fm'); ?></label></th>
            <td>
                <input type="text" id="fuego_dial_listeners" name="fuego_dial_listeners" value="<?php echo esc_attr($listeners); ?>" class="regular-text" placeholder="Ej: 23:00 h – 05:00 h" />
                <p class="description"><?php _e('Horas del evento o duración de la fiesta.', 'fuego-fm'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="fuego_dial_image"><?php _e('Imagen del Cartel / Evento', 'fuego-fm'); ?></label></th>
            <td>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                    <input type="text" id="fuego_dial_image" name="fuego_dial_image" value="<?php echo esc_url($image_url); ?>" class="large-text" placeholder="https://..." style="max-width: 480px;" />
                    <button type="button" class="button button-secondary" id="fuego_dial_image_btn"><?php _e('Subir / Elegir Imagen', 'fuego-fm'); ?></button>
                    <button type="button" class="button" id="fuego_dial_image_remove" style="<?php echo empty($image_url) ? 'display:none;' : ''; ?>"><?php _e('Quitar', 'fuego-fm'); ?></button>
                </div>
                <div id="fuego_dial_image_preview">
                    <?php if (!empty($image_url)) : ?>
                        <img src="<?php echo esc_url($image_url); ?>" style="max-width:240px;height:auto;border-radius:10px;box-shadow:0 3px 10px rgba(0,0,0,0.15);display:block;margin-top:6px;" />
                    <?php endif; ?>
                </div>
                <p class="description"><?php _e('Sube o selecciona la imagen/cartel del evento. También puedes usar la "Imagen destacada" estándar.', 'fuego-fm'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="fuego_dial_btn_text"><?php _e('Texto del Botón', 'fuego-fm'); ?></label></th>
            <td>
                <input type="text" id="fuego_dial_btn_text" name="fuego_dial_btn_text" value="<?php echo esc_attr($btn_text); ?>" class="regular-text" placeholder="Ej: 🎟️ Ver Evento" />
                <p class="description"><?php _e('Texto que muestra el botón de la tarjeta (por defecto: 🎟️ Ver Evento).', 'fuego-fm'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="fuego_dial_stream_url"><?php _e('Enlace Web de Entradas o Streaming', 'fuego-fm'); ?></label></th>
            <td>
                <input type="url" id="fuego_dial_stream_url" name="fuego_dial_stream_url" value="<?php echo esc_url($stream_url); ?>" class="large-text" placeholder="https://entradas.com/evento... o enlace a WhatsApp" />
                <p class="description"><?php _e('Opcional. Enlace directo para compra de entradas externas o streaming de radio.', 'fuego-fm'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

// 2. HTML Meta box Ranking
function fuego_ranking_details_html($post) {
    wp_nonce_field('fuego_save_ranking_details', 'fuego_ranking_nonce');

    $artist = get_post_meta($post->ID, '_fuego_track_artist', true) ?: '';
    $rank   = get_post_meta($post->ID, '_fuego_track_rank', true) ?: '1';
    $trend  = get_post_meta($post->ID, '_fuego_track_trend', true) ?: '= 0';
    $votes  = get_post_meta($post->ID, '_fuego_track_votes', true) ?: '50000';
    ?>
    <table class="form-table">
        <tr>
            <th scope="row"><label for="fuego_track_artist"><?php _e('Artista(s)', 'fuego-fm'); ?></label></th>
            <td><input type="text" id="fuego_track_artist" name="fuego_track_artist" value="<?php echo esc_attr($artist); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th scope="row"><label for="fuego_track_rank"><?php _e('Posición (Rango 1 a 5)', 'fuego-fm'); ?></label></th>
            <td><input type="number" id="fuego_track_rank" name="fuego_track_rank" value="<?php echo esc_attr($rank); ?>" min="1" max="50" /></td>
        </tr>
        <tr>
            <th scope="row"><label for="fuego_track_trend"><?php _e('Tendencia de Posición', 'fuego-fm'); ?></label></th>
            <td>
                <input type="text" id="fuego_track_trend" name="fuego_track_trend" value="<?php echo esc_attr($trend); ?>" class="small-text" />
                <p class="description"><?php _e('Ejemplos: ↑ 2, = 0, NEW, ↓ 1', 'fuego-fm'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="fuego_track_votes"><?php _e('Votos Iniciales', 'fuego-fm'); ?></label></th>
            <td><input type="number" id="fuego_track_votes" name="fuego_track_votes" value="<?php echo esc_attr($votes); ?>" class="regular-text" /></td>
        </tr>
    </table>
    <?php
}

// 3. HTML Meta box Shows
function fuego_show_details_html($post) {
    wp_nonce_field('fuego_save_show_details', 'fuego_show_nonce');

    $time   = get_post_meta($post->ID, '_fuego_show_time', true) ?: '10:00 - 14:00';
    $host   = get_post_meta($post->ID, '_fuego_show_host', true) ?: '';
    $active = get_post_meta($post->ID, '_fuego_show_active', true);
    ?>
    <table class="form-table">
        <tr>
            <th scope="row"><label for="fuego_show_time"><?php _e('Franja Horaria', 'fuego-fm'); ?></label></th>
            <td><input type="text" id="fuego_show_time" name="fuego_show_time" value="<?php echo esc_attr($time); ?>" class="regular-text" placeholder="10:00 - 14:00 COT" /></td>
        </tr>
        <tr>
            <th scope="row"><label for="fuego_show_host"><?php _e('Locutor / Presentador', 'fuego-fm'); ?></label></th>
            <td><input type="text" id="fuego_show_host" name="fuego_show_host" value="<?php echo esc_attr($host); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th scope="row"><?php _e('¿Al Aire Ahora?', 'fuego-fm'); ?></th>
            <td>
                <label>
                    <input type="checkbox" name="fuego_show_active" value="1" <?php checked($active, '1'); ?> />
                    <?php _e('Marcar este programa como el que está transmitiendo en vivo actualmente.', 'fuego-fm'); ?>
                </label>
            </td>
        </tr>
    </table>
    <?php
}

// 4. HTML Meta box Saludos de Oyentes
function fuego_shoutout_details_html($post) {
    wp_nonce_field('fuego_save_shoutout_details', 'fuego_shoutout_nonce');

    $city  = get_post_meta($post->ID, '_fuego_shoutout_city', true) ?: 'Medellín, COL 🇨🇴';
    $likes = get_post_meta($post->ID, '_fuego_shoutout_likes', true) ?: '42';
    ?>
    <table class="form-table">
        <tr>
            <th scope="row"><label for="fuego_shoutout_city"><?php _e('Ciudad / Ubicación / País', 'fuego-fm'); ?></label></th>
            <td>
                <input type="text" id="fuego_shoutout_city" name="fuego_shoutout_city" value="<?php echo esc_attr($city); ?>" class="regular-text" />
                <p class="description"><?php _e('Ejemplo: Medellín, COL 🇨🇴 o Miami, USA 🇺🇸 o Madrid, ESP 🇪🇸', 'fuego-fm'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="fuego_shoutout_likes"><?php _e('Número de Likes / Favoritos', 'fuego-fm'); ?></label></th>
            <td>
                <input type="number" id="fuego_shoutout_likes" name="fuego_shoutout_likes" value="<?php echo esc_attr($likes); ?>" min="0" class="small-text" />
            </td>
        </tr>
    </table>
    <?php
}

// Guardar datos de los Meta boxes
function fuego_save_custom_meta_boxes($post_id) {
    // 1. Guardar Dial
    if (isset($_POST['fuego_dial_nonce']) && wp_verify_nonce($_POST['fuego_dial_nonce'], 'fuego_save_dial_details')) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (isset($_POST['fuego_dial_tag'])) update_post_meta($post_id, '_fuego_dial_number', sanitize_text_field($_POST['fuego_dial_tag']));
        if (isset($_POST['fuego_dial_genre'])) update_post_meta($post_id, '_fuego_dial_genre', sanitize_text_field($_POST['fuego_dial_genre']));
        if (isset($_POST['fuego_dial_dj'])) update_post_meta($post_id, '_fuego_dial_dj', sanitize_text_field($_POST['fuego_dial_dj']));
        if (isset($_POST['fuego_dial_listeners'])) update_post_meta($post_id, '_fuego_dial_listeners', sanitize_text_field($_POST['fuego_dial_listeners']));
        if (isset($_POST['fuego_dial_image'])) update_post_meta($post_id, '_fuego_dial_image', esc_url_raw($_POST['fuego_dial_image']));
        if (isset($_POST['fuego_dial_btn_text'])) update_post_meta($post_id, '_fuego_dial_btn_text', sanitize_text_field($_POST['fuego_dial_btn_text']));
        if (isset($_POST['fuego_dial_stream_url'])) update_post_meta($post_id, '_fuego_dial_stream_url', esc_url_raw($_POST['fuego_dial_stream_url']));
    }

    // 2. Guardar Ranking
    if (isset($_POST['fuego_ranking_nonce']) && wp_verify_nonce($_POST['fuego_ranking_nonce'], 'fuego_save_ranking_details')) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (isset($_POST['fuego_track_artist'])) update_post_meta($post_id, '_fuego_track_artist', sanitize_text_field($_POST['fuego_track_artist']));
        if (isset($_POST['fuego_track_rank'])) update_post_meta($post_id, '_fuego_track_rank', (int)$_POST['fuego_track_rank']);
        if (isset($_POST['fuego_track_trend'])) update_post_meta($post_id, '_fuego_track_trend', sanitize_text_field($_POST['fuego_track_trend']));
        if (isset($_POST['fuego_track_votes'])) update_post_meta($post_id, '_fuego_track_votes', (int)$_POST['fuego_track_votes']);
    }

    // 3. Guardar Show
    if (isset($_POST['fuego_show_nonce']) && wp_verify_nonce($_POST['fuego_show_nonce'], 'fuego_save_show_details')) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (isset($_POST['fuego_show_time'])) update_post_meta($post_id, '_fuego_show_time', sanitize_text_field($_POST['fuego_show_time']));
        if (isset($_POST['fuego_show_host'])) update_post_meta($post_id, '_fuego_show_host', sanitize_text_field($_POST['fuego_show_host']));
        $active = isset($_POST['fuego_show_active']) ? '1' : '0';
        update_post_meta($post_id, '_fuego_show_active', $active);
    }

    // 4. Guardar Shoutout / Saludo
    if (isset($_POST['fuego_shoutout_nonce']) && wp_verify_nonce($_POST['fuego_shoutout_nonce'], 'fuego_save_shoutout_details')) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (isset($_POST['fuego_shoutout_city'])) update_post_meta($post_id, '_fuego_shoutout_city', sanitize_text_field($_POST['fuego_shoutout_city']));
        if (isset($_POST['fuego_shoutout_likes'])) update_post_meta($post_id, '_fuego_shoutout_likes', (int)$_POST['fuego_shoutout_likes']);
    }
}
add_action('save_post', 'fuego_save_custom_meta_boxes');

/**
 * Auto-reparación única de base de datos para eventos existentes creados con valores antiguos
 */
function fuego_repair_existing_events_once() {
    $version_flag = 'fuego_events_repaired_v5';
    if (get_option($version_flag)) {
        return;
    }

    $events = get_posts(array(
        'post_type'      => 'fuego_dial',
        'posts_per_page' => -1,
        'post_status'    => 'any',
    ));

    if (empty($events)) {
        update_option($version_flag, true);
        return;
    }

    $fallback_images = array(
        'https://images.unsplash.com/photo-1547153760-18fc86324498?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=800&auto=format&fit=crop&q=80',
    );

    $idx = 0;
    foreach ($events as $post) {
        $title         = $post->post_title;
        $cur_tag       = get_post_meta($post->ID, '_fuego_dial_number', true);
        $cur_dj        = get_post_meta($post->ID, '_fuego_dial_dj', true);
        $cur_img       = get_post_meta($post->ID, '_fuego_dial_image', true);
        $is_polluted   = ($cur_tag === 'BACHATA · MADRID' || $cur_dj === 'Sala Ritmo Latino — Madrid');

        if (stripos($title, 'Bilbao') !== false || stripos($title, 'Salsa') !== false) {
            if ($is_polluted || empty($cur_tag) || $cur_tag === 'BACHATA · MADRID') {
                update_post_meta($post->ID, '_fuego_dial_number', 'SALSA · BILBAO');
                update_post_meta($post->ID, '_fuego_dial_genre', '📅 7 de noviembre de 2026 · 📍 Bilbao');
                update_post_meta($post->ID, '_fuego_dial_dj', 'Sala Sabor del Norte — Bilbao');
                update_post_meta($post->ID, '_fuego_dial_listeners', '18:00 h – 02:00 h');
            }
            if (empty($cur_img)) {
                update_post_meta($post->ID, '_fuego_dial_image', $fallback_images[1]);
            }
        } elseif (stripos($title, 'Urbana') !== false || stripos($title, 'Barakaldo') !== false || stripos($title, 'Reguetón') !== false || stripos($title, 'Perreo') !== false) {
            if ($is_polluted || empty($cur_tag) || $cur_tag === 'BACHATA · MADRID') {
                update_post_meta($post->ID, '_fuego_dial_number', 'REGUETÓN · BARAKALDO');
                update_post_meta($post->ID, '_fuego_dial_genre', '📅 14 de noviembre de 2026 · 📍 Barakaldo');
                update_post_meta($post->ID, '_fuego_dial_dj', 'Urban Beat Club — Barakaldo');
                update_post_meta($post->ID, '_fuego_dial_listeners', '23:00 h – 05:00 h');
            }
            if (empty($cur_img)) {
                update_post_meta($post->ID, '_fuego_dial_image', $fallback_images[2]);
            }
        } elseif (stripos($title, 'Colombia') !== false || stripos($title, 'Dominicana') !== false || stripos($title, 'Portugalete') !== false || stripos($title, 'Sin Fronteras') !== false) {
            if ($is_polluted || empty($cur_tag) || $cur_tag === 'BACHATA · MADRID') {
                update_post_meta($post->ID, '_fuego_dial_number', 'FESTIVAL · PORTUGALETE');
                update_post_meta($post->ID, '_fuego_dial_genre', '📅 21 de noviembre de 2026 · 📍 Portugalete');
                update_post_meta($post->ID, '_fuego_dial_dj', 'Recinto Ferial — Portugalete');
                update_post_meta($post->ID, '_fuego_dial_listeners', '16:00 h – 00:00 h');
            }
            if (empty($cur_img)) {
                update_post_meta($post->ID, '_fuego_dial_image', $fallback_images[3]);
            }
        } elseif (stripos($title, 'Remember') !== false || stripos($title, 'Santander') !== false || stripos($title, '2000') !== false) {
            if ($is_polluted || empty($cur_tag) || $cur_tag === 'BACHATA · MADRID') {
                update_post_meta($post->ID, '_fuego_dial_number', 'REMEMBER · SANTANDER');
                update_post_meta($post->ID, '_fuego_dial_genre', '📅 28 de noviembre de 2026 · 📍 Santander');
                update_post_meta($post->ID, '_fuego_dial_dj', 'Sala Retro Club — Santander');
                update_post_meta($post->ID, '_fuego_dial_listeners', '22:30 h – 04:30 h');
            }
            if (empty($cur_img)) {
                update_post_meta($post->ID, '_fuego_dial_image', $fallback_images[4]);
            }
        } elseif (stripos($title, 'Bachata') !== false || stripos($title, 'Madrid') !== false) {
            if (empty($cur_img)) {
                update_post_meta($post->ID, '_fuego_dial_image', $fallback_images[0]);
            }
        } else {
            // Evento adicional / custom (ej. Caribbean Night)
            if ($is_polluted) {
                update_post_meta($post->ID, '_fuego_dial_number', 'EVENTO ' . sprintf('%02d', $idx + 1));
                update_post_meta($post->ID, '_fuego_dial_genre', '📅 Próximamente · 📍 Sala Latina');
                update_post_meta($post->ID, '_fuego_dial_dj', 'Recinto Principal');
                update_post_meta($post->ID, '_fuego_dial_listeners', '22:00 h – 05:00 h');
            }
            if (empty($cur_img)) {
                $img_choice = $fallback_images[$idx % count($fallback_images)];
                update_post_meta($post->ID, '_fuego_dial_image', $img_choice);
            }
        }

        // Limpiar comentarios brutos de Gutenberg y decodificar entidades en el contenido
        $raw_c = $post->post_content;
        $cleaned = preg_replace('/<!--\s*\/?wp:[^\>]*-->/', '', $raw_c);
        $cleaned = html_entity_decode($cleaned, ENT_QUOTES, 'UTF-8');
        $cleaned = trim($cleaned);
        if ($cleaned !== $raw_c && !empty($cleaned)) {
            wp_update_post(array(
                'ID'           => $post->ID,
                'post_content' => $cleaned
            ));
        }

        $idx++;
    }

    update_option($version_flag, true);
}
add_action('init', 'fuego_repair_existing_events_once');
