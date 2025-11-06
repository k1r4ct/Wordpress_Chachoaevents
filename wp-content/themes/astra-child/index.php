<?php
/**
 * The main template file
 * 
 * @package Chacoevents
 */

get_header(); ?>

<section class="content-section" style="padding-top: 100px;">
    <div class="container">
        <?php
        if (have_posts()) :
            
            // Se siamo sulla pagina del blog
            if (is_home() && !is_front_page()) : ?>
                <header class="page-header">
                    <h1 class="page-title">Blog</h1>
                </header>
            <?php endif;
            
            // Loop attraverso i post
            while (have_posts()) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php
                        if (is_singular()) :
                            the_title('<h1 class="entry-title">', '</h1>');
                        else :
                            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                        endif;
                        ?>
                    </header>
                    
                    <?php if ('post' === get_post_type()) : ?>
                        <div class="entry-meta">
                            <span class="posted-on">
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="byline">
                                di <?php the_author(); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                    
                    <div class="entry-content">
                        <?php
                        if (is_singular()) :
                            the_content();
                            
                            wp_link_pages(array(
                                'before' => '<div class="page-links">Pagine: ',
                                'after'  => '</div>',
                            ));
                        else :
                            the_excerpt();
                            ?>
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="btn">
                                Leggi di più →
                            </a>
                            <?php
                        endif;
                        ?>
                    </div>
                </article>
                
            <?php endwhile;
            
            // Paginazione
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '← Precedente',
                'next_text' => 'Successivo →',
            ));
            
        else : ?>
            
            <div style="text-align: center; padding: 60px 20px;">
                <h2>Nessun contenuto trovato</h2>
                <p style="color: #666; margin-top: 20px;">
                    Spiacenti, la pagina che stai cercando non esiste.
                </p>
                <a href="<?php echo home_url(); ?>" class="cta-button" style="display: inline-block; margin-top: 30px;">
                    Torna alla Homepage
                </a>
            </div>
            
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>