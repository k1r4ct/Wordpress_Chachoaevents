<?php
/**
 * Template for the Homepage
 * 
 * @package Chacoevents
 */

get_header(); ?>

<!-- HERO BANNER -->
<section class="hero-banner">
    <h1>Benvenuti a Chacoevents</h1>
    <p>Scopri il mondo del cioccolato artigianale e del thè pregiato attraverso degustazioni esclusive ed eventi unici</p>
    <a href="#eventi" class="cta-button">Scopri i prossimi eventi</a>
</section>

<!-- SEZIONE EVENTI -->
<section class="content-section" id="eventi">
    <h2>I Nostri Eventi</h2>
    <div class="event-grid">
        
        <!-- Card Evento 1 -->
        <div class="event-card">
            <div class="event-card-image">🍫</div>
            <div class="event-card-content">
                <h3>Degustazione Cioccolato</h3>
                <p>Un viaggio sensoriale attraverso le migliori origini del cacao. Scopri le sfumature e i profumi del cioccolato artigianale.</p>
                <a href="<?php echo home_url('/chacoa'); ?>" class="btn">Scopri di più →</a>
            </div>
        </div>

        <!-- Card Evento 2 -->
        <div class="event-card">
            <div class="event-card-image">☕</div>
            <div class="event-card-content">
                <h3>Cerimonia del Thè</h3>
                <p>Immergiti nella tradizione millenaria del thè con le nostre selezioni pregiate provenienti da tutto il mondo.</p>
                <a href="<?php echo home_url('/cerimonia-the'); ?>" class="btn">Scopri di più →</a>
            </div>
        </div>

        <!-- Card Evento 3 -->
        <div class="event-card">
            <div class="event-card-image">🎉</div>
            <div class="event-card-content">
                <h3>Eventi Privati</h3>
                <p>Organizziamo degustazioni personalizzate per eventi aziendali, compleanni e occasioni speciali.</p>
                <a href="<?php echo home_url('/eventi-privati'); ?>" class="btn">Scopri di più →</a>
            </div>
        </div>

    </div>
</section>

<!-- SEZIONE GALLERY -->
<section class="content-section gallery-section">
    <h2>I Momenti Più Belli</h2>
    
    <?php
    // Se hai installato Smash Balloon Instagram Feed, usa questo shortcode
    if (shortcode_exists('instagram-feed')) {
        echo do_shortcode('[instagram-feed]');
    } else {
        // Altrimenti mostra una gallery placeholder
        ?>
        <div class="gallery-grid">
            <div class="gallery-item">📸</div>
            <div class="gallery-item">🍰</div>
            <div class="gallery-item">🎂</div>
            <div class="gallery-item">🍵</div>
            <div class="gallery-item">🌿</div>
            <div class="gallery-item">✨</div>
        </div>
        <p style="text-align: center; margin-top: 30px; color: #666;">
            <em>Installa Smash Balloon Instagram Feed per mostrare le tue foto qui!</em>
        </p>
        <?php
    }
    ?>
</section>

<!-- CONTENUTO AGGIUNTIVO DALLA PAGINA (se presente) -->
<?php
if (have_posts()) :
    while (have_posts()) : the_post();
        if (get_the_content()) : ?>
            <section class="content-section">
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
            </section>
        <?php 
        endif;
    endwhile;
endif;
?>

<?php get_footer(); ?>