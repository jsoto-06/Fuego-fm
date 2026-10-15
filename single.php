<?php
/**
 * Fuego FM - Single Post Template
 *
 * @package Fuego_FM
 */

get_header();
?>

<main class="w-full pt-28 pb-32 bg-background min-h-screen px-gutter">
  <div class="max-w-4xl mx-auto">
    
    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('bg-surface-container-low rounded-2xl p-6 sm:p-10 shadow-2xl border border-white/5'); ?>>
        
        <!-- Post Header -->
        <header class="mb-8">
          <div class="flex items-center gap-2 mb-3">
            <span class="bg-primary-container text-white font-label-sm text-label-sm px-3 py-1 rounded-full uppercase tracking-wider">
              <?php
              $categories = get_the_category();
              echo !empty($categories) ? esc_html($categories[0]->name) : __('Fuego FM Exclusivo', 'fuego-fm');
              ?>
            </span>
            <span class="text-xs text-on-surface-variant"><?php echo get_the_date(); ?></span>
          </div>

          <h1 class="font-headline-lg text-headline-lg text-on-surface font-extrabold tracking-tight mb-4">
            <?php the_title(); ?>
          </h1>

          <div class="flex items-center gap-3 text-sm text-on-surface-variant border-y border-white/5 py-3">
            <span class="flex items-center gap-1">
              <span class="material-symbols-outlined text-base">person</span> <?php the_author(); ?>
            </span>
            <span>·</span>
            <span class="flex items-center gap-1">
              <span class="material-symbols-outlined text-base">schedule</span> <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ' . __('atrás', 'fuego-fm'); ?>
            </span>
          </div>
        </header>

        <!-- Featured Image -->
        <?php if (has_post_thumbnail()) : ?>
          <div class="w-full rounded-xl overflow-hidden mb-8 shadow-xl">
            <?php the_post_thumbnail('large', array('class' => 'w-full h-auto object-cover max-h-[480px]')); ?>
          </div>
        <?php endif; ?>

        <!-- Post Content -->
        <div class="fuego-prose text-body-lg text-on-surface">
          <?php the_content(); ?>
        </div>

        <!-- Tags / Categories -->
        <?php if (has_tag()) : ?>
          <div class="mt-8 pt-6 border-t border-white/5 flex items-center gap-2 flex-wrap">
            <span class="font-label-sm text-on-surface-variant uppercase"><?php esc_html_e('Etiquetas:', 'fuego-fm'); ?></span>
            <?php the_tags('<span class="bg-surface-container-high px-3 py-1 rounded-full text-xs text-secondary-container">', '</span> <span class="bg-surface-container-high px-3 py-1 rounded-full text-xs text-secondary-container">', '</span>'); ?>
          </div>
        <?php endif; ?>

        <!-- Back Link -->
        <div class="mt-8 pt-6 border-t border-white/5 flex items-center justify-between">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-surface-container-high hover:bg-surface-container-highest text-on-surface rounded-full font-label-md text-label-md transition-all">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            <span><?php esc_html_e('Volver a Inicio', 'fuego-fm'); ?></span>
          </a>
          <button class="fuego-share-btn px-4 py-2 bg-primary-container hover:bg-tertiary-container text-white rounded-full font-label-md text-label-md flex items-center gap-1.5 transition-all cursor-pointer" type="button">
            <span class="material-symbols-outlined text-base">share</span>
            <span><?php esc_html_e('Compartir', 'fuego-fm'); ?></span>
          </button>
        </div>

      </article>

      <!-- Comments -->
      <?php if (comments_open() || get_comments_number()) : ?>
        <div class="mt-10 bg-surface-container-low rounded-2xl p-6 sm:p-10 shadow-2xl border border-white/5">
          <?php comments_template(); ?>
        </div>
      <?php endif; ?>

    <?php endwhile; ?>

  </div>
</main>

<?php
get_footer();
