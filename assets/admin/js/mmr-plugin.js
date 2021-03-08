jQuery(document).ready(function ($) {
    var timelimit = 60;
    $('input#publish').after($('<div class="refresh-text"><p>The page will refresh in <b>60</b> seconds.</p></div>'));
    setInterval(function(){
        timelimit = timelimit - 1;
        $('.refresh-text b').text(timelimit);
        if(timelimit <= 0){
            $('input#publish').prop('disabled', true);
            location.reload(true);
        }
    }, 1000);
});