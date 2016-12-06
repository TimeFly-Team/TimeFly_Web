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
			
				<?php
				if ($moderator->isLogged())
				{
					echo '
					<div class="filter">
						<select onchange="getItems(\'Forum\', \'\')" class="form-control" id="sel1">
							<option>All</option>
							<option>My</option>
						</select>
					</div>
					
					';
				}
				?>
				
					<div class="search">
						<button  type="button" onclick="$('.search_ext').toggle();$('.res_search').remove();">Search</button>
					</div> 
				
			</div>
		</div>
		<div class="row search_ex">
			<div class="col-md-12">
				<div class="search_ext">
					<input id="searchText" class="" type="text"  name="Search" placeholder="search">
					<div class="checkbox">
						<label><input name="searchSetting" type="radio" value="0" checked>Topic names</label>
					</div>
					<div class="checkbox">
						<label><input name="searchSetting" type="radio" value="1">Topic names and comments</label>
					</div>
					<div class="checkbox">
						<label><input name="searchSetting" type="radio" value="2">Comments</label>
					</div>
					<button type="button" onclick="ResultSearch();$('.search_ext').toggle();">
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