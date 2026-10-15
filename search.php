<?php
/**
 * Fuego FM - Search Results Template
 *
 * @package Fuego_FM
 */

get_header();
?>

<main class="w-full pt-28 pb-32 bg-background min-h-screen px-gutter">
  <div class="max-w-6xl mx-auto">
    
    <header class="mb-10 text-center md:text-left">
      <div class="inline-flex items-center gap-2 text-primary font-label-sm text-label-sm uppercase tracking-wider mb-2">
        <span class="material-symbols-outlined text-sm">search</span> <?php esc_html_e('RESULTADOS DE BÚSQUEDA', 'fuego-fm'); ?>
      </div>
      <h1 class="font-headline-lg text-headline-lg text-on-surface font-extrabold tracking-tight">
        <?php printf(__('Resultados para: "%s"', 'fuego-fm'), '<span class="text-primary-container">' . esc_html(get_search_query()) . '</span>'); ?>
      </h1>
    </header>

    <?php if (have_posts()) : ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while (have_posts()) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('bg-surface-container-low rounded-xl overflow-hidden shadow-xl border border-white/5 flex flex-col justify-between hover:bg-surface-container transition-all group p-6'); ?>>
            <div>
              <span class="text-xs text-on-surface-variant block mb-2"><?php echo get_the_date(); ?></span>
              <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold group-hover:text-primary transition-colors mb-2">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>
              <div class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3">
                <?php the_excerpt(); ?>
              </div>
            </div>
            <div class="pt-4">
              <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1.5 text-primary hover:text-secondary font-label-md text-label-md font-semibold transition-colors">
                <span><?php esc_html_e('Ver Resultado', 'fuego-fm'); ?></span>
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
              </a>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

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
      <div class="bg-surface-container-low p-10 rounded-2xl text-center border border-white/5 max-w-xl mx-auto">
        <span class="material-symbols-outlined text-5xl text-on-surface-variant mb-4">search_off</span>
        <h2 class="font-title-md text-title-md text-on-surface font-bold mb-2">
          <?php esc_html_e('No se encontraron resultados', 'fuego-fm'); ?>
        </h2>
        <p class="font-body-md text-on-surface-variant mb-6">
          <?php esc_html_e('Intenta buscar con otros términos, nombres de artistas o temas musicales.', 'fuego-fm'); ?>
        </p>
        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative max-w-md mx-auto">
          <input name="s" class="w-full bg-surface-container-high text-on-surface placeholder:text-on-surface-variant/60 font-body-sm pl-4 pr-12 py-3 rounded-full outline-none focus:ring-2 focus:ring-primary-container" placeholder="<?php esc_attr_e('Buscar de nuevo...', 'fuego-fm'); ?>" type="search" value="<?php echo get_search_query(); ?>"/>
          <button class="absolute right-2 top-2 w-8 h-8 rounded-full bg-primary-container text-white flex items-center justify-center" type="submit">
            <span class="material-symbols-outlined text-sm">search</span>
          </button>
        </form>
      </div>
    <?php endif; ?>

  </div>
</main>

<?php
get_footer();
