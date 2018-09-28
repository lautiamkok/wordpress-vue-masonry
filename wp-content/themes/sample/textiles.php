<?php
/*
Template Name: Textiles
*/
/**
 * The template for displaying Textiles page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Sample
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>

<main role="main">

	<?php // Show the selected frontpage content.
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();

            // Send $parentSlug to template.
            set_query_var('slug', 'textiles');
			get_template_part( 'template-parts/page/content', 'collections-page' );
		endwhile;
	else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
		get_template_part( 'template-parts/post/content', 'none' );
	endif;
    ?>

</main>

<?php get_footer();
