<?php
/**
 * The template for displaying archive pages for DP Camper custom post type.
 *
 * @package dp-camper
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title"><?php
                    printf( esc_html__( 'All %s', 'dp-camper' ), '<span>' . get_post_type() . '</span>' );
                ?></h1>
            </header><!-- .page-header -->

            <?php
            // Start the Loop.
            while ( have_posts() ) :
                the_post();

                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', get_post_type() );

            endwhile;

            // Previous/next page navigation.
            the_posts_pagination( array(
                'prev_text' => __( 'Previous page', 'dp-camper' ),
                'next_text' => __( 'Next page', 'dp-camper' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'dp-camper' ) . ' </span>',
            ) );

        // If no content, include the "No posts found" template.
        else :
            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>