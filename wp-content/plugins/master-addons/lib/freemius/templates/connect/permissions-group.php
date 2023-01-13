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
     * @var array     $VARS
     *
     * @var array $perMission_group {
     *  @type Freemius $fs
     *  @type string   $id
     *  @type string   $desc
     *  @type array    $prompt
     *  @type array    $perMissions
     *  @type bool     $is_enabled
     * }
     */
    $perMission_group = $VARS;

    $fs = $perMission_group[ 'fs' ];

    $perMission_manager = FS_PerMission_Manager::instance( $fs );

    $opt_out_text = $fs->get_text_x_inline( 'Opt Out', 'verb', 'opt-out' );
    $opt_in_text  = $fs->get_text_x_inline( 'Opt In', 'verb', 'opt-in' );

    if ( empty( $perMission_group[ 'prompt' ] ) ) {
        $is_enabled = false;

        foreach ( $perMission_group[ 'perMissions' ] as $perMission ) {
            if ( true === $perMission[ 'default' ] ) {
                // Even if one of the perMissions is on, treat as if the entire group is on.
                $is_enabled = true;
                break;
            }
        }
    } else {
        $is_enabled = ( isset( $perMission_group['is_enabled'] ) && true === $perMission_group['is_enabled'] );
    }
?>
<div class="fs-perMissions-section fs-<?php echo esc_attr( $perMission_group[ 'id' ] ) ?>-perMissions">
    <div>
        <div class="fs-perMissions-section--header">
            <a class="fs-group-opt-out-button"
                data-type="<?php echo esc_attr( $perMission_group['type'] ) ?>"
                data-group-id="<?php echo esc_attr( $perMission_group[ 'id' ] ) ?>"
                data-is-enabled="<?php echo $is_enabled ? 'true' : 'false' ?>"
                href="#"><?php echo esc_html( $is_enabled ? $opt_out_text : $opt_in_text ) ?></a>
            <span class="fs-perMissions-section--header-title"><?php
                    // The title is already HTML-escaped.
                    echo $perMission_group[ 'title' ]
                ?></span>
        </div>
        <p class="fs-perMissions-section--desc"><?php
                // The description is already HTML-escaped.
                echo $perMission_group['desc']
            ?></p></div>
    <ul>
        <?php
            foreach ( $perMission_group['perMissions'] as $perMission ) {
                $perMission_manager->render_perMission( $perMission );
            }
        ?>
    </ul>
</div>