<?php
/**
 * @package mam-meeting-room
 */

namespace Mam\MeetingRoom\Admin;


use Mam\MeetingRoom\Base\ServiceInterface;

class MeetingRoom implements ServiceInterface{

	public function register() {
		add_action( 'plugins_loaded', [$this, 'add_option_page']);
		add_action( 'plugins_loaded', [$this, 'add_custom_fields']);
	}

	public static function add_custom_fields() {

	}

	public static function add_option_page() {
		// Register the option page using ACF
		if ( function_exists( 'acf_add_options_page' ) ) {
		    // parent page
            acf_add_options_page(array(
                'page_title' 	=> 'MAM',
                'menu_title'	=> 'MAM',
                'menu_slug' 	=> 'mam',
                'capability'	=> 'read',
                'redirect'		=> true
            ));

            // child page
            acf_add_options_sub_page(array(
                'page_title' 	=> 'Meeting Room',
                'menu_title'	=> 'Meeting Room',
                'menu_slug'  => 'mam-meeting-room',
                'capability'	=> 'read',
                'parent_slug'	=> 'mam'
            ));

		}
	}

}