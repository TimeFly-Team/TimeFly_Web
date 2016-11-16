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
  /*if( $(window).height() > $("body").height() ) {
    $("footer").css({"position": "absolute", "bottom": 0+"px"});
  }else{
    $("footer").css({"position": "relative"});
  }*/
});

function ContactToogle(open,close){
        $(open).css({"display": "block"});
        $(close).css({"display": "none"});
    }; 
