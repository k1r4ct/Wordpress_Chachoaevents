<?php
/**
 * Template for displaying all single posts
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
                    
                    <div class="entry-meta">
                        <span class="posted-on">
                            Pubblicato il <?php echo get_the_date(); ?>
                        </span>
                        <span class="byline">
                            da <?php the_author_posts_link(); ?>
                        </span>
                        <?php if (has_category()) : ?>
                            <span class="cat-links">
                                in <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>
                    </div>
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
                
                <footer class="entry-footer">
                    <?php if (has_tag()) : ?>
                        <div class="tag-links">
                            Tag: <?php the_tags('', ', ', ''); ?>
                        </div>
                    <?php endif; ?>
                </footer>
                
                <?php
                // Navigazione post precedente/successivo
                the_post_navigation(array(
                    'prev_text' => '← %title',
                    'next_text' => '%title →',
                ));
                
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