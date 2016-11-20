/** NAVBAR FIXED **/
(function($){


    $(document).ready(function(){
        var menuassoc = $('#bdn');
        var offset = $("#bdn").offset().top;
        $(document).scroll(function(){
            var scrollTop = $(document).scrollTop();
            if(scrollTop > offset){
                $("#bdn").css("position", "fixed");
                $("#bdn").css("left", "0");
                $("#bdn").css("top", "0");
                $("#bdn").css("right", "0");
                $("#bdn").css("z-index", "1000");
            }
            else {
                $("#bdn").css("position", "static");

            }
        });
    });
})(jQuery);

/** BOUTTON REMONTER HAUT DE PAGE **/
$(function(){
    $("#retour_haut_page").click(function(){
        $("html, body").animate({scrollTop: 0},"slow");
    });
});
