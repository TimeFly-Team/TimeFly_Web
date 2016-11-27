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

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#level0" href="#c01">Collapsible Group 1</a>
							</h4>
						</div>
						<div id="c01" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="panel-group" id="level1">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#level1" href="#collapse1">Collapsible Group 1<i class="fa fa-exclamation" aria-hidden="true"></i></a>
											</h4>
										</div>
										<div id="collapse1" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="media">
													<div class="media-body">
														<h4 class="media-heading">John Doe <small><i>Posted on February 19, 2016</i></small></h4>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>


														<div class="media">
															<div class="media-body">
																<h4 class="media-heading">John Doe <small><i>Posted on February 20, 2016</i></small></h4>
																<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
															</div>
														</div>


														<div class="media">
															<div class="media-body">
																<h4 class="media-heading">Jane Doe <small><i>Posted on February 20, 2016</i></small></h4>
																<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
															</div>
														</div>
													</div>
												</div>
											</div>
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
															<input class="mail" type="email"  name="yourmail" value="">
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="description_problem">
																<p>Opis problemu:</p>
																<textarea name="question" rows="4"></textarea>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="tlacidla">
																<button type="button" onclick="$('.add_reply').hide();">Cancel</button>
																<input type="submit" value="Submit">
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#level1" href="#collapse2">Collapsible Group 2<i class="fa fa-exclamation" aria-hidden="true"></i></a>
											</h4>
										</div>
										<div id="collapse2" class="panel-collapse collapse">
											<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
												sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
												quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#level1" href="#collapse3">Collapsible Group 3<i class="fa fa-check" aria-hidden="true"></i></a>
											</h4>
										</div>
										<div id="collapse3" class="panel-collapse collapse">
											<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
												sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
												quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
											</div>
										</div>
									</div>
									<div class="new_topic">
										<button  type="button" onclick="$('.add_topic').show();"><i class="fa fa-plus-square" aria-hidden="true"></i>
											Add</button>
									</div>
									<div class="add_topic" >
										<form class="send_topic">
											<div class="row">
												<div class="col-md-3">
													<p>Your email:</p>
													<input class="mail" type="email"  name="yourmail" value="">
												</div>
												<div class="col-md-9">
													<p>Nazov temy:</p>
													<input class="tema" type="text" name="tema" value="">
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="description_problem">
														<p>Opis problemu:</p>
														<textarea name="question" rows="4"></textarea>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="tlacidla">
														<button type="button" onclick="$('.add_topic').hide();">Cancel</button>
														<input type="submit" value="Submit">
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#level0" href="#c02">Collapsible Group 2</a>
							</h4>
						</div>
						<div id="c02" class="panel-collapse collapse">
							<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
								sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#level0" href="#c03">Collapsible Group 3</a>
							</h4>
						</div>
						<div id="c03" class="panel-collapse collapse">
							<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
								sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
							</div>
						</div>
					</div>
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
									<input class="tema" type="text" name="tema" value="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="tlacidla">
										<button type="button" onclick="$('.add_theme').hide();">Cancel</button>
										<input type="submit" value="Submit">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="team.html" class="chevron chevron_right text-center"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
	<a href="index.html" class="chevron chevron_left text-center"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
</article>