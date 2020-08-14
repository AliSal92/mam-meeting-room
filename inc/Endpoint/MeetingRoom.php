<?php
/**
 * @package mam-meeting-room
 */

namespace Mam\MeetingRoom\Endpoint;


use Mam\MeetingRoom\WPApi\Endpoint;
use Mam\MeetingRoom\Base\ServiceInterface;

class MeetingRoom implements ServiceInterface {

	/**
	 * @var Endpoint
	 */
	public $endpoint_api;

	public function __construct() {
		$this->endpoint_api = new Endpoint();

		// sort date values
        add_filter('acf/load_value/name=schedule', [$this, 'my_acf_load_value'], 10, 3);
    }

	/**
	 * Register SalesBoard Endpoint.
	 */
	public function register(){
		$this->endpoint_api->add_endpoint('meeting-room')->with_template('meeting-room.php')->register_endpoints();
		$this->endpoint_api->add_endpoint('meeting-room-data')->with_template('meeting-room-data.php')->register_endpoints();
	}

	public static function the_next_working_days() {
	    $count = 0;
        $date = [];
	    while($count < 7){
            $time = strtotime('+' . $count . ' days ');
            $count = $count + 1;

            $day = date("l", $time);
            if($day == 'Saturday' || $day == 'Sunday'){
                continue;
            }
            $date[] = date('Y-m-d', $time);
        }
        return $date;
    }

    public static function my_acf_load_value( $value, $post_id, $field ) {

        // vars
        $order = array();

        // bail early if no value
        if( empty($value) ) {
            return $value;
        }


        // populate order
        foreach( $value as $i => $row ) {
            $order[ $i ] = $row['field_5f23a6ff14207'] . ' ' . $row['field_5f23a74514209'];
        }

        // multisort
        array_multisort( $order, SORT_ASC, $value );

        // return
        return $value;

    }
}
