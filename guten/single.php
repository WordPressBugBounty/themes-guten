<?php
/**
 * The template for displaying all single posts.
 *
 * @package Guten
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'templates/contents/content', 'single' ); ?>

			<?php
			if ( !get_theme_mod( 'guten-single-remove-pagination', customizer_library_get_default( 'guten-single-remove-pagination' ) ) ) {
				the_post_navigation();
			} ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif; ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>