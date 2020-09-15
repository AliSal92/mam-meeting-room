jQuery(document).ready(function ($) {
    // auto reload page every 5 seconds
    $.ajaxSetup({
        cache: false
    });
    let loadedURL = "https://mamdevsite.com/mam/sales-game-data/";
    function get_load_url(){
        let loadUrl = "https://mamdevsite.com/mam/sales-game-data/";
        if(loadedURL == "https://mamdevsite.com/mam/sales-game-data/"){
            loadUrl = "https://mamdevsite.com/mam/meeting-room-data/";
            loadedURL = "https://mamdevsite.com/mam/meeting-room-data/";
        }else{
            loadedURL = "https://mamdevsite.com/mam/sales-game-data/";
        }
        return loadUrl;
    }

    let $table = $(".meeting-room-table");
    if($table.length){
        setInterval(function(){
            $table.load(get_load_url());
        }, 15000);
        $table.load(get_load_url());
    }
});