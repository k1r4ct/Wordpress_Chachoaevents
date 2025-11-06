/**
 * Chacoevents Navigation Script
 * Gestisce l'apertura/chiusura del menu sidebar
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        const hamburger = document.getElementById('hamburgerMenu');
        const sidebar = document.getElementById('customSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        if (!hamburger || !sidebar || !overlay) return;

        function toggleSidebar() {
            hamburger.classList.toggle('active');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        
        // Click sul bottone hamburger
        hamburger.addEventListener('click', toggleSidebar);
        
        // Click sull'overlay per chiudere
        overlay.addEventListener('click', toggleSidebar);
        
        // Chiudi sidebar quando clicchi su un link del menu
        const menuLinks = sidebar.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Piccolo delay per permettere la navigazione
                setTimeout(function() {
                    if (sidebar.classList.contains('active')) {
                        toggleSidebar();
                    }
                }, 200);
            });
        });
        
        // Chiudi sidebar con tasto ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                toggleSidebar();
            }
        });

        // Evidenzia la pagina corrente nel menu
        const currentUrl = window.location.href;
        const menuItems = sidebar.querySelectorAll('.sidebar-menu-list a');
        
        menuItems.forEach(function(item) {
            if (currentUrl === item.href) {
                item.parentElement.classList.add('current-menu-item');
            }
        });
    });

})(jQuery);