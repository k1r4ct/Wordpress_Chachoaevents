<?php
/**
 * Template for displaying all pages
 * 
 * @package Chacoevents
 */

get_header(); ?>

<section class="content-section" style="padding-top: 100px;">
    <div class="container">
        <?php
        while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                
                <div class="entry-content">
                    <?php 
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">Pagine: ',
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
                
                <?php
                // Se i commenti sono aperti o abbiamo almeno un commento
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </article>
            
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>