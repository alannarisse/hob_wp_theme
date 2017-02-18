<?php
/**
 * Template Name: Slideshow Template
 * Description: A Page Template that showcases Sticky Posts, Asides, and Blog Posts
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage House_of_Bagels
 * @since House of Bagels 1.0
 */

// Enqueue showcase script for the slider
wp_enqueue_script( 'twentyeleven-showcase', get_template_directory_uri() . '/js/showcase.js', array( 'jquery' ), '2011-04-28' );

get_header(); ?>

		<div id="hp-primary" class="slideshow">
			<div id="content" role="main">
			<?php if ( function_exists('show_skitter') )  { show_skitter(); } ?>


				<?php
					/**
					 * Begin the featured posts section.
					 *
					 * See if we have any sticky posts and use them to create our featured posts.
					 * We limit the featured posts at ten.
					 */
					$sticky = get_option( 'sticky_posts' );

					// Proceed only if sticky posts exist.
					if ( ! empty( $sticky ) ) :

					$featured_args = array(
						'post__in' => $sticky,
						'post_status' => 'publish',
						'posts_per_page' => 3,
						'no_found_rows' => true,
					);

					// The Featured Posts query.
					$featured = new WP_Query( $featured_args );

					// Proceed only if published posts exist
					if ( $featured->have_posts() ) :

					/**
					 * We will need to count featured posts starting from zero
					 * to create the slider navigation.
					 */
					$counter_slider = 0;

					?>
<!-- -->
	<div id="hp-content">
				<div id="hp-featured-posts">

				<?php
					// Let's roll.
					while ( $featured->have_posts() ) : $featured->the_post();

					// Increase the counter.
					$counter_slider++;

					/**
					 * We're going to add a class to our featured post for featured images
					 * by default it'll have the feature-text class.
					 */
					$feature_class = 'feature-text';

					if ( has_post_thumbnail() ) {
						// ... but if it has a featured image let's add some class
						$feature_class = 'feature-image small';

						// Hang on. Let's check this here image out.
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( HEADER_IMAGE_WIDTH, HEADER_IMAGE_WIDTH ) );

						// Is it bigger than or equal to our header?
						if ( $image[1] >= HEADER_IMAGE_WIDTH ) {
							// If bigger, let's add a BIGGER class. It's EXTRA classy now.
							$feature_class = 'feature-image large';
						}
					}
					?>
					<div id="feature-item">
					<div id="featured-image">
						<?php
							/**
							 * If the thumbnail is as big as the header image
							 * make it a large featured post, otherwise render it small
							 */
							if ( has_post_thumbnail() ) {
								if ( $image[1] >= HEADER_IMAGE_WIDTH )
									$thumbnail_size = 'large-feature';
								else
									$thumbnail_size = 'small-feature';
								?>
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'hob' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( $thumbnail_size ); ?></a>
								
								<?php
							}
						?>
				</div>						
				<div id="featured-title">
					<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'hob' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<span class="hp-byline"><?php the_date(); ?> by <?php the_author(); ?></span> 
					
					<span class="hp-comments"><a href="<?php comments_link(); ?> "><?php comments_number( '<img src="http://alannarisse.com/hob/wp-content/themes/hob/images/comment-bubble-sm.png"> 0', '<img src="http://alannarisse.com/hob/wp-content/themes/hob/images/comment-bubble-sm.png"/> 1', '<img src="http://alannarisse.com/hob/wp-content/themes/hob/images/comment-bubble-sm.png"/> %' ); ?></a></span>
					<!-- 				<section class="featured-post <?php echo $feature_class; ?>" id="featured-post-<?php echo $counter_slider; ?>"> -->
				</div>
				</div>
				<?php endwhile;	?>


				</div>
				<!-- .featured-posts -->
				
				<!-- promo2-spot -->
				
				<div id="hp-promo2spot" style="">
				
								<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/**
					 * We are using a heading by rendering the_content
					 * If we have content for this page, let's display it.
					 */
					if ( '' != get_the_content() )
						get_template_part( 'content', 'intro' );
				?>

				<?php endwhile; ?>
				
				</div>
				<!-- .promo2-spot -->
	</div>				
				<?php endif; // End check for published posts. ?>
				<?php endif; // End check for sticky posts. ?>

<!-- -->






			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>