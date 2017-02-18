<?php
/**
 * Template Name: Page TwoCol
 • Description: A Page Template with a two columns
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage House_of_Bagels
 * @since House of Bagels 1.0
 */



get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?//php comments_template( '', false ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_template_part('page-twocol-right'); ?>
<?php get_footer(); ?>