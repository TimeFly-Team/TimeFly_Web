<script>

function isLogged()
{
	return <?php echo $moderator->isLogged() ? 1 : 0; ?> > 0;
}

var symbolDict = {0:"exclamation", 1:"check"};

var addForumButton = '<div id="new_forum_div" class="new_forum">' +
						'<button  type="button" onclick="$(\'.add_theme\').show();">' +
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
							'<button  type="button" onclick="$(\'.add_topic\').show();"><i class="fa fa-plus-square" aria-hidden="true"></i>' +
								'Add</button>' +
					'</div>';

var addTopicForm =	'<div id="add_topic_div" class="add_topic" >' +
						'<form class="send_topic">' +
							'<div class="row">' +
								'<div class="col-md-3">' +
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
							'<button  type="button" onclick="$(\'.add_reply\').show();">' +
								'Add reply' +
							'</button>' +
						'</div>';
						
var addCommentForm	 =	'<div id="add_reply_div" class="add_reply">' +
							'<form class="send_reply">' +
								'<div class="row">' +
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
											'<button id="comment_submit" type="button" onclick="">Submin</button>' +
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
					
function settings(type, id)
{
	var view =  '<li> <a id="setting1"  onclick=""> Rename </a> </li>' +
				'<li> <a id="setting2"  onclick=""> Delete </a> </li>';
	document.getElementById('dropdown_ul_'+type+"_"+id).innerHTML = view;
	if (document.getElementById("edit_item_div") !== null)
	{
		document.getElementById("edit_item_div").parentNode.removeChild(document.getElementById("edit_item_div"));
	}
	
	console.log(type + "..." + id);
	document.getElementById('setting1').onclick = function ()
	{
		document.getElementById("item_"+type+"_"+id).innerHTML += editItemForm;
		document.getElementById('new_item_text_submit').onclick = function ()
		{
			callPHP("type="+type+"&id="+id+"&column=text"+"&value="+'"'+document.getElementById("new_item_text").value+'"', "editItem.php",
			function (type, id, responseText)
			{
				console.log(responseText);
				if (responseText)
				{
					document.getElementById('a_'+type+"_"+id).innerHTML = document.getElementById("new_item_text").value;
					document.getElementById("edit_item_div").parentNode.removeChild(document.getElementById("edit_item_div"));
				}
			}, type, id)
		};
	}
	
	document.getElementById('setting2').onclick = function ()
	{
		callPHP("type="+type+"&id="+id+"&column=visible"+"&value=2", "editItem.php",
		function (type, id, responseText)
		{
			if (responseText)
			{
				document.getElementById("item_"+type+"_"+id).parentNode.removeChild(document.getElementById("item_"+type+"_"+id));
			}
		}, type, id)
	};
}
					
function callPHP(params, target, func, type, id)
{
	console.log(params+"...."+target+"......"+func+"......"+type+"......"+id+"....."+isLogged());
    var httpc = new XMLHttpRequest();
    var url = "/" + target;
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    httpc.setRequestHeader("Content-Length", params.length);
    httpc.onreadystatechange = function() 
		{
			if(httpc.readyState == 4 && httpc.status == 200)
			{
				console.log(httpc.responseText.trim());
				func(type, id, httpc.responseText.trim());
			}
		}
	httpc.send(params);  
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
						
						'<div class="dropdown">' +
							'<a data-toggle="dropdown" class="btn btn-primary dropdown-toggle" onclick="settings(\'Forum\','+forum.forum_id+')"> <i class="fa fa-gear" aria-hidden="true"></i> </a>' +
							'<ul id="dropdown_ul_Forum_' + forum.forum_id + '" class="dropdown-menu">' +
							'</ul>' +
						'</div>' +
						
						'<a class="button_setting" onclick="setting(\'Forum\','+forum.forum_id+')"> <i class="fa fa-gear pl10" aria-hidden="true"></i> </a>' +
						'<i class="fa fa-exclamation" aria-hidden="true"></i>' +
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
							'<a id="a_Topic_' + topic.topic_id + '" data-toggle="collapse" data-parent="#level2" onclick="getItems(\'Comment\','+topic.topic_id+')" href="' + "#" + levelId + '">' + topic.topic_name + '<i class="fa fa-' + symbolDict[topic.topic_lock] + '" aria-hidden="true"></i>' + '</a>' +
						'</h4>' +
						
						'<div class="dropdown">' +
							'<a data-toggle="dropdown" class="btn btn-primary dropdown-toggle" onclick="settings(\'Topic\','+topic.topic_id+')"> <i class="fa fa-gear" aria-hidden="true"></i> </a>' +
							'<ul id="dropdown_ul_Topic_' + topic.topic_id + '" class="dropdown-menu">' +
							'</ul>' +
						'</div>' +
						
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
							'<h4 class="media-heading">' + comment.user_name + '<small><i>  Posted on ' + comment.time + '</i></small></h4>' +
							'<p id="a_Comment_' + comment.comment_id + '">' + comment.text + '</p>' +
							
						'</div>' +
						
					'</div>' +
					
					'<div class="dropdown">' +
						'<a data-toggle="dropdown" class="btn btn-primary dropdown-toggle" onclick="settings(\'Comment\','+comment.comment_id+')"> <i class="fa fa-gear" aria-hidden="true"></i> </a>' +
						'<ul id="dropdown_ul_Comment_' + comment.comment_id + '" class="dropdown-menu">' +
						'</ul>' +
					'</div>' +
				'</div>';
	}
};

var onAddItemClickDict = {	
	"Forum": function(id)
	{
		callPHP("type=forum" + "&name=" + document.getElementById('theme_name').value,
				"addNewItem.php", function(type, id, responseText)
				{
					var newForumView = showItems(type, JSON.parse(responseText));
					var div = document.createElement('div');
					div.innerHTML = newForumView;
					document.getElementById("level0").insertBefore(div.firstChild, document.getElementById("new_forum_div"));
					document.getElementById("add_forum_div").style.display = "none";
				}, 'Forum', id
		);
	},
	"Topic": function(id)
	{
		callPHP("type=topic" + "&forum=" + id
			+ "&name=" + document.getElementById('topic_tema').value
			+ "&user=" + document.getElementById('topic_mail').value
			+ "&desc=" + document.getElementById('topic_desc').value,
			"addNewItem.php", function(type, id, responseText)
			{
				var newTopicView = showItems(type, JSON.parse(responseText));
				var div = document.createElement('div');
				div.innerHTML = newTopicView;
				document.getElementById("panel_0_" + id).insertBefore(div.firstChild, document.getElementById("new_topic_div"));
				document.getElementById("add_topic_div").style.display = "none";
			}, "Topic", id	
		);
	},
	"Comment": function(id)
	{
		callPHP("type=comment" + "&topic=" + id
			+ "&user=" + document.getElementById('reply_mail').value
			+ "&desc=" + document.getElementById('reply_desc').value,
			"addNewItem.php", function(type, id, responseText)
			{
				var newCommentView = showItems(type, JSON.parse(responseText));
				var div = document.createElement('div');
				div.innerHTML = newCommentView;
				document.getElementById("panel_2_" + id).insertBefore(div.firstChild, document.getElementById("new_reply_div"));
				document.getElementById("add_reply_div").style.display = "none";
				
			}, "Comment", id
		);
	}
};

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
		document.getElementById("panel_0_" + id).innerHTML = showItems(type, JSON.parse(responseText)) + addTopicButton + addTopicForm;
		document.getElementById("new_topic_div").style.display = "block";
		if (forumsAccess[id] > 0 && !isLogged())
		{
			document.getElementById("new_topic_div").style.display = "none";
		}
	},
	"Comment": function(type, id, responseText)
	{
		document.getElementById("panel_2_" + id).innerHTML = showItems(type, JSON.parse(responseText)) + addCommentButton + addCommentForm;
	}
};

function getItems(type, id)
{
	callPHP("id=" + id, "get" + type + "s.php",
		function (type, id, responseText)
		{
			setItemsToHTMLDict[type](type, id, responseText);
			document.getElementById(submitItemTypeDict[type]).onclick = function () {onAddItemClickDict[type](id);};
		}, type, id
	);
}

function showItems(type, response)
{
	result = "";
	console.log(response);
	for (var i in response)
	{
		result += createItemViewDict[type](response[i]);
	}
	return result;
}

</script>

<article id="forum">
	<div class="container article under_nav blog">
		<div class="row">
			<div class="col-md-12 text-center pb35 nadpis">
				<h1>Lorem ipsum dolor sit amet.</h1>
				<h4>Lorem ipsum dolor sit amet.</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="filter">
					<select class="form-control" id="sel1">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select>
				</div>
				<div class="search">
					<button  type="button" onclick="$('.search_ext').toggle();">Search</button>
				</div>
			</div>
		</div>
		<div class="row search_ex">
			<div class="col-md-12">
				<div class="search_ext">
					<input class="" type="text"  name="Search" placeholder="search">
					<div class="checkbox">
						<label><input type="checkbox" value="">Option 1</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="">Option 1</label>
					</div>
					<button  type="button" onclick="ResultSearch();$('.search_ext').toggle();">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 pt20">
				<div class="panel-group" id="level0">

				</div>
			</div>
		</div>
	</div>
	<a id="chevron-blog" onclick="ArrowLeftChangePage();" class="chevron chevron_right text-center"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
	<a onclick="ArrowRightChangePage();" class="chevron chevron_left text-center"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
</article>
<script>
getItems("Forum", "");
</script>
										