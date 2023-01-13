</div></div>
<footer id="dt__footer" class="dt__footer dt__footer--one">
	<?php 
		// Footer Top
		do_action('cosmobit_footer_top'); 
		
		// Footer Widget
		do_action('cosmobit_footer_widget');

		// Footer Copyright	
		do_action('cosmobit_footer_copyright_data'); 
	?>
</footer>
<?php 
// Top Scroller
do_action('cosmobit_top_scroller'); 
?>
<?php 
wp_footer(); ?>
</body>
</html>
