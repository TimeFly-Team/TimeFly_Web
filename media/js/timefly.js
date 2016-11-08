$(window).scroll(function(){
    if(($(window).scrollTop()) < ($(".chevron").height()-80) ){
        $(".fa-chevron-circle-right").stop().animate({"marginTop": ($(window).scrollTop()) + "px"}, "slow" );
    }
});
		
$(window).scroll(function(){
    if(($(window).scrollTop()) < ($(".chevron").height()-80) ){
        $(".fa-chevron-circle-left").stop().animate({"marginTop": ($(window).scrollTop()) + "px"}, "slow" );
    }
});

$(function(){
  $(".under_nav").css({"marginTop": ($(".navbar-fixed-top").height())+ "px"})
});
function ContactToogle(open,close){
        $(open).css({"display": "block"});
        $(close).css({"display": "none"});
    }; 
