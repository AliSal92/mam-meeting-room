<?php
/**
 * @package mam-meeting-room
 */

namespace Mam\MeetingRoom\Endpoint;


use Mam\MeetingRoom\WPApi\Endpoint;
use Mam\MeetingRoom\Base\ServiceInterface;

class MeetingRoom implements ServiceInterface
{

    /**
     * @var Endpoint
     */
    public $endpoint_api;

    public function __construct()
    {
        $this->endpoint_api = new Endpoint();

        // sort date values
        add_filter('acf/load_value/name=schedule', [$this, 'acf_sort_date_values'], 10, 3);

        // add fields
        add_action('acf/init', [$this, 'afc_schedule_field'], 200);
    }

    /**
     * Register SalesBoard Endpoint.
     */
    public function register()
    {
        $this->endpoint_api->add_endpoint('meeting-room')->with_template('meeting-room.php')->register_endpoints();
        $this->endpoint_api->add_endpoint('meeting-room-data')->with_template('meeting-room-data.php')->register_endpoints();
    }

    public static function the_next_working_days()
    {
        $count = 0;
        $date = [];
        while ($count < 7) {
            $time = strtotime('+' . $count . ' days ');
            $count = $count + 1;

            $day = date("l", $time);
            if ($day == 'Saturday' || $day == 'Sunday') {
                continue;
            }
            $date[] = date('Y-m-d', $time);
        }
        return $date;
    }

    public static function acf_sort_date_values($value, $post_id, $field)
    {

        // vars
        $order = array();

        // bail early if no value
        if (empty($value)) {
            return $value;
        }


        // populate order
        foreach ($value as $i => $row) {
            $order[$i] = $row['field_5f23a6ff14207'] . ' ' . $row['field_5f23a74514209'];
        }

        // multisort
        array_multisort($order, SORT_ASC, $value);

        // return
        return $value;

    }

    public static function afc_schedule_field()
    {
        if (function_exists('acf_add_local_field_group')) {

            acf_add_local_field_group(array(
                'key' => 'group_5f23a6b1a9301',
                'title' => 'Meeting Room',
                'fields' => array(
                    array(
                        'key' => 'field_5f23a6b614206',
                        'label' => 'Schedule',
                        'name' => 'schedule',
                        'type' => 'repeater',
                        'instructions' => 'View Meetings: <a target="_blank" href="https://mamdevsite.com/mam/meeting-room/">https://mamdevsite.com/mam/meeting-room/</a>',
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
}
