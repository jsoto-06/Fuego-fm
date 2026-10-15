<?php
/**
 * Fuego FM - 404 Error Page Template
 *
 * @package Fuego_FM
 */

get_header();
?>

<main class="w-full pt-28 pb-32 bg-background min-h-screen px-gutter flex items-center justify-center">
  <div class="max-w-xl mx-auto text-center bg-surface-container-low rounded-2xl p-8 sm:p-12 shadow-2xl border border-white/5 relative overflow-hidden">
    
    <div class="absolute -top-16 -right-16 w-44 h-44 bg-primary-container/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="inline-flex items-center gap-2 bg-error-container/40 text-on-error-container px-4 py-1.5 rounded-full font-label-sm text-label-sm uppercase tracking-wider mb-6">
      <span class="w-2 h-2 rounded-full bg-primary-container animate-ping"></span>
      <?php esc_html_e('FRECUENCIA NO ENCONTRADA', 'fuego-fm'); ?>
    </div>

    <h1 class="font-headline-xl text-headline-xl text-primary font-black tracking-tight leading-none mb-4">
      404
    </h1>

    <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold mb-3">
      <?php esc_html_e('Esta señal está fuera del aire', 'fuego-fm'); ?>
    </h2>

    <p class="font-body-md text-body-md text-on-surface-variant mb-8 max-w-md mx-auto">
      <?php esc_html_e('La página que buscas no existe o ha cambiado de frecuencia. Vuelve a la señal central para seguir disfrutando de la música en vivo.', 'fuego-fm'); ?>
    </p>

    <div class="flex flex-wrap items-center justify-center gap-4">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="px-6 py-3 bg-primary-container hover:bg-tertiary-container text-white font-label-md text-label-md font-bold rounded-full shadow-[0_0_20px_rgba(255,87,34,0.45)] transition-all flex items-center gap-2">
        <span class="material-symbols-outlined text-lg">radio</span>
        <span><?php esc_html_e('Volver a la Transmisión En Vivo', 'fuego-fm'); ?></span>
      </a>
    </div>

  </div>
</main>

<?php
get_footer();
