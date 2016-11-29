<?php
/**
 * Admin Pages
 *
 * @package     QUADS
 * @subpackage  Admin/Pages
 * @copyright   Copyright (c) 2015, René Hermenau
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       2.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Creates the admin submenu pages under the Quick AdSense Reloaded menu and assigns their
 * links to global variables
 *
 * @since 1.0
 * @global $quads_settings_page
 * @global $quads_add_ons_page
 * @return void
 */
function quads_add_options_link() {
	global $quads_options, $quads_parent_page, $quads_add_ons_page, $quads_add_ons_page2, $quads_settings_page;

        $create_settings = isset($quads_options['create_settings']) ? true : false;
        if ($create_settings){
            $quads_settings_page = add_submenu_page( 'options-general.php', __( 'WP QUADS Settings', 'quick-adsense-reloaded' ), __( 'WPQUADS', 'quick-adsense-reloaded' ), 'manage_options', 'quads-settings', 'quads_options_page' );
        }else{
            $quads_parent_page   = add_menu_page( 'Quick AdSense Reloaded Settings', __( 'WP <strong>QUADS</strong>', 'quick-adsense-reloaded' ), 'manage_options', 'quads-settings', 'quads_options_page' );
            //if (quads_is_installed_clickfraud() ){
            //$quads_add_ons_page   = add_submenu_page('quads-settings', __('Click Fraud Monitor'), __('Click Fraud Monitor'), 'manage_options', 'cfmonitor-config', 'cfmonitor_conf');
            //} else {
                $quads_add_ons_page   = add_submenu_page( 'quads-settings', __( 'Get Add-On', 'quick-adsense-reloaded' ), 'Get WP QUADS Pro', 'manage_options', 'quads-addons', 'quads_add_ons_page' );
            //}
        }
}
add_action( 'admin_menu', 'quads_add_options_link', 10 );

/**
 *  Determines whether the current admin page is an QUADS admin page.
 *  
 *  Only works after the `wp_loaded` hook, & most effective 
 *  starting on `admin_menu` hook.
 *  
 *  @since 1.9.6
 *  @return bool True if QUADS admin page.
 */
function quads_is_admin_page() {
        $currentpage = isset($_GET['page']) ? $_GET['page'] : '';
	if ( ! is_admin() || ! did_action( 'wp_loaded' ) ) {
		return false;
	}
	
	global $quads_parent_page, $pagenow, $typenow, $quads_settings_page, $quads_add_ons_page, $quads_tools_page;

	if ( 'quads-settings' == $currentpage || 'quads-addons' == $currentpage || 'quads-tools' == $currentpage) {
		return true;      
	}
	
         
}
