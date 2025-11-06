</div><!-- #content .site-content -->

    <!-- FOOTER PERSONALIZZATO -->
    <footer class="site-footer">
        <div class="footer-content">
            <h3>Prenota la Tua Esperienza</h3>
            <p>Contattaci per organizzare la tua degustazione privata o per partecipare ai nostri eventi pubblici. Ti aspettiamo!</p>
            
            <div class="footer-links">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
                
                // Se non c'è un menu footer, mostra link predefiniti
                if (!has_nav_menu('footer-menu')) {
                    ?>
                    <a href="<?php echo home_url('/privacy'); ?>">Privacy Policy</a>
                    <a href="<?php echo home_url('/termini'); ?>">Termini e Condizioni</a>
                    <a href="<?php echo home_url('/contatti'); ?>">Contattaci</a>
                    <?php
                }
                ?>
            </div>
            
            <div class="copyright">
                <p>© <?php echo date('Y'); ?> <?php bloginfo('name'); ?> - Degustazioni Cioccolato & Thè | Made with ❤️</p>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>