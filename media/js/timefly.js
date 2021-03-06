var DEBUG_MODE = 1;
var logged_user = 0;

function callPHP(params, url, func, args = [])
{
	var httpc = new XMLHttpRequest();
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    httpc.onreadystatechange = function() 
		{
			if(httpc.readyState == 4 && httpc.status == 200)
			{
				debug("callPHP response: " + url, httpc.responseText.trim());
				args.push(httpc.responseText.trim());
				func(args);
			}
		}
	httpc.send(params);  
}

function debug(info, message)
{
	if (DEBUG_MODE)
	{
		console.log(info + "\n" + message + "\n");
	}
}

function initialize()
{
	callPHP("", "isLogged.php",
		function (args)
		{
			logged_user = args[0];
			getItems("Forum", "");  
      if(isMobile()){  
        $(".login-div").hide();
  
      }
		}
	);  
}

function isLogged()
{
	return logged_user > 0;
}

function echoMessage(message, success = true)
{
	$("<div id='oznam' class='oznam_" + success + "'>" + message + "</div>").appendTo("body");
	setTimeout(removeMessage, 3000);
}

function removeMessage()
{
	$("#oznam").remove();
}
if(!isMobile()) {
	$(window).scroll(function () {
		if (($(window).scrollTop()) < ($("#chevron-index").height() - 200)) {
			$(".fa-chevron-circle-right").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height()) - 50) / 2 + ($(window).scrollTop())) - 42 + "px"}, "slow");
		}
	});
	$(window).scroll(function () {
		if (($(window).scrollTop()) < ($("#chevron-index").height() - 200)) {
			$(".fa-chevron-circle-left").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height()) - 50) / 2 + ($(window).scrollTop())) - 42 + "px"}, "slow");
		}
	});

	$(window).scroll(function () {
		if (($(window).scrollTop()) < ($("#chevron-tim").height() - 200)) {
			$(".fa-chevron-circle-right").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height()) - 50) / 2 + ($(window).scrollTop())) - 42 + "px"}, "slow");
		}
	});
	$(window).scroll(function () {
		if (($(window).scrollTop()) < ($("#chevron-tim").height() - 200)) {
			$(".fa-chevron-circle-left").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height()) - 50) / 2 + ($(window).scrollTop())) - 42 + "px"}, "slow");
		}
	});

	$(window).scroll(function () {
		if (($(window).scrollTop()) < ($("#chevron-blog").height() - 200)) {
			$(".fa-chevron-circle-right").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height()) - 50) / 2 + ($(window).scrollTop())) - 42 + "px"}, "slow");
		}
	});
	$(window).scroll(function () {
		if (($(window).scrollTop()) < ($("#chevron-blog").height() - 200)) {
			$(".fa-chevron-circle-left").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height()) - 50) / 2 + ($(window).scrollTop())) - 42 + "px"}, "slow");
		}
	});
}
$(function(){
  $(".under_nav").css({"marginTop": ($(".navbar-fixed-top").height())+ "px"});
	if(!isMobile()){
  		$(".fa-chevron-circle-left").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height())-50)/2 + ($(window).scrollTop()))- 42 + "px"}, "slow" );
  		$(".fa-chevron-circle-right").stop().animate({"marginTop": ((($(window).height()) - ($(".slider").height())-50)/2 + ($(window).scrollTop()))- 42 + "px"}, "slow" );
	}
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
        $("#TeamName").text("Forum");
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
        $("#TeamName").text("Forum");
    }
};

var actual_page = "#index";
function LeftChangePage(new_page) {
    $('html, body').stop().animate({
        scrollTop: 0
    }, 0, 'linear');
    if(new_page ==="#index"){
        $("#home").css({"display": "flex"});
        $("#tim").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': $(window).height()/1366+'s','animation-timing-function': 'linear','position':'absolute','left':'-100%'});
        $("#forum").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': $(window).height()/1366+'s','animation-timing-function': 'linear','position':'absolute','left':'-100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_l','animation-duration': $(window).height()/1366+'s','animation-timing-function': 'linear','position':'relative','left':'0%'});
    }
    if(new_page ==="#tim"){
        $("#home").css({"display": "none"});
        $("#index").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': $(window).height()/1366+'s','position':'absolute','left':'100%'});
        $("#forum").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': $(window).height()/1366+'s','position':'absolute','left':'100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_l','animation-duration': $(window).height()/1366+'s','position':'relative','left':'0%'});
    }
    if(new_page ==="#forum"){
        $("#home").css({"display": "none"});
        $("#index").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': $(window).height()/1366+'s','position':'absolute','left':'-100%'});
        $("#tim").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': $(window).height()/1366+'s','position':'absolute','left':'-100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_l','animation-duration': $(window).height()/1366+'s','position':'relative','left':'0%'});
    }
    actual_page = new_page;
};
function RightChangePage(new_page) {
    $('html, body').stop().animate({
        scrollTop: 0
    }, 0, 'linear');
    if(new_page ==="#index"){
        $("#home").css({"display": "flex"});
        $("#tim").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': $(window).height()/1366+'s','animation-timing-function': 'linear','position':'absolute','left':'-100%'});
        $("#forum").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': $(window).height()/1366+'s','animation-timing-function': 'linear','position':'absolute','left':'-100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_r','animation-duration': $(window).height()/1366+'s','animation-timing-function': 'linear','position':'relative','left':'0%'});
    }
    if(new_page ==="#tim"){
        $("#home").css({"display": "none"});
        $("#index").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': $(window).height()/1366+'s','position':'absolute','left':'100%'});
        $("#forum").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': $(window).height()/1366+'s','position':'absolute','left':'100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_r','animation-duration': $(window).height()/1366+'s','position':'relative','left':'0%'});
    }
    if(new_page ==="#forum"){
        $("#home").css({"display": "none"});
        $("#index").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': $(window).height()/1366+'s','position':'absolute','left':'-100%'});
        $("#tim").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': $(window).height()/1366+'s','position':'absolute','left':'-100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_r','animation-duration': $(window).height()/1366+'s','position':'relative','left':'0%'});
    }
    actual_page = new_page;
};
function ChangePage(new_page) {
    $('html, body').stop().animate({
        scrollTop: 0
    }, 0, 'linear');
    if(new_page ==="#index"){
        if (actual_page ==="#forum"){
            $("#home").css({"display": "flex"});
            $("#forum").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': $(window).height()/1366+'s','animation-timing-function': 'linear','position':'absolute','left':'-100%'});
            $(new_page).css({"display": "block",'animation-name': 'show_page_l','animation-duration': $(window).height()/1366+'s','animation-timing-function': 'linear','position':'relative','left':'0%'});
        }
        if (actual_page ==="#tim"){
            $("#home").css({"display": "flex"});
            $("#tim").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': $(window).height()/1366+'s','animation-timing-function': 'linear','position':'absolute','left':'100%'});
            $(new_page).css({"display": "block",'animation-name': 'show_page_r','animation-duration': $(window).height()/1366+'s','animation-timing-function': 'linear','position':'relative','left':'0%'});
        }
        num_page = 1;
        $("#TeamName").text("Home/About us");
    }
    if(new_page ==="#tim"){
        $("#home").css({"display": "none"});
        $("#index").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': $(window).height()/1366+'s','position':'absolute','left':'100%'});
        $("#forum").css({'display': 'none','animation-name': 'hide_page_l','animation-duration': $(window).height()/1366+'s','position':'absolute','left':'100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_l','animation-duration': $(window).height()/1366+'s','position':'relative','left':'0%'});
        num_page = 0;
        $("#TeamName").text("Team");
    }
    if(new_page ==="#forum"){
        $("#home").css({"display": "none"});
        $("#index").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': $(window).height()/1366+'s','position':'absolute','left':'-100%'});
        $("#tim").css({'display': 'none','animation-name': 'hide_page_r','animation-duration': $(window).height()/1366+'s','position':'absolute','left':'-100%'});
        $(new_page).css({"display": "block",'animation-name': 'show_page_r','animation-duration': $(window).height()/1366+'s','position':'relative','left':'0%'});
        num_page = 2;
        $("#TeamName").text("Forum");
    }
    actual_page = new_page;
};

function isMobile() {
  try{ document.createEvent("TouchEvent"); return true; }
  catch(e){ return false; }
}

$(function() {
	if(isMobile()){
	  $("body").swipe( {
          swipeLeft:function(event, direction, distance, duration, fingerCount) {
			ArrowRightChangePage();
		  },
          swipeRight:function(event, direction, distance, duration, fingerCount) {
			ArrowLeftChangePage();
          }
	   });
	}else{
		$("article").addClass("noSwipe");
	}

    var swipeOptions=
           {
               threshold: 150,
               allowPageScroll:"auto"
           };

  $("body").swipe(swipeOptions);
});

//Script from forum.php

var symbolDict = {0:"exclamation", 1:"check", 2:"eye", 3:"eye-slash"};

var addForumButton = '<div id="new_forum_div" class="new_forum">' +
						'<button  type="button" onclick="removetext(\'.tema\');$(\'.add_theme\').show();">' +
							'<i class="add fa fa-plus-square" aria-hidden="true"></i>' +
						'Add</button>' +
					 '</div>';
					
var addForumForm   = '<div id="add_forum_div" class="add_theme" >' +
						'<form class="send_theme">' +
							'<div class="row">' +
								'<div class="col-md-12">' +
									'<p>Nazov temy:</p>' +
									'<input id="theme_name" class="tema" type="text" name="tema" value="">' +
								'</div>' +
							'</div>' +
							'<div class="row">' +
								'<div class="col-md-12">' +
									'<div class="tlacidla">' +
										'<button type="button" onclick="$(\'.add_theme\').hide();">Cancel</button>' +
										'<button id="forum_submit" type="button" onclick="">Submit</button>' +
									'</div>' +
								'</div>' +
							'</div>' +
						'</form>' +
					'</div>';
					
var addTopicButton = '<div id="new_topic_div" class="new_topic">' + 
							'<button  type="button" onclick="removetext(\'.mail\');removetext(\'.tema\');removetext(\'#topic_desc\');$(\'.add_topic\').show();"><i class="fa fa-plus-square" aria-hidden="true"></i>' +
								'Add</button>' +
					'</div>';

var addTopicForm =	'<div id="add_topic_div" class="add_topic" >' +
						'<form class="send_topic">' +
							'<div class="row">' +
								'<div class="col-md-3 mail_hide">' +
									'<p>Your email:</p>' +
									'<input id="topic_mail" class="mail" type="email"  name="yourmail" value="">' +
								'</div>' +
								'<div class="col-md-9">' +
									'<p>Nazov temy:</p>' +
									'<input id="topic_tema" class="tema" type="text" name="tema" value="">' +
								'</div>' +
							'</div>' +
							'<div class="row">' +
								'<div class="col-md-12">' +
									'<div class="description_problem">' +
										'<p>Opis problemu:</p>' +
										'<textarea id="topic_desc" name="question" rows="4"></textarea>' +
									'</div>' +
								'</div>' +
							'</div>' +
							'<div class="row">' +
								'<div class="col-md-12">' +
									'<div class="tlacidla">' +
										'<button type="button" onclick="$(\'.add_topic\').hide();">Cancel</button>' +
										'<button id="topic_submit" type="button" onclick="">Submit</button>' +
									'</div>' +
								'</div>' +
							'</div>' +
						'</form>' +
					'</div>';
						
var addCommentButton = '<div id="new_reply_div" class="new_reply">' +
							'<button  type="button" onclick="removetext(\'.mail\');removetext(\'#reply_desc\');$(\'.add_reply\').show();">' +
								'Add reply' +
							'</button>' +
						'</div>';
						
var addCommentForm	 =	'<div id="add_reply_div" class="add_reply">' +
							'<form class="send_reply">' +
								'<div class="row mail_hide">' +
									'<div class="col-md-3">' +
										'<p>Your email:</p>' +
										'<input id="reply_mail" class="mail" type="email"  name="yourmail" value="">' +
									'</div>' +
								'</div>' +
								'<div class="row">' +
									'<div class="col-md-12">' +
										'<div class="description_problem">' +
											'<p>Opis problemu:</p>' +
											'<textarea id="reply_desc" name="question" rows="4"></textarea>' +
										'</div>' +
									'</div>' +
								'</div>' +
								'<div class="row">' +
									'<div class="col-md-12">' +
										'<div class="tlacidla">' +
											'<button type="button" onclick="$(\'.add_reply\').hide();">Cancel</button>' +
											'<button id="comment_submit" type="button" onclick="">Submit</button>' +
										'</div>' +
									'</div>' +
								'</div>' +
							'</form>' +
						'</div>';
						
var editItemForm =	'<div id="edit_item_div" class="edit_item" >' +
						'<form class="send_theme">' +
							'<div class="row">' +
								'<div class="col-md-12">' +
									'<p>Text:</p>' +
									'<input id="new_item_text" class="tema" type="text" name="tema" value="">' +
								'</div>' +
							'</div>' +
							'<div class="row">' +
								'<div class="col-md-12">' +
									'<div class="tlacidla">' +
										'<button type="button" onclick="$(\'.edit_item\').hide();">Cancel</button>' +
										'<button id="new_item_text_submit" type="button" onclick="">Submit</button>' +
									'</div>' +
								'</div>' +
							'</div>' +
						'</form>' +
					'</div>';

var editCommentForm =	'<div id="edit_item_div" class="edit_item" >' +
						'<form class="send_theme">' +
							'<div class="row">' +
								'<div class="col-md-12">' +
									'<p>Text:</p>' +
									'<textarea id="new_item_text" class="tema" name="question" rows="4"></textarea>' +
								'</div>' +
							'</div>' +
							'<div class="row">' +
								'<div class="col-md-12">' +
									'<div class="tlacidla">' +
										'<button type="button" onclick="$(\'.edit_item\').hide();">Cancel</button>' +
										'<button id="new_item_text_submit" type="button" onclick="">Submit</button>' +
									'</div>' +
								'</div>' +
							'</div>' +
						'</form>' +
					'</div>';

					
var settingsList = ["Rename", "Delete", "Privacy", "Lock"];
					
function settings(type, id, flag = false)
{	
	setDropdownMenu(type, id, flag);
	destroyEditForm();
	for (i = 0 ; i < settingsList.length ; i++)
	{
		var setttingButton = document.getElementById('setting_' + settingsList[i]);
		if (setttingButton === null) continue;
		setttingButton.onclick = function (setting, type, id)
		{
			return function ()
			{
				settingsFunctionsDict[settingsList[setting]](type, id);
				document.getElementById('dropdown_ul_'+type+"_"+id).innerHTML = "";
			};
		}(i, type, id)
	}
}

function setDropdownMenu(type, id, flag)
{
	document.getElementById('dropdown_ul_'+type+"_"+id).innerHTML = '<li> <a id="setting_Rename"  onclick=""> Rename </a> </li>' +
																	'<li> <a id="setting_Delete"  onclick=""> Delete </a> </li>' +
																	'<li> <a id="setting_Privacy"  onclick=""> Public/Private </a> </li>';
	if (hasItemLockSetting(type, id, flag))
	{
		document.getElementById('dropdown_ul_'+type+"_"+id).innerHTML += '<li> <a id="setting_Lock"  onclick=""> Resolved/Unresolved </a> </li>';
	}
}

function hasItemLockSetting(type, id, flag)
{
	if (type == "Topic" && flag == 2)
	{
		return true;
	}
	return false;
}

function destroyEditForm()
{
	var editForm = document.getElementById("edit_item_div");
	if (editForm !== null)
	{
		editForm.parentNode.removeChild(editForm);
	}
}

var settingsFunctionsDict = {
	"Rename": function (type, id)
	{
		if (type == "Comment")
		{
			document.getElementById("item_"+type+"_"+id).innerHTML += editCommentForm;
		}
		else
		{
			document.getElementById("item_"+type+"_"+id).innerHTML += editItemForm;
		}
		document.getElementById('new_item_text_submit').onclick = function ()
		{
			callPHP("type="+type+"&id="+id+"&column=text"+"&value="+'"'+document.getElementById("new_item_text").value+'"', "editItem.php",
				function (args)
				{
					if (args[2])
					{
						document.getElementById('a_' + args[0] + "_" + args[1]).innerHTML = document.getElementById("new_item_text").value;
						document.getElementById("edit_item_div").parentNode.removeChild(document.getElementById("edit_item_div"));
						echoMessage('Changes were successful.', true);
					}
					else
					{
						echoMessage('Error occurred during changing text in item.', false);
					}
				}, [type, id]
			);
		};
	},
	"Delete": function (type, id)
	{
		if (type == "Forum" && id < 3)
		{
			echoMessage("It is not possible delete this forum.", false);
			return;
		}
		callPHP("type="+type+"&id="+id+"&column=visible"+"&value=2", "editItem.php",
			function (args)
			{
				if (args[2])
				{
					document.getElementById("item_" + args[0] + "_" + args[1]).parentNode.removeChild(document.getElementById("item_"+type+"_"+id));
					echoMessage('Changes were successful.', true);
				}
				else
				{
					echoMessage('Error occurred during deleting item.', false);
				}
			}, [type, id]
		);
	},
	"Privacy": function (type, id)
	{
		callPHP("type="+type+"&id="+id+"&column=visible"+"&value=!visible", "editItem.php",
			function (args)
			{
				if (args[2])
				{
					var tag = document.getElementById('tag1_' + args[0] + '_' + args[1]);
					if (tag !== null)
					{
						if (tag.className == 'fa fa-eye pl10 pr10 tooltipx')
						{
							tag.className = 'fa fa-eye-slash pl10 pr10 tooltipx';
						}
						else
						{
							tag.className = 'fa fa-eye pl10 pr10 tooltipx';
						}
					}
					echoMessage('Changes were successful.', true);
				}
				else
				{
					echoMessage('Error occurred during changing privacy settings of item.', false);
				}
			}, [type, id]
		);		
	},
	"Lock": function (type, id)
	{
		callPHP("type="+type+"&id="+id+"&column=lock"+"&value=!lock", "editItem.php",
			function (args)
			{
				if (args[2])
				{
					var tag = document.getElementById('tag_' + args[0] + '_' + args[1]);
					if (tag !== null)
					{
						if (tag.className == 'fa fa-exclamation tooltipx')
						{
							tag.className = 'fa fa-check tooltipx';
						}
						else
						{
							tag.className = 'fa fa-exclamation tooltipx';
						}
					}
					echoMessage('Changes were successful.', true);
				}
				else
				{
					echoMessage('Error occurred during changing tag of item.', false);
				}
			}, [type, id]
		);
	}
}

var forumsAccess = {};
var submitItemTypeDict = {"Forum":"forum_submit", "Topic":"topic_submit", "Comment":"comment_submit"};
var createItemViewDict = {	
	"Forum": function (forum)
	{
		forumsAccess[forum.forum_id] = forum.forum_access;
		var levelId = "level_0_" + forum.forum_id;
		var panelId = "panel_0_" + forum.forum_id; 
		return	'<div id="item_Forum_'+forum.forum_id+'" class="panel panel-default">' +
					'<div class="panel-heading">' +
						'<h4 class="panel-title">' +
							'<a id="a_Forum_' + forum.forum_id + '" data-toggle="collapse" data-parent="#level0" onclick="getItems(\'Topic\','+forum.forum_id+')" href="' + "#" + levelId + '">' + forum.forum_name + '</a>' +
						'</h4>' +
						
						(isLogged()
						?						
							'<div class="dropdown">' +
								'<a data-toggle="dropdown" class="dropdown-toggle" onclick="settings(\'Forum\','+forum.forum_id+')"> <i class="fa fa-gear" aria-hidden="true"></i> </a>' +
								'<ul id="dropdown_ul_Forum_' + forum.forum_id + '" class="dropdown-menu">' +
								'</ul>' +
							'</div>' +
							'<i id="tag1_Forum_' + forum.forum_id + '" class="fa fa-' + symbolDict[1*forum.visible + 2] + ' pl10 pr10 tooltipx" aria-hidden="true">' +
								'<span class="tooltipxtext">' +
									'Public/Private' +
								'</span>' +
							'</i>'
						:
							''
						) +

					'</div>' +
					'<div id="' + levelId + '" class="panel-collapse collapse">' +
						'<div id="' + panelId + '" class="panel-body">' +
						'</div>	' +
					'</div>' +
				'</div>';
	},
	"Topic": function (topic)
	{
		var levelId = "level_2_" + topic.topic_id;
		var panelId = "panel_2_" + topic.topic_id; 
		return  '<div id="item_Topic_'+topic.topic_id+'" class="panel panel-default">' +
					'<div class="panel-heading">' +
						'<h4 class="panel-title">' +
							'<a id="a_Topic_' + topic.topic_id + '" data-toggle="collapse" data-parent="#panel_0_' + topic.forum_id + '" onclick="getItems(\'Comment\','+topic.topic_id+')" href="' + "#" + levelId + '">' + topic.topic_name  + '</a>' +
						'</h4>' +
						
						(isLogged()
						?
					
							'<div class="dropdown">' +
								'<a data-toggle="dropdown" class="dropdown-toggle" onclick="settings(\'Topic\','+topic.topic_id+', '+ topic.forum_id +')"> <i class="fa fa-gear pl10" aria-hidden="true"></i> </a>' +
								'<ul id="dropdown_ul_Topic_' + topic.topic_id + '" class="dropdown-menu">' +
								'</ul>' +
							'</div>' +
							'<i id="tag1_Topic_' + topic.topic_id + '" class="fa fa-' + symbolDict[1*topic.visible + 2] + ' pl10 pr10 tooltipx" aria-hidden="true">' +
								'<span class="tooltipxtext">' +
									'Public/Private' +
								'</span>' +
							'</i>'
						:
							''
						) +
						
						(topic.forum_id == 2
						?
							'<i id="tag_Topic_' + topic.topic_id + '" class="fa fa-' + symbolDict[topic.topic_lock] + ' tooltipx" aria-hidden="true">' +
							(!isMobile()
							?
							'<span class="tooltipxtext">' +
									'Resolved/Unresolved' +
								'</span>'
								: ""
						)+
							'</i>'
						:
							''

						) +
						
					'</div>' +
					'<div id="' + levelId + '" class="panel-collapse collapse">' +
						'<div id="' + panelId + '" class="panel-body">' +
						'</div>	' +
					'</div>' +
				'</div>';
	},
	"Comment": function(comment)
	{
		return  '<div id="item_Comment_'+comment.comment_id+'">' +
					'<div class="media">' +
						'<div class="media-body">' +
							'<h4 class="media-heading">' + comment.user_name + '<small><i>  Posted on ' + comment.time + '</i></small>' +
							
							(isLogged()
							?
							
								'<div class="dropdown">' +
									'<a data-toggle="dropdown" class="dropdown-toggle" onclick="settings(\'Comment\','+comment.comment_id+')"> <i class="fa fa-gear" aria-hidden="true"></i> </a>' +
									'<ul id="dropdown_ul_Comment_' + comment.comment_id + '" class="dropdown-menu">' +
									'</ul>' +
								'</div>' +
								'<i id="tag1_Comment_' + comment.comment_id + '" class="fa fa-' + symbolDict[1*comment.visible + 2] + ' pl10 pr10 tooltipx" aria-hidden="true">' +
										'<span class="tooltipxtext">' +
											'Public/Private' +
										'</span>' +
								'</i>'
							:
								''
							) + '</h4>' +
							
							'<p id="a_Comment_' + comment.comment_id + '">' + comment.text + '</p>' +
							
						'</div>' +
						
					'</div>' +
					
				'</div>';
	}
};

var onAddItemClickDict = {	
	"Forum": function(id)
	{
		if (!validateItemName(document.getElementById('theme_name').value))
		{
			echoMessage("This field must not be empty.", false);
			$('#theme_name').css({"border":"2px solid red"});
			return;
		}
		$('#theme_name').css({"border":"1px solid #ddd"});
		callPHP("type=forum" + "&name=" + document.getElementById('theme_name').value,
				"addNewItem.php", function(args)
				{
					if (args[1] != false)
					{
						var newForumView = showItems(args[0], JSON.parse(args[1]));
						var div = document.createElement('div');
						div.innerHTML = newForumView;
						document.getElementById("level0").insertBefore(div.firstChild, document.getElementById("new_forum_div"));
						document.getElementById("add_forum_div").style.display = "none";
						echoMessage("New forum was created.", true);
					}
					else
					{
						echoMessage("Error occurred during creating forum.", false);
					}
				}, ["Forum"]
		);
	},
	"Topic": function(id)
	{
		if (!isLogged() && !validateEmail(document.getElementById('topic_mail').value))
		{
			echoMessage("Your mail is not valid.", false);
			$("#topic_mail").css({"border":"2px solid red"});
			return;
		}
		$("#topic_mail").css({"border":"1px solid #ddd"});
		if (!validateItemName(document.getElementById('topic_tema').value))
		{
			echoMessage("This field must not be empty.", false);
			$('#topic_tema').css({"border":"2px solid red"});
			return;
		}
		$('#topic_tema').css({"border":"1px solid #ddd"});
		callPHP("type=topic" + "&forum=" + id
			+ "&name=" + document.getElementById('topic_tema').value
			+ "&user=" + document.getElementById('topic_mail').value
			+ "&desc=" + document.getElementById('topic_desc').value,
			"addNewItem.php", function(args)
			{
				if (args[2] != false)
				{
					var newTopicView = showItems(args[0], JSON.parse(args[2]));
					var div = document.createElement('div');
					div.innerHTML = newTopicView;
					document.getElementById("panel_0_" + args[1]).insertBefore(div.firstChild, document.getElementById("new_topic_div"));
					document.getElementById("add_topic_div").style.display = "none";
					echoMessage("New topic was created.", true);
				}
				else
				{
					echoMessage("Error occurred during creating topic.", false);
				}
			}, ["Topic", id]
		);
	},
	"Comment": function(id)
	{
		if (!isLogged() && !validateEmail(document.getElementById('reply_mail').value))
		{
			echoMessage("Your mail is not valid.", false);
			$("#reply_mail").css({"border":"2px solid red"});
			return;
		}
		$("#reply_mail").css({"border":"1px solid #ddd"});
		
		callPHP("type=comment" + "&topic=" + id
			+ "&user=" + document.getElementById('reply_mail').value
			+ "&desc=" + document.getElementById('reply_desc').value,
			"addNewItem.php", function(args)
			{
				if (args[2] != false)
				{
					var newCommentView = showItems(args[0], JSON.parse(args[2]));
					var div = document.createElement('div');
					div.innerHTML = newCommentView;
					document.getElementById("panel_2_" + args[1]).insertBefore(div.firstChild, document.getElementById("new_reply_div"));
					document.getElementById("add_reply_div").style.display = "none";
					echoMessage("Your comment was send.", true);
				}
				else
				{
					echoMessage("Error occurred during sending comment.", false);
				}
				
			}, ["Comment", id]
		);
	}
};

function hideMailIfLogged()
{
	if (isLogged())
	{
		$('.mail_hide').css({"display":"none"});
	}
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validateItemName(name)
{
	return name.trim() != "";
}

var setItemsToHTMLDict = {	
	"Forum": function(type, id, responseText)
	{
		document.getElementById("level0").innerHTML = showItems(type, JSON.parse(responseText)) + addForumButton + addForumForm;
		document.getElementById("new_forum_div").style.display = "block";
		if (!isLogged())
		{
			document.getElementById("new_forum_div").style.display = "none";
		}
	},
	"Topic": function(type, id, responseText)
	{
		delNewTopicForm();
		delNewCommentForm();
		document.getElementById("panel_0_" + id).innerHTML = showItems(type, JSON.parse(responseText)) + addTopicButton + addTopicForm;
		hideMailIfLogged();
		document.getElementById("new_topic_div").style.display = "block";
		if (forumsAccess[id] > 0 && !isLogged())
		{
			document.getElementById("new_topic_div").style.display = "none";
		}
	},
	"Comment": function(type, id, responseText)
	{
		delNewCommentForm();
		document.getElementById("panel_2_" + id).innerHTML = showItems(type, JSON.parse(responseText)) + addCommentButton + addCommentForm;
		hideMailIfLogged();
	}
};

function delNewCommentForm()
{
	var elem = document.getElementById('new_comment_div');
	if (elem !== null)
	{
		elem.parentNode.removeChild(elem);
	}
	elem = document.getElementById('add_comment_div');
	if (elem !== null)
	{
		elem.parentNode.removeChild(elem);
	}
}

function delNewTopicForm()
{
	var elem = document.getElementById('new_topic_div');
	if (elem !== null)
	{
		elem.parentNode.removeChild(elem);
	}
	elem = document.getElementById('add_topic_div');
	if (elem !== null)
	{
		elem.parentNode.removeChild(elem);
	}
}

function getItems(type, id)
{
	var params = "id=" + id;
	if (isLogged() && type == 'Topic')
	{
		params += "&filter=" + document.getElementById('sel1').selectedIndex;
	}
	callPHP(params, "get" + type + "s.php",
		function (args)
		{
			setItemsToHTMLDict[type](args[0], args[1], args[2]);
			document.getElementById(submitItemTypeDict[type]).onclick = function () {onAddItemClickDict[type](id);};
		}, [type, id]
	);
}

function showItems(type, response)
{
	result = "";
	for (var i in response)
	{
		result += createItemViewDict[type](response[i]);
	}
	return result;
}

function setAddQuestionSubmit(id)
{
	document.getElementById('add_question_submit_' + id).onclick = function (id)
	{
		return function ()
		{		
			if (!isLogged() && !validateEmail(document.getElementById('add_question_mail_' + id).value))
			{
				echoMessage("Your mail is not valid.", false);
				$('#add_question_mail_' + id).css({"border":"2px solid red"});
				return;
			}
			$('#add_question_mail_' + id).css({"border":"1px solid #ddd"});
			if (!validateItemName(document.getElementById('add_question_topic_name_' + id).value))
			{
				echoMessage("This field must not be empty.", false);
				$('#add_question_topic_name_' + id).css({"border":"2px solid red"});
				return;
			}
			$('#add_question_topic_name_' + id).css({"border":"1px solid #ddd"});
			callPHP("type=topic" + "&forum=2"
					+ "&name=" + document.getElementById('add_question_topic_name_' + id).value
					+ "&user=" + document.getElementById('add_question_mail_' + id).value
					+ "&desc=" + document.getElementById('add_question_desc_' + id).value
					+ "&moderator=" + id, "addNewItem.php",
						function (args)
						{
							if (args[0] != false)
							{
								echoMessage("Question was send", true);
							}
							else
							{
								echoMessage("Error occurred during sending question.", false)
							}
						}
				);
			ContactToogle('#moderator_' + id,'#message_' + id);
		};
	}(id);
}

//vyhladavanie

function ResultSearch()
{
  var checkedValue = null; 
  var inputElements = document.getElementsByClassName('checkbox');
  
  checkedValue = $('input:radio:checked')[0].value;
		
  var text =document.getElementById("searchText").value; 
  console.log(text);
  $(".res_search").remove();
	$("<div class='row pt10 res_search'><div class='col-md-12'><div class='result_search panel-collapse collapse in'><a onclick='RemoveResultSearch();'><i class='fa fa-times' aria-hidden='true'></i></a> <div id=\"searchResult\" class='panel-body'> </div> </div></div></div>").insertAfter(".search_ex");
  getSearchResult(checkedValue,text);
    
}

function getSearchResult(value,text)
{
    $.ajax({
    type: 'get',
    url: 'getSearch.php?value='+value+'&text='+text,
    dataType:"json",
    success: function (response)
    {     
          var result='<b>Search results: '+text+'</b>';
          for(var i=0; i<response.length;i++){
              var levelId = "level_1_" + response[i]['topic_id'];
                  var panelId = "panel_1_" + response[i]['topic_id'];
              result += '<div id="search_item_Topic_'+response[i]['topic_id']+'" class="panel panel-default">' +
                        '<div class="panel-heading">' +
                            '<h4 class="panel-title">' +
                               '<a id="search_a_Topic_' + response[i]['topic_id'] + '" data-toggle="collapse" data-parent="#searchResult" onclick="getComments('+response[i]['topic_id']+',\''+text+'\')\" href="' + "#search_" + levelId + '">' + boldni(response[i]['text'], text) + '</a>' +
                            '</h4>' +
							
							'<i id="tag_Topic_' + response[i]['topic_id'] + '" class="fa fa-' + symbolDict[response[i]['lock']] + '" aria-hidden="true"></i>' +
							
                          '</div>' +
                        '<div id="search_' + levelId + '" class="panel-collapse collapse">' +
                            '<div id="search_' + panelId + '" class="panel-body">' +
                            '</div>    ' +
                        '</div>' +
                    '</div>';
           }
           if(response.length==0){
              result+='<p>No results</p>';
           }
           var div = document.createElement('div');
           div.innerHTML=result;
           document.getElementById("searchResult").innerHTML += div.innerHTML;
    }
  }).fail(function(data){console.log(data)});

}

function getComments(id,text)
{
	var params = "id=" + id;
	callPHP(params, "getComments.php",
		function (args)
		{
			response = JSON.parse(args[1]);
			result = "";
			for (var i in response)
			{
				result += getHTMLCosi(response[i], text);
			}
			document.getElementById("search_panel_1_" + args[0]).innerHTML = result;
		}, [id]
	);
}

function getHTMLCosi(comment, text)
{	
	return  '<div id="item_Comment_'+comment.comment_id+'">' +
					'<div class="media">' +
						'<div class="media-body">' +
							'<h4 class="media-heading">' + comment.user_name + '<small><i>  Posted on ' + comment.time + '</i></small></h4>' +
							'<p id="a_Comment_' + comment.comment_id + '">' + boldni(comment.text, text) + '</p>' +
							
						'</div>' +
						
					'</div>' +
				'</div>';
}

function boldni(text, query)
{
	return text.split(query).join("<b style='color: orange'>" + query + "</b>");
}	

function removetext(comu)
{
  $(comu).val($(comu).val().replace($(comu).val(), ''));
}

