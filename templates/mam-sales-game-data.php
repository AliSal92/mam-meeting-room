<div class="text text-center"><h2>Game On</h2></div>
<?php
use Mam\MeetingRoom\Endpoint\SalesGame;

$salesGame = new SalesGame();

echo $salesGame->get_data();