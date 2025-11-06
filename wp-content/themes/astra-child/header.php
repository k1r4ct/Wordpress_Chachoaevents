<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    
    <!-- HAMBURGER MENU PRINCIPALE (visibile quando sidebar è chiusa) -->
    <button class="hamburger-menu" id="hamburgerMenu" aria-label="Apri Menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
    </button>
    
    <!-- SIDEBAR LATERALE A SCOMPARSA -->
    <aside class="custom-sidebar" id="customSidebar" aria-hidden="true" role="navigation" aria-label="Menu principale">
        
        <!-- Logo Area -->
        <div class="custom-sidebar-logo">
            <?php
            // Se c'è un logo personalizzato, mostralo
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                // Altrimenti mostra il nome del sito
                ?>
                <h1><?php bloginfo('name'); ?></h1>
                <?php
                $description = get_bloginfo('description', 'display');
                if ($description || is_customize_preview()) :
                    ?>
                    <p class="tagline"><?php echo $description; ?></p>
                <?php endif;
            }
            ?>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="custom-sidebar-nav">
            <?php
            // Menu WordPress personalizzato
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'sidebar-menu-list',
                    'container'      => false,
                    'depth'          => 2,
                    'fallback_cb'    => false,
                ));
            } else {
                // Menu di fallback se non è stato configurato un menu
                ?>
                <ul class="sidebar-menu-list">
                    <li class="menu-item <?php if(is_home() || is_front_page()) echo 'current-menu-item'; ?>">
                        <a href="<?php echo esc_url(home_url('/')); ?>">🏠 Home</a>
                    </li>
                    <li class="menu-item <?php if(is_page('il-chacoa')) echo 'current-menu-item'; ?>">
                        <a href="<?php echo esc_url(home_url('/il-chacoa')); ?>">🍫 Il Chacoa</a>
                    </li>
                    <li class="menu-item <?php if(is_page('chi-sono')) echo 'current-menu-item'; ?>">
                        <a href="<?php echo esc_url(home_url('/chi-sono')); ?>">👤 Chi sono?</a>
                    </li>
                    <li class="menu-item <?php if(is_page('eventi')) echo 'current-menu-item'; ?>">
                        <a href="<?php echo esc_url(home_url('/eventi')); ?>">📅 Prossimi eventi</a>
                    </li>
                    <li class="menu-item <?php if(is_page('contatti')) echo 'current-menu-item'; ?>">
                        <a href="<?php echo esc_url(home_url('/contatti')); ?>">✉️ Contatti</a>
                    </li>
                    <li class="menu-item <?php if(is_home() && !is_front_page()) echo 'current-menu-item'; ?>">
                        <a href="<?php echo esc_url(home_url('/blog')); ?>">📝 Blog</a>
                    </li>
                </ul>
                <?php
            }
            ?>
        </nav>
        
        <!-- Footer della Sidebar con Social Icons -->
        <div class="custom-sidebar-footer">
            <div class="social-icons">
                <?php
                // Puoi personalizzare questi link con i tuoi social
                $social_links = array(
                    'facebook'  => get_theme_mod('chacoevents_facebook', '#'),
                    'instagram' => get_theme_mod('chacoevents_instagram', '#'),
                    'twitter'   => get_theme_mod('chacoevents_twitter', '#'),
                );
                
                foreach ($social_links as $social => $url) {
                    if ($url && $url != '#') {
                        echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer" aria-label="' . ucfirst($social) . '">';
                        
                        // Icone SVG per i social (puoi sostituire con font icons se preferisci)
                        switch($social) {
                            case 'facebook':
                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>';
                                break;
                            case 'instagram':
                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1 1 12.324 0 6.162 6.162 0 0 1-12.324 0zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm4.965-10.405a1.44 1.44 0 1 1 2.881.001 1.44 1.44 0 0 1-2.881-.001z"/></svg>';
                                break;
                            case 'twitter':
                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>';
                                break;
                        }
                        
                        echo '</a>';
                    }
                }
                ?>
            </div>
        </div>
        
    </aside>
    
    <!-- TOGGLE BUTTON (Linguetta al lato della sidebar quando è aperta) -->
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Chiudi Menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
    </button>
    
    <!-- OVERLAY (quando sidebar è aperta) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- MAIN CONTENT -->
    <div id="content" class="site-content">
        <div class="ast-container">