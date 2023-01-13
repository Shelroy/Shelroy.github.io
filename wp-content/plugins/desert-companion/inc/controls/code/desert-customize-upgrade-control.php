<?php
/** 
 * Customize Upgrade control class.
 *
 * @package Desert Companion
 * 
 * @see     WP_Customize_Control
 * @access  public
 */

/**
 * Class Desert_Companion_Customize_Upgrade_Control
 */
 
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

class Desert_Companion_Customize_Upgrade_Control extends WP_Customize_Control {

	/**
	 * Customize control type.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'desert-companion-upgrade';

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @access protected
	 * @return void
	 */
	protected function content_template() {
		
	}

	/**
	 * Render content is still called, so be sure to override it with an empty function in your subclass as well.
	 */
	protected function render_content() {
		$desert_activated_theme = wp_get_theme(); // gets the current theme
		if('Celexo' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/celexo-pro/';
		elseif('Chitvi' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/chitvi-pro/';
		elseif('Flexora' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/flexora-pro/';	
		elseif('Thinity' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/thinity-pro/';	
		elseif('EasyWiz' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/easywiz-pro/';	
		else:
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/cosmobit-pro/';
		endif;	
		?>

		<div class="desert-companion-upgrade-message" style="display:none";>
			<?php if(!empty($this->label)): ?>
				<h4 class="customize-control-title"><?php echo wp_kses_post( 'Upgrade to <a href="'.esc_url($upgrade_to_pro_link).'" target="_blank" > '.esc_html($desert_activated_theme). ' Pro </a> to be add More ', 'desert-companion') . esc_html($this->label); ?></h4>
			<?php endif; ?>
		</div>

		<?php
	}

}