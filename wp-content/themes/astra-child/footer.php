</div><!-- .ast-container -->
    </div><!-- #content -->
    
    <!-- FOOTER -->
    <footer class="site-footer" role="contentinfo">
        <div class="ast-container">
            <div class="site-footer-wrap">
                
                <!-- Footer Content -->
                <div class="footer-content">
                    <div class="footer-copyright">
                        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tutti i diritti riservati.</p>
                        <p class="footer-tagline">
                            <?php 
                            $tagline = get_bloginfo('description');
                            if ($tagline) {
                                echo esc_html($tagline);
                            }
                            ?>
                        </p>
                    </div>
                    
                    <?php
                    // Footer menu se configurato
                    if (has_nav_menu('footer')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'container'      => 'nav',
                            'container_class' => 'footer-navigation',
                            'depth'          => 1,
                        ));
                    }
                    ?>
                </div>
                
                <!-- Back to Top Button (opzionale) -->
                <button id="backToTop" class="back-to-top" aria-label="Torna su">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                </button>
                
            </div>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

<!-- Script aggiuntivo per Back to Top -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var backToTopButton = document.getElementById('backToTop');
    if (backToTopButton) {
        // Mostra/nascondi il bottone basato sullo scroll
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });
        
        // Scroll to top quando cliccato
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});
</script>

<!-- Stili aggiuntivi per il footer -->
<style>
.site-footer {
    background: linear-gradient(to bottom, #f9f9f9 0%, #ffffff 100%);
    border-top: 1px solid #e5e5e5;
    padding: 60px 0 30px;
    margin-top: 80px;
    position: relative;
}

.footer-content {
    text-align: center;
}

.footer-copyright {
    margin-bottom: 30px;
}

.footer-copyright p {
    margin: 5px 0;
    color: #666;
    font-size: 14px;
}

.footer-tagline {
    font-style: italic;
    color: #8B7355;
}

.footer-navigation {
    margin-top: 20px;
}

.footer-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 30px;
}

.footer-menu li {
    display: inline-block;
}

.footer-menu a {
    color: #666;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
}

.footer-menu a:hover {
    color: #8B7355;
}

/* Back to Top Button */
.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 45px;
    height: 45px;
    background: #8B7355;
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.back-to-top.visible {
    opacity: 1;
    visibility: visible;
}

.back-to-top:hover {
    background: #6d5637;
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

/* Responsive Footer */
@media (max-width: 768px) {
    .site-footer {
        padding: 40px 0 20px;
        margin-top: 50px;
    }
    
    .footer-menu {
        flex-direction: column;
        gap: 15px;
    }
    
    .back-to-top {
        bottom: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
    }
}

/* Dark mode support per il footer */
@media (prefers-color-scheme: dark) {
    .site-footer {
        background: linear-gradient(to bottom, #2a2a2a 0%, #1f1f1f 100%);
        border-top-color: #444;
    }
    
    .footer-copyright p,
    .footer-menu a {
        color: #ccc;
    }
    
    .footer-menu a:hover,
    .footer-tagline {
        color: #d4a574;
    }
}
</style>

</body>
</html>