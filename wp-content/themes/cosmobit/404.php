<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Cosmobit
 */

get_header();
?>
<section class="dt__error dt-py-default">
	<div class="dt-container">
		<div class="dt-row wow fadeInUp">
			<div class="dt-col-lg-12 dt-col-md-12 dt-col-12">
				<div class="dt__error-404 dt-text-center">
					<div class="dt__error-inner">
						<h3 class="title"><?php esc_html_e('404','cosmobit'); ?></h3>
						<p class="text"><?php esc_html_e('Sorry we cannot find that page! Go back to home','cosmobit'); ?></p>
						<a class="dt-btn dt-btn-primary" href="<?php echo esc_url(home_url( '/' )); ?>"><?php esc_html_e('Home Page','cosmobit'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
