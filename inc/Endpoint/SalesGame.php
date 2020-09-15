<?php
/**
 * @package mam-meeting-room
 */

namespace Mam\MeetingRoom\Endpoint;


use Mam\MeetingRoom\WPApi\Endpoint;
use Mam\MeetingRoom\Base\ServiceInterface;

class SalesGame implements ServiceInterface
{

    /**
     * @var Endpoint
     */
    public $endpoint_api;


    /**
     * SalesGame constructor.
     */
    public function __construct()
    {
        $this->endpoint_api = new Endpoint();
    }

    /**
     * Register SalesGame Endpoint.
     */
    public function register()
    {
        $this->endpoint_api->add_endpoint('sales-game-data')->with_template('mam-sales-game-data.php')->register_endpoints();
    }

    /**
     * Get the data from the excel sheet as array
     * @return string html table
     */
    public function get_data(){
        $response = wp_remote_get( 'https://docs.google.com/spreadsheets/d/18ehz58i2KzGxNQlxpAD8_QzFBekRJq0zlxdjTi6n35c/gviz/tq?tqx=out:csv&sheet=2020');
        return $this->csv_to_table($response['body']);
    }

    /**
     * Covert CSV data to html table
     * @param $csv_content string csv string
     * @return string html table
     */
    private function csv_to_table($csv_content)
    {
        $table = "<table class='sales-game'>";
        $rows = str_getcsv($csv_content, "\n");

        $th = array_shift($rows);
        $tfooter = array_pop($rows);

        $table .= "<thead>";
        $table .= "<tr>";
        $cells = str_getcsv($th);
        $count = 0;
        foreach ($cells as $cell) {
            $count = $count + 1;
            if($count == 11){
                break;
            }
            $table .= "<td>$cell</td>";
        }
        $table .= "</tr>";
        $table .= "</thead>";

        foreach ($rows as &$row) {
            $table .= "<tr>";
            $cells = str_getcsv($row);
            $count = 0;
            foreach ($cells as $cell) {
                $count = $count + 1;
                if($count == 11){
                    break;
                }
                $table .= "<td>$cell</td>";
            }
            $table .= "</tr>";
        }

        $table .= "<tfoot>";
        $table .= "<tr>";
        $cells = str_getcsv($tfooter);
        $count = 0;
        foreach ($cells as $cell) {
            $count = $count + 1;
            if($count == 11){
                break;
            }
            $table .= "<td>$cell</td>";
        }
        $table .= "</tr>";
        $table .= "</tfoot>";

        $table .= "</table>";
        return $table;
    }

}
