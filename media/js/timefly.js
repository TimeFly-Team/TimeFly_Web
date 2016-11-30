$(window).scroll(function(){
    if(($(window).scrollTop()) < ($("#chevron-index").height()-200) ){
        $(".fa-chevron-circle-right").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height())-50)/2 + ($(window).scrollTop()))- 42 + "px"}, "slow" );
    }
});
$(window).scroll(function(){
    if(($(window).scrollTop()) < ($("#chevron-index").height()-200) ){
        $(".fa-chevron-circle-left").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height())-50)/2 + ($(window).scrollTop()))- 42 + "px"}, "slow" );
    }
});

$(window).scroll(function(){
    if(($(window).scrollTop()) < ($("#chevron-tim").height()-200) ){
        $(".fa-chevron-circle-right").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height())-50)/2 + ($(window).scrollTop()))- 42 + "px"}, "slow" );
    }
});
$(window).scroll(function(){
    if(($(window).scrollTop()) < ($("#chevron-tim").height()-200) ){
        $(".fa-chevron-circle-left").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height())-50)/2 + ($(window).scrollTop()))- 42 + "px"}, "slow" );
    }
});

$(window).scroll(function(){
    if(($(window).scrollTop()) < ($("#chevron-blog").height()-200) ){
        $(".fa-chevron-circle-right").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height())-50)/2 + ($(window).scrollTop()))- 42 + "px"}, "slow" );
    }
});
$(window).scroll(function(){
    if(($(window).scrollTop()) < ($("#chevron-blog").height()-200) ){
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
        }, 2500, 'easeInOutExpo');
        event.preventDefault();
    });
});
function ResultSearch() {
    $(".res_search").remove();
    $("<div class='row pt10 res_search'><div class='col-md-12'><div class='result_search'><a onclick='RemoveResultSearch();'><i class='fa fa-times' aria-hidden='true'></i></a></div></div></div>").insertAfter(".search_ex");
}
function RemoveResultSearch() {
    $(".res_search").remove();
}

var num_page = 1;
function ArrowLeftChangePage() {
    num_page++;
    if(num_page>2){
        num_page=0;
    }
    if (num_page === 0){
        LeftChangePage("#tim");
        $("#TeamName").text("Team");
    }
    if (num_page === 1){
        LeftChangePage("#index");
        $("#TeamName").text("Home/About us");
    }
    if (num_page === 2){
        LeftChangePage("#forum");
        $("#TeamName").text("Blog");
    }
};
function ArrowRightChangePage() {
    num_page--;
    if(num_page<0){
        num_page=2;
    }
    if (num_page === 0){
        RightChangePage("#tim");
        $("#TeamName").text("Team");
    }
    if (num_page === 1){
        RightChangePage("#index");
        $("#TeamName").text("Home/About us");
    }
    if (num_page === 2){
        RightChangePage("#forum");
        $("#TeamName").text("Blog");
    }
};

var actual_page = "#index";
function LeftChangePage(new_page) {
    $('html, body').stop().animate({
        scrollTop: 0
    }, 0, 'linear');
    if(new_page ==="#index"){
        $("#home").css({"display": "block"});
        $("#tim").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': '1s','animation-timing-function': 'linear','position':'absolute','left':'-100%'});
        $("#forum").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': '1s','animation-timing-function': 'linear','position':'absolute','left':'-100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_l','animation-duration': '1s','animation-timing-function': 'linear','position':'relative','left':'0%'});
    }
    if(new_page ==="#tim"){
        $("#home").css({"display": "none"});
        $("#index").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': '1s','position':'absolute','left':'100%'});
        $("#forum").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': '1s','position':'absolute','left':'100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_l','animation-duration': '1s','position':'relative','left':'0%'});
    }
    if(new_page ==="#forum"){
        $("#home").css({"display": "none"});
        $("#index").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': '1s','position':'absolute','left':'-100%'});
        $("#tim").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': '1s','position':'absolute','left':'-100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_l','animation-duration': '1s','position':'relative','left':'0%'});
    }
    actual_page = new_page;
};
function RightChangePage(new_page) {
    $('html, body').stop().animate({
        scrollTop: 0
    }, 0, 'linear');
    if(new_page ==="#index"){
        $("#home").css({"display": "block"});
        $("#tim").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': '1s','animation-timing-function': 'linear','position':'absolute','left':'-100%'});
        $("#forum").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': '1s','animation-timing-function': 'linear','position':'absolute','left':'-100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_r','animation-duration': '1s','animation-timing-function': 'linear','position':'relative','left':'0%'});
    }
    if(new_page ==="#tim"){
        $("#home").css({"display": "none"});
        $("#index").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': '1s','position':'absolute','left':'100%'});
        $("#forum").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': '1s','position':'absolute','left':'100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_r','animation-duration': '1s','position':'relative','left':'0%'});
    }
    if(new_page ==="#forum"){
        $("#home").css({"display": "none"});
        $("#index").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': '1s','position':'absolute','left':'-100%'});
        $("#tim").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': '1s','position':'absolute','left':'-100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_r','animation-duration': '1s','position':'relative','left':'0%'});
    }
    actual_page = new_page;
};
function ChangePage(new_page) {
    $('html, body').stop().animate({
        scrollTop: 0
    }, 0, 'linear');
    if(new_page ==="#index"){
        if (actual_page ==="#forum"){
            $("#home").css({"display": "block"});
            $("#forum").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': '1s','animation-timing-function': 'linear','position':'absolute','left':'-100%'});
            $(new_page).css({"display": "block",'animation-name': 'show_page_l','animation-duration': '1s','animation-timing-function': 'linear','position':'relative','left':'0%'});
        }
        if (actual_page ==="#tim"){
            $("#home").css({"display": "block"});
            $("#tim").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': '1s','animation-timing-function': 'linear','position':'absolute','left':'100%'});
            $(new_page).css({"display": "block",'animation-name': 'show_page_r','animation-duration': '1s','animation-timing-function': 'linear','position':'relative','left':'0%'});
        }
        num_page = 1;
        $("#TeamName").text("Home/About us");
    }
    if(new_page ==="#tim"){
        $("#home").css({"display": "none"});
        $("#index").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': '1s','position':'absolute','left':'100%'});
        $("#forum").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': '1s','position':'absolute','left':'100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_l','animation-duration': '1s','position':'relative','left':'0%'});
        num_page = 0;
        $("#TeamName").text("Team");
    }
    if(new_page ==="#forum"){
        $("#home").css({"display": "none"});
        $("#index").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': '1s','position':'absolute','left':'-100%'});
        $("#tim").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': '1s','position':'absolute','left':'-100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_r','animation-duration': '1s','position':'relative','left':'0%'});
        num_page = 2;
        $("#TeamName").text("Blog");
    }
    actual_page = new_page;
};

$(function() {
  $("body").swipe( {
    swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
        console.log(direction);
        if(direction==="right"){
            ArrowLeftChangePage();
        }else if(direction==="left"){
            ArrowRightChangePage();
        }
    }
  });

  $("body").swipe({allowPageScroll:"auto"});
});
