<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cosmobit
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('dt__post dt-mb-4'); ?> class="">
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="dt__post-thumb">
			<a href="<?php echo esc_url( get_permalink() ); ?> " class="dt__post-img-link">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php } ?>
	<div class="dt__post-top-meta">
		<ul class="top-meta-list">
			<li><div class="dt__post-category"><i class="before-icon fa fa-folder-o" aria-hidden="true"></i><?php the_category(' '); ?></div></li>
		</ul>
	</div>
	<div class="dt__post-entry">
		<?php     
			if ( is_single() ) :
			
			the_title('<h5 class="dt__post-title">', '</h5>' );
			
			else:
			
			the_title( sprintf( '<h5 class="dt__post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
			
			endif; 
		?> 
		<?php
			the_content( 
					sprintf( 
						__( 'Read More', 'cosmobit' ), 
						'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
					) 
				);
		  ?>
	</div>
	<div class="dt__post-bottom-meta">
		<ul class="bottom-meta-list">
			<li>
				<div class="dt__post-author">
					<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>">
						<span class="dt__post-author-img">
							<i class="fa fa-user-o" aria-hidden="true"></i>
						</span>
						<span class="dt__post-author-name"><?php esc_html(the_author()); ?></span>
					</a>
				</div>
			</li>
		</ul>
		<ul class="bottom-meta-list">
			<li><div class="dt__post-date"><a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo esc_html(get_the_date('M, D, Y')); ?></a></div></li>
		</ul>
	</div>
</div>