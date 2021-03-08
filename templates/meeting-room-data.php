<?php

use Mam\MeetingRoom\Endpoint\MeetingRoom;

$workingDays = MeetingRoom::the_next_working_days();
$meetings = [];

$acf_repater = 'schedule';
if (have_rows($acf_repater, 'option')) {
    $index = 0;
    while (have_rows($acf_repater, 'option')) {
        the_row();

        $meeting['date'] = get_sub_field('date');
        $meeting['name'] = get_sub_field('name');
        $meeting['start_time'] = get_sub_field('start_time');
        $meeting['end_time'] = get_sub_field('end_time');
        $meeting['room'] = get_sub_field('room');

        if (strtotime($meeting['date'] . ' ' . $meeting['start_time']) < time()) {
            delete_row($acf_repater, get_row_index(), 'option');
        } else {
            $meetings[] = $meeting;
        }
        $index = $index + 1;
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <center><img src="https://www.moveaheadmedia.com.au/wp-content/uploads/2017/06/MAM-LOGO.png" alt="SEO Company Sydney Australia | SEO Services Specialist" title="SEO Company Sydney Australia | SEO Services Specialist" data-at2x="https://www.moveaheadmedia.com.au/wp-content/uploads/2015/04/logo1.png"></center>
    </div>

    <div class="col-md-2 orange-col">
        <h2></h2>
    </div>
    <div class="col-md-5 orange-col">
        <h2>Big Room</h2>
    </div>
    <div class="col-md-5 orange-col small-room">
        <h2>Small Room</h2>
    </div>
</div>
<div class="row">
    <?php foreach ($workingDays as $workingDay) {

        ?>
        <div class="col-md-2 orange-col">
            <h3><?php echo date('l j, F', strtotime($workingDay)); ?></h3>
        </div>
        <div class="col-md-5 stripe">
            <?php foreach ($meetings as $meeting) {
                if ($meeting['date'] != $workingDay) {
                    continue;
                }
                if ($meeting['room'] != 'The Big Room') {
                    continue;
                }
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <h4><?php echo $meeting['name']; ?></h4>
                    </div>
                    <div class="col-md-3">
                        <h5><?php echo date('g:i A', strtotime($meeting['start_time'])); ?></h5>
                    </div>
                    <div class="col-md-3">
                        <h5><?php echo date('g:i A', strtotime($meeting['end_time'])); ?></h5>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="col-md-5 small-room stripe-2">

            <?php foreach ($meetings as $meeting) {
                if ($meeting['date'] != $workingDay) {
                    continue;
                }
                if ($meeting['room'] != 'The Small Room') {
                    continue;
                }
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <h4><?php echo $meeting['name']; ?></h4>
                    </div>
                    <div class="col-md-3">
                        <h5><?php echo date('g:i A', strtotime($meeting['start_time'])); ?></h5>
                    </div>
                    <div class="col-md-3">
                        <h5><?php echo date('g:i A', strtotime($meeting['end_time'])); ?></h5>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<style>
    .meeting-room-table .stripe:nth-child(even) {
        background-color: rgba(242, 88, 44, 0.25);
    }

    .meeting-room-table .stripe-2:nth-child(odd) {
        background-color: rgba(242, 88, 44, 0.25);
    }

    .meeting-room-table h4, .meeting-room-table h5 {
        margin: 15px 0;
        font-size: 23px;
    }

    .meeting-room-table h5 {
        white-space: nowrap;
    }

    .meeting-room-table h3 {
        font-size: 24px;
    }

    .meeting-room-table h2 {
        font-size: 24px;
    }
</style>