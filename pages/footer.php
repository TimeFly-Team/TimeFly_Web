
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="foot">
						<i></i>
						Powered by TimeFly - Webdeveloper Team
						    <?php
						    if(!$moderator->isLogged()){
				    		?>

		    					<button type="button" class="login-div" data-toggle="modal" data-target="#myModal">Login</button>
						
    						<?php
    						}else{
    						?>

    							<form method="post" class="login-div">
    								<input name="logout" type="submit" id="logout" value="Log out">
							   </form>
						
						    <?php
						    }  
						    ?> 
					</div>

					<div class="modal fade login" id="myModal" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Login</h4>
								</div>
								<div class="modal-body">
									<form class="send_theme" method="post">
										<div class="row">
											<div class="col-md-12">
												<label>Name:</label>
												<input class="name" type="text" name="name" value="">
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<label>Password:</label>
												<input class="pass" type="password" name="pass" value="">
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="tlacidla">
													<input type="submit" value="Login">
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
		</div>
	</footer>

	<!-- Bootstrap core JavaScript -->
	<script src="./media/js/jquery.min.js"></script>
	<script src="./media/js/bootstrap.min.js"></script>
	<script src="./media/js/jquery.sidr.min.js"></script>
	<script src="./media/js/timefly.js"></script>
	<script src="./media/js/jquery.easing.min.js"></script>
	<script type="text/javascript" src="media/js/jquery.touchSwipe.min.js"></script>
	<script type="text/javascript">
		initialize();
		var question_formulars = document.getElementsByClassName("send_message");
		for (var i = 0 ; i < question_formulars.length ; i++)
		{
			var id = question_formulars[i].children[9].id.split("_")[3];
			setAddQuestionSubmit(id);
		}
	</script>

</body>

</html>