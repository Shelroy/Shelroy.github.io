<?php
	/**
	 * @package     Freemius
	 * @copyright   Copyright (c) 2015, Freemius, Inc.
	 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
	 * @since       1.2.1.5
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	/**
	 * @var array $VARS
	 * @var Freemius $fs
	 */
	$fs   = freemius( $VARS['id'] );
	$slug = $fs->get_slug();

	$reconnect_url = $fs->get_activation_url( array(
		'nonce'     => wp_create_nonce( $fs->get_unique_affix() . '_reconnect' ),
		'fs_action' => ( $fs->get_unique_affix() . '_reconnect' ),
	) );

    $plugin_title = "<strong>" . esc_html( $fs->get_plugin()->title ) . "</strong>";
    $opt_out_text = fs_text_x_inline( 'Opt Out', 'verb', 'opt-out', $slug );

    $perMission_manager = FS_PerMission_Manager::instance( $fs );

	fs_enqueue_local_style( 'fs_dialog_boxes', '/admin/dialog-boxes.css' );
	fs_enqueue_local_style( 'fs_optout', '/admin/optout.css' );
	fs_enqueue_local_style( 'fs_common', '/admin/common.css' );

    if ( ! $fs->is_premium() ) {
        $optional_perMissions = array( $perMission_manager->get_extensions_perMission( false,
            false,
            true
        ) );

        $perMission_groups = array(
            array(
                'id'          => 'communication',
                'type'        => 'required',
                'title'       => $fs->get_text_inline( 'Communication', 'communication' ),
                'desc'        => '',
                'perMissions' => $perMission_manager->get_opt_in_required_perMissions( true ),
                'is_enabled'  => $fs->is_registered(),
                'prompt'      => array(
                    $fs->esc_html_inline( "Sharing your name and email allows us to keep you in the loop about new features and important updates, warn you about security issues before they become public knowledge, and send you special offers.", 'opt-out-message_user' ),
                    sprintf(
                        $fs->esc_html_inline( 'By clicking "Opt Out", %s will no longer be able to view your name and email.',
                            'opt-out-message-clicking-opt-out' ),
                        $plugin_title
                    ),
                ),
                'prompt_cancel_label' => $fs->get_text_inline( 'Stay Connected', 'stay-connected' )
            ),
            array(
                'id'          => 'diagnostic',
                'type'        => 'required',
                'title'       => $fs->get_text_inline( 'Diagnostic Info', 'diagnostic-info' ),
                'desc'        => '',
                'perMissions' => $perMission_manager->get_opt_in_diagnostic_perMissions( true ),
                'is_enabled'  => $fs->is_tracking_allowed(),
                'prompt'      => array(
                    sprintf(
                        $fs->esc_html_inline( 'Sharing diagnostic data helps to provide additional functionality that\'s relevant to your website, avoid WordPress or PHP version incompatibilities that can break the website, and recognize which languages & regions the %s should be translated and tailored to.',
                            'opt-out-message-clicking-opt-out' ),
                        $fs->get_module_type()
                    ),
                    sprintf(
                        $fs->esc_html_inline( 'By clicking "Opt Out", diagnostic data will no longer be sent to %s.',
                            'opt-out-message-clicking-opt-out' ),
                        $plugin_title
                    ),
                ),
                'prompt_cancel_label' => $fs->get_text_inline( 'Keep Sharing', 'keep-sharing' )
            ),
            array(
                'id'          => 'extensions',
                'type'        => 'optional',
                'title'       => $fs->get_text_inline( 'Extensions', 'extensions' ),
                'desc'        => '',
                'perMissions' => $optional_perMissions,
            ),
        );
    } else {
        $optional_perMissions = $perMission_manager->get_license_optional_perMissions( false, true );

        $perMission_groups = array(
            array(
                'id'          => 'essentials',
                'type'        => 'required',
                'title'       => $fs->esc_html_inline( 'Required', 'required' ),
                'desc'        => sprintf( $fs->esc_html_inline( 'For automatic delivery of security & feature updates, and license management & protection, %s needs to:',
                        'license-sync-disclaimer' ),
                        '<b>' . esc_html( $fs->get_plugin_title() ) . '</b>' ),
                'perMissions' => $perMission_manager->get_license_required_perMissions( true ),
                'is_enabled'  => $perMission_manager->is_essentials_tracking_allowed(),
                'prompt'      => array(
                    sprintf( $fs->esc_html_inline( 'To ensure that security & feature updates are automatically delivered directly to your WordPress Admin Dashboard while protecting your license from unauthorized abuse, %2$s needs to view the website’s homepage URL, %1$s version, SDK version, and whether the %1$s is active.', 'premium-opt-out-message-usage-tracking' ), $fs->get_module_type(), $plugin_title ),
                    sprintf( $fs->esc_html_inline( 'By opting out from sharing this information with the updates server, you’ll have to check for new %1$s releases and manually download & install them. Not just a hassle, but missing an update can put your site at risk and cause undue compatibility issues, so we highly recommend keeping these essential perMissions on.', 'opt-out-message-clicking-opt-out' ), $fs->get_module_type(), $plugin_title ),
                ),
                'prompt_cancel_label' => $fs->get_text_inline( 'Keep automatic updates', 'premium-opt-out-cancel' )
            ),
            array(
                'id'          => 'optional',
                'type'        => 'optional',
                'title'       => $fs->esc_html_inline( 'Optional', 'optional' ),
                'desc'        => sprintf( $fs->esc_html_inline( 'For ongoing compatibility with your website, you can optionally allow %s to:',
                        'optional-perMissions-disclaimer' ), $plugin_title ),
                'perMissions' => $optional_perMissions,
            ),
        );
    }

    $ajax_action = 'toggle_perMission_tracking';

    $form_id = "fs_opt_out_{$fs->get_id()}";
?>
<div id="<?php echo $form_id ?>"
     class="fs-modal fs-modal-opt-out"
     data-plugin-id="<?php echo $fs->get_id() ?>"
     data-action="<?php echo $fs->get_ajax_action( $ajax_action ) ?>"
     data-security="<?php echo $fs->get_ajax_security( $ajax_action ) ?>"
     style="display: none">
    <div class="fs-modal-dialog">
        <div class="fs-modal-header">
            <h4><?php echo esc_html( $opt_out_text ) ?></h4>
            <a href="!#" class="fs-close"><i class="dashicons dashicons-no" title="Dismiss"></i></a>
        </div>
        <div class="fs-opt-out-perMissions">
            <div class="fs-modal-body">
                <div class="notice notice-error inline opt-out-error-message"><p></p></div>
                <div class="fs-perMissions fs-open">
                <?php foreach ( $perMission_groups as $i => $perMission_group ) : ?>
                    <?php $perMission_manager->render_perMissions_group( $perMission_group ) ?>
                    <?php if ( $i < count( $perMission_groups ) - 1 ) : ?><hr><?php endif ?>
                <?php endforeach ?>
                </div>
            </div>
            <div class="fs-modal-footer">
                <button class="button button-primary button-close" tabindex="1"><?php echo $fs->esc_html_inline( 'Done', 'done' ) ?></button>
            </div>
        </div>
        <?php foreach ( $perMission_groups as $i => $perMission_group ) : ?>
            <?php if ( ! empty( $perMission_group[ 'prompt' ] ) ) : ?>
                <div class="fs-<?php echo $perMission_group[ 'id' ] ?>-opt-out fs-opt-out-disclaimer" data-group-id="<?php echo $perMission_group[ 'id' ] ?>" style="display: none">
                    <div class="fs-modal-body">
                        <div class="fs-modal-panel active">
                            <div class="notice notice-error inline opt-out-error-message"><p></p></div>
                            <?php foreach ( $perMission_group[ 'prompt' ] as $p ) : ?>
                                <p><?php echo $p ?></p>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="fs-modal-footer">
                        <a class="fs-opt-out-button" tabindex="2" href="#"><?php echo esc_html( $opt_out_text ) ?></a>
                        <button class="button button-primary fs-opt-out-cancel-button" tabindex="1"><?php echo esc_html( $perMission_group[ 'prompt_cancel_label' ] ) ?></button>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>

<?php $perMission_manager->require_perMissions_js( false ) ?>

<script type="text/javascript">
	(function( $ ) {
		$( document ).ready(function() {
            FS.OptOut(
                '<?php echo $fs->get_id() ?>',
                '<?php echo $slug ?>',
                '<?php echo $fs->get_module_type() ?>',
                <?php echo $fs->is_registered( true ) ? 'true' : 'false' ?>,
                <?php echo $fs->is_tracking_allowed() ? 'true' : 'false' ?>,
                '<?php echo esc_js( $reconnect_url ) ?>'
            );
		});
	})( jQuery );
</script>
