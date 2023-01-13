<?php 
/**
 * The sidebar containing the main widget area
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cosmobit
 */
if ( ! is_active_sidebar( 'cosmobit-sidebar-primary' ) ) {	return; } ?>
<div class="dt-col-lg-4 dt-col-md-12 dt-col-12">
	<div class="dt_widget-area">
		<?php dynamic_sidebar('cosmobit-sidebar-primary'); ?>
	</div>
</div>