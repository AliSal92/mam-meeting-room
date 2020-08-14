<?php
/**
 * @package mam-meeting-room
 */

namespace Mam\MeetingRoom\Base;


class Enqueue implements ServiceInterface {

	/**
	 * Register Enqueue hooks.
	 *
	 */
	public function register() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_css' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_js' ] );
	}

	/**
	 * Registers the Plugin stylesheet.
	 *
	 * @wp-hook admin_enqueue_scripts
	 */
	public function register_css() {

		wp_register_style('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap');

		wp_register_style('mmr-plugin', MMR_URL.'assets/css/mmr-plugin.css');
		wp_enqueue_style('mmr-plugin');
	}

	/**
	 * Registers the Plugin javascript.
	 *
	 * @wp-hook admin_enqueue_scripts
	 */
	public function register_js() {
		wp_register_script('mmr-plugin', MMR_URL.'assets/js/mmr-plugin.js', array('jquery'), '3.3.5' );
		wp_enqueue_script('mmr-plugin');
	}
}