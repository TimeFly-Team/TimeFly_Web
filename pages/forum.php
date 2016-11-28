<script>

//var button = document.getElementById("level0").innerHTML;

function callPHP(params) {
    var httpc = new XMLHttpRequest(); // simplified for clarity
    var url = "/TimeFly_Web/addNewItem.php";
    httpc.open("POST", url, true); // sending as POST

    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    httpc.setRequestHeader("Content-Length", params.length); // POST request MUST have a Content-Length header (as per HTTP/1.1)
    httpc.onreadystatechange = function() { //Call a function when the state changes.
    if(httpc.readyState == 4 && httpc.status == 200) { // complete and no errors
        	return httpc.responseText; // some processing here, or whatever you want to do with the response
        }
    }
    httpc.send(params);
}

function getForums(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        	var button = document.getElementById("level0").innerHTML;
        	//document.getElementById("level0").innerHTML = "";
            document.getElementById("level0").innerHTML = showForums(JSON.parse(this.responseText)) + button;
			document.getElementById('theme_submit').onclick = function ()
			{
				var x = callPHP("type=forum" + "&name=" + document.getElementById('theme_name').value);
				var view = createForumView({forum_id: x, forum_name: document.getElementById('theme_name').value});
				$(view).insertBefore(".new_forum");
				$(".add_theme").hide();
			}
            //document.getElementById("level0").innerHTML = button;
        }
    };
    xmlhttp.open("GET", "/TimeFly_Web/getForums.php", true);
    xmlhttp.send();
}

function showForums(response){
	result = "";
	for(var i in response){
		result += createForumView(response[i]);
	}
	return result;
}

function createForumView(forum){
	console.log(forum.forum_id);
	var levelId = "xxx" + forum.forum_id;
	var panelId = "panel" + forum.forum_id; 
	var view =  '<div class="panel panel-default">' +
					'<div class="panel-heading">' +
						'<h4 class="panel-title">' +
							'<a data-toggle="collapse" data-parent="#level0" onclick="getTopics('+forum.forum_id+')" href="' + "#" + levelId + '">' + forum.forum_name + '</a>' +
						'</h4>' +
					'</div>' +
					'<div id="' + levelId + '" class="panel-collapse collapse">' +
						'<div id="' + panelId + '" class="panel-body">' +
						'</div>	' +
					'</div>' +
				'</div>';

	return view;
}

function getTopics(id){
	var httpc = new XMLHttpRequest(); // simplified for clarity
    var url = "/TimeFly_Web/getTopics.php";
    httpc.open("POST", url, true); // sending as POST

    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    httpc.setRequestHeader("Content-Length", id.length); // POST request MUST have a Content-Length header (as per HTTP/1.1)
    httpc.onreadystatechange = function() { //Call a function when the state changes.
    if(httpc.readyState == 4 && httpc.status == 200) { // complete and no errors
        	console.log(httpc.responseText);
			
            //document.getElementById("level1").innerHTML = showTopics(JSON.parse(this.responseText)) + button;
			$('#panel'+id).empty();
			$('#panel'+id).append(showTopics(JSON.parse(httpc.responseText),button));
			
			//console.log(showTopics(JSON.parse(this.responseText)));
			
			document.getElementById('topic_submit').onclick = function ()
			{
				var y = callPHP("type=topic" + "&forum=" + id
 								+ "&name=" + document.getElementById('topic_tema').value
 								+ "&user=" + document.getElementById('topic_mail').value
 								+ "&desc=" + document.getElementById('topic_desc').value);
				var viewt = createTopicView({topic_id: y, topic_name: document.getElementById('topic_tema').value});
				$(viewt).insertBefore(".new_topic");
				$(".add_topic").hide();
			}
        }
    }
    httpc.send("id="+id);
}

function showTopics(response,button){
	result = '<div class="panel-group" id="level2">';
	for(var i in response){
		result += createTopicView(response[i]);
	}
	result += button;
	result += '</div>';
	return result;
}

function createTopicView(topic){
	var levelId = "yyy" + topic.topic_id;
	var panelId = "panel2_" + topic.topic_id; 
	var view =  '<div class="panel panel-default">' +
					'<div class="panel-heading">' +
						'<h4 class="panel-title">' +
							'<a data-toggle="collapse" data-parent="#level2" onclick="getComments('+topic.topic_id+')" href="' + "#" + levelId + '">' + topic.topic_name + '</a>' +
						'</h4>' +
					'</div>' +
					'<div id="' + levelId + '" class="panel-collapse collapse">' +
						'<div id="' + panelId + '" class="panel-body">' +
						'</div>	' +
					'</div>' +
				'</div>';
	return view;
}

//--------------------------------------
function getComments(id){
	console.log("dfnmjdfnjgkdflv");
	var httpc = new XMLHttpRequest(); // simplified for clarity
    var url = "/TimeFly_Web/getComments.php";
    httpc.open("POST", url, true); // sending as POST

    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    httpc.setRequestHeader("Content-Length", id.length); // POST request MUST have a Content-Length header (as per HTTP/1.1)
    httpc.onreadystatechange = function() { //Call a function when the state changes.
    if(httpc.readyState == 4 && httpc.status == 200) { // complete and no errors
        	
            $('#panel2_'+id).empty();
			$('#panel2_'+id).append(showComments(JSON.parse(httpc.responseText)));
			$('#panel2_'+id).append(button2);
			
			//console.log($('#panel2_'+id).innerHTML);
			
			document.getElementById('reply_submit').onclick = function ()
			{
				var y = callPHP("type=comment" + "&topic=" + id
 								+ "&user=" + document.getElementById('reply_mail').value
								+ "&desc=" + document.getElementById('reply_desc').value);
				var viewt = createTopicView({topic_id: y, topic_name: document.getElementById('topic_tema').value});
				$(viewt).insertBefore(".new_topic");
				$(".add_reply").hide();
			}
        }
    }
    httpc.send("id="+id);
}

function showComments(response){
	var result = "";
	for(var i in response){
		result += createCommentView(response[i]);
	}
	return result;
}

function createCommentView(comment){
	var levelId = "zzz" + comment.comment_id;
	var panelId = "#panel3_" + comment.comment_id; 
	var view =  '<div class="media">' +
					'<div class="media-body">' +
						'<h4 class="media-heading">' + comment.user_name + '<small><i>Posted on ' + comment.time + '</i></small></h4>' +
						'<p>' + comment.text + '</p>' +
					'</div>' +
				'</div>';
	return view;
}


getForums();

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

					<div class="panel-group" id="level1">
					
						<div class="new_topic">
							<button  type="button" onclick="$('.add_topic').show();"><i class="fa fa-plus-square" aria-hidden="true"></i>
								Add</button>
						</div>
						<div class="add_topic" >
							<form class="send_topic">
								<div class="row">
									<div class="col-md-3">
										<p>Your email:</p>
										<input id="topic_mail" class="mail" type="email"  name="yourmail" value="">
									</div>
									<div class="col-md-9">
										<p>Nazov temy:</p>
										<input id="topic_tema" class="tema" type="text" name="tema" value="">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="description_problem">
											<p>Opis problemu:</p>
											<textarea id="topic_desc" name="question" rows="4"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="tlacidla">
											<button type="button" onclick="$('.add_topic').hide();">Cancel</button>
											<button id="topic_submit" type="button" onclick="">Submit</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					
					</div>
				
					<div class="new_forum">
						<button  type="button" onclick="$('.add_theme').show();">
							<i class="add fa fa-plus-square" aria-hidden="true"></i>
						Add</button>
					</div>
					<div class="add_theme" >
						<form class="send_theme">
							<div class="row">
								<div class="col-md-12">
									<p>Nazov temy:</p>
									<input id="theme_name" class="tema" type="text" name="tema" value="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="tlacidla">
										<button type="button" onclick="$('.add_theme').hide();">Cancel</button>
										<button id="theme_submit" type="button" onclick="">Submit</button>

									</div>
								</div>
							</div>
						</form>
					</div>
					
					<div id="1234567">
						<div class="new_reply">
							<button  type="button" onclick="$('.add_reply').show();">
								Add reply
							</button>
						</div>
						<div class="add_reply">
							<form class="send_reply">
								<div class="row">
									<div class="col-md-3">
										<p>Your email:</p>
										<input id="reply_mail" class="mail" type="email"  name="yourmail" value="">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="description_problem">
											<p>Opis problemu:</p>
											<textarea id="reply_desc" name="question" rows="4"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="tlacidla">
											<button type="button" onclick="$('.add_reply').hide();">Cancel</button>
											<button id="reply_submit" type="button" onclick="">Submin</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<a id="chevron-blog" onclick="ArrowLeftChangePage();" class="chevron chevron_right text-center"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
	<a onclick="ArrowRightChangePage();" class="chevron chevron_left text-center"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
</article>
<script>
var button = document.getElementById("level1").innerHTML;
document.getElementById("level0").removeChild(document.getElementById("level1"));

var button2 = document.getElementById("1234567").innerHTML;
document.getElementById("level0").removeChild(document.getElementById("1234567"));

</script>
										