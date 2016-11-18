$(window).scroll(function(){
    if(($(window).scrollTop()) < ($(".chevron").height()-200) ){
        $(".fa-chevron-circle-right").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height())-50)/2 + ($(window).scrollTop()))- 42 + "px"}, "slow" );
    }
});
		
$(window).scroll(function(){
    if(($(window).scrollTop()) < ($(".chevron").height()-200) ){
        $(".fa-chevron-circle-left").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height())-50)/2 + ($(window).scrollTop()))- 42 + "px"}, "slow" );
    }
});

$(function(){
  $(".under_nav").css({"marginTop": ($(".navbar-fixed-top").height())+ "px"});
  $(".fa-chevron-circle-left").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height())-50)/2 + ($(window).scrollTop()))- 42 + "px"}, "slow" );
  $(".fa-chevron-circle-right").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height())-50)/2 + ($(window).scrollTop()))- 42 + "px"}, "slow" );
});

function ContactToogle(open,close) {
        $(open).css({"display": "block"});
        $(close).css({"display": "none"});
    };
    
function ShowLabel(label,collapse) {
        if($(collapse).attr("aria-expanded") === 'false'){
            $(label).text("- More information");   
        }else{
            $(label).text("+ More information");
        }
    };
    
//jQuery to collapse the navbar on scroll
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top-50
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});
