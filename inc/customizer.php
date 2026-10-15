<?php
/**
 * Fuego FM / KLK Radio 47 - WordPress Customizer Settings
 * Provides comprehensive controls for stream URLs, logo size, live cabin,
 * Dials/Sections, Listener Wall, WhatsApp, and mobile apps.
 */

if (!defined('ABSPATH')) {
    exit;
}

function fuego_customize_register($wp_customize) {

    // Main Panel: KLK Radio 47 - Configuración General
    $wp_customize->add_panel('fuego_radio_panel', array(
        'title'       => __('KLK Radio 47 - Configuración', 'fuego-fm'),
        'description' => __('Ajustes completos de logo, streaming, locutores, diales/secciones, muro de oyentes y WhatsApp.', 'fuego-fm'),
        'priority'    => 25,
    ));

    // ==========================================
    // SECCIÓN 1: LOGOTIPO Y CABECERA
    // ==========================================
    $wp_customize->add_section('fuego_logo_section', array(
        'title'    => __('1. Tamaño del Logotipo y Cabecera', 'fuego-fm'),
        'panel'    => 'fuego_radio_panel',
        'priority' => 5,
    ));

    // Logo Height Setting & Control
    $wp_customize->add_setting('fuego_logo_height', array(
        'default'           => 42,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('fuego_logo_height', array(
        'label'       => __('Altura del Logotipo (en píxeles)', 'fuego-fm'),
        'description' => __('Ajusta el tamaño del logo para que encaje perfecto en la barra superior (recomendado: 32 a 60 px).', 'fuego-fm'),
        'section'     => 'fuego_logo_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 20,
            'max'  => 120,
            'step' => 2,
        ),
    ));

    // ==========================================
    // SECCIÓN 2: TRANSMISIÓN EN VIVO (STREAMING)
    // ==========================================
    $wp_customize->add_section('fuego_stream_section', array(
        'title'    => __('2. Transmisión en Vivo (Streaming)', 'fuego-fm'),
        'panel'    => 'fuego_radio_panel',
        'priority' => 10,
    ));

    // Master Stream URL
    $wp_customize->add_setting('fuego_stream_url', array(
        'default'           => 'https://srv1.streamingradio.ar/8380/stream',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('fuego_stream_url', array(
        'label'       => __('URL del Streaming Principal (SSL)', 'fuego-fm'),
        'section'     => 'fuego_stream_section',
        'type'        => 'url',
        'description' => __('Enlace de audio ShoutCast v2 o Icecast seguro (https).', 'fuego-fm'),
    ));

    // Stats / Now Playing API URL
    $wp_customize->add_setting('fuego_stats_url', array(
        'default'           => 'https://srv1.streamingradio.ar:8380/stats?json=1',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('fuego_stats_url', array(
        'label'       => __('URL de Estadísticas / Canción en Vivo (JSON)', 'fuego-fm'),
        'section'     => 'fuego_stream_section',
        'type'        => 'url',
        'description' => __('Endpoint JSON de tu servidor para detectar automáticamente la canción y artista al aire.', 'fuego-fm'),
    ));

    // Bitrate Text
    $wp_customize->add_setting('fuego_stream_bitrate', array(
        'default'           => '128K HD',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_stream_bitrate', array(
        'label'    => __('Texto de Calidad / Bitrate', 'fuego-fm'),
        'section'  => 'fuego_stream_section',
        'type'     => 'text',
    ));

    // Listeners Count Text
    $wp_customize->add_setting('fuego_listeners_count', array(
        'default'           => 'EN DIRECTO',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_listeners_count', array(
        'label'    => __('Contador o Estado de Oyentes', 'fuego-fm'),
        'section'  => 'fuego_stream_section',
        'type'     => 'text',
    ));

    // Fondo de la Tarjeta del Reproductor Hero
    $wp_customize->add_setting('fuego_player_bg_mode', array(
        'default'           => 'logo',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('fuego_player_bg_mode', array(
        'label'       => __('Fondo del Reproductor Principal', 'fuego-fm'),
        'description' => __('Elige qué elemento mostrar como fondo desvanecido en la caja del reproductor central.', 'fuego-fm'),
        'section'     => 'fuego_stream_section',
        'type'        => 'select',
        'choices'     => array(
            'logo'   => __('Logotipo Oficial KLK Desvanecido (Recomendado)', 'fuego-fm'),
            'custom' => __('Subir Imagen Personalizada', 'fuego-fm'),
            'none'   => __('Solo Gradiente y Luces Neón', 'fuego-fm'),
        ),
    ));

    $wp_customize->add_setting('fuego_player_bg_custom', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'fuego_player_bg_custom', array(
        'label'       => __('Imagen de Fondo Personalizada', 'fuego-fm'),
        'description' => __('Si seleccionaste "Subir Imagen Personalizada", sube tu imagen aquí.', 'fuego-fm'),
        'section'     => 'fuego_stream_section',
    )));

    $wp_customize->add_setting('fuego_player_bg_opacity', array(
        'default'           => 15,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('fuego_player_bg_opacity', array(
        'label'       => __('Nivel de Desvanecido / Opacidad (%)', 'fuego-fm'),
        'description' => __('Ajusta la transparencia (10% a 20% es ideal para mantener el contraste de los textos).', 'fuego-fm'),
        'section'     => 'fuego_stream_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 5,
            'max'  => 60,
            'step' => 5,
        ),
    ));

    // ==========================================
    // SECCIÓN 3: CABINA Y LOCUTORES EN VIVO
    // ==========================================
    $wp_customize->add_section('fuego_cabin_section', array(
        'title'    => __('3. En Cabina Principal y Locutores', 'fuego-fm'),
        'panel'    => 'fuego_radio_panel',
        'priority' => 20,
    ));

    $wp_customize->add_setting('fuego_cabin_title', array(
        'default'           => 'EN CABINA PRINCIPAL',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_cabin_title', array(
        'label'    => __('Etiqueta Superior de Cabina', 'fuego-fm'),
        'section'  => 'fuego_cabin_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_show_title', array(
        'default'           => 'La Batidora Urbana',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_show_title', array(
        'label'    => __('Título del Programa en Vivo', 'fuego-fm'),
        'section'  => 'fuego_cabin_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_hosts_names', array(
        'default'           => 'Miguel 47',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_hosts_names', array(
        'label'    => __('Nombres de los Locutores', 'fuego-fm'),
        'section'  => 'fuego_cabin_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_hosts_tagline', array(
        'default'           => 'Los reyes de la Salsa',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_hosts_tagline', array(
        'label'    => __('Lema de los Locutores', 'fuego-fm'),
        'section'  => 'fuego_cabin_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_hosts_time', array(
        'default'           => '10:00 - 14:00 COT',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_hosts_time', array(
        'label'    => __('Horario de Cabina', 'fuego-fm'),
        'section'  => 'fuego_cabin_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_hosts_ig1', array(
        'default'           => '@klkradio47',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_hosts_ig1', array(
        'label'       => __('Texto / Usuario Red Social 1', 'fuego-fm'),
        'description' => __('Ejemplo: @klkradio47', 'fuego-fm'),
        'section'     => 'fuego_cabin_section',
        'type'        => 'text',
    ));

    $wp_customize->add_setting('fuego_hosts_url1', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('fuego_hosts_url1', array(
        'label'       => __('Enlace URL Red Social 1 (Opcional)', 'fuego-fm'),
        'description' => __('Si se deja vacío, enlazará automáticamente a https://instagram.com/usuario', 'fuego-fm'),
        'section'     => 'fuego_cabin_section',
        'type'        => 'url',
    ));

    $wp_customize->add_setting('fuego_hosts_ig2', array(
        'default'           => '@klkradio47',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_hosts_ig2', array(
        'label'       => __('Texto / Usuario Red Social 2', 'fuego-fm'),
        'description' => __('Ejemplo: @klkradio47', 'fuego-fm'),
        'section'     => 'fuego_cabin_section',
        'type'        => 'text',
    ));

    $wp_customize->add_setting('fuego_hosts_url2', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('fuego_hosts_url2', array(
        'label'       => __('Enlace URL Red Social 2 (Opcional)', 'fuego-fm'),
        'description' => __('Si se deja vacío, enlazará automáticamente a https://instagram.com/usuario', 'fuego-fm'),
        'section'     => 'fuego_cabin_section',
        'type'        => 'url',
    ));

    // Hosts Portrait Image
    $wp_customize->add_setting('fuego_hosts_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'fuego_hosts_image', array(
        'label'       => __('Foto de los Locutores', 'fuego-fm'),
        'description' => __('Sube la imagen circular de los presentadores en cabina.', 'fuego-fm'),
        'section'     => 'fuego_cabin_section',
    )));

    // Voice Note texts
    $wp_customize->add_setting('fuego_voicenote_text', array(
        'default'           => 'Grabar nota de voz (15s)',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_voicenote_text', array(
        'label'    => __('Texto del Botón Nota de Voz', 'fuego-fm'),
        'section'  => 'fuego_cabin_section',
        'type'     => 'text',
    ));

    // ==========================================
    // SECCIÓN 4: RECIÉN SONADAS Y MÉTRICA DE SEÑAL
    // ==========================================
    $wp_customize->add_section('fuego_recent_section', array(
        'title'    => __('4. Recién Sonadas y Métrica de Señal', 'fuego-fm'),
        'panel'    => 'fuego_radio_panel',
        'priority' => 25,
    ));

    $wp_customize->add_setting('fuego_recent_title', array(
        'default'           => 'RECIÉN SONADAS',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_recent_title', array(
        'label'    => __('Título del Historial', 'fuego-fm'),
        'section'  => 'fuego_recent_section',
        'type'     => 'text',
    ));

    // Track 1
    $wp_customize->add_setting('fuego_recent_1_title', array('default' => 'LALA', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('fuego_recent_1_title', array('label' => __('Tema 1 - Título', 'fuego-fm'), 'section' => 'fuego_recent_section', 'type' => 'text'));
    $wp_customize->add_setting('fuego_recent_1_artist', array('default' => 'Myke Towers', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('fuego_recent_1_artist', array('label' => __('Tema 1 - Artista', 'fuego-fm'), 'section' => 'fuego_recent_section', 'type' => 'text'));
    $wp_customize->add_setting('fuego_recent_1_time', array('default' => 'Hace 4m', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('fuego_recent_1_time', array('label' => __('Tema 1 - Tiempo', 'fuego-fm'), 'section' => 'fuego_recent_section', 'type' => 'text'));

    // Track 2
    $wp_customize->add_setting('fuego_recent_2_title', array('default' => 'Columbia', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('fuego_recent_2_title', array('label' => __('Tema 2 - Título', 'fuego-fm'), 'section' => 'fuego_recent_section', 'type' => 'text'));
    $wp_customize->add_setting('fuego_recent_2_artist', array('default' => 'Quevedo', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('fuego_recent_2_artist', array('label' => __('Tema 2 - Artista', 'fuego-fm'), 'section' => 'fuego_recent_section', 'type' => 'text'));
    $wp_customize->add_setting('fuego_recent_2_time', array('default' => 'Hace 7m', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('fuego_recent_2_time', array('label' => __('Tema 2 - Tiempo', 'fuego-fm'), 'section' => 'fuego_recent_section', 'type' => 'text'));

    // Track 3
    $wp_customize->add_setting('fuego_recent_3_title', array('default' => 'Monaco', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('fuego_recent_3_title', array('label' => __('Tema 3 - Título', 'fuego-fm'), 'section' => 'fuego_recent_section', 'type' => 'text'));
    $wp_customize->add_setting('fuego_recent_3_artist', array('default' => 'Bad Bunny', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('fuego_recent_3_artist', array('label' => __('Tema 3 - Artista', 'fuego-fm'), 'section' => 'fuego_recent_section', 'type' => 'text'));
    $wp_customize->add_setting('fuego_recent_3_time', array('default' => 'Hace 11m', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('fuego_recent_3_time', array('label' => __('Tema 3 - Tiempo', 'fuego-fm'), 'section' => 'fuego_recent_section', 'type' => 'text'));

    // Signal metric
    $wp_customize->add_setting('fuego_signal_text', array('default' => 'Señal Global Activa', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('fuego_signal_text', array('label' => __('Texto de Señal', 'fuego-fm'), 'section' => 'fuego_recent_section', 'type' => 'text'));
    $wp_customize->add_setting('fuego_signal_uptime', array('default' => '99.98% UPTIME', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('fuego_signal_uptime', array('label' => __('Porcentaje Uptime', 'fuego-fm'), 'section' => 'fuego_recent_section', 'type' => 'text'));

    // ==========================================
    // SECCIÓN 5: DIALES, SECCIONES Y EVENTOS
    // ==========================================
    $wp_customize->add_section('fuego_dials_section', array(
        'title'       => __('5. Eventos, Fiestas y Diales', 'fuego-fm'),
        'description' => __('Personaliza los títulos de la agenda de eventos y fiestas latinas. Los eventos se añaden y editan en el menú "Eventos & Diales".', 'fuego-fm'),
        'panel'       => 'fuego_radio_panel',
        'priority'    => 30,
    ));

    $wp_customize->add_setting('fuego_dials_badge', array(
        'default'           => 'PRÓXIMOS EVENTOS & FIESTAS LATINAS',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_dials_badge', array(
        'label'    => __('Etiqueta Superior', 'fuego-fm'),
        'section'  => 'fuego_dials_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_dials_title', array(
        'default'           => 'AGENDA DE EVENTOS & CONCIERTOS',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_dials_title', array(
        'label'    => __('Título Principal de la Sección', 'fuego-fm'),
        'section'  => 'fuego_dials_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_dials_subtitle', array(
        'default'           => 'Los festivales, noches de baile y conciertos latinos más esperados en Madrid, Bilbao, Barakaldo y Santander.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('fuego_dials_subtitle', array(
        'label'    => __('Descripción o Subtítulo', 'fuego-fm'),
        'section'  => 'fuego_dials_section',
        'type'     => 'textarea',
    ));

    // ==========================================
    // SECCIÓN 6: RANKING Y VOTACIÓN (EL TERMÓMETRO LATINO)
    // ==========================================
    $wp_customize->add_section('fuego_ranking_section', array(
        'title'       => __('6. Ranking: El Termómetro Latino', 'fuego-fm'),
        'description' => __('Personaliza los textos del encabezado del ranking. Para añadir o editar los temas, artistas y votos, ve al menú "El Termómetro" en tu panel de WordPress.', 'fuego-fm'),
        'panel'       => 'fuego_radio_panel',
        'priority'    => 32,
    ));

    $wp_customize->add_setting('fuego_ranking_badge', array(
        'default'           => 'VOTACIÓN EN DIRECTO',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_ranking_badge', array(
        'label'    => __('Etiqueta Superior', 'fuego-fm'),
        'section'  => 'fuego_ranking_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_ranking_title', array(
        'default'           => 'EL TERMÓMETRO LATINO',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_ranking_title', array(
        'label'    => __('Título Principal del Ranking', 'fuego-fm'),
        'section'  => 'fuego_ranking_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_ranking_subtitle', array(
        'default'           => 'Top 5 más votado por la audiencia en las últimas 24 horas.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('fuego_ranking_subtitle', array(
        'label'    => __('Subtítulo o Descripción', 'fuego-fm'),
        'section'  => 'fuego_ranking_section',
        'type'     => 'textarea',
    ));

    // ==========================================
    // SECCIÓN 7: MURO DE OYENTES Y WHATSAPP
    // ==========================================
    $wp_customize->add_section('fuego_wall_section', array(
        'title'    => __('7. Muro de Oyentes y WhatsApp', 'fuego-fm'),
        'panel'    => 'fuego_radio_panel',
        'priority' => 35,
    ));

    $wp_customize->add_setting('fuego_wall_badge', array(
        'default'           => 'INTERACCIÓN DIRECTA',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_wall_badge', array(
        'label'    => __('Etiqueta Superior', 'fuego-fm'),
        'section'  => 'fuego_wall_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_wall_title', array(
        'default'           => 'MURO DE OYENTES EN VIVO',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_wall_title', array(
        'label'    => __('Título del Muro', 'fuego-fm'),
        'section'  => 'fuego_wall_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_wall_subtitle', array(
        'default'           => 'Mensajes leídos al aire cada 15 minutos en cabina principal.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('fuego_wall_subtitle', array(
        'label'    => __('Subtítulo del Muro', 'fuego-fm'),
        'section'  => 'fuego_wall_section',
        'type'     => 'textarea',
    ));

    $wp_customize->add_setting('fuego_whatsapp_number', array(
        'default'           => '+1234567890',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_whatsapp_number', array(
        'label'       => __('Número de WhatsApp de Cabina', 'fuego-fm'),
        'description' => __('Incluye el código internacional, ej. +34... o +1...', 'fuego-fm'),
        'section'     => 'fuego_wall_section',
        'type'        => 'text',
    ));

    $wp_customize->add_setting('fuego_whatsapp_btn_text', array(
        'default'           => 'Línea Directa WhatsApp',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_whatsapp_btn_text', array(
        'label'    => __('Texto del Botón de WhatsApp', 'fuego-fm'),
        'section'  => 'fuego_wall_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_wall_placeholder', array(
        'default'           => 'Escribe tu saludo o pide una canción para que salga en vivo...',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_wall_placeholder', array(
        'label'    => __('Texto del Campo de Saludos', 'fuego-fm'),
        'section'  => 'fuego_wall_section',
        'type'     => 'text',
    ));

    // ==========================================
    // SECCIÓN 8: APLICACIONES MÓVILES
    // ==========================================
    $wp_customize->add_section('fuego_apps_section', array(
        'title'    => __('8. Enlaces App Móvil y CarPlay', 'fuego-fm'),
        'panel'    => 'fuego_radio_panel',
        'priority' => 40,
    ));

    $wp_customize->add_setting('fuego_app_badge', array(
        'default'           => 'APPLE CARPLAY & ANDROID AUTO READY',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_app_badge', array(
        'label'    => __('Etiqueta Superior', 'fuego-fm'),
        'section'  => 'fuego_apps_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_app_title', array(
        'default'           => 'LLEVA EL FUEGO EN CADA KILÓMETRO',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_app_title', array(
        'label'    => __('Título del Banner', 'fuego-fm'),
        'section'  => 'fuego_apps_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('fuego_app_desc', array(
        'default'           => 'Descarga la App oficial. Audio espacial Hi-Res, modo offline para tus rankings preferidos y compatibilidad total con el tablero de tu auto.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('fuego_app_desc', array(
        'label'    => __('Descripción', 'fuego-fm'),
        'section'  => 'fuego_apps_section',
        'type'     => 'textarea',
    ));

    $wp_customize->add_setting('fuego_app_store_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('fuego_app_store_url', array(
        'label'    => __('Enlace App Store (iOS)', 'fuego-fm'),
        'section'  => 'fuego_apps_section',
        'type'     => 'url',
    ));

    $wp_customize->add_setting('fuego_google_play_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('fuego_google_play_url', array(
        'label'    => __('Enlace Google Play (Android)', 'fuego-fm'),
        'section'  => 'fuego_apps_section',
        'type'     => 'url',
    ));

    // ==========================================
    // SECCIÓN 9: PIE DE PÁGINA Y PÁGINAS ESTÁTICAS
    // ==========================================
    $wp_customize->add_section('fuego_footer_section', array(
        'title'    => __('9. Pie de Página y Páginas Estáticas', 'fuego-fm'),
        'panel'    => 'fuego_radio_panel',
        'priority' => 45,
    ));

    $wp_customize->add_setting('fuego_footer_copyright', array(
        'default'           => '© ' . date('Y') . ' KLK Radio 47 · Sabor Latino. Todos los derechos reservados.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fuego_footer_copyright', array(
        'label'       => __('Texto de Copyright', 'fuego-fm'),
        'description' => __('Puedes usar {year} para que el año se mantenga siempre actualizado.', 'fuego-fm'),
        'section'     => 'fuego_footer_section',
        'type'        => 'text',
    ));

    $wp_customize->add_setting('fuego_footer_about_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('fuego_footer_about_url', array(
        'label'       => __('Enlace: Acerca de nosotros', 'fuego-fm'),
        'description' => __('Deja vacío para enlazar automáticamente a la página estática "Acerca de nosotros".', 'fuego-fm'),
        'section'     => 'fuego_footer_section',
        'type'        => 'url',
    ));

    $wp_customize->add_setting('fuego_footer_contact_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('fuego_footer_contact_url', array(
        'label'       => __('Enlace: Contáctenos', 'fuego-fm'),
        'description' => __('Deja vacío para enlazar automáticamente a la página estática "Contáctenos".', 'fuego-fm'),
        'section'     => 'fuego_footer_section',
        'type'        => 'url',
    ));

    $wp_customize->add_setting('fuego_footer_privacy_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('fuego_footer_privacy_url', array(
        'label'       => __('Enlace: Política de privacidad', 'fuego-fm'),
        'description' => __('Deja vacío para enlazar automáticamente a la página estática "Política de privacidad".', 'fuego-fm'),
        'section'     => 'fuego_footer_section',
        'type'        => 'url',
    ));

    $wp_customize->add_setting('fuego_footer_terms_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('fuego_footer_terms_url', array(
        'label'       => __('Enlace: Términos del servicio', 'fuego-fm'),
        'description' => __('Deja vacío para enlazar automáticamente a la página estática "Términos del servicio".', 'fuego-fm'),
        'section'     => 'fuego_footer_section',
        'type'        => 'url',
    ));
}
add_action('customize_register', 'fuego_customize_register');
