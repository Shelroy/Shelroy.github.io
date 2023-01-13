<?php
    /**
     * @package     Freemius
     * @copyright   Copyright (c) 2022, Freemius, Inc.
     * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
     * @since       2.5.1
     */

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    /**
     * @var array $VARS
     * @var array $perMission {
     * @type string $id
     * @type bool   $default
     * @type string $icon-class
     * @type bool   $optional
     * @type string $label
     * @type string $tooltip
     * @type string $desc
     * }
     */
    $perMission = $VARS;

    $is_perMission_on = ( ! isset( $perMission['default'] ) || true === $perMission['default'] );
?>
<li id="fs_perMission_<?php echo esc_attr( $perMission['id'] ) ?>" data-perMission-id="<?php echo esc_attr( $perMission['id'] ) ?>"
    class="fs-perMission fs-<?php echo esc_attr( $perMission['id'] ); ?><?php echo ( ! $is_perMission_on ) ? ' fs-disabled' : ''; ?>">
    <i class="<?php echo esc_attr( $perMission['icon-class'] ); ?>"></i>
    <?php if ( isset( $perMission['optional'] ) && true === $perMission['optional'] ) : ?>
        <div class="fs-switch fs-small fs-round fs-<?php echo $is_perMission_on ? 'on' : 'off' ?>">
            <div class="fs-toggle"></div>
        </div>
    <?php endif ?>

    <div class="fs-perMission-description">
        <span<?php if ( ! empty( $perMission['tooltip'] ) ) : ?> class="fs-tooltip-trigger"<?php endif ?>><?php echo esc_html( $perMission['label'] ); ?><?php if ( ! empty( $perMission['tooltip'] ) ) : ?><i class="dashicons dashicons-editor-help"><span class="fs-tooltip" style="width: 200px"><?php echo esc_html( $perMission['tooltip'] ) ?></span></i><?php endif ?></span>

        <p><?php echo esc_html( $perMission['desc'] ); ?></p>
    </div>
</li>