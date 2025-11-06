/**
 * Chacoevents Navigation Script
 * Gestione sidebar con linguetta hamburger elegante
 * Version: 2.0.0
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        // Elementi principali
        const hamburger = document.getElementById('hamburgerMenu');
        const sidebar = document.getElementById('customSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const body = document.body;
        
        // Verifica che tutti gli elementi esistano
        if (!hamburger || !sidebar || !overlay) {
            console.warn('Elementi sidebar non trovati');
            return;
        }

        // Funzione per aprire la sidebar
        function openSidebar() {
            body.classList.add('sidebar-open');
            hamburger.classList.add('hidden');
            sidebar.classList.add('active');
            overlay.classList.add('active');
            
            // Accessibilità
            sidebar.setAttribute('aria-hidden', 'false');
            if (sidebarToggle) {
                sidebarToggle.setAttribute('aria-expanded', 'true');
            }
            
            // Previeni scroll del body su mobile
            if (window.innerWidth <= 768) {
                body.style.overflow = 'hidden';
            }
        }
        
        // Funzione per chiudere la sidebar
        function closeSidebar() {
            body.classList.remove('sidebar-open');
            hamburger.classList.remove('hidden');
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            
            // Accessibilità
            sidebar.setAttribute('aria-hidden', 'true');
            if (sidebarToggle) {
                sidebarToggle.setAttribute('aria-expanded', 'false');
            }
            
            // Ripristina scroll del body
            body.style.overflow = '';
        }
        
        // Funzione toggle
        function toggleSidebar() {
            if (sidebar.classList.contains('active')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        }
        
        // Event Listeners
        
        // Click sul hamburger per aprire
        hamburger.addEventListener('click', openSidebar);
        
        // Click sul toggle button della sidebar per chiudere
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', closeSidebar);
        }
        
        // Click sull'overlay per chiudere
        overlay.addEventListener('click', closeSidebar);
        
        // Tasto ESC per chiudere
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                closeSidebar();
            }
        });
        
        // Chiudi sidebar quando clicchi su un link del menu (con delay per navigazione)
        const menuLinks = sidebar.querySelectorAll('.sidebar-menu-list a, .custom-sidebar-nav a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Se è un link interno (anchor)
                if (this.getAttribute('href').startsWith('#')) {
                    closeSidebar();
                } else {
                    // Delay per permettere la navigazione
                    setTimeout(function() {
                        if (sidebar.classList.contains('active')) {
                            closeSidebar();
                        }
                    }, 200);
                }
            });
        });
        
        // Gestione resize finestra
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                // Se la finestra diventa grande e la sidebar è aperta
                if (window.innerWidth > 1024 && sidebar.classList.contains('active')) {
                    body.style.overflow = '';
                }
                // Se la finestra diventa piccola e la sidebar è aperta
                if (window.innerWidth <= 768 && sidebar.classList.contains('active')) {
                    body.style.overflow = 'hidden';
                }
            }, 250);
        });
        
        // Swipe gestures per dispositivi touch
        let touchStartX = null;
        let touchStartY = null;
        
        document.addEventListener('touchstart', function(e) {
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
        });
        
        document.addEventListener('touchmove', function(e) {
            if (!touchStartX || !touchStartY) return;
            
            const touchEndX = e.touches[0].clientX;
            const touchEndY = e.touches[0].clientY;
            const diffX = touchStartX - touchEndX;
            const diffY = touchStartY - touchEndY;
            
            // Controlla che sia uno swipe orizzontale
            if (Math.abs(diffX) > Math.abs(diffY)) {
                // Swipe a sinistra per chiudere
                if (diffX > 50 && sidebar.classList.contains('active')) {
                    closeSidebar();
                    touchStartX = null;
                    touchStartY = null;
                }
                
                // Swipe a destra per aprire (solo se inizia dal bordo sinistro)
                if (diffX < -50 && !sidebar.classList.contains('active') && touchStartX < 30) {
                    openSidebar();
                    touchStartX = null;
                    touchStartY = null;
                }
            }
        });
        
        document.addEventListener('touchend', function() {
            touchStartX = null;
            touchStartY = null;
        });
        
        // Evidenzia pagina corrente nel menu
        const currentUrl = window.location.href;
        const menuItems = sidebar.querySelectorAll('.sidebar-menu-list a, .custom-sidebar-nav a');
        
        menuItems.forEach(function(item) {
            // Rimuovi eventuali classi esistenti
            item.parentElement.classList.remove('current-menu-item');
            
            // Aggiungi classe se l'URL corrisponde
            if (currentUrl === item.href || 
                (item.href !== '#' && currentUrl.includes(item.href))) {
                item.parentElement.classList.add('current-menu-item');
            }
        });
        
        // Animazione smooth scroll per link interni
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId && targetId !== '#') {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        e.preventDefault();
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        // Chiudi sidebar dopo scroll
                        if (sidebar.classList.contains('active')) {
                            setTimeout(closeSidebar, 300);
                        }
                    }
                }
            });
        });
        
        // Inizializza attributi ARIA
        sidebar.setAttribute('aria-hidden', 'true');
        sidebar.setAttribute('role', 'navigation');
        sidebar.setAttribute('aria-label', 'Menu principale');
        if (sidebarToggle) {
            sidebarToggle.setAttribute('aria-expanded', 'false');
        }
    });
})();