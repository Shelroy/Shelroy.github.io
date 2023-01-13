<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cosmobit
 */

get_header(); 
?>
<section class="dt__posts dt-py-default">
	<div class="dt-container">
		<div class="dt-row dt-g-5">
			<?php if (  !is_active_sidebar( 'cosmobit-sidebar-primary' ) ): ?>
				<div class="dt-col-lg-12 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php else: ?>	
				<div class="dt-col-lg-8 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php endif; ?>	
				<div class="dt-row dt-g-4">
					<div class="dt-col-lg-12 dt-col-md-12 dt-col-12 wow fadeInUp">
						<?php if( have_posts() ): ?>
						<?php 
						// Start the loop.
						while( have_posts() ): the_post(); ?>
							<article id="post-1" class="post-1 dt__post">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="dt__post-thumb">
										<?php the_post_thumbnail(); ?>
									</div>
								<?php } ?>
								<div class="dt__post-top-meta">
									<ul class="top-meta-list">
										<li>
											<div class="dt__post-date"><a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo esc_html(get_the_date('M, D, Y')); ?></a></div>
										</li>
										<li>
											<?php  $user = wp_get_current_user(); ?>
											<div class="dt__post-author"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><span class="author-img"><img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" srcset="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" class="avatar avatar-30 photo" height="30" width="30"></span><span class="author-name"><?php esc_html(the_author()); ?></span></a></div>
										</li>
										<li>
											<div class="dt__post-category"><i class="before-icon fa fa-folder-o" aria-hidden="true"></i><?php the_category(' '); ?></div>
										</li>                                            
									</ul>
								</div>
								<div class="dt__post-entry">
									<?php     
										if ( is_single() ) :
										
										the_title('<h5 class="dt__post-title">', '</h5>' );
										
										else:
										
										the_title( sprintf( '<h5 class="dt__post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
										
										endif; 
										
										the_content( 
											sprintf( 
												__( 'Read More', 'cosmobit' ), 
												'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
											) 
										);
									?> 
								</div>
								<div class="dt__post-bottom-meta">
									<div class="post-meta pull-left">
										<div class="post-tags"><?php the_tags('', ', ', ''); ?></div>
									</div>
									<div class="post-meta pull-right">
										 <div class="post-comment"><a href="#respond" rel="bookmark" class="comments-count"><?php esc_html_e('Comments','cosmobit'); ?> <?php echo esc_html(get_comments_number($post->ID)); ?></a></div>
									</div>
								</div>
							</article>
						<?php endwhile; 
						// End the loop.
						endif; ?>
						<?php 
						// Comment Template
						comments_template( '', true );  ?>
					</div>
				</div>
			</div>
			<?php  get_sidebar(); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
