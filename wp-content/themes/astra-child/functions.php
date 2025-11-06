<?php
/**
 * Astra Child Theme - Chacoevents
 * Functions and definitions
 * Version: 2.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define Child Theme Constants
 */
define('CHACOEVENTS_THEME_VERSION', '2.0.0');
define('CHACOEVENTS_CHILD_DIR', trailingslashit(get_stylesheet_directory()));
define('CHACOEVENTS_CHILD_URI', trailingslashit(get_stylesheet_directory_uri()));

/**
 * Enqueue Parent and Child Theme Styles and Scripts
 */
function chacoevents_enqueue_assets() {
    // Parent theme style
    wp_enqueue_style(
        'astra-parent-style', 
        get_template_directory_uri() . '/style.css', 
        array(), 
        CHACOEVENTS_THEME_VERSION
    );
    
    // Child theme style con versioning basato su file modification time
    wp_enqueue_style(
        'chacoevents-style', 
        get_stylesheet_uri(), 
        array('astra-parent-style'), 
        filemtime(CHACOEVENTS_CHILD_DIR . 'style.css')
    );
    
    // Google Fonts
    wp_enqueue_style(
        'google-fonts', 
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap', 
        array(), 
        null
    );
    
    // jQuery (assicurati che sia caricato)
    wp_enqueue_script('jquery');
    
    // Custom Navigation JavaScript
    wp_enqueue_script(
        'chacoevents-navigation',
        CHACOEVENTS_CHILD_URI . 'assets/js/navigation.js',
        array(), // Rimosso jQuery dalle dipendenze per usare vanilla JS
        filemtime(CHACOEVENTS_CHILD_DIR . 'assets/js/navigation.js'),
        true // Carica nel footer
    );
    
    // Aggiungi alcune variabili JavaScript globali se necessario
    wp_localize_script('chacoevents-navigation', 'chacoevents_vars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('chacoevents_nonce'),
        'home_url' => home_url(),
        'is_mobile' => wp_is_mobile(),
        'sidebar_animation_speed' => 300,
    ));
}
add_action('wp_enqueue_scripts', 'chacoevents_enqueue_assets', 20);

/**
 * Register Navigation Menus
 */
function chacoevents_register_menus() {
    register_nav_menus(array(
        'primary' => __('Menu Principale Sidebar', 'chacoevents'),
        'footer' => __('Menu Footer', 'chacoevents'),
    ));
}
add_action('after_setup_theme', 'chacoevents_register_menus');

/**
 * Add Theme Support
 */
function chacoevents_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');
    
    // Add theme support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');
    
    // Add support for editor styles
    add_theme_support('editor-styles');
    
    // Add support for HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ));
}
add_action('after_setup_theme', 'chacoevents_theme_setup');

/**
 * Customizer additions for social links
 */
function chacoevents_customize_register($wp_customize) {
    // Add Social Media Section
    $wp_customize->add_section('chacoevents_social_links', array(
        'title'    => __('Link Social Media', 'chacoevents'),
        'priority' => 120,
    ));
    
    // Facebook
    $wp_customize->add_setting('chacoevents_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('chacoevents_facebook', array(
        'label'    => __('Facebook URL', 'chacoevents'),
        'section'  => 'chacoevents_social_links',
        'type'     => 'url',
    ));
    
    // Instagram
    $wp_customize->add_setting('chacoevents_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('chacoevents_instagram', array(
        'label'    => __('Instagram URL', 'chacoevents'),
        'section'  => 'chacoevents_social_links',
        'type'     => 'url',
    ));
    
    // Twitter
    $wp_customize->add_setting('chacoevents_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('chacoevents_twitter', array(
        'label'    => __('Twitter URL', 'chacoevents'),
        'section'  => 'chacoevents_social_links',
        'type'     => 'url',
    ));
}
add_action('customize_register', 'chacoevents_customize_register');

/**
 * Add body classes for better styling control
 */
function chacoevents_body_classes($classes) {
    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    }
    
    // Add class for homepage
    if (is_front_page() && is_home()) {
        $classes[] = 'chacoevents-home';
    }
    
    return $classes;
}
add_filter('body_class', 'chacoevents_body_classes');

/**
 * Filter per modificare il markup del menu
 * Aggiunge le icone emoji direttamente nel menu se necessario
 */
function chacoevents_nav_menu_items($items, $args) {
    if ($args->theme_location == 'primary') {
        // Puoi modificare qui il markup del menu se necessario
        // Per esempio, aggiungere icone automaticamente
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'chacoevents_nav_menu_items', 10, 2);

/**
 * Funzione helper per ottenere l'URL del logo
 */
function chacoevents_get_logo_url() {
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
    
    if (has_custom_logo()) {
        return $logo[0];
    } else {
        return false;
    }
}

/**
 * Disabilita alcuni elementi Astra non necessari
 */
function chacoevents_disable_astra_elements() {
    // Rimuovi action non necessarie di Astra per il nostro design custom
    remove_action('astra_header_before', 'astra_header_before_markup');
    remove_action('astra_header', 'astra_header_markup');
    remove_action('astra_header_after', 'astra_header_after_markup');
}
add_action('init', 'chacoevents_disable_astra_elements', 15);

/**
 * Aggiungi meta tag per dispositivi mobili
 */
function chacoevents_add_meta_tags() {
    ?>
    <meta name="theme-color" content="#8B7355">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <?php
}
add_action('wp_head', 'chacoevents_add_meta_tags');

/**
 * Inline critical CSS per performance migliori
 */
function chacoevents_inline_critical_css() {
    ?>
    <style>
        /* Critical CSS per evitare FOUC */
        .hamburger-menu {
            position: fixed;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            z-index: 1001;
        }
        .custom-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 1000;
        }
        .custom-sidebar.active {
            transform: translateX(0);
        }
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
    <?php
}
add_action('wp_head', 'chacoevents_inline_critical_css', 5);

/**
 * Aggiungi supporto per Async/Defer loading degli script
 */
function chacoevents_add_async_defer_attributes($tag, $handle) {
    // Aggiungi defer al navigation script
    if ('chacoevents-navigation' === $handle) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'chacoevents_add_async_defer_attributes', 10, 2);

/**
 * Custom Walker per il menu se necessario in futuro
 */
class Chacoevents_Walker_Nav_Menu extends Walker_Nav_Menu {
    // Puoi personalizzare il walker del menu qui se necessario
}

/**
 * Funzione per debug (disattivare in produzione)
 */
if (!function_exists('chacoevents_debug')) {
    function chacoevents_debug($data) {
        if (WP_DEBUG) {
            echo '<pre style="background: #fff; color: #000; padding: 10px; margin: 10px; border: 1px solid #ccc;">';
            print_r($data);
            echo '</pre>';
        }
    }
}

/**
 * Cleanup WordPress Head
 */
function chacoevents_cleanup_head() {
    // Remove RSD link
    remove_action('wp_head', 'rsd_link');
    
    // Remove Windows Live Writer
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Remove Generator
    remove_action('wp_head', 'wp_generator');
    
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'chacoevents_cleanup_head');

// Fine del file - non chiudere il tag PHP per evitare problemi di whitespace