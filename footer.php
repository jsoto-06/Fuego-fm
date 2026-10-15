<?php
/**
 * Fuego FM - Footer Template & Persistent Audio Streaming Dock
 *
 * @package Fuego_FM
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

  <!-- Main Site Footer -->
  <footer class="w-full bg-surface-container-lowest pt-14 pb-36 sm:pb-44 border-t border-white/10 relative z-20">
    <div class="w-full px-gutter max-w-7xl mx-auto">
      
      <!-- 4-Column Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-10 mb-12">
        
        <!-- Column 1: Station Brand & Live Badge (5 cols) -->
        <div class="lg:col-span-5 space-y-4">
          <div class="flex items-center gap-3">
            <a class="flex items-center gap-2 group" href="<?php echo esc_url(home_url('/')); ?>">
              <img alt="KLK Radio 47" class="h-10 w-auto object-contain transition-transform group-hover:scale-105" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>"/>
              <span class="font-headline-md text-headline-md text-on-surface font-black tracking-tight">KLK<span class="text-primary-container"> RADIO 47</span></span>
            </a>
          </div>
          <p class="text-on-surface-variant font-body-md text-sm max-w-md leading-relaxed">
            <?php esc_html_e('La estación de radio oficial de la música latina las 24 horas: Salsa brava, Bachata, Reggaetón y Dembow transmitiendo en directo en alta fidelidad.', 'fuego-fm'); ?>
          </p>
          <div class="flex items-center gap-3 flex-wrap">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-high/60 border border-white/5 text-xs text-secondary-container">
              <span class="w-2 h-2 rounded-full bg-primary-container animate-live-dot"></span>
              <span class="font-bold">SEÑAL HD 320 KBPS</span>
            </div>
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-high/60 border border-white/5 text-xs text-on-surface-variant">
              <span class="material-symbols-outlined text-sm text-primary">radio</span>
              <span>ShoutCast v2</span>
            </div>
          </div>
        </div>

        <!-- Column 2: Nuestra Emisora (3 cols) -->
        <div class="lg:col-span-3 space-y-3">
          <h3 class="text-on-surface font-title-md text-sm uppercase tracking-wider font-bold">
            <?php esc_html_e('Nuestra Emisora', 'fuego-fm'); ?>
          </h3>
          <ul class="space-y-2 text-sm text-on-surface-variant">
            <li>
              <a class="hover:text-primary transition-colors flex items-center gap-1.5" href="<?php echo esc_url(fuego_get_about_url()); ?>">
                <span class="material-symbols-outlined text-xs text-primary">arrow_forward</span>
                <span class="font-semibold text-on-surface hover:text-primary"><?php esc_html_e('Acerca de nosotros', 'fuego-fm'); ?></span>
              </a>
            </li>
            <li>
              <a class="hover:text-primary transition-colors flex items-center gap-1.5" href="<?php echo esc_url(fuego_get_contact_url()); ?>">
                <span class="material-symbols-outlined text-xs text-primary">arrow_forward</span>
                <span class="font-semibold text-on-surface hover:text-primary"><?php esc_html_e('Contáctenos', 'fuego-fm'); ?></span>
              </a>
            </li>
            <li>
              <a class="hover:text-primary transition-colors flex items-center gap-1.5" href="<?php echo esc_url(home_url('/#diales')); ?>">
                <span class="material-symbols-outlined text-xs text-on-surface-variant">confirmation_number</span>
                <?php esc_html_e('Agenda de Eventos', 'fuego-fm'); ?>
              </a>
            </li>
            <li>
              <a class="hover:text-primary transition-colors flex items-center gap-1.5" href="<?php echo esc_url(home_url('/#programacion')); ?>">
                <span class="material-symbols-outlined text-xs text-on-surface-variant">schedule</span>
                <?php esc_html_e('Programación y Shows', 'fuego-fm'); ?>
              </a>
            </li>
            <li>
              <a class="hover:text-primary transition-colors flex items-center gap-1.5" href="<?php echo esc_url(home_url('/#ranking')); ?>">
                <span class="material-symbols-outlined text-xs text-on-surface-variant">local_fire_department</span>
                <?php esc_html_e('El Termómetro Latino', 'fuego-fm'); ?>
              </a>
            </li>
          </ul>
        </div>

        <!-- Column 3: Legal & Normativa (2 cols) -->
        <div class="lg:col-span-2 space-y-3">
          <h3 class="text-on-surface font-title-md text-sm uppercase tracking-wider font-bold">
            <?php esc_html_e('Legal & Términos', 'fuego-fm'); ?>
          </h3>
          <ul class="space-y-2 text-sm text-on-surface-variant">
            <li>
              <a class="hover:text-primary transition-colors flex items-center gap-1.5" href="<?php echo esc_url(fuego_get_privacy_url()); ?>">
                <span class="material-symbols-outlined text-xs text-primary">arrow_forward</span>
                <span class="font-semibold text-on-surface hover:text-primary"><?php esc_html_e('Política de privacidad', 'fuego-fm'); ?></span>
              </a>
            </li>
            <li>
              <a class="hover:text-primary transition-colors flex items-center gap-1.5" href="<?php echo esc_url(fuego_get_terms_url()); ?>">
                <span class="material-symbols-outlined text-xs text-primary">arrow_forward</span>
                <span class="font-semibold text-on-surface hover:text-primary"><?php esc_html_e('Términos del servicio', 'fuego-fm'); ?></span>
              </a>
            </li>
            <li>
              <a class="hover:text-primary transition-colors flex items-center gap-1.5" href="<?php echo esc_url(home_url('/#comunidad')); ?>">
                <span class="material-symbols-outlined text-xs text-on-surface-variant">forum</span>
                <?php esc_html_e('Muro de Oyentes', 'fuego-fm'); ?>
              </a>
            </li>
          </ul>
        </div>

        <!-- Column 4: Contacto Rápido & WhatsApp (2 cols) -->
        <div class="lg:col-span-2 space-y-3">
          <h3 class="text-on-surface font-title-md text-sm uppercase tracking-wider font-bold">
            <?php esc_html_e('Cabina Directa', 'fuego-fm'); ?>
          </h3>
          <div class="space-y-3">
            <a href="<?php echo esc_url(fuego_get_whatsapp_url()); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-green-500/20 hover:bg-green-500/30 text-green-400 border border-green-500/30 text-xs font-bold transition-all shadow-sm group w-full justify-center">
              <span class="material-symbols-outlined text-base group-hover:scale-110 transition-transform">chat</span>
              <span><?php esc_html_e('WhatsApp Cabina', 'fuego-fm'); ?></span>
            </a>
            <p class="text-xs text-on-surface-variant">
              <?php esc_html_e('Locutor al aire:', 'fuego-fm'); ?> <strong class="text-white"><?php echo esc_html(fuego_get_hosts_names()); ?></strong>
            </p>
          </div>
        </div>

      </div>

      <!-- Bottom Bar with Copyright and Horizontal Links -->
      <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-xs text-on-surface-variant text-center md:text-left">
          <?php echo esc_html(fuego_get_footer_copyright()); ?>
        </p>

        <!-- Quick Access Navigation Pills -->
        <nav aria-label="<?php esc_attr_e('Enlaces estáticos oficiales', 'fuego-fm'); ?>" class="flex items-center gap-2 sm:gap-3 flex-wrap justify-center text-xs">
          <a class="px-3 py-1 rounded-full bg-surface-container-high/60 hover:bg-surface-container-highest text-on-surface font-medium border border-white/5 hover:border-primary/40 transition-colors" href="<?php echo esc_url(fuego_get_about_url()); ?>">
            <?php esc_html_e('Acerca de nosotros', 'fuego-fm'); ?>
          </a>
          <a class="px-3 py-1 rounded-full bg-surface-container-high/60 hover:bg-surface-container-highest text-on-surface font-medium border border-white/5 hover:border-primary/40 transition-colors" href="<?php echo esc_url(fuego_get_contact_url()); ?>">
            <?php esc_html_e('Contáctenos', 'fuego-fm'); ?>
          </a>
          <a class="px-3 py-1 rounded-full bg-surface-container-high/60 hover:bg-surface-container-highest text-on-surface font-medium border border-white/5 hover:border-primary/40 transition-colors" href="<?php echo esc_url(fuego_get_privacy_url()); ?>">
            <?php esc_html_e('Política de privacidad', 'fuego-fm'); ?>
          </a>
          <a class="px-3 py-1 rounded-full bg-surface-container-high/60 hover:bg-surface-container-highest text-on-surface font-medium border border-white/5 hover:border-primary/40 transition-colors" href="<?php echo esc_url(fuego_get_terms_url()); ?>">
            <?php esc_html_e('Términos del servicio', 'fuego-fm'); ?>
          </a>
        </nav>
      </div>

    </div>
  </footer>

  <!-- PERSISTENT MASTER AUDIO STREAMING DOCK (STATION PLAYER) -->
  <div class="fuego-bottom-dock fixed bottom-0 left-0 right-0 z-50 h-20 sm:h-24 bg-surface-container-lowest/95 backdrop-blur-2xl shadow-[0_-8px_32px_rgba(0,0,0,0.8)] border-t border-primary-container/20">
    <!-- Slim top progress line for mobile -->
    <div class="sm:hidden w-full h-[2px] bg-surface-container-high overflow-hidden">
      <div class="fuego-progress-bar-fill h-full bg-secondary-container w-2/3 transition-all"></div>
    </div>

    <div class="h-full w-full px-3 sm:px-gutter flex items-center justify-between gap-2 sm:gap-space-md">
      
      <!-- Left Track & Station Metadata -->
      <div class="flex items-center gap-2 sm:gap-space-md min-w-0 max-w-[170px] sm:max-w-[340px] xl:max-w-md">
        <div class="relative w-11 h-11 sm:w-14 sm:h-14 rounded-lg bg-surface-container-highest flex-shrink-0 overflow-hidden flex items-center justify-center shadow-lg">
          <img id="fuego-dock-cover" alt="Current Cover" class="w-full h-full object-cover fuego-vinyl-art" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/album-titi.jpg'); ?>"/>
          <div class="absolute inset-0 bg-primary-container/10"></div>
        </div>
        <div class="min-w-0 flex flex-col justify-center">
          <span id="fuego-dock-title" class="font-title-md text-sm sm:text-title-md text-on-surface font-bold truncate leading-tight">Tití Me Preguntó</span>
          <span id="fuego-dock-artist" class="font-body-sm text-xs sm:text-body-sm text-on-surface-variant truncate">Bad Bunny · Un Verano Sin Ti</span>
          <div class="hidden sm:flex items-center gap-space-xs mt-0.5">
            <span class="material-symbols-outlined text-primary text-xs">graphic_eq</span>
            <span id="fuego-dock-tag" class="font-label-sm text-[10px] sm:text-label-sm text-primary uppercase">KLK Radio 47 Master HD</span>
          </div>
        </div>
        <button class="hidden md:inline-flex text-on-surface-variant hover:text-tertiary-container transition-colors ml-space-xs" type="button" aria-label="<?php esc_attr_e('Favorito', 'fuego-fm'); ?>">
          <span class="material-symbols-outlined text-xl">favorite</span>
        </button>
      </div>

      <!-- Center Playback Controls & Progress Scrubber -->
      <div class="flex flex-col items-center gap-1 sm:gap-space-xs flex-1 max-w-xl px-1 sm:px-space-md">
        <div class="flex items-center gap-3 sm:gap-space-lg">
          <button class="text-on-surface-variant hover:text-on-surface transition-colors cursor-pointer" type="button" aria-label="<?php esc_attr_e('Anterior', 'fuego-fm'); ?>">
            <span class="material-symbols-outlined text-lg sm:text-xl">skip_previous</span>
          </button>
          
          <!-- Master Dock Play/Pause Button -->
          <button class="fuego-toggle-play w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-primary-container hover:bg-tertiary-container text-white flex items-center justify-center shadow-[0_0_24px_rgba(255,87,34,0.55)] transition-all cursor-pointer hover:scale-105 active:scale-95 flex-shrink-0" type="button" aria-label="<?php esc_attr_e('Reproducir / Pausar', 'fuego-fm'); ?>">
            <span class="material-symbols-outlined text-xl sm:text-2xl fuego-play-icon">play_arrow</span>
          </button>
          
          <button class="text-on-surface-variant hover:text-on-surface transition-colors cursor-pointer" type="button" aria-label="<?php esc_attr_e('Siguiente', 'fuego-fm'); ?>">
            <span class="material-symbols-outlined text-lg sm:text-xl">skip_next</span>
          </button>
        </div>
        
        <!-- Live Stream Audio Bar / Scrubber (Desktop/Tablet) -->
        <div class="hidden sm:flex w-full items-center gap-space-sm">
          <span class="fuego-current-time font-body-sm text-body-sm text-on-surface-variant w-12 text-right">00:00</span>
          <div class="flex-1 h-1.5 bg-surface-container-high rounded-full overflow-hidden relative cursor-pointer">
            <div class="fuego-progress-bar-fill h-full bg-secondary-container rounded-full w-2/3 transition-all"></div>
          </div>
          <span class="font-body-sm text-body-sm text-secondary-container font-semibold w-12 flex items-center gap-1">
            <span class="w-1.5 h-1.5 rounded-full bg-primary-container animate-pulse"></span> LIVE
          </span>
        </div>
      </div>

      <!-- Right Area: Equalizer Waveform, Active Listeners, Bitrate & Volume -->
      <div class="flex items-center gap-2 sm:gap-space-lg flex-shrink-0">
        
        <!-- Mobile mini LIVE pill -->
        <div class="flex sm:hidden items-center gap-1 bg-surface-container-high/60 px-2 py-0.5 rounded-full">
          <span class="w-1.5 h-1.5 rounded-full bg-primary-container animate-pulse"></span>
          <span class="text-[10px] font-bold text-secondary-container">LIVE</span>
        </div>

        <!-- Equalizer Waveform Bars -->
        <div class="hidden xl:flex items-center gap-1.5 h-6 px-space-sm bg-surface-container-low rounded-lg">
          <div class="w-1 bg-secondary-container rounded-full waveform-bar paused"></div>
          <div class="w-1 bg-primary-container rounded-full waveform-bar paused"></div>
          <div class="w-1 bg-tertiary-container rounded-full waveform-bar paused"></div>
          <div class="w-1 bg-secondary-container rounded-full waveform-bar paused"></div>
          <div class="w-1 bg-primary rounded-full waveform-bar paused"></div>
        </div>

        <!-- Real-time Listeners Badge -->
        <div class="hidden md:flex items-center gap-space-xs bg-surface-container-low px-space-md py-1.5 rounded-full shadow-sm">
          <span class="material-symbols-outlined text-secondary-container text-sm">headset</span>
          <span class="font-label-sm text-label-sm text-on-surface font-semibold"><?php echo esc_html(fuego_get_listeners_count()); ?></span>
        </div>

        <!-- Bitrate Format -->
        <div class="hidden lg:flex items-center gap-space-xs">
          <span class="bg-surface-container-high text-secondary-container font-label-sm text-label-sm px-2 py-0.5 rounded"><?php echo esc_html(fuego_get_bitrate()); ?></span>
        </div>

        <!-- Volume Controller -->
        <div class="hidden sm:flex items-center gap-space-xs">
          <button class="fuego-volume-mute-btn text-on-surface-variant hover:text-on-surface transition-colors" type="button" aria-label="<?php esc_attr_e('Silenciar / Reactivar volumen', 'fuego-fm'); ?>">
            <span class="material-symbols-outlined text-lg fuego-volume-icon">volume_up</span>
          </button>
          <div class="w-20 flex items-center">
            <input class="fuego-volume-slider fuego-slider w-full" type="range" min="0" max="100" value="80" aria-label="<?php esc_attr_e('Control de volumen', 'fuego-fm'); ?>" />
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- POPUP MODAL: PEDIR CANCIÓN / SOLICITUD A CABINA -->
  <div id="fuego-request-modal" class="fuego-modal-backdrop">
    <div class="fuego-modal-card p-6 sm:p-8">
      <div class="flex items-center justify-between pb-4 border-b border-white/10 mb-6">
        <div class="flex items-center gap-2">
          <span class="material-symbols-outlined text-primary-container text-2xl">queue_music</span>
          <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold"><?php esc_html_e('Pedir Canción a Cabina', 'fuego-fm'); ?></h3>
        </div>
        <button id="fuego-close-request-modal" class="w-8 h-8 rounded-full bg-surface-container-high hover:bg-surface-container-highest text-on-surface flex items-center justify-center transition-colors" type="button">
          <span class="material-symbols-outlined text-lg">close</span>
        </button>
      </div>
      
      <form id="fuego-request-form" class="space-y-4">
        <div>
          <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1" for="fuego-req-name"><?php esc_html_e('Tu Nombre o Apodo', 'fuego-fm'); ?></label>
          <input id="fuego-req-name" name="name" required class="w-full bg-surface-container-high text-on-surface px-4 py-2.5 rounded-lg outline-none focus:ring-2 focus:ring-primary-container text-body-md" placeholder="<?php esc_attr_e('Ej. Carlos de Medellín', 'fuego-fm'); ?>" type="text" />
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1" for="fuego-req-song"><?php esc_html_e('Canción / Tema', 'fuego-fm'); ?></label>
            <input id="fuego-req-song" name="song" required class="w-full bg-surface-container-high text-on-surface px-4 py-2.5 rounded-lg outline-none focus:ring-2 focus:ring-primary-container text-body-md" placeholder="<?php esc_attr_e('Ej. Tití Me Preguntó', 'fuego-fm'); ?>" type="text" />
          </div>
          <div>
            <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1" for="fuego-req-artist"><?php esc_html_e('Artista', 'fuego-fm'); ?></label>
            <input id="fuego-req-artist" name="artist" required class="w-full bg-surface-container-high text-on-surface px-4 py-2.5 rounded-lg outline-none focus:ring-2 focus:ring-primary-container text-body-md" placeholder="<?php esc_attr_e('Ej. Bad Bunny', 'fuego-fm'); ?>" type="text" />
          </div>
        </div>
        <div>
          <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1" for="fuego-req-dedication"><?php esc_html_e('Dedicatoria o Mensaje al Aire', 'fuego-fm'); ?></label>
          <textarea id="fuego-req-dedication" name="dedication" rows="2" class="w-full bg-surface-container-high text-on-surface px-4 py-2 rounded-lg outline-none focus:ring-2 focus:ring-primary-container text-body-md" placeholder="<?php esc_attr_e('Un saludo para el combo que está escuchando en el trabajo...', 'fuego-fm'); ?>"></textarea>
        </div>
        <div>
          <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1" for="fuego-req-phone"><?php esc_html_e('WhatsApp o Teléfono (Opcional para llamada al aire)', 'fuego-fm'); ?></label>
          <input id="fuego-req-phone" name="phone" class="w-full bg-surface-container-high text-on-surface px-4 py-2.5 rounded-lg outline-none focus:ring-2 focus:ring-primary-container text-body-md" placeholder="<?php esc_attr_e('+1 234 567 8900', 'fuego-fm'); ?>" type="text" />
        </div>
        <div class="pt-2 flex justify-end gap-3">
          <button class="px-6 py-2.5 bg-primary-container hover:bg-tertiary-container text-white font-label-md text-label-md font-bold rounded-full shadow-lg transition-all" type="submit">
            <?php esc_html_e('Enviar Pedido a Cabina', 'fuego-fm'); ?>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL INTERACTIVO DE DETALLES DEL EVENTO -->
  <div id="fuego-event-modal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-surface-container rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border border-white/10 shadow-2xl relative flex flex-col">
      
      <!-- Event Header Image with Overlay -->
      <div class="relative w-full h-56 sm:h-64 bg-surface-container-highest flex-shrink-0">
        <img id="fuego-ev-img" class="w-full h-full object-cover" src="" alt="Evento KLK Radio 47" />
        <div class="absolute inset-0 bg-gradient-to-t from-surface-container via-surface-container/40 to-transparent"></div>
        <button id="fuego-close-event-modal" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-surface-container-lowest/80 hover:bg-surface-container-lowest text-on-surface flex items-center justify-center transition-all cursor-pointer shadow-lg" type="button" aria-label="<?php esc_attr_e('Cerrar', 'fuego-fm'); ?>">
          <span class="material-symbols-outlined text-xl select-none" aria-hidden="true">close</span>
        </button>
        <div class="absolute bottom-4 left-6 right-6">
          <div class="flex items-center gap-2 mb-1.5 flex-wrap">
            <span id="fuego-ev-tag" class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-primary-container text-white shadow-md">BACHATA</span>
            <span id="fuego-ev-category" class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-md">Bachata</span>
          </div>
          <h2 id="fuego-ev-title" class="font-headline-md text-2xl sm:text-3xl font-black text-on-surface leading-tight drop-shadow-md">Madrid Bachata Sensation 2026</h2>
        </div>
      </div>

      <!-- Modal Body Content -->
      <div class="p-6 sm:p-8 space-y-6">
        
        <!-- Info Chips Bar -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 bg-surface-container-high/60 p-4 rounded-xl border border-white/5">
          <div class="flex items-center gap-2.5 text-on-surface">
            <span class="material-symbols-outlined text-primary-container text-2xl select-none flex-shrink-0" aria-hidden="true">calendar_month</span>
            <div class="min-w-0">
              <span class="block text-[10px] uppercase font-bold text-on-surface-variant tracking-wider"><?php esc_html_e('Fecha', 'fuego-fm'); ?></span>
              <span id="fuego-ev-date" class="font-label-md text-sm font-semibold truncate block">28 Octubre 2026</span>
            </div>
          </div>
          <div class="flex items-center gap-2.5 text-on-surface">
            <span class="material-symbols-outlined text-secondary-container text-2xl select-none flex-shrink-0" aria-hidden="true">schedule</span>
            <div class="min-w-0">
              <span class="block text-[10px] uppercase font-bold text-on-surface-variant tracking-wider"><?php esc_html_e('Horario', 'fuego-fm'); ?></span>
              <span id="fuego-ev-time" class="font-label-md text-sm font-semibold truncate block">20:00 h – 03:00 h</span>
            </div>
          </div>
          <div class="flex items-center gap-2.5 text-on-surface">
            <span class="material-symbols-outlined text-tertiary-container text-2xl select-none flex-shrink-0" aria-hidden="true">location_on</span>
            <div class="min-w-0">
              <span class="block text-[10px] uppercase font-bold text-on-surface-variant tracking-wider"><?php esc_html_e('Lugar / Sala', 'fuego-fm'); ?></span>
              <span id="fuego-ev-venue" class="font-label-md text-sm font-semibold truncate block">Sala Ritmo Latino</span>
            </div>
          </div>
        </div>

        <!-- Description Box -->
        <div>
          <h4 class="font-label-sm text-xs text-primary uppercase font-bold tracking-wider mb-2"><?php esc_html_e('Detalles del Evento', 'fuego-fm'); ?></h4>
          <div id="fuego-ev-desc" class="font-body-md text-sm sm:text-base text-on-surface-variant leading-relaxed bg-surface-container-high/40 p-5 rounded-xl border border-white/5 overflow-y-auto max-h-96">
            <!-- Populated dynamically via JS -->
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="pt-4 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3">
          <a id="fuego-ev-whatsapp-btn" class="w-full sm:w-auto px-6 py-3 bg-[#25D366] hover:bg-[#20ba5a] text-[#073816] font-label-md font-bold rounded-full flex items-center justify-center gap-2 shadow-lg transition-all" href="#" target="_blank" rel="noopener noreferrer">
            <span class="material-symbols-outlined text-xl select-none" aria-hidden="true">call</span>
            <span><?php esc_html_e('Consultar Entradas en WhatsApp', 'fuego-fm'); ?></span>
          </a>
          <button id="fuego-ev-tune-btn" class="w-full sm:w-auto px-5 py-3 bg-primary-container hover:bg-tertiary-container text-white font-label-md font-bold rounded-full flex items-center justify-center gap-2 shadow-lg transition-all cursor-pointer" type="button">
            <span class="material-symbols-outlined text-xl select-none" aria-hidden="true">play_arrow</span>
            <span><?php esc_html_e('Sintonizar KLK Radio', 'fuego-fm'); ?></span>
          </button>
        </div>

      </div>

    </div>
  </div>

  <!-- Toast Container for Real-time Alerts -->
  <div id="fuego-toast-container"></div>

  <!-- Inline Event Modal HTML Formatter (Guarantees zero browser cache delays and clean rendering) -->
  <script id="fuego-inline-modal-fix">
  (function() {
    function cleanAndFormatDesc(card) {
      var descEl = document.getElementById('fuego-ev-desc');
      if (!descEl) return;

      var cleanEl = card ? card.querySelector('.fuego-event-clean-html') : null;
      var rawHtml = '';

      if (cleanEl && cleanEl.innerHTML.trim().length > 0) {
        rawHtml = cleanEl.innerHTML;
      } else if (card) {
        var jsonEl = card.querySelector('.fuego-event-data');
        if (jsonEl) {
          try {
            var data = JSON.parse(jsonEl.textContent.trim());
            rawHtml = data.content || data.artists || '';
          } catch(e) {}
        }
      }

      if (!rawHtml && descEl.innerHTML) {
        rawHtml = descEl.innerHTML;
      }

      if (rawHtml) {
        // Decode entities up to 2 times
        var helper = document.createElement('textarea');
        for (var i = 0; i < 2; i++) {
          if (rawHtml.indexOf('&lt;') !== -1 || rawHtml.indexOf('&amp;') !== -1 || rawHtml.indexOf('&gt;') !== -1) {
            helper.innerHTML = rawHtml;
            rawHtml = helper.value;
          }
        }
        rawHtml = rawHtml.replace(/<!--\s*\/?wp:[^\>]*-->/gi, '').trim();
        descEl.innerHTML = rawHtml;

        // Self-healing check: if descEl literally displays "<p>" as visible text
        if (descEl.textContent.trim().indexOf('<p>') === 0 || descEl.textContent.trim().indexOf('<p ') === 0 || descEl.textContent.indexOf('</p>') !== -1) {
          descEl.innerHTML = descEl.textContent;
        }
      }
    }

    document.addEventListener('click', function(e) {
      var card = e.target.closest('.fuego-event-card');
      if (card) {
        setTimeout(function() { cleanAndFormatDesc(card); }, 15);
        setTimeout(function() { cleanAndFormatDesc(card); }, 80);
      }
    }, true);
  })();
  </script>

  <!-- Audio Element (Managed by player.js) -->
  <audio id="fuego-live-audio" preload="none"></audio>

  <?php wp_footer(); ?>
</body>
</html>
