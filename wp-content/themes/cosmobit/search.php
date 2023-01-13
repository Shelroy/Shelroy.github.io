<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Cosmobit
 */

get_header();
?>
<section class="dt__posts dt__posts--one dt-py-default">
	<div class="dt-container">
		<div class="dt-row dt-g-5">
			<?php if (  !is_active_sidebar( 'cosmobit-sidebar-primary' ) ): ?>
				<div class="dt-col-lg-12 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php else: ?>	
				<div class="dt-col-lg-8 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php endif;
				if( have_posts() ):
					/* Start the Loop */
					 while( have_posts() ) : the_post();
						get_template_part('template-parts/content','page');
					endwhile; 
					/* End the Loop */
					
					/* Post Navigation */
					the_posts_navigation();
					 else: get_template_part('template-parts/content','none'); 
			    endif; 
				?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
