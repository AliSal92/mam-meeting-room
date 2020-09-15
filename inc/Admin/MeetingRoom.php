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
        add_filter('acf/validate_value/name=schedule', [$this, 'validate_meeting'], 10, 4);

    }

    public function validate_meeting($valid, $value, $field, $input_name){
	    $check = true;
	    foreach ($value as $schedule){
	        if(!$this->validate_schedule($schedule, $value)){
                $check = false;
            }
        }
	    if($check){
            return $valid;
        }else{
	        return __('The time you chose is booked, please choose a different time');
        }

    }

    private function validate_schedule($schedule, $values){
        $start = strtotime($schedule['field_5f23a6ff14207'] . ' ' . $schedule['field_5f23a74514209']);
        $end = strtotime($schedule['field_5f23a6ff14207'] . ' ' . $schedule['field_5f23a8261420a']);
	    foreach ($values as $value){
            if($value == $schedule){
                continue;
            }
            if($value['field_5f23a89f1420b'] != $schedule['field_5f23a89f1420b']){
                continue;
            }
	        $_start = strtotime($value['field_5f23a6ff14207'] . ' ' . $value['field_5f23a74514209']);
            $_end = strtotime($value['field_5f23a6ff14207'] . ' ' . $value['field_5f23a8261420a']);
            if($start >= $_start && $start < $_end){
                return false;
            }
            if($end > $_start && $end <= $_end){
                return false;
            }
        }
	    return true;
    }

	public static function add_custom_fields() {
        // Register the option page using ACF
        if ( function_exists( 'acf_add_options_page' ) ) {
            acf_add_local_field_group(array(
                'key' => 'group_5f23a6b1a9301',
                'title' => 'Meeting Room',
                'fields' => array(
                    array(
                        'key' => 'field_5f23a6b614206',
                        'label' => 'Schedule',
                        'name' => 'schedule',
                        'type' => 'repeater',
                        'instructions' => 'View Meetings: <a target="_blank" href="https://mamdevsite.com/mam/meeting-room/">https://mamdevsite.com/mam/meeting-room/</a>
<h2 style="color:#900;">Please Refresh the Page Before Updating the Meetings - To Avoid Overwriting Others Meetings</h2>',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'collapsed' => '',
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'table',
                        'button_label' => 'Add Meeting',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_5f23a6ff14207',
                                'label' => 'Date',
                                'name' => 'date',
                                'type' => 'date_picker',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'display_format' => 'd/m/Y',
                                'return_format' => 'Y-m-d',
                                'first_day' => 1,
                            ),
                            array(
                                'key' => 'field_5f23a72b14208',
                                'label' => 'Name',
                                'name' => 'name',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_5f23a74514209',
                                'label' => 'Start Time',
                                'name' => 'start_time',
                                'type' => 'select',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'choices' => array(
                                    '07:00:00' => '07:00 AM',
                                    '07:30:00' => '07:30 AM',
                                    '08:00:00' => '08:00 AM',
                                    '08:30:00' => '08:30 AM',
                                    '09:00:00' => '09:00 AM',
                                    '09:30:00' => '09:30 AM',
                                    '10:00:00' => '10:00 AM',
                                    '10:30:00' => '10:30 AM',
                                    '11:00:00' => '11:00 AM',
                                    '11:30:00' => '11:30 AM',
                                    '12:00:00' => '12:00 PM',
                                    '12:30:00' => '12:30 PM',
                                    '13:00:00' => '01:00 PM',
                                    '13:30:00' => '01:30 PM',
                                    '14:00:00' => '02:00 PM',
                                    '14:30:00' => '02:30 PM',
                                    '15:00:00' => '03:00 PM',
                                    '15:30:00' => '03:30 PM',
                                    '16:00:00' => '04:00 PM',
                                    '16:30:00' => '04:30 PM',
                                ),
                                'default_value' => false,
                                'allow_null' => 0,
                                'multiple' => 0,
                                'ui' => 0,
                                'return_format' => 'value',
                                'ajax' => 0,
                                'placeholder' => '',
                            ),
                            array(
                                'key' => 'field_5f23a8261420a',
                                'label' => 'End Time',
                                'name' => 'end_time',
                                'type' => 'select',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'choices' => array(
                                    '07:30:00' => '07:30 AM',
                                    '08:00:00' => '08:00 AM',
                                    '08:30:00' => '08:30 AM',
                                    '09:00:00' => '09:00 AM',
                                    '09:30:00' => '09:30 AM',
                                    '10:00:00' => '10:00 AM',
                                    '10:30:00' => '10:30 AM',
                                    '11:00:00' => '11:00 AM',
                                    '11:30:00' => '11:30 AM',
                                    '12:00:00' => '12:00 PM',
                                    '12:30:00' => '12:30 PM',
                                    '13:00:00' => '01:00 PM',
                                    '13:30:00' => '01:30 PM',
                                    '14:00:00' => '02:00 PM',
                                    '14:30:00' => '02:30 PM',
                                    '15:00:00' => '03:00 PM',
                                    '15:30:00' => '03:30 PM',
                                    '16:00:00' => '04:00 PM',
                                    '16:30:00' => '04:30 PM',
                                    '17:00:00' => '05:00 PM',
                                ),
                                'default_value' => false,
                                'allow_null' => 0,
                                'multiple' => 0,
                                'ui' => 0,
                                'return_format' => 'value',
                                'ajax' => 0,
                                'placeholder' => '',
                            ),
                            array(
                                'key' => 'field_5f23a89f1420b',
                                'label' => 'Room',
                                'name' => 'room',
                                'type' => 'select',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'choices' => array(
                                    'The Big Room' => 'The Big Room',
                                    'The Small Room' => 'The Small Room',
                                ),
                                'default_value' => false,
                                'allow_null' => 0,
                                'multiple' => 0,
                                'ui' => 0,
                                'return_format' => 'value',
                                'ajax' => 0,
                                'placeholder' => '',
                            ),
                        ),
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'mam-meeting-room',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));
        }
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