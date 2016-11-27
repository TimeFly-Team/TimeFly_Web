<script>

//var button = document.getElementById("level0").innerHTML;

function callPHP(params) {
	console.log(params);
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
				$(view).insertBefore(".new_topic");
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
	var levelId = "level" + forum.forum_id;
	var panelId = "#panel" + forum.forum_id; 
	var view =  '<div class="panel panel-default">' +
					'<div class="panel-heading">' +
						'<h4 class="panel-title">' +
							'<a data-toggle="collapse" data-parent="#level0" href="' + "#" + levelId + '">' + forum.forum_name + '</a>' +
						'</h4>' +
					'</div>' +
					'<div id="' + levelId + '" class="panel-collapse collapse">' +
						'<div id="' + panelId + '" class="panel-body">' +
						'</div>	' +
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

					<div class="new_topic">
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

				</div>
			</div>
		</div>
	</div>
	<a id="chevron-blog" onclick="ArrowLeftChangePage();" class="chevron chevron_right text-center"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
	<a id="chevron-blog" onclick="ArrowRightChangePage();" class="chevron chevron_left text-center"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
</article>

										