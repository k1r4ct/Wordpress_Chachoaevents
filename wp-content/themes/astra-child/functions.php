<?php
/**
 * Astra Child Theme - Chacoevents
 * Functions and definitions
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue Parent and Child Theme Styles and Scripts
 */
function chacoevents_enqueue_assets() {
    // Parent theme style
    wp_enqueue_style('astra-parent-style', get_template_directory_uri() . '/style.css', array(), '1.0.0');
    
    // Child theme style
    wp_enqueue_style('chacoevents-style', get_stylesheet_uri(), array('astra-parent-style'), filemtime(get_stylesheet_directory() . '/style.css'));
    
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap', array(), null);
    
    // Custom JavaScript inline
    wp_add_inline_script('jquery', '
        jQuery(document).ready(function($) {
            const hamburger = document.getElementById("hamburgerMenu");
            const sidebar = document.getElementById("customSidebar");
            const overlay = document.getElementById("sidebarOverlay");
            const sidebarToggle = document.getElementById("sidebarToggle");
            
            if (hamburger && sidebar && overlay) {
                function openSidebar() {
                    hamburger.classList.add("active");
                    sidebar.classList.add("active");
                    overlay.classList.add("active");
                }
                
                function closeSidebar() {
                    hamburger.classList.remove("active");
                    sidebar.classList.remove("active");
                    overlay.classList.remove("active");
                }
                
                // Click sul hamburger per aprire
                hamburger.addEventListener("click", openSidebar);
                
                // Click sull\'overlay per chiudere
                overlay.addEventListener("click", closeSidebar);
                
                // Click sulla linguetta di chiusura (toggle button)
                if (sidebarToggle) {
                    sidebarToggle.addEventListener("click", closeSidebar);
                }
                
                // Click sui link del menu
                const menuLinks = sidebar.querySelectorAll("a");
                menuLinks.forEach(link => {
                    link.addEventListener("click", function() {
                        setTimeout(closeSidebar, 200);
                    });
                });
                
                // Tasto ESC
                document.addEventListener("keydown", function(e) {
                    if (e.key === "Escape" && sidebar.classList.contains("active")) {
                        closeSidebar();
                    }
                });
                
                // Evidenzia la pagina corrente nel menu
                const currentUrl = window.location.href;
                const menuItems = sidebar.querySelectorAll(".sidebar-menu-list a");
                
                menuItems.forEach(function(item) {
                    if (currentUrl === item.href) {
                        item.parentElement.classList.add("current-menu-item");
                    }
                });
            }
        });
    ');
}
add_action('wp_enqueue_scripts', 'chacoevents_enqueue_assets', 15);

/**
 * Register Navigation Menus
 */
function chacoevents_register_menus() {
    register_nav_menus(array(
        'sidebar-menu' => __('Menu Sidebar', 'chacoevents'),
        'footer-menu'  => __('Menu Footer', 'chacoevents'),
    ));
}
add_action('init', 'chacoevents_register_menus');

/**
 * Custom Logo Support
 */
function chacoevents_custom_logo_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'chacoevents_custom_logo_setup');

/**
 * Add body class for custom layout
 */
function chacoevents_body_classes($classes) {
    $classes[] = 'chacoevents-layout';
    return $classes;
}
add_filter('body_class', 'chacoevents_body_classes');

/**
 * Remove Astra default header/footer actions
 */
function chacoevents_remove_default_astra() {
    remove_action('astra_header', 'astra_header_markup');
    remove_action('astra_footer', 'astra_footer_markup');
}
add_action('after_setup_theme', 'chacoevents_remove_default_astra', 20);

/**
 * Default menu fallback
 */
function chacoevents_default_menu() {
    ?>
    <ul class="sidebar-menu-list">
        <li><a href="<?php echo home_url(); ?>">🏠 Home</a></li>
        <li><a href="<?php echo home_url('/chacoa'); ?>">🍫 Il Chacoa</a></li>
        <li><a href="<?php echo home_url('/chi-sono'); ?>">👤 Chi sono?</a></li>
        <li><a href="<?php echo home_url('/prossimi-eventi'); ?>">📅 Prossimi eventi</a></li>
        <li><a href="<?php echo home_url('/contatti'); ?>">✉️ Contatti</a></li>
        <li><a href="<?php echo home_url('/blog'); ?>">📝 Blog</a></li>
    </ul>
    <?php
}

/**
 * Customize excerpt length
 */
function chacoevents_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'chacoevents_excerpt_length');

/**
 * Customize excerpt more text
 */
function chacoevents_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'chacoevents_excerpt_more');

/**
 * Register Theme Customizer settings
 */
function chacoevents_customize_register($wp_customize) {
    // Add Social Media Section
    $wp_customize->add_section('chacoevents_social_media', array(
        'title'    => __('Social Media Links', 'chacoevents'),
        'priority' => 130,
    ));
    
    // Facebook
    $wp_customize->add_setting('chacoevents_facebook', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('chacoevents_facebook', array(
        'label'    => __('Facebook URL', 'chacoevents'),
        'section'  => 'chacoevents_social_media',
        'type'     => 'url',
    ));
    
    // Instagram
    $wp_customize->add_setting('chacoevents_instagram', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('chacoevents_instagram', array(
        'label'    => __('Instagram URL', 'chacoevents'),
        'section'  => 'chacoevents_social_media',
        'type'     => 'url',
    ));
    
    // LinkedIn
    $wp_customize->add_setting('chacoevents_linkedin', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('chacoevents_linkedin', array(
        'label'    => __('LinkedIn URL', 'chacoevents'),
        'section'  => 'chacoevents_social_media',
        'type'     => 'url',
    ));
    
    // YouTube
    $wp_customize->add_setting('chacoevents_youtube', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('chacoevents_youtube', array(
        'label'    => __('YouTube URL', 'chacoevents'),
        'section'  => 'chacoevents_social_media',
        'type'     => 'url',
    ));
}
add_action('customize_register', 'chacoevents_customize_register');