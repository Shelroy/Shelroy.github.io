<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cosmobit
 */

/*=========================================
Theme Page Header Title
=========================================*/
function cosmobit_theme_page_header_title(){
	if( is_archive() )
	{
		echo '<h1>';
		if ( is_day() ) :
		/* translators: %1$s %2$s: date */	
		  printf( esc_html__( '%1$s %2$s', 'cosmobit' ), esc_html__('Archives','cosmobit'), get_the_date() );  
        elseif ( is_month() ) :
		/* translators: %1$s %2$s: month */	
		  printf( esc_html__( '%1$s %2$s', 'cosmobit' ), esc_html__('Archives','cosmobit'), get_the_date( 'F Y' ) );
        elseif ( is_year() ) :
		/* translators: %1$s %2$s: year */	
		  printf( esc_html__( '%1$s %2$s', 'cosmobit' ), esc_html__('Archives','cosmobit'), get_the_date( 'Y' ) );
		elseif( is_author() ):
		/* translators: %1$s %2$s: author */	
			printf( esc_html__( '%1$s %2$s', 'cosmobit' ), esc_html__('All posts by','cosmobit'), get_the_author() );
        elseif( is_category() ):
		/* translators: %1$s %2$s: category */	
			printf( esc_html__( '%1$s %2$s', 'cosmobit' ), esc_html__('Category','cosmobit'), single_cat_title( '', false ) );
		elseif( is_tag() ):
		/* translators: %1$s %2$s: tag */	
			printf( esc_html__( '%1$s %2$s', 'cosmobit' ), esc_html__('Tag','cosmobit'), single_tag_title( '', false ) );
		elseif( class_exists( 'WooCommerce' ) && is_shop() ):
		/* translators: %1$s %2$s: WooCommerce */	
			printf( esc_html__( '%1$s %2$s', 'cosmobit' ), esc_html__('Shop','cosmobit'), single_tag_title( '', false ));
        elseif( is_archive() ): 
		the_archive_title( '<h1>', '</h1>' ); 
		endif;
		echo '</h1>';
	}
	elseif( is_404() )
	{
		echo '<h1>';
		/* translators: %1$s: 404 */	
		printf( esc_html__( '%1$s ', 'cosmobit' ) , esc_html__('404','cosmobit') );
		echo '</h1>';
	}
	elseif( is_search() )
	{
		echo '<h1>';
		/* translators: %1$s %2$s: search */
		printf( esc_html__( '%1$s %2$s', 'cosmobit' ), esc_html__('Search results for','cosmobit'), get_search_query() );
		echo '</h1>';
	}
	else
	{
		echo '<h1>'.esc_html( get_the_title() ).'</h1>';
	}
}


/*=========================================
Theme Breadcrumbs Url
=========================================*/
function cosmobit_page_url() {
	$page_url = 'http';
	if ( key_exists("HTTPS", $_SERVER) && ( $_SERVER["HTTPS"] == "on" ) ){
		$page_url .= "s";
	}
	$page_url .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $page_url;
}


/*=========================================
Theme Breadcrumbs
=========================================*/
if( !function_exists('cosmobit_page_header_breadcrumbs') ):
	function cosmobit_page_header_breadcrumbs() { 	
		global $post;
		$homeLink = home_url();
								
			if (is_home() || is_front_page()) :
				echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','cosmobit').'</a></li>';
	            echo '<li class="breadcrumb-item active">'; echo single_post_title(); echo '</li>';
			else:
				echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','cosmobit').'</a></li>';
				if ( is_category() ) {
				    echo '<li class="breadcrumb-item active"><a href="'. cosmobit_page_url() .'">' . __('Archive by category','cosmobit').' "' . single_cat_title('', false) . '"</a></li>';
				} elseif ( is_day() ) {
					echo '<li class="breadcrumb-item active"><a href="'. get_year_link(get_the_time('Y')) . '">'. get_the_time('Y') .'</a>';
					echo '<li class="breadcrumb-item active"><a href="'. get_month_link(get_the_time('Y'),get_the_time('m')) .'">'. get_the_time('F') .'</a>';
					echo '<li class="breadcrumb-item active"><a href="'. cosmobit_page_url() .'">'. get_the_time('d') .'</a></li>';
				} elseif ( is_month() ) {
					echo '<li class="breadcrumb-item active"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
					echo '<li class="breadcrumb-item active"><a href="'. cosmobit_page_url() .'">'. get_the_time('F') .'</a></li>';
				} elseif ( is_year() ) {
				    echo '<li class="breadcrumb-item active"><a href="'. cosmobit_page_url() .'">'. get_the_time('Y') .'</a></li>';
				} elseif ( is_single() && !is_attachment() && is_page('single-product') ) {					
				if ( get_post_type() != 'post' ) {
					$cat = get_the_category(); 
					$cat = $cat[0];
					echo '<li class="breadcrumb-item">';
					echo get_category_parents($cat, TRUE, '');
					echo '</li>';
					echo '<li class="breadcrumb-item active"><a href="' . cosmobit_page_url() . '">'. get_the_title() .'</a></li>';
				} }  
					elseif ( is_page() && $post->post_parent ) {
				    $parent_id  = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						$breadcrumbs[] = '<li class="breadcrumb-item active"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ($breadcrumbs as $crumb) echo $crumb;
					    echo '<li class="breadcrumb-item active"><a href="' . cosmobit_page_url() . '">'. get_the_title() .'</a></li>';
                    }
					elseif( is_search() )
					{
					    echo '<li class="breadcrumb-item active"><a href="' . cosmobit_page_url() . '">'. get_search_query() .'</a></li>';
					}
					elseif( is_404() )
					{
						echo '<li class="breadcrumb-item active"><a href="' . cosmobit_page_url() . '">'.__('Error 404','cosmobit').'</a></li>';
					}
					else { 
					    echo '<li class="breadcrumb-item active"><a href="' . cosmobit_page_url() . '">'. get_the_title() .'</a></li>';
					}
				endif;
        }
endif;


/*=========================================
Backward compatibility for wp_body_open hook.
=========================================*/
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}


/*=========================================
Cosmobit String Replace
=========================================*/
if (!function_exists('cosmobit_str_replace_assoc')) {
    function cosmobit_str_replace_assoc(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}


/*=========================================
Register Google fonts for Cosmobit.
=========================================*/
function cosmobit_google_fonts_url() {
	
    $font_families = array('Quicksand:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900');

	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	return wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

function cosmobit_google_fonts_scripts_styles() {
    wp_enqueue_style( 'cosmobit-google-fonts', cosmobit_google_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'cosmobit_google_fonts_scripts_styles' );

/*=========================================
Cosmobit Site Preloader
=========================================*/
if ( ! function_exists( 'cosmobit_site_preloader' ) ) :
function cosmobit_site_preloader() {
	$cosmobit_hs_preloader_option 	= get_theme_mod( 'cosmobit_hs_preloader_option'); 
	if($cosmobit_hs_preloader_option == '1') { 
	?>
		 <div class="prealoader">
			<!--=== / Start: As--Preloader / === -->
			<div class="spinner">
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			</div>
			<!--=== / Start: As--Preloader / === -->
		</div>
	<?php }
	} 
endif;
add_action( 'cosmobit_site_preloader', 'cosmobit_site_preloader' );



/*=========================================
Cosmobit Site Header
=========================================*/
if ( ! function_exists( 'cosmobit_site_main_header' ) ) :
function cosmobit_site_main_header() {
		get_template_part('template-parts/site','header');
	} 
endif;
add_action( 'cosmobit_site_main_header', 'cosmobit_site_main_header' );



/*=========================================
Cosmobit Header Image
=========================================*/
if ( ! function_exists( 'cosmobit_wp_hdr_image' ) ) :
function cosmobit_wp_hdr_image() {
	if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-header" id="custom-header" rel="home">
		<img src="<?php esc_url(header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
	</a>
<?php endif;
	} 
endif;
add_action( 'cosmobit_wp_hdr_image', 'cosmobit_wp_hdr_image' );



/*=========================================
Cosmobit Site Navigation
=========================================*/
if ( ! function_exists( 'cosmobit_site_header_navigation' ) ) :
function cosmobit_site_header_navigation() {
	wp_nav_menu( 
		array(  
			'theme_location' => 'primary_menu',
			'container'  => '',
			'menu_class' => 'dt__navbar-mainmenu',
			'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
			'walker' => new WP_Bootstrap_Navwalker()
			 ) 
		);
	} 
endif;
add_action( 'cosmobit_site_header_navigation', 'cosmobit_site_header_navigation' );


/*=========================================
Cosmobit Header Button
=========================================*/
if ( ! function_exists( 'cosmobit_header_button' ) ) :
function cosmobit_header_button() {
	$cosmobit_hs_hdr_btn 		= get_theme_mod( 'cosmobit_hs_hdr_btn','1'); 
	$cosmobit_hdr_btn_lbl 		= get_theme_mod( 'cosmobit_hdr_btn_lbl'); 
	$cosmobit_hdr_btn_link 		= get_theme_mod( 'cosmobit_hdr_btn_link'); 
	$cosmobit_hdr_btn_target 		= get_theme_mod( 'cosmobit_hdr_btn_target');
	if($cosmobit_hdr_btn_target=='1'): $target='target=_blank'; else: $target=''; endif; 
	if($cosmobit_hs_hdr_btn=='1'  && !empty($cosmobit_hdr_btn_lbl)):	
?>
	<li class="dt__navbar-button-item">
		<a href="<?php echo esc_url($cosmobit_hdr_btn_link); ?>" <?php echo esc_attr($target); ?> class="dt-btn dt-btn-primary"><?php echo wp_kses_post($cosmobit_hdr_btn_lbl); ?></a>
	</li>
<?php endif;
	} 
endif;
add_action( 'cosmobit_header_button', 'cosmobit_header_button' );


/*=========================================
Cosmobit Site Search
=========================================*/
if ( ! function_exists( 'cosmobit_site_main_search' ) ) :
function cosmobit_site_main_search() {
	$cosmobit_hs_hdr_search 	= get_theme_mod( 'cosmobit_hs_hdr_search','1'); 
	if($cosmobit_hs_hdr_search=='1'):	
?>
<li class="dt__navbar-search-item">
	<button class="dt__navbar-search-toggle"><i class="fa fa-search" aria-hidden="true"></i></button>
	<div class="dt__search search--header">
		<form  method="get" class="dt__search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'search again', 'cosmobit' ); ?>">
			<label for="dt__search-form-1">
				<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'cosmobit' ); ?></span>
				<input type="search" id="dt__search-form-1" class="dt__search-field" placeholder="<?php esc_attr_e( 'search Here', 'cosmobit' ); ?>" value="" name="s">
			</label>
			<button type="submit" class="dt__search-submit search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
		</form>
		<button type="button" class="dt__search-close"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
	</div>
</li>
<?php endif;
	} 
endif;
add_action( 'cosmobit_site_main_search', 'cosmobit_site_main_search' );



/*=========================================
Cosmobit WooCommerce Cart
=========================================*/
if ( ! function_exists( 'cosmobit_woo_cart' ) ) :
function cosmobit_woo_cart() {
	$cosmobit_hs_hdr_cart 	= get_theme_mod( 'cosmobit_hs_hdr_cart','1'); 
		if($cosmobit_hs_hdr_cart=='1' && class_exists( 'WooCommerce' )):	
	?>
	<li class="dt__navbar-cart-item">
		<a href="javascript:void(0);" class="dt__navbar-cart-icon">
			<span class="cart--icon">
				<?php 
				$count = WC()->cart->cart_contents_count;
				if ( $count > 0 ) { ?>
					 <strong class="cart-count"><?php echo esc_html( $count ); ?></strong>
				<?php }else { ?>
					<strong class="cart-count"><?php  esc_html_e('0','cosmobit'); ?></strong>
				<?php } ?>
			</span>
		</a>
		<div class="dt__navbar-shopcart">
			<?php get_template_part('woocommerce/cart/mini','cart'); ?>
		</div>
	</li>
	<?php endif; 
	} 
endif;
add_action( 'cosmobit_woo_cart', 'cosmobit_woo_cart' );


/*========================================================================
Add WooCommerce Cart Icon With Cart Count (https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header)
=========================================================================*/
function cosmobit_woo_add_to_cart_fragment( $fragments ) {
    ob_start();
    $count = WC()->cart->cart_contents_count; 
    ?> 
	<?php 
		$count = WC()->cart->cart_contents_count;
		if ( $count > 0 ) { ?>
			 <strong class="cart-count"><?php echo esc_html( $count ); ?></strong>
		<?php }else { ?>
			<strong class="cart-count"><?php esc_html_e('0','cosmobit'); ?></strong>
		<?php } 
    $fragments['.cart-count'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'cosmobit_woo_add_to_cart_fragment' );



/*=========================================
Cosmobit Site Logo
=========================================*/
if ( ! function_exists( 'cosmobit_site_logo' ) ) :
function cosmobit_site_logo() {
		if(has_custom_logo())
			{	
				the_custom_logo();
			}
			else { 
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site--title">
				<h4 class="site-title">
					<?php 
						echo esc_html(get_bloginfo('name'));
					?>
				</h4>
			</a>	
		<?php 						
			}
		?>
		<?php
			$cosmobit_description = get_bloginfo( 'description');
			if ($cosmobit_description) : ?>
				<p class="site-description"><?php echo esc_html($cosmobit_description); ?></p>
		<?php endif;
	} 
endif;
add_action( 'cosmobit_site_logo', 'cosmobit_site_logo' );


/*=========================================
Cosmobit Footer Widget
=========================================*/
if ( ! function_exists( 'cosmobit_footer_widget' ) ) :
function cosmobit_footer_widget() {
	?>
		<div class="dt__footer-middle">
			<div class="dt-container">
				<div class="dt-row dt-g-4">
					<?php if ( is_active_sidebar( 'cosmobit-footer-widget-1' ) ) : ?>
						<div class="dt-col-lg-3 dt-col-md-6">
							 <?php dynamic_sidebar( 'cosmobit-footer-widget-1'); ?>
						</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'cosmobit-footer-widget-2' ) ) : ?>
						<div class="dt-col-lg-3 dt-col-md-6">
							 <?php dynamic_sidebar( 'cosmobit-footer-widget-2'); ?>
						</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'cosmobit-footer-widget-3' ) ) : ?>
						<div class="dt-col-lg-3 dt-col-md-6">
							 <?php dynamic_sidebar( 'cosmobit-footer-widget-3'); ?>
						</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'cosmobit-footer-widget-4' ) ) : ?>
						<div class="dt-col-lg-3 dt-col-md-6">
							 <?php dynamic_sidebar( 'cosmobit-footer-widget-4'); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php 
	} 
endif;
add_action( 'cosmobit_footer_widget', 'cosmobit_footer_widget' );


/*=========================================
Cosmobit Footer Copyright
=========================================*/
if ( ! function_exists( 'cosmobit_footer_copyright_data' ) ) :
function cosmobit_footer_copyright_data() {
	$cosmobit_footer_copyright_first_img = get_theme_mod('cosmobit_footer_copyright_first_img');
	$cosmobit_footer_copyright_first_link = get_theme_mod('cosmobit_footer_copyright_first_link',esc_url( home_url( '/' ) ));
	$cosmobit_footer_copyright_second_text = get_theme_mod('cosmobit_footer_copyright_second_text','Copyright &copy; [current_year] [site_title] | Powered by [theme_author]');
	if(!empty($cosmobit_footer_copyright_first_img) || !empty($cosmobit_footer_copyright_second_text)):
	?>
		<div class="dt__footer-copyright">
			<div class="dt-container">
				<div class="dt-row dt-g-4 dt-mt-md-0">
					<div class="dt-col-md-4 dt-col-sm-6 dt-text-sm-left dt-text-center">
						<?php if(!empty($cosmobit_footer_copyright_first_img)): ?>
							<aside id="block-14" class="widget widget_block widget_media_image">
								<figure class="wp-block-image size-full">
									<a href="<?php echo esc_url($cosmobit_footer_copyright_first_link); ?>"><img width="180" height="42" src="<?php echo esc_url($cosmobit_footer_copyright_first_img); ?>" /></a>
								</figure>
							</aside>
						<?php endif; ?>	
					</div>
					<div class="dt-col-md-4 dt-col-sm-6 dt-text-sm-center dt-text-center">
						<?php if(!empty($cosmobit_footer_copyright_second_text)): 
								$cosmobit_copyright_allowed_tags = array(
										'[current_year]' => date_i18n('Y'),
										'[site_title]'   => get_bloginfo('name'),
										'[theme_author]' => sprintf(__('<a href="https://desertthemes.com/" target="_blank">Desert Themes</a>', 'cosmobit')),
									);
						?>
							<div class="dt__footer-copyright-text">
								<?php
									echo apply_filters('cosmobit_footer_copyright', wp_kses_post(cosmobit_str_replace_assoc($cosmobit_copyright_allowed_tags, $cosmobit_footer_copyright_second_text)));
								?>
							</div>
						<?php endif; ?>	
					</div>
					<div class="dt-col-md-4 dt-col-sm-6 dt-text-sm-right dt-text-center">
						<div class="widget widget_nav_menu">
							<div class="menu-copyright-menu-container">
								<?php
									wp_nav_menu( 
										array(  
											'theme_location' => 'footer_menu',
											'container'  => '',
											'menu_class' => 'menu',
											'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
											'walker' => new WP_Bootstrap_Navwalker()
											 ) 
										);
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif;
	} 
endif;
add_action( 'cosmobit_footer_copyright_data', 'cosmobit_footer_copyright_data' );



/*=========================================
Cosmobit Scroller
=========================================*/
if ( ! function_exists( 'cosmobit_top_scroller' ) ) :
function cosmobit_top_scroller() {
	$cosmobit_hs_scroller_option	=	get_theme_mod('cosmobit_hs_scroller_option','1');
?>		
	<?php if ($cosmobit_hs_scroller_option == '1') { ?>
		<button type="button" class="dt__uptop"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
	<?php }
	} 
endif;
add_action( 'cosmobit_top_scroller', 'cosmobit_top_scroller' );