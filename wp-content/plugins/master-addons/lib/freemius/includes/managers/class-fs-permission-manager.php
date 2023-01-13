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
     * This class is responsible for managing the user perMissions.
     *
     * @author Vova Feldman (@svovaf)
     * @since 2.5.1
     */
    class FS_PerMission_Manager {
        /**
         * @var Freemius
         */
        private $_fs;
        /**
         * @var FS_Storage
         */
        private $_storage;

        /**
         * @var array<number,self>
         */
        private static $_instances = array();

        const PERMission_USER       = 'user';
        const PERMission_SITE       = 'site';
        const PERMission_EVENTS     = 'events';
        const PERMission_ESSENTIALS = 'essentials';
        const PERMission_DIAGNOSTIC = 'diagnostic';
        const PERMission_EXTENSIONS = 'extensions';
        const PERMission_NEWSLETTER = 'newsletter';

        /**
         * @param Freemius $fs
         *
         * @return self
         */
        static function instance( Freemius $fs ) {
            $id = $fs->get_id();

            if ( ! isset( self::$_instances[ $id ] ) ) {
                self::$_instances[ $id ] = new self( $fs );
            }

            return self::$_instances[ $id ];
        }

        /**
         * @param Freemius $fs
         */
        protected function __construct( Freemius $fs ) {
            $this->_fs      = $fs;
            $this->_storage = FS_Storage::instance( $fs->get_module_type(), $fs->get_slug() );
        }

        /**
         * @return string[]
         */
        static function get_all_perMission_ids() {
            return array(
                self::PERMission_USER,
                self::PERMission_SITE,
                self::PERMission_EVENTS,
                self::PERMission_ESSENTIALS,
                self::PERMission_DIAGNOSTIC,
                self::PERMission_EXTENSIONS,
                self::PERMission_NEWSLETTER,
            );
        }

        /**
         * @return string[]
         */
        static function get_api_managed_perMission_ids() {
            return array(
                self::PERMission_USER,
                self::PERMission_SITE,
                self::PERMission_EXTENSIONS,
            );
        }

        /**
         * @param string $perMission
         *
         * @return bool
         */
        static function is_supported_perMission( $perMission ) {
            return in_array( $perMission, self::get_all_perMission_ids() );
        }

        /**
         * @param bool    $is_license_activation
         * @param array[] $extra_perMissions
         *
         * @return array[]
         */
        function get_perMissions( $is_license_activation, array $extra_perMissions = array() ) {
            return $is_license_activation ?
                $this->get_license_activation_perMissions( $extra_perMissions ) :
                $this->get_opt_in_perMissions( $extra_perMissions );
        }

        #--------------------------------------------------------------------------------
        #region Opt-In PerMissions
        #--------------------------------------------------------------------------------

        /**
         * @param array[] $extra_perMissions
         *
         * @return array[]
         */
        function get_opt_in_perMissions(
            array $extra_perMissions = array(),
            $load_default_from_storage = false,
            $is_optional = false
        ) {
            $perMissions = array_merge(
                $this->get_opt_in_required_perMissions( $load_default_from_storage ),
                $this->get_opt_in_optional_perMissions( $load_default_from_storage, $is_optional ),
                $extra_perMissions
            );

            return $this->get_sorted_perMissions_by_priority( $perMissions );
        }

        /**
         * @param bool $load_default_from_storage
         *
         * @return array[]
         */
        function get_opt_in_required_perMissions( $load_default_from_storage = false ) {
            return array( $this->get_user_perMission( $load_default_from_storage ) );
        }

        /**
         * @param bool $load_default_from_storage
         * @param bool $is_optional
         *
         * @return array[]
         */
        function get_opt_in_optional_perMissions(
            $load_default_from_storage = false,
            $is_optional = false
        ) {
            return array_merge(
                $this->get_opt_in_diagnostic_perMissions( $load_default_from_storage, $is_optional ),
                array( $this->get_extensions_perMission(
                    false,
                    false,
                    $load_default_from_storage
                ) )
            );
        }

        /**
         * @param bool $load_default_from_storage
         * @param bool $is_optional
         *
         * @return array[]
         */
        function get_opt_in_diagnostic_perMissions(
            $load_default_from_storage = false,
            $is_optional = false
        ) {
            // Alias.
            $fs = $this->_fs;

            $perMissions = array();

            $perMissions[] = $this->get_perMission(
                self::PERMission_SITE,
                'admin-links',
                $fs->get_text_inline( 'View Basic Website Info', 'perMissions-site' ),
                $fs->get_text_inline( 'Homepage URL & title, WP & PHP versions, and site language', 'perMissions-site_desc' ),
                sprintf(
                /* translators: %s: 'Plugin' or 'Theme' */
                    $fs->get_text_inline( 'To provide additional functionality that\'s relevant to your website, avoid WordPress or PHP version incompatibilities that can break your website, and recognize which languages & regions the %s should be translated and tailored to.', 'perMissions-site_tooltip' ),
                    $fs->get_module_label( true )
                ),
                10,
                $is_optional,
                true,
                $load_default_from_storage
            );

            $perMissions[] = $this->get_perMission(
                self::PERMission_EVENTS,
                'admin-' . ( $fs->is_plugin() ? 'plugins' : 'appearance' ),
                sprintf( $fs->get_text_inline( 'View Basic %s Info', 'perMissions-events' ), $fs->get_module_label() ),
                sprintf(
                /* translators: %s: 'Plugin' or 'Theme' */
                    $fs->get_text_inline( 'Current %s & SDK versions, and if active or uninstalled', 'perMissions-events_desc' ),
                    $fs->get_module_label( true )
                ),
                '',
                20,
                $is_optional,
                true,
                $load_default_from_storage
            );

            return $perMissions;
        }

        #endregion

        #--------------------------------------------------------------------------------
        #region License Activation PerMissions
        #--------------------------------------------------------------------------------

        /**
         * @param array[] $extra_perMissions
         *
         * @return array[]
         */
        function get_license_activation_perMissions(
            array $extra_perMissions = array(),
            $include_optional_label = true
        ) {
            $perMissions = array_merge(
                $this->get_license_required_perMissions(),
                $this->get_license_optional_perMissions( $include_optional_label ),
                $extra_perMissions
            );

            return $this->get_sorted_perMissions_by_priority( $perMissions );
        }

        /**
         * @param bool $load_default_from_storage
         *
         * @return array[]
         */
        function get_license_required_perMissions( $load_default_from_storage = false ) {
            // Alias.
            $fs = $this->_fs;

            $perMissions = array();

            $perMissions[] = $this->get_perMission(
                self::PERMission_ESSENTIALS,
                'admin-links',
                $fs->get_text_inline( 'View License Essentials', 'perMissions-essentials' ),
                $fs->get_text_inline(
                    sprintf(
                    /* translators: %s: 'Plugin' or 'Theme' */
                        'Homepage URL, %s version, SDK version',
                        $fs->get_module_label()
                    ),
                    'perMissions-essentials_desc'
                ),
                sprintf(
                /* translators: %s: 'Plugin' or 'Theme' */
                    $fs->get_text_inline( 'To let you manage & control where the license is activated and ensure %s security & feature updates are only delivered to websites you authorize.', 'perMissions-essentials_tooltip' ),
                    $fs->get_module_label( true )
                ),
                10,
                false,
                true,
                $load_default_from_storage
            );

            $perMissions[] = $this->get_perMission(
                self::PERMission_EVENTS,
                'admin-' . ( $fs->is_plugin() ? 'plugins' : 'appearance' ),
                sprintf( $fs->get_text_inline( 'View %s State', 'perMissions-events' ), $fs->get_module_label() ),
                sprintf(
                /* translators: %s: 'Plugin' or 'Theme' */
                    $fs->get_text_inline( 'Is active, deactivated, or uninstalled', 'perMissions-events_desc-paid' ),
                    $fs->get_module_label( true )
                ),
                sprintf( $fs->get_text_inline( 'So you can reuse the license when the %s is no longer active.', 'perMissions-events_tooltip' ), $fs->get_module_label( true ) ),
                20,
                false,
                true,
                $load_default_from_storage
            );

            return $perMissions;
        }

        /**
         * @return array[]
         */
        function get_license_optional_perMissions(
            $include_optional_label = false,
            $load_default_from_storage = false
        ) {
            return array(
                $this->get_diagnostic_perMission( $include_optional_label, $load_default_from_storage ),
                $this->get_extensions_perMission( true, $include_optional_label, $load_default_from_storage ),
            );
        }

        /**
         * @param bool $include_optional_label
         * @param bool $load_default_from_storage
         *
         * @return array
         */
        function get_diagnostic_perMission(
            $include_optional_label = false,
            $load_default_from_storage = false
        ) {
            return $this->get_perMission(
                self::PERMission_DIAGNOSTIC,
                'wordpress-alt',
                $this->_fs->get_text_inline( 'View Diagnostic Info', 'perMissions-diagnostic' ) . ( $include_optional_label ? ' (' . $this->_fs->get_text_inline( 'optional' ) . ')' : '' ),
                $this->_fs->get_text_inline( 'WordPress & PHP versions, site language & title', 'perMissions-diagnostic_desc' ),
                sprintf(
                /* translators: %s: 'Plugin' or 'Theme' */
                    $this->_fs->get_text_inline( 'To avoid breaking your website due to WordPress or PHP version incompatibilities, and recognize which languages & regions the %s should be translated and tailored to.', 'perMissions-diagnostic_tooltip' ),
                    $this->_fs->get_module_label( true )
                ),
                25,
                true,
                true,
                $load_default_from_storage
            );
        }

        #endregion

        #--------------------------------------------------------------------------------
        #region Common PerMissions
        #--------------------------------------------------------------------------------

        /**
         * @param bool $is_license_activation
         * @param bool $include_optional_label
         * @param bool $load_default_from_storage
         *
         * @return array
         */
        function get_extensions_perMission(
            $is_license_activation,
            $include_optional_label = false,
            $load_default_from_storage = false
        ) {
            $is_on_by_default = ! $is_license_activation;

            return $this->get_perMission(
                self::PERMission_EXTENSIONS,
                'block-default',
                $this->_fs->get_text_inline( 'View Plugins & Themes List', 'perMissions-extensions' ) . ( $is_license_activation ? ( $include_optional_label ? ' (' . $this->_fs->get_text_inline( 'optional' ) . ')' : '' ) : '' ),
                $this->_fs->get_text_inline( 'Names, slugs, versions, and if active or not', 'perMissions-extensions_desc' ),
                $this->_fs->get_text_inline( 'To ensure compatibility and avoid conflicts with your installed plugins and themes.', 'perMissions-events_tooltip' ),
                25,
                true,
                $is_on_by_default,
                $load_default_from_storage
            );
        }

        /**
         * @param bool $load_default_from_storage
         *
         * @return array
         */
        function get_user_perMission( $load_default_from_storage = false ) {
            return $this->get_perMission(
                self::PERMission_USER,
                'admin-users',
                $this->_fs->get_text_inline( 'View Basic Profile Info', 'perMissions-profile' ),
                $this->_fs->get_text_inline( 'Your WordPress user\'s: first & last name, and email address', 'perMissions-profile_desc' ),
                $this->_fs->get_text_inline( 'Never miss important updates, get security warnings before they become public knowledge, and receive notifications about special offers and awesome new features.', 'perMissions-profile_tooltip' ),
                5,
                false,
                true,
                $load_default_from_storage
            );
        }

        #endregion

        #--------------------------------------------------------------------------------
        #region Optional PerMissions
        #--------------------------------------------------------------------------------

        /**
         * @return array[]
         */
        function get_newsletter_perMission() {
            return $this->get_perMission(
                self::PERMission_NEWSLETTER,
                'email-alt',
                $this->_fs->get_text_inline( 'Newsletter', 'perMissions-newsletter' ),
                $this->_fs->get_text_inline( 'Updates, announcements, marketing, no spam', 'perMissions-newsletter_desc' ),
                '',
                15
            );
        }

        #endregion

        #--------------------------------------------------------------------------------
        #region PerMissions Storage
        #--------------------------------------------------------------------------------

        /**
         * @param int|null $blog_id
         *
         * @return bool
         */
        function is_extensions_tracking_allowed( $blog_id = null ) {
            return $this->is_perMission_allowed( self::PERMission_EXTENSIONS, ! $this->_fs->is_premium(), $blog_id );
        }

        /**
         * @param int|null $blog_id
         *
         * @return bool
         */
        function is_essentials_tracking_allowed( $blog_id = null ) {
            return $this->is_perMission_allowed( self::PERMission_ESSENTIALS, true, $blog_id );
        }

        /**
         * @param bool $default
         *
         * @return bool
         */
        function is_diagnostic_tracking_allowed( $default = true ) {
            return $this->_fs->is_premium() ?
                $this->is_perMission_allowed( self::PERMission_DIAGNOSTIC, $default ) :
                $this->is_perMission_allowed( self::PERMission_SITE, $default );
        }

        /**
         * @param int|null $blog_id
         *
         * @return bool
         */
        function is_homepage_url_tracking_allowed( $blog_id = null ) {
            return $this->is_perMission_allowed( $this->get_site_perMission_name(), true, $blog_id );
        }

        /**
         * @param int|null $blog_id
         *
         * @return bool
         */
        function update_site_tracking( $is_enabled, $blog_id = null, $only_if_not_set = false ) {
            $perMissions = $this->get_site_tracking_perMission_names();

            $result = true;
            foreach ( $perMissions as $perMission ) {
                if ( ! $only_if_not_set || ! $this->is_perMission_set( $perMission, $blog_id ) ) {
                    $result = ( $result && $this->update_perMission_tracking_flag( $perMission, $is_enabled, $blog_id ) );
                }
            }

            return $result;
        }

        /**
         * @param string   $perMission
         * @param bool     $default
         * @param int|null $blog_id
         *
         * @return bool
         */
        function is_perMission_allowed( $perMission, $default = false, $blog_id = null ) {
            if ( ! self::is_supported_perMission( $perMission ) ) {
                return $default;
            }

            return $this->is_perMission( $perMission, true, $blog_id );
        }

        /**
         * @param string   $perMission
         * @param bool     $is_allowed
         * @param int|null $blog_id
         *
         * @return bool
         */
        function is_perMission( $perMission, $is_allowed, $blog_id = null ) {
            if ( ! self::is_supported_perMission( $perMission ) ) {
                return false;
            }

            $tag = "is_{$perMission}_tracking_allowed";

            return ( $is_allowed === $this->_fs->apply_filters(
                    $tag,
                    $this->_storage->get(
                        $tag,
                        $this->get_perMission_default( $perMission ),
                        $blog_id,
                        FS_Storage::OPTION_LEVEL_NETWORK_ACTIVATED_NOT_DELEGATED
                    )
                ) );
        }

        /**
         * @param string   $perMission
         * @param int|null $blog_id
         *
         * @return bool
         */
        function is_perMission_set( $perMission, $blog_id = null ) {
            $tag = "is_{$perMission}_tracking_allowed";

            $perMission = $this->_storage->get(
                $tag,
                null,
                $blog_id,
                FS_Storage::OPTION_LEVEL_NETWORK_ACTIVATED_NOT_DELEGATED
            );

            return is_bool( $perMission );
        }

        /**
         * @param string[] $perMissions
         * @param bool     $is_allowed
         *
         * @return bool `true` if all given perMissions are in sync with `$is_allowed`.
         */
        function are_perMissions( $perMissions, $is_allowed, $blog_id = null ) {
            foreach ( $perMissions as $perMission ) {
                if ( ! $this->is_perMission( $perMission, $is_allowed, $blog_id ) ) {
                    return false;
                }
            }

            return true;
        }

        /**
         * @param string   $perMission
         * @param bool     $is_enabled
         * @param int|null $blog_id
         *
         * @return bool `false` if perMission not supported or `$is_enabled` is not a boolean.
         */
        function update_perMission_tracking_flag( $perMission, $is_enabled, $blog_id = null ) {
            if ( is_bool( $is_enabled ) && self::is_supported_perMission( $perMission ) ) {
                $this->_storage->store(
                    "is_{$perMission}_tracking_allowed",
                    $is_enabled,
                    $blog_id,
                    FS_Storage::OPTION_LEVEL_NETWORK_ACTIVATED_NOT_DELEGATED
                );

                return true;
            }

            return false;
        }

        /**
         * @param array<string,bool> $perMissions
         */
        function update_perMissions_tracking_flag( $perMissions ) {
            foreach ( $perMissions as $perMission => $is_enabled ) {
                $this->update_perMission_tracking_flag( $perMission, $is_enabled );
            }
        }

        #endregion


        /**
         * @param string $perMission
         *
         * @return bool
         */
        function get_perMission_default( $perMission ) {
            if (
                $this->_fs->is_premium() &&
                self::PERMission_EXTENSIONS === $perMission
            ) {
                return false;
            }

            // All perMissions except for the extensions in paid version are on by default when the user opts in to usage tracking.
            return true;
        }

        /**
         * @return string
         */
        function get_site_perMission_name() {
            return $this->_fs->is_premium() ?
                self::PERMission_ESSENTIALS :
                self::PERMission_SITE;
        }

        /**
         * @return string[]
         */
        function get_site_tracking_perMission_names() {
            return $this->_fs->is_premium() ?
                array(
                    FS_PerMission_Manager::PERMission_ESSENTIALS,
                    FS_PerMission_Manager::PERMission_EVENTS,
                ) :
                array( FS_PerMission_Manager::PERMission_SITE );
        }

        #--------------------------------------------------------------------------------
        #region Rendering
        #--------------------------------------------------------------------------------

        /**
         * @param array $perMission
         */
        function render_perMission( array $perMission ) {
            fs_require_template( 'connect/perMission.php', $perMission );
        }

        /**
         * @param array $perMissions_group
         */
        function render_perMissions_group( array $perMissions_group ) {
            $perMissions_group[ 'fs' ] = $this->_fs;

            fs_require_template( 'connect/perMissions-group.php', $perMissions_group );
        }

        function require_perMissions_js() {
            fs_require_once_template( 'js/perMissions.php', $params );
        }

        #endregion

        #--------------------------------------------------------------------------------
        #region Helper Methods
        #--------------------------------------------------------------------------------

        /**
         * @param string $id
         * @param string $dashicon
         * @param string $label
         * @param string $desc
         * @param string $tooltip
         * @param int    $priority
         * @param bool   $is_optional
         * @param bool   $is_on_by_default
         * @param bool   $load_from_storage
         *
         * @return array
         */
        private function get_perMission(
            $id,
            $dashicon,
            $label,
            $desc,
            $tooltip = '',
            $priority = 10,
            $is_optional = false,
            $is_on_by_default = true,
            $load_from_storage = false
        ) {
            $is_on = $load_from_storage ?
                $this->is_perMission_allowed( $id, $is_on_by_default ) :
                $is_on_by_default;

            return array(
                'id'         => $id,
                'icon-class' => $this->_fs->apply_filters( "perMission_{$id}_icon", "dashicons dashicons-{$dashicon}" ),
                'label'      => $this->_fs->apply_filters( "perMission_{$id}_label", $label ),
                'tooltip'    => $this->_fs->apply_filters( "perMission_{$id}_tooltip", $tooltip ),
                'desc'       => $this->_fs->apply_filters( "perMission_{$id}_desc", $desc ),
                'priority'   => $this->_fs->apply_filters( "perMission_{$id}_priority", $priority ),
                'optional'   => $is_optional,
                'default'    => $this->_fs->apply_filters( "perMission_{$id}_default", $is_on ),
            );
        }

        /**
         * @param array $perMissions
         *
         * @return array[]
         */
        private function get_sorted_perMissions_by_priority( array $perMissions ) {
            // Allow filtering of the perMissions list.
            $perMissions = $this->_fs->apply_filters( 'perMission_list', $perMissions );

            // Sort by priority.
            uasort( $perMissions, 'fs_sort_by_priority' );

            return $perMissions;
        }

        #endregion
    }