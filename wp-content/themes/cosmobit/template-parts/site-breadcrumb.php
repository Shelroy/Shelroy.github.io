<?php 
$cosmobit_hide_site_breadcrumb= get_theme_mod('cosmobit_hs_site_breadcrumb','1');
$cosmobit_breadcrumb_background_img	= get_theme_mod('cosmobit_breadcrumb_bg_img',esc_url(get_template_directory_uri() .'/assets/images/pagetitle_bg.jpg'));	
if($cosmobit_hide_site_breadcrumb == '1'):	
?>
<section class="dt__pagetitle" style="background-image: url('<?php echo esc_url($cosmobit_breadcrumb_background_img); ?>');">
	<div class="dt-container">
		<div class="dt__pagetitle-content">
			<div class="dt__pagetitle-wrapper">
				<div class="title">
					<?php
		                if(is_home() || is_front_page()) {
		                    echo '<h1>'; single_post_title(); echo '</h1>';
		                } else {
		                    cosmobit_theme_page_header_title();
		                } 
					?>
				</div>
				<ul class="dt__pagetitle-breadcrumb">
					<?php cosmobit_page_header_breadcrumbs(); ?>
				</ul>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>	