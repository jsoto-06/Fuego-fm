<?php
/**
 * Fuego FM - Front Page Template
 * High-energy Latin radio landing page with live streaming and interactive modules.
 *
 * @package Fuego_FM
 */

get_header();

// Fetch Dials: WP Query with fallback
$dials_query = new WP_Query(array(
    'post_type'      => 'fuego_dial',
    'posts_per_page' => 6,
    'post_status'    => 'publish'
));
$dials = array();
if ($dials_query->have_posts()) {
    $dial_index = 1;
    while ($dials_query->have_posts()) {
        $dials_query->the_post();
        
        // Check for custom event image meta first, then featured image, then cycled fallback
        $custom_img = get_post_meta(get_the_ID(), '_fuego_dial_image', true);
        if (!empty($custom_img)) {
            $thumb = $custom_img;
        } else {
            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if (!$thumb) {
                $default_list = fuego_get_default_dials();
                $def_count = !empty($default_list) ? count($default_list) : 1;
                $thumb = isset($default_list[($dial_index - 1) % $def_count]) ? $default_list[($dial_index - 1) % $def_count]['image'] : 'https://images.unsplash.com/photo-1547153760-18fc86324498?w=800&auto=format&fit=crop&q=80';
            }
        }

        $genres = wp_get_post_terms(get_the_ID(), 'fuego_genre', array('fields' => 'names'));
        $category = !empty($genres) ? $genres[0] : 'Urbano';

        $btn_text  = get_post_meta(get_the_ID(), '_fuego_dial_btn_text', true) ?: __('🎟️ Ver Evento', 'fuego-fm');
        $tag       = get_post_meta(get_the_ID(), '_fuego_dial_number', true) ?: sprintf('EVENTO %02d', $dial_index);
        $genre     = get_post_meta(get_the_ID(), '_fuego_dial_genre', true) ?: get_the_excerpt();
        $dj        = get_post_meta(get_the_ID(), '_fuego_dial_dj', true) ?: 'Sala Principal';
        $listeners = get_post_meta(get_the_ID(), '_fuego_dial_listeners', true) ?: '20:00 h';
        $stream    = get_post_meta(get_the_ID(), '_fuego_dial_stream_url', true) ?: fuego_get_stream_url();

        // Process rich content, decode entities & clean raw Gutenberg comments
        $raw_content = get_the_content();
        if (!empty($raw_content)) {
            $decoded_raw = html_entity_decode($raw_content, ENT_QUOTES, 'UTF-8');
            $rendered_blocks = do_blocks($decoded_raw);
            $clean_html = wpautop($rendered_blocks);
            $clean_html = preg_replace('/<!--\s*\/?wp:[^\>]*-->/', '', $clean_html);
            // Decode any leftover escaped tags like &lt;p&gt;
            $clean_html = html_entity_decode($clean_html, ENT_QUOTES, 'UTF-8');
            $clean_html = str_replace(array('<p><p>', '</p></p>'), array('<p>', '</p>'), $clean_html);
            $clean_html = trim($clean_html);
        } else {
            $clean_html = '<p>' . esc_html($genre) . '</p>';
        }

        $plain_excerpt = wp_strip_all_tags($clean_html);
        $clean_title = html_entity_decode(get_the_title(), ENT_QUOTES, 'UTF-8');

        $dials[] = array(
            'id'        => 'event_' . get_the_ID(),
            'tag'       => $tag,
            'title'     => $clean_title,
            'genre'     => $genre,
            'category'  => $category,
            'artists'   => wp_trim_words($plain_excerpt, 16, '...'),
            'content'   => $clean_html,
            'dj'        => $dj,
            'listeners' => $listeners,
            'date'      => $genre,
            'time'      => $listeners,
            'venue'     => $dj,
            'image'     => $thumb,
            'stream'    => $stream,
            'btn_text'  => $btn_text,
            'badge_bg'  => ($dial_index % 3 === 1) ? 'bg-primary-container' : (($dial_index % 3 === 2) ? 'bg-secondary-container' : 'bg-tertiary-container'),
            'badge_txt' => ($dial_index % 3 === 2) ? 'text-on-secondary-container' : 'text-white'
        );
        $dial_index++;
    }
    wp_reset_postdata();
} else {
    $dials = fuego_get_default_dials();
}

// Fetch Ranking: WP Query with fallback
$ranking_query = new WP_Query(array(
    'post_type'      => 'fuego_ranking',
    'posts_per_page' => 5,
    'meta_key'       => '_fuego_track_rank',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish'
));
$ranking = array();
if ($ranking_query->have_posts()) {
    $r_index = 1;
    while ($ranking_query->have_posts()) {
        $ranking_query->the_post();
        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'fuego-album-thumb');
        if (!$thumb) {
            $def_r = fuego_get_default_ranking();
            $thumb = isset($def_r[$r_index - 1]) ? $def_r[$r_index - 1]['image'] : '';
        }
        $votes = (int) get_post_meta(get_the_ID(), '_fuego_track_votes', true);
        if ($votes <= 0) $votes = 60000;

        $trend = get_post_meta(get_the_ID(), '_fuego_track_trend', true) ?: '= 0';
        $trend_class = 'text-primary bg-primary/20';
        if (strpos($trend, '↑') !== false) {
            $trend_class = 'text-secondary-container bg-secondary-container/20';
        } elseif (strpos($trend, 'NEW') !== false) {
            $trend_class = 'text-tertiary bg-tertiary/20';
        } elseif (strpos($trend, '↓') !== false) {
            $trend_class = 'text-on-surface-variant bg-surface-container-highest';
        }

        $ranking[] = array(
            'id'          => get_the_ID(),
            'rank'        => sprintf('%02d', $r_index),
            'title'       => get_the_title(),
            'artist'      => get_post_meta(get_the_ID(), '_fuego_track_artist', true) ?: 'Artista Fuego',
            'trend'       => $trend,
            'trend_class' => $trend_class,
            'votes'       => $votes,
            'image'       => $thumb,
            'is_grand'    => ($r_index === 1)
        );
        $r_index++;
    }
    wp_reset_postdata();
} else {
    $ranking = fuego_get_default_ranking();
}

// Fetch Shows: WP Query with fallback
$shows_query = new WP_Query(array(
    'post_type'      => 'fuego_show',
    'posts_per_page' => 6,
    'post_status'    => 'publish'
));
$shows = array();
if ($shows_query->have_posts()) {
    while ($shows_query->have_posts()) {
        $shows_query->the_post();
        $shows[] = array(
            'time'       => get_post_meta(get_the_ID(), '_fuego_show_time', true) ?: '10:00 - 14:00',
            'title'      => get_the_title(),
            'host'       => get_post_meta(get_the_ID(), '_fuego_show_host', true) ?: get_the_excerpt(),
            'status'     => get_post_meta(get_the_ID(), '_fuego_show_active', true) ? 'live' : 'upcoming',
            'status_tag' => get_post_meta(get_the_ID(), '_fuego_show_active', true) ? 'EN EL AIRE' : 'schedule',
        );
    }
    wp_reset_postdata();
} else {
    $shows = fuego_get_default_shows();
}

// Fetch Shoutouts: WP Query with fallback
$shoutouts_query = new WP_Query(array(
    'post_type'      => 'fuego_shoutout',
    'posts_per_page' => 4,
    'post_status'    => 'publish'
));
$shoutouts = array();
if ($shoutouts_query->have_posts()) {
    while ($shoutouts_query->have_posts()) {
        $shoutouts_query->the_post();
        $shoutouts[] = array(
            'author'    => get_the_title(),
            'location'  => get_post_meta(get_the_ID(), '_fuego_shoutout_city', true) ?: 'Online 🌐',
            'loc_color' => 'text-secondary-container',
            'message'   => get_the_content(),
            'time_ago'  => human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ' . __('atrás', 'fuego-fm'),
            'likes'     => (int) get_post_meta(get_the_ID(), '_fuego_shoutout_likes', true) ?: 15
        );
    }
    wp_reset_postdata();
} else {
    $shoutouts = fuego_get_default_shoutouts();
}
?>

<main class="w-full pt-20 pb-28 bg-background min-h-screen">
  <div class="flex flex-col w-full">
    
    <!-- AMBIENT NEON GLOWS (Restricted to coordinate space) -->
    <div class="relative w-full overflow-hidden">
      <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[720px] h-[340px] bg-primary-container/15 blur-[130px] rounded-full pointer-events-none"></div>
      <div class="absolute top-96 -left-20 w-[420px] h-[420px] bg-tertiary-container/10 blur-[150px] rounded-full pointer-events-none"></div>
      <div class="absolute top-80 -right-20 w-[460px] h-[460px] bg-secondary-container/10 blur-[160px] rounded-full pointer-events-none"></div>

      <!-- 1. HERO: TRANSMISIÓN EN DIRECTO PRINCIPAL -->
      <section id="en-vivo" class="relative w-full px-gutter max-w-7xl mx-auto pt-6 pb-20">
        
        <!-- Status pill & Overline -->
        <div class="flex flex-wrap items-center justify-between gap-space-sm mb-6">
          <div class="inline-flex items-center gap-2 bg-surface-container-high/80 backdrop-blur-xl px-4 py-1.5 rounded-full shadow-lg">
            <span class="w-2.5 h-2.5 rounded-full bg-primary-container animate-ping"></span>
            <span class="w-2.5 h-2.5 rounded-full bg-primary-container -ml-[18px]"></span>
            <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest">
              <?php esc_html_e('EN VIVO AHORA · MASTER FEED HD 320 KBPS', 'fuego-fm'); ?>
            </span>
            <span class="text-outline text-xs">/</span>
            <span class="font-label-sm text-label-sm text-secondary-container">
              <?php echo esc_html(fuego_get_listeners_count()); ?>
            </span>
          </div>
          
          <div class="hidden md:flex items-center gap-space-sm font-label-sm text-label-sm text-on-surface-variant">
            <span class="flex items-center gap-1 text-primary">
              <span class="material-symbols-outlined text-sm">public</span> <?php esc_html_e('45+ PAÍSES', 'fuego-fm'); ?>
            </span>
            <span class="text-outline">·</span>
            <span><?php esc_html_e('SIN CORTES COMERCIALES', 'fuego-fm'); ?></span>
          </div>
        </div>

        <!-- Main Master Stage (Bento Grid 12-cols) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
          
          <!-- Live Player Mega-Card (8 cols) -->
          <div class="lg:col-span-8 bg-surface-container-low/90 backdrop-blur-2xl rounded-xl p-6 sm:p-8 flex flex-col justify-between shadow-2xl relative overflow-hidden group">
            
            <!-- Background Atmosphere & Faded Logo / Custom Image Backdrop -->
            <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
              <!-- Ambient Color Orbs -->
              <div class="absolute -right-16 -top-16 w-80 h-80 bg-primary-container/20 rounded-full blur-3xl"></div>
              <div class="absolute -left-16 -bottom-16 w-80 h-80 bg-secondary-container/20 rounded-full blur-3xl"></div>

              <?php
              $bg_mode = get_theme_mod('fuego_player_bg_mode', 'logo');
              $bg_opacity = (int) get_theme_mod('fuego_player_bg_opacity', 15);
              $opacity_dec = max(0.05, min(0.6, $bg_opacity / 100));
              ?>

              <?php if ($bg_mode === 'custom' && ($custom_img = get_theme_mod('fuego_player_bg_custom', ''))) : ?>
                <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-700" style="background-image: url('<?php echo esc_url($custom_img); ?>'); opacity: <?php echo esc_attr($opacity_dec); ?>;"></div>
              <?php elseif ($bg_mode !== 'none') : ?>
                <!-- Faded Watermark KLK Radio 47 Logo -->
                <div class="absolute -right-8 -bottom-8 sm:right-0 sm:bottom-0 w-80 sm:w-96 md:w-[440px] h-auto transition-all duration-700 transform translate-x-4 translate-y-4 group-hover:scale-105 pointer-events-none flex items-center justify-end" style="opacity: <?php echo esc_attr($opacity_dec); ?>;">
                  <img src="<?php echo esc_url(fuego_get_watermark_logo()); ?>" alt="KLK Radio 47" class="w-full h-auto object-contain filter drop-shadow-[0_0_20px_rgba(255,87,34,0.3)]" />
                </div>
              <?php endif; ?>

              <!-- Gradient Scrim for crisp text contrast -->
              <div class="absolute inset-0 bg-gradient-to-t from-surface-container-low via-surface-container-low/75 to-surface-container-low/30"></div>
            </div>

            <!-- Top Player Header -->
            <div class="relative z-10 flex flex-wrap items-center justify-between gap-4">
              <div class="flex items-center gap-3">
                <span class="px-3 py-1 bg-primary-container text-white font-label-sm text-label-sm rounded-full uppercase tracking-wider shadow-md">
                  <?php esc_html_e('PROGRAMA CENTRAL', 'fuego-fm'); ?>
                </span>
                <span class="font-title-md text-title-md text-on-surface font-bold tracking-tight">
                  <?php echo esc_html(fuego_get_show_title()); ?>
                </span>
              </div>
              <div class="flex items-center gap-2">
                <span class="bg-surface-container-highest px-3 py-1 rounded-full text-secondary-container font-label-sm text-label-sm flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-sm">high_quality</span>
                  <?php echo esc_html(fuego_get_bitrate()); ?>
                </span>
                <button class="w-9 h-9 rounded-full bg-surface-container-high hover:bg-surface-container-highest text-on-surface flex items-center justify-center transition-colors" type="button" aria-label="<?php esc_attr_e('Ecualizador', 'fuego-fm'); ?>">
                  <span class="material-symbols-outlined text-lg">equalizer</span>
                </button>
              </div>
            </div>

            <!-- Central Player Content -->
            <div class="relative z-10 my-8 flex flex-col sm:flex-row items-center gap-6">
              
              <!-- Rotating Vinyl / Album Art Artifice -->
              <div class="relative w-44 h-44 sm:w-52 sm:h-52 flex-shrink-0">
                <div class="absolute -inset-2 rounded-2xl bg-gradient-to-tr from-primary-container via-tertiary-container to-secondary-container opacity-40 blur-lg animate-pulse"></div>
                <div class="relative w-full h-full rounded-xl overflow-hidden shadow-2xl bg-surface-container-highest">
                  <img id="fuego-hero-album" class="w-full h-full object-cover fuego-vinyl-art" alt="Album Cover" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/album-titi.jpg'); ?>" />
                  <div class="absolute top-2 right-2 bg-surface-container-lowest/80 backdrop-blur-md px-2 py-0.5 rounded text-primary font-label-sm text-label-sm">
                    #1 LATINO
                  </div>
                </div>
              </div>

              <!-- Track Metadata & Dynamic EQ Visualizer -->
              <div class="flex flex-col items-center sm:items-start text-center sm:text-left flex-1 min-w-0">
                <div class="flex items-center gap-2 text-primary font-label-md text-label-md uppercase tracking-wider mb-1">
                  <span class="material-symbols-outlined text-base">radio</span> <?php esc_html_e('SONANDO AL AIRE AHORA', 'fuego-fm'); ?>
                </div>
                <h1 id="fuego-hero-track-title" class="font-headline-lg text-headline-lg text-on-surface font-black tracking-tight leading-none mb-2 truncate w-full">
                  Tití Me Preguntó
                </h1>
                <p id="fuego-hero-track-artist" class="font-title-md text-title-md text-secondary font-semibold mb-4">
                  Bad Bunny <span class="text-on-surface-variant font-normal">· Un Verano Sin Ti</span>
                </p>

                <!-- Dynamic Audio Spectrum Graphic (Animated Equalizer) -->
                <div class="fuego-eq-visualizer eq-container w-full h-12 bg-surface-container-highest/60 rounded-lg p-2.5 flex items-end justify-between gap-1 overflow-hidden eq-paused">
                  <div class="eq-bar bg-primary-container h-3/6"></div>
                  <div class="eq-bar bg-secondary-container h-4/6"></div>
                  <div class="eq-bar bg-tertiary-container h-6/6"></div>
                  <div class="eq-bar bg-primary-container h-5/6"></div>
                  <div class="eq-bar bg-secondary-container h-2/6"></div>
                  <div class="eq-bar bg-primary-container h-4/6"></div>
                  <div class="eq-bar bg-tertiary-container h-6/6"></div>
                  <div class="eq-bar bg-primary-container h-3/6"></div>
                  <div class="eq-bar bg-secondary-container h-5/6"></div>
                  <div class="eq-bar bg-tertiary-container h-4/6"></div>
                  <div class="eq-bar bg-primary-container h-6/6"></div>
                  <div class="eq-bar bg-secondary-container h-5/6"></div>
                  <div class="eq-bar bg-tertiary-container h-3/6"></div>
                  <div class="eq-bar bg-primary-container h-6/6"></div>
                  <div class="eq-bar bg-secondary-container h-4/6"></div>
                  <div class="eq-bar bg-primary-container h-2/6"></div>
                  <div class="eq-bar bg-tertiary-container h-5/6"></div>
                  <div class="eq-bar bg-secondary-container h-6/6"></div>
                  <div class="eq-bar bg-primary-container h-4/6"></div>
                  <div class="eq-bar bg-tertiary-container h-5/6"></div>
                  <div class="eq-bar bg-secondary-container h-3/6"></div>
                  <div class="eq-bar bg-primary-container h-6/6"></div>
                  <div class="eq-bar bg-tertiary-container h-4/6"></div>
                  <div class="eq-bar bg-secondary-container h-2/6"></div>
                </div>

                <div class="flex items-center justify-between w-full mt-2 font-body-sm text-body-sm text-on-surface-variant">
                  <span class="fuego-current-time">02:38 / 04:03</span>
                  <span class="text-tertiary font-semibold"><?php esc_html_e('Siguiente: Karol G - QLONA', 'fuego-fm'); ?></span>
                </div>
              </div>

            </div>

            <!-- Bottom Mega Action Bar -->
            <div class="relative z-10 pt-4 flex flex-wrap items-center justify-between gap-4 border-t border-white/5">
              <div class="flex items-center gap-3">
                
                <!-- Giant Radiant Play/Pause Button -->
                <button class="fuego-toggle-play relative group/btn flex items-center justify-center w-14 h-14 rounded-full bg-primary-container hover:bg-tertiary-container text-white transition-all shadow-xl hover:scale-105 active:scale-95 cursor-pointer" type="button" aria-label="<?php esc_attr_e('Reproducir en vivo', 'fuego-fm'); ?>">
                  <span class="material-symbols-outlined text-3xl fuego-play-icon">play_arrow</span>
                  <span class="absolute inset-0 rounded-full bg-primary-container/40 blur-md group-hover/btn:blur-xl transition-all -z-10"></span>
                </button>
                <div>
                  <span class="block font-label-md text-label-md text-on-surface font-bold"><?php esc_html_e('TRANSMITIENDO EN DIRECTO', 'fuego-fm'); ?></span>
                  <span class="block font-body-sm text-body-sm text-on-surface-variant"><?php esc_html_e('Latencia ultrabaja < 0.4s', 'fuego-fm'); ?></span>
                </div>
              </div>

              <!-- Quick Action Pills -->
              <div class="flex flex-wrap items-center gap-2">
                <a class="px-4 py-2 bg-[#25D366]/20 hover:bg-[#25D366]/30 text-[#25D366] font-label-md text-label-md rounded-full flex items-center gap-1.5 transition-colors" href="<?php echo esc_url(fuego_get_whatsapp_url()); ?>" rel="noopener noreferrer" target="_blank">
                  <span class="material-symbols-outlined text-base">chat</span>
                  <?php esc_html_e('WhatsApp Cabina', 'fuego-fm'); ?>
                </a>
                <button class="fuego-open-request-modal px-4 py-2 bg-surface-container-high hover:bg-surface-container-highest text-on-surface font-label-md text-label-md rounded-full flex items-center gap-1.5 transition-colors cursor-pointer" type="button">
                  <span class="material-symbols-outlined text-base">queue_music</span>
                  <?php esc_html_e('Pedir Canción', 'fuego-fm'); ?>
                </button>
                <button class="fuego-share-btn w-10 h-10 bg-surface-container-high hover:bg-surface-container-highest text-on-surface rounded-full flex items-center justify-center transition-colors cursor-pointer" type="button" aria-label="<?php esc_attr_e('Compartir estación', 'fuego-fm'); ?>">
                  <span class="material-symbols-outlined text-lg">share</span>
                </button>
              </div>
            </div>

          </div>

          <!-- Right Side Live Studio Hub (4 cols) -->
          <div class="lg:col-span-4 flex flex-col gap-4">
            
            <!-- Locutores en Turno Card -->
            <div class="bg-surface-container-low rounded-xl p-5 shadow-xl flex flex-col border border-white/5">
              <div class="flex items-center justify-between pb-3 mb-3 border-b border-white/5">
                <span class="font-label-sm text-label-sm text-primary uppercase font-bold tracking-wider"><?php echo esc_html(fuego_get_cabin_title()); ?></span>
                <span class="font-label-sm text-label-sm text-on-surface-variant"><?php echo esc_html(fuego_get_hosts_time()); ?></span>
              </div>
              <div class="flex items-center gap-3">
                <div class="relative w-16 h-16 rounded-full overflow-hidden flex-shrink-0 ring-2 ring-primary-container">
                  <img class="w-full h-full object-cover" alt="<?php echo esc_attr(fuego_get_hosts_names()); ?>" src="<?php echo esc_url(fuego_get_hosts_image()); ?>" />
                </div>
                <div class="min-w-0">
                  <h2 class="font-title-md text-title-md text-on-surface font-bold truncate">
                    <?php echo esc_html(fuego_get_hosts_names()); ?>
                  </h2>
                  <p class="font-body-sm text-body-sm text-on-surface-variant truncate">
                    <?php echo esc_html(fuego_get_hosts_tagline()); ?>
                  </p>
                  <div class="flex items-center gap-2 mt-1">
                    <?php 
                    $ig1 = fuego_get_hosts_ig1();
                    $url1 = fuego_get_hosts_url1();
                    $ig2 = fuego_get_hosts_ig2();
                    $url2 = fuego_get_hosts_url2();
                    ?>
                    <?php if (!empty($ig1)) : ?>
                      <a href="<?php echo esc_url($url1); ?>" target="_blank" rel="noopener noreferrer" class="font-label-sm text-label-sm text-secondary hover:text-white transition-colors underline-offset-2 hover:underline inline-flex items-center gap-1 cursor-pointer" title="<?php echo esc_attr(sprintf(__('Visitar perfil de %s', 'fuego-fm'), $ig1)); ?>">
                        <span class="material-symbols-outlined text-xs">open_in_new</span><?php echo esc_html($ig1); ?>
                      </a>
                    <?php endif; ?>
                    <?php if (!empty($ig1) && !empty($ig2)) : ?>
                      <span class="text-outline text-xs">·</span>
                    <?php endif; ?>
                    <?php if (!empty($ig2)) : ?>
                      <a href="<?php echo esc_url($url2); ?>" target="_blank" rel="noopener noreferrer" class="font-label-sm text-label-sm text-tertiary hover:text-white transition-colors underline-offset-2 hover:underline inline-flex items-center gap-1 cursor-pointer" title="<?php echo esc_attr(sprintf(__('Visitar perfil de %s', 'fuego-fm'), $ig2)); ?>">
                        <span class="material-symbols-outlined text-xs">open_in_new</span><?php echo esc_html($ig2); ?>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <!-- Audio Note to Studio Widget -->
              <div class="mt-4 bg-surface-container-high p-3 rounded-lg flex items-center justify-between gap-2">
                <div class="flex items-center gap-2 text-on-surface font-label-md text-label-md">
                  <span class="material-symbols-outlined text-primary-container">mic</span>
                  <span><?php echo esc_html(fuego_get_voicenote_text()); ?></span>
                </div>
                <button class="fuego-record-voice-btn px-3 py-1 bg-primary-container hover:bg-tertiary-container text-white text-xs font-bold rounded-full transition-all cursor-pointer" type="button">
                  <?php esc_html_e('Enviar', 'fuego-fm'); ?>
                </button>
              </div>
            </div>

            <!-- Recent Plays Feed Mini-Panel -->
            <div class="bg-surface-container-low rounded-xl p-5 shadow-xl flex-1 flex flex-col justify-between border border-white/5">
              <div>
                <div class="flex items-center justify-between mb-3">
                  <span class="font-label-sm text-label-sm text-on-surface uppercase font-bold tracking-wider"><?php echo esc_html(fuego_get_recent_title()); ?></span>
                  <span class="material-symbols-outlined text-on-surface-variant text-base">history</span>
                </div>
                <div class="space-y-2.5" id="fuego-recent-plays-list">
                  <?php foreach (fuego_get_recent_tracks() as $rec) : ?>
                    <div class="flex items-center justify-between gap-2 p-2 rounded-lg bg-surface-container/60 hover:bg-surface-container transition-colors">
                      <div class="flex items-center gap-2.5 min-w-0">
                        <span class="font-label-sm text-label-sm text-on-surface-variant w-4"><?php echo esc_html($rec['num']); ?></span>
                        <div class="min-w-0">
                          <p class="font-title-md text-sm text-on-surface font-semibold truncate leading-tight"><?php echo esc_html($rec['title']); ?></p>
                          <p class="font-body-sm text-xs text-on-surface-variant truncate"><?php echo esc_html($rec['artist']); ?></p>
                        </div>
                      </div>
                      <span class="text-xs text-on-surface-variant flex-shrink-0"><?php echo esc_html($rec['time']); ?></span>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <!-- Global Listener Metric Bar -->
              <div class="mt-4 pt-3 bg-surface-container/40 p-3 rounded-lg flex items-center justify-between border border-white/5">
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-secondary text-lg">signal_cellular_alt</span>
                  <span class="font-body-sm text-body-sm text-on-surface"><?php echo esc_html(fuego_get_signal_text()); ?></span>
                </div>
                <span class="font-label-sm text-label-sm text-primary font-bold"><?php echo esc_html(fuego_get_signal_uptime()); ?></span>
              </div>
            </div>

          </div>

        </div>
      </section>

      <!-- 2. AGENDA DE EVENTOS & CONCIERTOS LATINOS -->
      <section id="diales" class="relative w-full px-gutter max-w-7xl mx-auto py-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
          <div>
            <div class="flex items-center gap-2 font-label-sm text-label-sm text-secondary-container uppercase tracking-wider mb-2">
              <span class="material-symbols-outlined text-sm">confirmation_number</span> <?php echo esc_html(fuego_get_dials_badge()); ?>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface font-black tracking-tight leading-none">
              <?php echo esc_html(fuego_get_dials_title()); ?>
            </h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-2 max-w-xl">
              <?php echo esc_html(fuego_get_dials_subtitle()); ?>
            </p>
          </div>

          <!-- Filter Pills -->
          <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0">
            <button class="fuego-filter-pill px-4 py-1.5 bg-primary-container text-white rounded-full font-label-md text-label-md shadow-md flex-shrink-0 transition-all cursor-pointer font-bold" data-filter="all" type="button">
              <?php esc_html_e('Todos los Eventos', 'fuego-fm'); ?>
            </button>
            <button class="fuego-filter-pill px-4 py-1.5 bg-surface-container-high hover:bg-surface-container-highest text-on-surface-variant hover:text-on-surface rounded-full font-label-md text-label-md flex-shrink-0 transition-colors cursor-pointer" data-filter="Bachata" type="button">
              <?php esc_html_e('Bachata', 'fuego-fm'); ?>
            </button>
            <button class="fuego-filter-pill px-4 py-1.5 bg-surface-container-high hover:bg-surface-container-highest text-on-surface-variant hover:text-on-surface rounded-full font-label-md text-label-md flex-shrink-0 transition-colors cursor-pointer" data-filter="Salsa" type="button">
              <?php esc_html_e('Salsa', 'fuego-fm'); ?>
            </button>
            <button class="fuego-filter-pill px-4 py-1.5 bg-surface-container-high hover:bg-surface-container-highest text-on-surface-variant hover:text-on-surface rounded-full font-label-md text-label-md flex-shrink-0 transition-colors cursor-pointer" data-filter="Reguetón" type="button">
              <?php esc_html_e('Reguetón', 'fuego-fm'); ?>
            </button>
            <button class="fuego-filter-pill px-4 py-1.5 bg-surface-container-high hover:bg-surface-container-highest text-on-surface-variant hover:text-on-surface rounded-full font-label-md text-label-md flex-shrink-0 transition-colors cursor-pointer" data-filter="Festival" type="button">
              <?php esc_html_e('Festival Latino', 'fuego-fm'); ?>
            </button>
            <button class="fuego-filter-pill px-4 py-1.5 bg-surface-container-high hover:bg-surface-container-highest text-on-surface-variant hover:text-on-surface rounded-full font-label-md text-label-md flex-shrink-0 transition-colors cursor-pointer" data-filter="Remember" type="button">
              <?php esc_html_e('Remember 2000', 'fuego-fm'); ?>
            </button>
          </div>
        </div>

        <!-- Events Grid (Interactive Cards) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php foreach ($dials as $dial) : ?>
            <div class="fuego-dial-card fuego-event-card bg-surface-container-low rounded-xl p-5 hover:bg-surface-container transition-all shadow-xl group flex flex-col justify-between relative overflow-hidden border border-white/5 cursor-pointer" data-category="<?php echo esc_attr($dial['category']); ?>" data-event-id="<?php echo esc_attr($dial['id']); ?>">
              <div class="absolute top-0 right-0 w-28 h-28 bg-primary-container/10 rounded-full blur-2xl group-hover:bg-primary-container/20 transition-all"></div>
              <div>
                <div class="relative w-full h-48 rounded-lg overflow-hidden mb-4 bg-surface-container-highest">
                  <img class="fuego-dial-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?php echo esc_attr($dial['title']); ?>" src="<?php echo esc_url($dial['image']); ?>" />
                  <div class="absolute top-3 left-3 <?php echo esc_attr($dial['badge_bg'] . ' ' . $dial['badge_txt']); ?> font-label-sm text-label-sm px-2.5 py-1 rounded-full uppercase tracking-wider flex items-center gap-1 shadow-md font-bold">
                    <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span> <?php echo esc_html($dial['tag']); ?>
                  </div>
                  <div class="absolute bottom-3 right-3 bg-surface-container-lowest/85 backdrop-blur-md px-2.5 py-1 rounded-full text-xs text-on-surface font-semibold flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs text-secondary-container">schedule</span> <?php echo esc_html($dial['listeners']); ?>
                  </div>
                </div>
                <h3 class="fuego-dial-title font-headline-sm text-headline-sm text-on-surface font-bold group-hover:text-primary transition-colors">
                  <?php echo esc_html($dial['title']); ?>
                </h3>
                <p class="fuego-dial-genre font-body-sm text-body-sm text-primary font-semibold mt-0.5">
                  <?php echo esc_html($dial['genre']); ?>
                </p>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-2 line-clamp-3">
                  <?php echo esc_html($dial['artists']); ?>
                </p>
              </div>
              <div class="mt-5 pt-3 flex items-center justify-between border-t border-white/5">
                <span class="fuego-dial-dj font-label-sm text-label-sm text-on-surface-variant flex items-center gap-1 truncate max-w-[170px]" title="<?php echo esc_attr($dial['dj']); ?>">
                  <span class="material-symbols-outlined text-xs text-secondary-container">location_on</span> <?php echo esc_html($dial['dj']); ?>
                </span>
                <button class="fuego-dial-btn fuego-open-event-btn px-4 py-2 bg-primary-container hover:bg-tertiary-container text-white font-label-md text-label-md rounded-full flex items-center gap-1.5 shadow-md transition-all cursor-pointer font-bold" type="button" data-dial-id="<?php echo esc_attr($dial['id']); ?>" data-stream-url="<?php echo esc_url($dial['stream']); ?>" data-btn-text="<?php echo esc_attr($dial['btn_text'] ?? __('🎟️ Ver Evento', 'fuego-fm')); ?>">
                  <span class="material-symbols-outlined text-base">confirmation_number</span> <?php echo esc_html($dial['btn_text'] ?? __('🎟️ Ver Evento', 'fuego-fm')); ?>
                </button>
              </div>

              <!-- Pre-rendered Clean HTML for Modal (Bypasses any JS/JSON parsing issues) -->
              <div class="fuego-event-clean-html" style="display:none;" aria-hidden="true">
                <?php echo wp_kses_post($dial['content']); ?>
              </div>

              <!-- Embedded JSON Data for Event Details Modal -->
              <script type="application/json" class="fuego-event-data">
                <?php echo json_encode($dial, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); ?>
              </script>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 3. TOP 10 RANKING SEMANAL: 'EL TERMÓMETRO LATINO' & PROGRAMACIÓN (Split Panel Bento) -->
      <section id="ranking" class="relative w-full px-gutter max-w-7xl mx-auto py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          
          <!-- Left Column: El Termómetro Latino (7 cols) -->
          <div class="lg:col-span-7 bg-surface-container-low rounded-xl p-6 sm:p-8 shadow-2xl border border-white/5">
            <div class="flex items-center justify-between mb-6">
              <div>
                <div class="flex items-center gap-2 text-primary font-label-sm text-label-sm uppercase tracking-wider mb-1">
                  <span class="material-symbols-outlined text-sm">local_fire_department</span> <?php echo esc_html(fuego_get_ranking_badge()); ?>
                </div>
                <h2 class="font-headline-md text-headline-md text-on-surface font-extrabold tracking-tight">
                  <?php echo esc_html(fuego_get_ranking_title()); ?>
                </h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                  <?php echo esc_html(fuego_get_ranking_subtitle()); ?>
                </p>
              </div>
              <span class="bg-primary-container/20 text-primary-container font-label-sm text-label-sm px-3 py-1 rounded-full uppercase font-bold">
                <?php esc_html_e('SEMANA', 'fuego-fm'); ?> <?php echo date('W'); ?>
              </span>
            </div>

            <!-- Top Track Entries -->
            <div class="space-y-3">
              <?php foreach ($ranking as $item) : ?>
                <?php if (!empty($item['is_grand'])) : ?>
                  <!-- Rank #1 Grand Highlight -->
                  <div class="p-4 rounded-xl bg-gradient-to-r from-surface-container to-surface-container-high flex items-center justify-between gap-4 shadow-lg border border-secondary-container/20">
                    <div class="flex items-center gap-4 min-w-0">
                      <span class="font-headline-md text-headline-md font-black text-secondary-container w-8 text-center"><?php echo esc_html($item['rank']); ?></span>
                      <div class="w-14 h-14 rounded-lg overflow-hidden flex-shrink-0 bg-surface-container-highest">
                        <img class="w-full h-full object-cover" alt="<?php echo esc_attr($item['title']); ?>" src="<?php echo esc_url($item['image']); ?>"/>
                      </div>
                      <div class="min-w-0">
                        <div class="flex items-center gap-2">
                          <h3 class="font-title-md text-title-md text-on-surface font-bold truncate"><?php echo esc_html($item['title']); ?></h3>
                          <span class="text-xs font-bold px-1.5 py-0.5 rounded <?php echo esc_attr($item['trend_class']); ?>"><?php echo esc_html($item['trend']); ?></span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant truncate"><?php echo esc_html($item['artist']); ?></p>
                        <p id="track-votes-<?php echo esc_attr($item['id']); ?>" class="font-label-sm text-label-sm text-secondary mt-0.5">
                          <?php echo number_format($item['votes']); ?> <?php esc_html_e('Votos registrados', 'fuego-fm'); ?>
                        </p>
                      </div>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                      <button class="fuego-toggle-play w-10 h-10 rounded-full bg-primary-container hover:bg-tertiary-container text-white flex items-center justify-center shadow-md transition-all cursor-pointer" type="button" aria-label="<?php esc_attr_e('Reproducir tema', 'fuego-fm'); ?>">
                        <span class="material-symbols-outlined text-xl">play_arrow</span>
                      </button>
                      <button class="fuego-vote-btn px-3 py-1.5 bg-surface-container-highest hover:bg-surface-bright text-on-surface font-label-sm text-label-sm rounded-full transition-colors cursor-pointer" type="button" data-track-id="<?php echo esc_attr($item['id']); ?>" data-track-title="<?php echo esc_attr($item['title']); ?>">
                        <?php esc_html_e('Votar', 'fuego-fm'); ?>
                      </button>
                    </div>
                  </div>
                <?php else : ?>
                  <!-- Rank #2 - #5 Items -->
                  <div class="p-3.5 rounded-xl bg-surface-container hover:bg-surface-container-high flex items-center justify-between gap-4 transition-colors">
                    <div class="flex items-center gap-4 min-w-0">
                      <span class="font-title-md text-title-md font-bold text-on-surface-variant w-8 text-center"><?php echo esc_html($item['rank']); ?></span>
                      <div class="w-12 h-12 rounded-lg overflow-hidden flex-shrink-0 bg-surface-container-highest">
                        <img class="w-full h-full object-cover" alt="<?php echo esc_attr($item['title']); ?>" src="<?php echo esc_url($item['image']); ?>"/>
                      </div>
                      <div class="min-w-0">
                        <div class="flex items-center gap-2">
                          <h3 class="font-body-lg text-body-lg text-on-surface font-semibold truncate"><?php echo esc_html($item['title']); ?></h3>
                          <span class="text-xs font-bold px-1.5 py-0.5 rounded <?php echo esc_attr($item['trend_class']); ?>"><?php echo esc_html($item['trend']); ?></span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant truncate"><?php echo esc_html($item['artist']); ?></p>
                        <p id="track-votes-<?php echo esc_attr($item['id']); ?>" class="font-body-sm text-xs text-on-surface-variant/80 mt-0.5">
                          <?php echo number_format($item['votes']); ?> <?php esc_html_e('votos', 'fuego-fm'); ?>
                        </p>
                      </div>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                      <button class="fuego-toggle-play w-9 h-9 rounded-full bg-surface-container-highest hover:bg-primary-container hover:text-white text-on-surface flex items-center justify-center transition-all cursor-pointer" type="button" aria-label="<?php esc_attr_e('Escuchar', 'fuego-fm'); ?>">
                        <span class="material-symbols-outlined text-lg">play_arrow</span>
                      </button>
                      <button class="fuego-vote-btn px-3 py-1.5 bg-surface-container-highest hover:bg-surface-bright text-on-surface font-label-sm text-label-sm rounded-full transition-colors cursor-pointer" type="button" data-track-id="<?php echo esc_attr($item['id']); ?>" data-track-title="<?php echo esc_attr($item['title']); ?>">
                        <?php esc_html_e('Votar', 'fuego-fm'); ?>
                      </button>
                    </div>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Right Column: Parrilla del Día (5 cols) -->
          <div id="programacion" class="lg:col-span-5 flex flex-col gap-6">
            <div class="bg-surface-container-low rounded-xl p-6 sm:p-8 shadow-2xl border border-white/5">
              <div class="flex items-center justify-between mb-6">
                <div>
                  <span class="text-primary font-label-sm text-label-sm uppercase tracking-wider block font-bold"><?php esc_html_e('HORARIO DE TRANSMISIÓN', 'fuego-fm'); ?></span>
                  <h3 class="font-headline-md text-headline-md text-on-surface font-bold tracking-tight"><?php esc_html_e('PARRILLA DE HOY', 'fuego-fm'); ?></h3>
                </div>
                <span class="font-label-sm text-label-sm text-secondary-container bg-surface-container px-3 py-1 rounded-full"><?php esc_html_e('EN DIRECTO', 'fuego-fm'); ?></span>
              </div>

              <!-- Schedule List with Active Highlight -->
              <div class="space-y-4">
                <?php foreach ($shows as $show) : ?>
                  <?php if ($show['status'] === 'live') : ?>
                    <!-- Current Active Show -->
                    <div class="p-4 rounded-lg bg-primary-container/15 flex items-center gap-3 relative overflow-hidden shadow-md border-l-4 border-primary-container">
                      <div class="text-primary-container font-label-sm text-label-sm w-24 font-bold flex flex-col">
                        <span><?php echo esc_html($show['time']); ?></span>
                        <span class="text-[10px] text-tertiary uppercase"><?php esc_html_e('EN EL AIRE', 'fuego-fm'); ?></span>
                      </div>
                      <div class="min-w-0 flex-1 pl-1">
                        <p class="font-title-md text-title-md text-on-surface font-bold truncate"><?php echo esc_html($show['title']); ?></p>
                        <p class="font-body-sm text-body-sm text-primary truncate"><?php echo esc_html($show['host']); ?></p>
                      </div>
                      <div class="w-2.5 h-2.5 rounded-full bg-primary-container animate-ping flex-shrink-0"></div>
                    </div>
                  <?php else : ?>
                    <!-- Past or Upcoming Show -->
                    <div class="p-3.5 rounded-lg bg-surface-container/60 flex items-center gap-3">
                      <div class="text-on-surface-variant font-label-sm text-label-sm w-24"><?php echo esc_html($show['time']); ?></div>
                      <div class="min-w-0 flex-1">
                        <p class="font-body-md text-body-md text-on-surface font-semibold truncate"><?php echo esc_html($show['title']); ?></p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant truncate"><?php echo esc_html($show['host']); ?></p>
                      </div>
                      <span class="material-symbols-outlined text-outline text-sm"><?php echo esc_html($show['status_tag']); ?></span>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- DJ On Call Feature Card -->
            <div class="bg-gradient-to-br from-surface-container-low to-surface-container rounded-xl p-5 flex items-center gap-4 shadow-xl border border-white/5">
              <div class="w-16 h-16 rounded-xl overflow-hidden bg-surface-container-highest flex-shrink-0">
                <img class="w-full h-full object-cover" alt="Sofía Santos" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/sofia-featured.jpg'); ?>"/>
              </div>
              <div class="min-w-0 flex-1">
                <span class="text-xs uppercase text-tertiary font-bold tracking-wider"><?php esc_html_e('LOCUTORA DESTACADA DEL MES', 'fuego-fm'); ?></span>
                <h4 class="font-title-md text-title-md text-on-surface font-bold truncate">Sofía Santos</h4>
                <p class="font-body-sm text-body-sm text-on-surface-variant"><?php esc_html_e('Voz oficial de \'La Batidora\' · 890k seguidores', 'fuego-fm'); ?></p>
              </div>
            </div>

          </div>

        </div>
      </section>

      <!-- 4. COMUNIDAD Y MURO EN VIVO DESDE CABINA -->
      <section id="comunidad" class="relative w-full px-gutter max-w-7xl mx-auto py-12">
        <div class="bg-surface-container-low rounded-2xl p-6 sm:p-10 shadow-2xl relative overflow-hidden border border-white/5">
          <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8 pb-6 bg-surface-container/30 -mx-6 -mt-6 sm:-mx-10 sm:-mt-10 p-6 sm:p-10 border-b border-white/5">
            <div>
              <div class="flex items-center gap-2 text-primary font-label-sm text-label-sm uppercase tracking-wider mb-1">
                <span class="material-symbols-outlined text-sm">forum</span> <?php echo esc_html(fuego_get_wall_badge()); ?>
              </div>
              <h2 class="font-headline-lg text-headline-lg text-on-surface font-black tracking-tight">
                <?php echo esc_html(fuego_get_wall_title()); ?>
              </h2>
              <p class="font-body-md text-body-md text-on-surface-variant mt-1">
                <?php echo esc_html(fuego_get_wall_subtitle()); ?>
              </p>
            </div>
            <div class="flex items-center gap-3">
              <a class="px-5 py-2.5 bg-[#25D366] hover:bg-[#20ba5a] text-[#073816] font-label-md text-label-md font-bold rounded-full flex items-center gap-2 shadow-lg transition-all" href="<?php echo esc_url(fuego_get_whatsapp_url()); ?>" rel="noopener noreferrer" target="_blank">
                <span class="material-symbols-outlined text-lg">call</span>
                <?php echo esc_html(fuego_get_whatsapp_btn_text()); ?>
              </a>
            </div>
          </div>

          <!-- Live Messages Grid (Shoutouts) -->
          <div id="fuego-shoutouts-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <?php foreach ($shoutouts as $msg) : ?>
              <div class="bg-surface-container p-4 rounded-xl flex flex-col justify-between border border-white/5">
                <div>
                  <div class="flex items-center justify-between mb-2">
                    <span class="font-label-sm text-label-sm font-bold text-on-surface"><?php echo esc_html($msg['author']); ?></span>
                    <span class="font-label-sm text-label-sm <?php echo esc_attr($msg['loc_color']); ?>"><?php echo esc_html($msg['location']); ?></span>
                  </div>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">
                    "<?php echo esc_html($msg['message']); ?>"
                  </p>
                </div>
                <div class="flex items-center justify-between mt-3 pt-2 text-xs text-outline border-t border-white/5">
                  <span><?php echo esc_html($msg['time_ago']); ?></span>
                  <span class="fuego-like-shoutout text-primary flex items-center gap-1 cursor-pointer hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-xs">favorite</span>
                    <span class="fuego-like-count"><?php echo esc_html($msg['likes']); ?></span>
                  </span>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Fast Message Input Box (AJAX Form) -->
          <form id="fuego-shoutout-form" class="bg-surface-container-highest/80 p-3 rounded-xl flex flex-col sm:flex-row items-center gap-3">
            <input id="fuego-shoutout-input" class="w-full bg-transparent text-on-surface font-body-md text-body-md placeholder:text-on-surface-variant/60 px-3 py-2 outline-none" placeholder="<?php echo esc_attr(fuego_get_wall_placeholder()); ?>" type="text" />
            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
              <button class="w-10 h-10 rounded-full bg-surface-container hover:bg-surface-bright text-on-surface flex items-center justify-center transition-colors cursor-pointer" type="button" aria-label="<?php esc_attr_e('Emoji', 'fuego-fm'); ?>">
                <span class="material-symbols-outlined text-lg">sentiment_satisfied</span>
              </button>
              <button class="px-5 py-2.5 bg-primary-container hover:bg-tertiary-container text-white font-label-md text-label-md rounded-full font-bold shadow-md transition-all flex items-center gap-1.5 flex-shrink-0 cursor-pointer" type="submit">
                <span class="material-symbols-outlined text-base">send</span>
                <?php esc_html_e('Enviar Saludo', 'fuego-fm'); ?>
              </button>
            </div>
          </form>

        </div>
      </section>

      <!-- 5. BANNER MULTIPLATAFORMA & APP MÓVIL CON CARPLAY -->
      <section id="app" class="relative w-full px-gutter max-w-7xl mx-auto py-12 mb-10">
        <div class="bg-gradient-to-r from-surface-container-low via-surface-container to-surface-container-low rounded-2xl p-8 sm:p-12 shadow-2xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8 border border-white/5">
          
          <!-- Glow Blob in banner -->
          <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-primary-container/20 rounded-full blur-3xl pointer-events-none"></div>

          <div class="max-w-xl text-center lg:text-left">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-secondary-container/20 text-secondary-container rounded-full font-label-sm text-label-sm uppercase tracking-wider mb-3">
              <span class="material-symbols-outlined text-sm">directions_car</span> <?php esc_html_e('APPLE CARPLAY & ANDROID AUTO READY', 'fuego-fm'); ?>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface font-black tracking-tight leading-tight">
              <?php esc_html_e('LLEVA EL FUEGO EN CADA KILÓMETRO', 'fuego-fm'); ?>
            </h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-3">
              <?php esc_html_e('Descarga la App oficial. Audio espacial Hi-Res, modo offline para tus rankings preferidos y compatibilidad total con el tablero de tu auto.', 'fuego-fm'); ?>
            </p>

            <!-- Store Badges -->
            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 mt-6">
              <a class="px-5 py-3 bg-surface-container-highest hover:bg-surface-bright text-on-surface rounded-xl flex items-center gap-3 transition-colors shadow-lg" href="<?php echo esc_url(fuego_get_app_store_url()); ?>">
                <span class="material-symbols-outlined text-3xl">phone_iphone</span>
                <div class="text-left">
                  <span class="block text-[10px] text-on-surface-variant uppercase leading-none"><?php esc_html_e('Disponible en', 'fuego-fm'); ?></span>
                  <span class="font-title-md text-title-md font-bold leading-tight">App Store</span>
                </div>
              </a>
              <a class="px-5 py-3 bg-surface-container-highest hover:bg-surface-bright text-on-surface rounded-xl flex items-center gap-3 transition-colors shadow-lg" href="<?php echo esc_url(fuego_get_google_play_url()); ?>">
                <span class="material-symbols-outlined text-3xl">android</span>
                <div class="text-left">
                  <span class="block text-[10px] text-on-surface-variant uppercase leading-none"><?php esc_html_e('Disponible en', 'fuego-fm'); ?></span>
                  <span class="font-title-md text-title-md font-bold leading-tight">Google Play</span>
                </div>
              </a>
            </div>
          </div>

          <!-- Smartphone Mockup Display -->
          <div class="flex items-center gap-6 flex-shrink-0">
            <div class="relative w-48 sm:w-56 h-80 sm:h-96 rounded-2xl bg-surface-container-highest p-3 shadow-2xl flex flex-col justify-between overflow-hidden border border-white/10">
              <div class="w-full h-full rounded-xl overflow-hidden relative">
                <img class="w-full h-full object-cover" alt="Fuego FM Mobile App" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/app-mockup.png'); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-surface-container-lowest via-transparent to-transparent"></div>
                <div class="absolute bottom-3 left-3 right-3 text-center">
                  <span class="font-label-sm text-label-sm text-primary font-bold">4.9 ★★★★★</span>
                  <span class="block text-[10px] text-on-surface-variant"><?php esc_html_e('+2M Descargas', 'fuego-fm'); ?></span>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>

    </div>
  </div>
</main>

<?php
get_footer();
