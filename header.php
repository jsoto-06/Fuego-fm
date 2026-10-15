<!DOCTYPE html>
<html class="dark" <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="web_standard" name="shell-type"/>
  <link href="https://fonts.googleapis.com" rel="preconnect"/>
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
  <?php wp_head(); ?>
</head>
<body <?php body_class('bg-background font-body-md text-body-md text-on-surface antialiased selection:bg-primary-container selection:text-white'); ?>>
<?php wp_body_open(); ?>

<header class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest/90 backdrop-blur-2xl shadow-[0_4px_24px_rgba(0,0,0,0.5)]">
  <div class="h-20 w-full px-gutter flex items-center justify-between gap-space-md">
    
    <!-- Brand / Station Logo -->
    <div class="flex items-center gap-space-lg flex-shrink-0">
      <a class="flex items-center gap-2 sm:gap-space-sm group" href="<?php echo esc_url(home_url('/')); ?>">
        <?php if (has_custom_logo()) : ?>
          <?php the_custom_logo(); ?>
        <?php else : ?>
          <img alt="KLK Radio 47" style="height: <?php echo esc_attr(fuego_get_logo_height()); ?>px;" class="w-auto object-contain transition-transform group-hover:scale-105" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" />
          <span class="font-headline-sm text-headline-sm tracking-tight text-on-surface font-extrabold hidden md:inline-block">KLK<span class="text-primary-container"> RADIO 47</span></span>
        <?php endif; ?>
      </a>
      
      <!-- Live Indicator Dot -->
      <div class="hidden xl:flex items-center gap-space-xs bg-error-container/40 px-space-sm py-1 rounded-full shadow-[0_0_16px_rgba(255,87,34,0.35)]">
        <span class="w-2 h-2 rounded-full bg-primary-container animate-live-dot"></span>
        <span class="font-label-sm text-label-sm text-on-error-container uppercase tracking-wider"><?php esc_html_e('EN DIRECTO', 'fuego-fm'); ?></span>
      </div>
    </div>

    <!-- Main Navigation Menu (Desktop) -->
    <nav class="hidden lg:flex items-center gap-1 bg-surface-container-low/70 p-1.5 rounded-full shadow-inner" data-active-classes="bg-surface-container-high text-primary font-bold rounded-full">
      <?php if (has_nav_menu('primary')) : ?>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'fallback_cb'    => false,
        ));
        ?>
      <?php else : ?>
        <a aria-current="page" class="px-space-md py-1.5 transition-all bg-surface-container-high text-primary font-bold rounded-full" href="<?php echo esc_url(home_url('/#en-vivo')); ?>"><?php esc_html_e('En Vivo', 'fuego-fm'); ?></a>
        <a class="px-space-md py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-all" href="<?php echo esc_url(home_url('/#diales')); ?>"><?php esc_html_e('Diales & Géneros', 'fuego-fm'); ?></a>
        <a class="px-space-md py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-all" href="<?php echo esc_url(home_url('/#programacion')); ?>"><?php esc_html_e('Programación', 'fuego-fm'); ?></a>
        <a class="px-space-md py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-all" href="<?php echo esc_url(home_url('/#ranking')); ?>"><?php esc_html_e('Top 50 Latino', 'fuego-fm'); ?></a>
        <a class="px-space-md py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-all" href="<?php echo esc_url(home_url('/#comunidad')); ?>"><?php esc_html_e('Muro de Oyentes', 'fuego-fm'); ?></a>
        <a class="px-space-md py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-all" href="<?php echo esc_url(home_url('/#app')); ?>"><?php esc_html_e('App Móvil', 'fuego-fm'); ?></a>
        <a class="px-space-md py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-all" href="<?php echo esc_url(fuego_get_about_url()); ?>"><?php esc_html_e('Acerca de', 'fuego-fm'); ?></a>
        <a class="px-space-md py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-all" href="<?php echo esc_url(fuego_get_contact_url()); ?>"><?php esc_html_e('Contacto', 'fuego-fm'); ?></a>
      <?php endif; ?>
    </nav>

    <!-- Header Right Area: Search, Escuchar Ahora, Profile, Mobile Menu Toggle -->
    <div class="flex items-center gap-space-md flex-shrink-0">
      
      <!-- Quick Search Bar -->
      <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="hidden md:flex items-center relative w-60">
        <span class="material-symbols-outlined absolute left-3 text-on-surface-variant text-lg pointer-events-none">search</span>
        <input name="s" class="w-full bg-surface-container-high/60 text-on-surface placeholder:text-on-surface-variant/60 font-body-sm text-body-sm pl-9 pr-3 py-2 rounded-full outline-none focus:bg-surface-container-highest transition-all" placeholder="<?php esc_attr_e('Buscar temas, artistas...', 'fuego-fm'); ?>" type="search" value="<?php echo get_search_query(); ?>" />
      </form>

      <!-- Escuchar Ahora Play Button -->
      <button class="fuego-toggle-play flex items-center gap-space-xs bg-primary-container hover:bg-tertiary-container text-white px-space-md py-2 rounded-full font-label-md text-label-md shadow-[0_0_20px_rgba(255,87,34,0.45)] transition-all cursor-pointer" type="button">
        <span class="material-symbols-outlined text-lg fuego-play-icon">play_arrow</span>
        <span><?php esc_html_e('Escuchar Ahora', 'fuego-fm'); ?></span>
      </button>

      <!-- Profile Avatar -->
      <div class="hidden sm:flex items-center pl-space-xs">
        <img alt="Profile" class="w-8 h-8 rounded-full object-cover ring-2 ring-primary-container/40" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/avatar-user.jpg'); ?>"/>
      </div>

      <!-- Mobile Hamburger Toggle -->
      <button id="fuego-menu-toggle" class="lg:hidden flex items-center justify-center w-10 h-10 rounded-full bg-surface-container-high text-on-surface hover:bg-surface-container-highest transition-colors" type="button" aria-label="<?php esc_attr_e('Abrir menú', 'fuego-fm'); ?>">
        <span class="material-symbols-outlined text-xl">menu</span>
      </button>
    </div>
  </div>

  <!-- Mobile Drawer Menu -->
  <div id="fuego-mobile-menu" class="fuego-mobile-menu lg:hidden">
    <a class="px-4 py-2 rounded-lg bg-surface-container-high text-primary font-bold" href="<?php echo esc_url(home_url('/#en-vivo')); ?>"><?php esc_html_e('En Vivo', 'fuego-fm'); ?></a>
    <a class="px-4 py-2 rounded-lg text-on-surface hover:bg-surface-container-high" href="<?php echo esc_url(home_url('/#diales')); ?>"><?php esc_html_e('Diales & Géneros', 'fuego-fm'); ?></a>
    <a class="px-4 py-2 rounded-lg text-on-surface hover:bg-surface-container-high" href="<?php echo esc_url(home_url('/#programacion')); ?>"><?php esc_html_e('Programación', 'fuego-fm'); ?></a>
    <a class="px-4 py-2 rounded-lg text-on-surface hover:bg-surface-container-high" href="<?php echo esc_url(home_url('/#ranking')); ?>"><?php esc_html_e('Top 50 Latino', 'fuego-fm'); ?></a>
    <a class="px-4 py-2 rounded-lg text-on-surface hover:bg-surface-container-high" href="<?php echo esc_url(home_url('/#comunidad')); ?>"><?php esc_html_e('Muro de Oyentes', 'fuego-fm'); ?></a>
    <a class="px-4 py-2 rounded-lg text-on-surface hover:bg-surface-container-high" href="<?php echo esc_url(home_url('/#app')); ?>"><?php esc_html_e('App Móvil', 'fuego-fm'); ?></a>
    <a class="px-4 py-2 rounded-lg text-on-surface hover:bg-surface-container-high" href="<?php echo esc_url(fuego_get_about_url()); ?>"><?php esc_html_e('Acerca de nosotros', 'fuego-fm'); ?></a>
    <a class="px-4 py-2 rounded-lg text-on-surface hover:bg-surface-container-high" href="<?php echo esc_url(fuego_get_contact_url()); ?>"><?php esc_html_e('Contáctenos', 'fuego-fm'); ?></a>
    <div class="my-2 border-t border-white/10 pt-2 flex flex-col gap-1">
      <a class="px-4 py-1 text-xs text-on-surface-variant hover:text-primary transition-colors" href="<?php echo esc_url(fuego_get_privacy_url()); ?>"><?php esc_html_e('Política de privacidad', 'fuego-fm'); ?></a>
      <a class="px-4 py-1 text-xs text-on-surface-variant hover:text-primary transition-colors" href="<?php echo esc_url(fuego_get_terms_url()); ?>"><?php esc_html_e('Términos del servicio', 'fuego-fm'); ?></a>
    </div>
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="mt-2 relative">
      <span class="material-symbols-outlined absolute left-3 top-2.5 text-on-surface-variant text-lg pointer-events-none">search</span>
      <input name="s" class="w-full bg-surface-container-high text-on-surface placeholder:text-on-surface-variant/60 font-body-sm pl-9 pr-3 py-2 rounded-full outline-none" placeholder="<?php esc_attr_e('Buscar temas, artistas...', 'fuego-fm'); ?>" type="search" value="<?php echo get_search_query(); ?>" />
    </form>
  </div>
</header>
