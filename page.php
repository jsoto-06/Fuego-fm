<?php
/**
 * Fuego FM - Static Page Template
 *
 * @package Fuego_FM
 */

get_header();
?>

<main class="w-full pt-28 pb-32 bg-background min-h-screen px-gutter">
  <div class="max-w-4xl mx-auto">
    
    <!-- Top Back Navigation -->
    <div class="mb-6 flex items-center justify-between gap-4">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center gap-2 text-primary hover:text-white transition-colors text-sm font-bold bg-surface-container-high/60 hover:bg-surface-container-highest px-4 py-2 rounded-full border border-white/5 shadow-sm">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        <?php esc_html_e('Volver a la Emisora en Vivo', 'fuego-fm'); ?>
      </a>
      <span class="inline-flex items-center gap-1.5 text-xs text-on-surface-variant uppercase tracking-wider font-semibold">
        <span class="w-2 h-2 rounded-full bg-primary-container animate-live-dot"></span>
        KLK Radio 47
      </span>
    </div>

    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('bg-surface-container-low rounded-2xl p-6 sm:p-10 shadow-2xl border border-white/5'); ?>>
        
        <header class="mb-8 pb-6 border-b border-white/5">
          <div class="text-primary font-label-sm text-label-sm uppercase tracking-wider mb-2 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-sm">article</span>
            <?php esc_html_e('Información Oficial', 'fuego-fm'); ?>
          </div>
          <h1 class="font-headline-lg text-headline-lg text-on-surface font-extrabold tracking-tight leading-tight">
            <?php the_title(); ?>
          </h1>
        </header>

        <?php if (has_post_thumbnail()) : ?>
          <div class="w-full rounded-xl overflow-hidden mb-8 shadow-xl">
            <?php the_post_thumbnail('large', array('class' => 'w-full h-auto object-cover max-h-[440px]')); ?>
          </div>
        <?php endif; ?>

        <div class="fuego-prose text-body-lg text-on-surface">
          <?php the_content(); ?>
        </div>

        <!-- Footer Banner inside Article -->
        <div class="mt-12 pt-8 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-4">
          <div class="flex items-center gap-3">
            <img alt="KLK Radio 47" class="h-10 w-auto object-contain" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" />
            <div>
              <p class="font-bold text-white text-sm">KLK Radio 47 · Sabor Latino</p>
              <p class="text-xs text-on-surface-variant"><?php esc_html_e('Sintoniza la música más encendida las 24 horas.', 'fuego-fm'); ?></p>
            </div>
          </div>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="px-5 py-2.5 rounded-full bg-primary-container hover:bg-tertiary-container text-white font-bold text-sm shadow-lg transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-lg">radio</span>
            <?php esc_html_e('Escuchar Ahora', 'fuego-fm'); ?>
          </a>
        </div>

      </article>
    <?php endwhile; ?>

  </div>
</main>

<?php
get_footer();

