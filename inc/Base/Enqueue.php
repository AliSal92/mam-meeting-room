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
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_register_css' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_register_js' ] );

	}

    /**
     * Registers the Plugin stylesheet.
     *
     * @wp-hook wp_enqueue_scripts
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
     * @wp-hook wp_enqueue_scripts
     */
    public function register_js() {
        wp_register_script('mmr-plugin', MMR_URL.'assets/js/mmr-plugin.js', array('jquery'), '3.3.5' );
        wp_enqueue_script('mmr-plugin');
    }


    /**
     * Registers the Plugin admin stylesheet.
     *
     * @wp-hook admin_enqueue_scripts
     */
    public function admin_register_css() {
        wp_register_style('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
        wp_enqueue_style('fancybox');
        wp_register_style('mmr-plugin', MMR_URL.'assets/admin/css/mmr-plugin.css');
        wp_enqueue_style('mmr-plugin');
    }

    /**
     * Registers the Plugin admin javascript.
     *
     * @wp-hook admin_enqueue_scripts
     */
    public function admin_register_js() {
        wp_register_script('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), '3.5.7' );
        wp_enqueue_script('fancybox');
        wp_register_script('mmr-plugin', MMR_URL.'assets/admin/js/mmr-plugin.js', array('jquery'), '3.3.5' );
        wp_enqueue_script('mmr-plugin');
    }
}