<?php
/**
 * Plugin Name:     Wordpress Cleaner
 * Plugin URI:      https://parfaitementweb.com
 * Description:     Clean Wordpress from junk panels and warnings
 * Author:          Parfaitement Web
 * Author URI:      https://parfaitementweb.com
 * Text Domain:     pw-cleaner
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         pw-cleaner
 */

namespace Parfaitementweb\Cleaner;

defined( 'ABSPATH' ) || die( 'Cheatin’ uh?' );

class PW_Cleaner {

	public function __construct() {
		add_action( 'plugin_loaded', function () {
			$this->cleanDashboard();
			$this->removeGeneratorHeader();
			$this->hideFrontendToolbar();
		} );
	}

	function cleanDashboard() {
		remove_action( 'welcome_panel', 'wp_welcome_panel' );
		add_action( 'admin_init', function () {
			remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' ); //Removes the 'incoming links' widget
			remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' ); //Removes the 'plugins' widget
			remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' ); //Removes the 'WordPress News' widget
			remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' ); //Removes the secondary widget
			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); //Removes the 'Quick Draft' widget
			remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' ); //Removes the 'Recent Drafts' widget
			remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); //Removes the 'Activity' widget
			remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); //Removes the 'Activity' widget (since 3.8)
			remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' ); //Removes the 'Activity' widget (since 3.8)
			// remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // Removes the 'At a Glance' widget
			remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'side' ); // Removes Yoast Dashboard
			remove_meta_box( 'dashboard_rediscache', 'dashboard', 'normal' ); // Removes Yoast Dashboard
		} );
	}

	public function removeGeneratorHeader() {
		remove_action( 'wp_head', 'wp_generator' );
	}

	public function hideFrontendToolbar() {
		add_filter( 'show_admin_bar', '__return_false' );
	}

}

new PW_Cleaner();
