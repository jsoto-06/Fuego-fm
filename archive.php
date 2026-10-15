<?php
/**
 * Fuego FM - Archive Template
 *
 * @package Fuego_FM
 */

get_header();
?>

<main class="w-full pt-28 pb-32 bg-background min-h-screen px-gutter">
  <div class="max-w-6xl mx-auto">
    
    <!-- Archive Header -->
    <header class="mb-10 text-center md:text-left">
      <div class="inline-flex items-center gap-2 text-secondary-container font-label-sm text-label-sm uppercase tracking-wider mb-2">
        <span class="material-symbols-outlined text-sm">folder</span> <?php esc_html_e('ARCHIVO DE TRANSMISIÓN', 'fuego-fm'); ?>
      </div>
      <h1 class="font-headline-lg text-headline-lg text-on-surface font-extrabold tracking-tight">
        <?php the_archive_title(); ?>
      </h1>
      <?php if (get_the_archive_description()) : ?>
        <div class="font-body-lg text-body-lg text-on-surface-variant mt-2 max-w-2xl">
          <?php the_archive_description(); ?>
        </div>
      <?php endif; ?>
    </header>

    <?php if (have_posts()) : ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while (have_posts()) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('bg-surface-container-low rounded-xl overflow-hidden shadow-xl border border-white/5 flex flex-col justify-between hover:bg-surface-container transition-all group'); ?>>
            
            <div>
              <?php if (has_post_thumbnail()) : ?>
                <div class="relative w-full h-48 overflow-hidden bg-surface-container-highest">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500')); ?>
                  </a>
                </div>
              <?php endif; ?>

              <div class="p-6">
                <span class="text-xs text-on-surface-variant mb-2 block"><?php echo get_the_date(); ?></span>
                <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold group-hover:text-primary transition-colors mb-2 line-clamp-2">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3">
                  <?php the_excerpt(); ?>
                </div>
              </div>
            </div>

            <div class="p-6 pt-0">
              <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1.5 text-primary hover:text-secondary font-label-md text-label-md font-semibold transition-colors">
                <span><?php esc_html_e('Ver Contenido', 'fuego-fm'); ?></span>
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
              </a>
            </div>

          </article>
        <?php endwhile; ?>
      </div>

      <!-- Pagination -->
      <div class="mt-12 flex justify-center">
        <?php
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => __('« Anterior', 'fuego-fm'),
            'next_text' => __('Siguiente »', 'fuego-fm'),
        ));
        ?>
      </div>

    <?php else : ?>
      <div class="bg-surface-container-low p-8 rounded-xl text-center border border-white/5">
        <p class="font-title-md text-on-surface"><?php esc_html_e('No hay publicaciones en esta categoría.', 'fuego-fm'); ?></p>
      </div>
    <?php endif; ?>

  </div>
</main>

<?php
get_footer();
