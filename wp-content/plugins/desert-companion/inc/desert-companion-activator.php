<?php
/**
 * Fired during plugin Activation
 *
 * @package    Desert Companion
 */

/**
 * This class defines all code necessary to run during the plugin's activation.
 *
 */
class Desert_Companion_Activator {

	public static function activate() {

        $item_details_page = get_option('item_details_page'); 
		$desert_activated_theme = wp_get_theme(); // gets the current theme
		if(!$item_details_page){
			if ( 'Cosmobit' == $desert_activated_theme->name || 'Cosmobit Child' == $desert_activated_theme->name || 'Celexo' == $desert_activated_theme->name  || 'Chitvi' == $desert_activated_theme->name  || 'Flexora' == $desert_activated_theme->name  || 'Thinity' == $desert_activated_theme->name  || 'EasyWiz' == $desert_activated_theme->name  || 'LazyPress' == $desert_activated_theme->name){
				 require desert_companion_plugin_dir .'inc/themes/cosmobit/fresh-site-data/media.php';
				require desert_companion_plugin_dir .'inc/themes/cosmobit/fresh-site-data/widget.php';
				$pages = array( esc_html__( 'Home', 'desert-companion' ), esc_html__( 'Blog', 'desert-companion' ) );
					foreach ($pages as $page){ 
					$post_data = array( 'post_author' => 1, 'post_name' => $page,  'post_status' => 'publish' , 'post_title' => $page, 'post_type' => 'page', ); 	
					if($page== 'Home'): 
						$page_option = 'page_on_front';
						$template = 'page-templates/frontpage.php';	
					else: 	
						$page_option = 'page_for_posts';
						$template = 'page.php';
					endif;
					$post_data = wp_insert_post( $post_data, false );
						if ( $post_data ){
							update_post_meta( $post_data, '_wp_page_template', $template );
							$page = get_page_by_title($page);
							update_option( 'show_on_front', 'page' );
							update_option( $page_option, $page->ID );
						}
					}
			}
			
			update_option( 'item_details_page', 'Done' );
		}
	}

}