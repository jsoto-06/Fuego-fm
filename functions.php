<?php
/**
 * Fuego FM - Functions and Definitions
 *
 * @package Fuego_FM
 */

if (!defined('ABSPATH')) {
    exit;
}

define('FUEGO_VERSION', '1.0.11');
define('FUEGO_DIR', get_template_directory());
define('FUEGO_URI', get_template_directory_uri());

// Include Modular Inc Files
require_once FUEGO_DIR . '/inc/customizer.php';
require_once FUEGO_DIR . '/inc/post-types.php';
require_once FUEGO_DIR . '/inc/ajax-handlers.php';
require_once FUEGO_DIR . '/inc/sample-data.php';
require_once FUEGO_DIR . '/inc/template-tags.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function fuego_setup() {
    // Make theme available for translation
    load_theme_textdomain('fuego-fm', FUEGO_DIR . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(800, 600, true);
    add_image_size('fuego-dial-thumb', 600, 400, true);
    add_image_size('fuego-album-thumb', 400, 400, true);

    // Register primary and footer navigation menus
    register_nav_menus(array(
        'primary' => __('Menú Principal Superior', 'fuego-fm'),
        'footer'  => __('Menú Pie de Página', 'fuego-fm'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Custom Logo support
    add_theme_support('custom-logo', array(
        'height'      => 48,
        'width'       => 160,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Responsive embeds
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'fuego_setup');

/**
 * Enqueue scripts and styles.
 */
function fuego_scripts() {
    // 1. Google Fonts
    wp_enqueue_style(
        'fuego-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Syne:wght@600;700;800&display=swap',
        array(),
        null
    );

    // 2. Material Symbols Outlined
    wp_enqueue_style(
        'fuego-material-symbols',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap',
        array(),
        null
    );

    // 3. Theme Main Stylesheet
    $style_ver = file_exists(get_stylesheet_directory() . '/style.css') ? filemtime(get_stylesheet_directory() . '/style.css') : FUEGO_VERSION;
    wp_enqueue_style('fuego-style', get_stylesheet_uri(), array(), $style_ver);

    // 4. Custom Animations & Components Stylesheet
    $custom_css_ver = file_exists(FUEGO_DIR . '/assets/css/fuego-custom.css') ? filemtime(FUEGO_DIR . '/assets/css/fuego-custom.css') : FUEGO_VERSION;
    wp_enqueue_style('fuego-custom-css', FUEGO_URI . '/assets/css/fuego-custom.css', array('fuego-style'), $custom_css_ver);

    // 5. Tailwind CSS CDN Engine
    wp_enqueue_script('fuego-tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null, false);

    // 6. Tailwind Theme Configuration Inline Script
    $tailwind_config = '
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "tertiary-fixed": "#ffd9de",
            "on-secondary-fixed-variant": "#5e4200",
            "on-tertiary-fixed-variant": "#900038",
            "on-secondary": "#412d00",
            "on-error-container": "#ffdad6",
            "error": "#ffb4ab",
            "surface-variant": "#333538",
            "primary-fixed": "#ffdbd1",
            "secondary": "#ffdb9d",
            "inverse-surface": "#e2e2e6",
            "primary-fixed-dim": "#ffb5a0",
            "primary": "#ffb5a0",
            "on-secondary-container": "#6b4b00",
            "surface-container": "#1e2023",
            "on-primary": "#5f1500",
            "on-tertiary-fixed": "#400014",
            "on-secondary-fixed": "#271900",
            "inverse-on-surface": "#2f3034",
            "error-container": "#93000a",
            "secondary-fixed": "#ffdea8",
            "on-tertiary-container": "#5a0020",
            "on-error": "#690005",
            "outline": "#ab8980",
            "inverse-primary": "#b02f00",
            "outline-variant": "#5b4039",
            "tertiary-fixed-dim": "#ffb2be",
            "surface-dim": "#111317",
            "surface-container-high": "#282a2d",
            "tertiary": "#ffb2be",
            "secondary-container": "#feb700",
            "surface-bright": "#37393d",
            "on-tertiary": "#660025",
            "background": "#111317",
            "on-primary-fixed-variant": "#862200",
            "on-surface-variant": "#e4beb4",
            "primary-container": "#ff5722",
            "surface-container-low": "#1a1c1f",
            "secondary-fixed-dim": "#ffba20",
            "on-primary-fixed": "#3b0900",
            "on-primary-container": "#541200",
            "surface-tint": "#ffb5a0",
            "surface-container-lowest": "#0c0e11",
            "on-surface": "#e2e2e6",
            "surface": "#111317",
            "surface-container-highest": "#333538",
            "on-background": "#e2e2e6",
            "tertiary-container": "#ff4e7c"
          },
          borderRadius: {
            "DEFAULT": "0.25rem",
            "lg": "0.5rem",
            "xl": "0.75rem",
            "full": "9999px"
          },
          spacing: {
            "space-sm": "0.5rem",
            "margin-mobile": "1rem",
            "space-xl": "2.5rem",
            "gutter-mobile": "1rem",
            "margin": "2rem",
            "space-xs": "0.25rem",
            "gutter": "1.5rem",
            "space-lg": "1.5rem",
            "space-md": "1rem"
          },
          fontFamily: {
            "headline-xl-mobile": ["Syne", "sans-serif"],
            "headline-sm": ["Syne", "sans-serif"],
            "headline-lg-mobile": ["Syne", "sans-serif"],
            "headline-lg": ["Syne", "sans-serif"],
            "label-md": ["Inter", "sans-serif"],
            "label-sm": ["Inter", "sans-serif"],
            "body-md": ["Inter", "sans-serif"],
            "title-md": ["Inter", "sans-serif"],
            "headline-md": ["Syne", "sans-serif"],
            "body-lg": ["Inter", "sans-serif"],
            "body-sm": ["Inter", "sans-serif"],
            "headline-xl": ["Syne", "sans-serif"]
          },
          fontSize: {
            "headline-xl-mobile": ["36px", { lineHeight: "42px", letterSpacing: "-0.02em", fontWeight: "800" }],
            "headline-sm": ["20px", { lineHeight: "28px", fontWeight: "600" }],
            "headline-lg-mobile": ["28px", { lineHeight: "34px", letterSpacing: "-0.01em", fontWeight: "700" }],
            "headline-lg": ["40px", { lineHeight: "48px", letterSpacing: "-0.02em", fontWeight: "700" }],
            "label-md": ["13px", { lineHeight: "18px", letterSpacing: "0.04em", fontWeight: "600" }],
            "label-sm": ["11px", { lineHeight: "14px", letterSpacing: "0.08em", fontWeight: "700" }],
            "body-md": ["14px", { lineHeight: "20px", fontWeight: "400" }],
            "title-md": ["18px", { lineHeight: "24px", fontWeight: "600" }],
            "headline-md": ["28px", { lineHeight: "36px", letterSpacing: "-0.01em", fontWeight: "700" }],
            "body-lg": ["16px", { lineHeight: "24px", fontWeight: "400" }],
            "body-sm": ["12px", { lineHeight: "16px", fontWeight: "400" }],
            "headline-xl": ["56px", { lineHeight: "64px", letterSpacing: "-0.03em", fontWeight: "800" }]
          }
        }
      }
    };';
    wp_add_inline_script('fuego-tailwind-cdn', $tailwind_config);

    // 7. Interactive Audio Player Engine
    $player_ver = file_exists(FUEGO_DIR . '/assets/js/player.js') ? filemtime(FUEGO_DIR . '/assets/js/player.js') : FUEGO_VERSION;
    wp_enqueue_script('fuego-player-js', FUEGO_URI . '/assets/js/player.js', array(), $player_ver, true);

    // Localize AJAX and Theme Config
    wp_localize_script('fuego-player-js', 'fuegoAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('fuego_ajax_nonce'),
    ));

    wp_localize_script('fuego-player-js', 'fuegoThemeConfig', array(
        'streamUrl'      => fuego_get_stream_url(),
        'bitrate'        => fuego_get_bitrate(),
        'listenersCount' => fuego_get_listeners_count(),
        'whatsappNumber' => get_theme_mod('fuego_whatsapp_number', '+1234567890'),
        'themeUri'       => FUEGO_URI,
    ));
}
add_action('wp_enqueue_scripts', 'fuego_scripts');

/**
 * Filter footer navigation links to add consistent hover & color styling
 */
function fuego_footer_nav_menu_link_attributes($atts, $item, $args) {
    if (isset($args->theme_location) && $args->theme_location === 'footer') {
        $existing = isset($atts['class']) ? $atts['class'] : '';
        $atts['class'] = trim($existing . ' hover:text-primary transition-colors');
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'fuego_footer_nav_menu_link_attributes', 10, 3);

