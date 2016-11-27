
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>
						<i></i>
						Powered by TimeFly - Webdeveloper Team

						<?php
						if(!$user->isLogged()){
						?>
						
							<button type="button" data-toggle="modal" data-target="#myModal">Login</button>
						
						<?php
						}else{
						?>

							<form method="post">
								<input name="logout" type="submit" id="logout" value="Log out">
							</form>
						
						<?php
						}
						?>

					</p>
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


</body>

</html>