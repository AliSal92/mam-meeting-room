jQuery(document).ready(function ($) {
    // auto reload page every 5 seconds
    $.ajaxSetup({
        cache: false
    });
    if($(".meeting-room-table").length){
        var loadUrl = "https://mamdevsite.com/mam/meeting-room-data/";
        setInterval(function(){
            $(".meeting-room-table").load(loadUrl);
        }, 5000);
        $(".meeting-room-table").load(loadUrl);
    }
});