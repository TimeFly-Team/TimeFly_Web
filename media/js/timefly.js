$(window).scroll(function(){
$(".fa-chevron-circle-right").stop().animate({"marginTop": ($(window).scrollTop()) + "px", "marginLeft":($(window).scrollLeft()) + "px"}, "slow" );
});
		
$(window).scroll(function(){
$(".fa-chevron-circle-left").stop().animate({"marginTop": ($(window).scrollTop()) + "px", "marginLeft":($(window).scrollLeft()) + "px"}, "slow" );
});
