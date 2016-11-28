
<?php
function generateModerator($moderator)
{
	?>
	<div class="col-md-4 cols">
		<div class="person">
			<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_moderator_<?php echo $moderator['user_id'];?>" aria-expanded="false" aria-controls="collapse_moderator_<?php echo $moderator['user_id'];?>" onclick="ShowLabel('#label_<?php echo $moderator['user_id'];?>','#collapse_moderator_<?php echo $moderator['user_id'];?>');">
				<img src="media/img/portret.jpg" alt="clen_tymu">
				<div class="info text-center">
					<h1><?php echo $moderator['name'];?></h1>
				</div>
				<p class="inf" id="label_<?php echo $moderator['user_id'];?>">+ More information</p>
			</a>
			<div id="collapse_moderator_<?php echo $moderator['user_id'];?>" class="collapse" role="tabpanel" aria-expanded="false">
				<div id="moderator_<?php echo $moderator['user_id'];?>" class="card-block contact">
					<p>Tel: <?php echo $moderator['property1'];?></p>
					<p>Email: <?php echo $moderator['property2'];?></p>
					<p>Twiter: <?php echo $moderator['property3'];?></p>
					<button class="button button_kontakt" type="button" onclick="ContactToogle('#message_<?php echo $moderator['user_id'];?>','#moderator_<?php echo $moderator['user_id'];?>');">Contact</button>
				</div>
				<div id="message_<?php echo $moderator['user_id'];?>" class="message" >
					<form class="send_message">
						<p>Your mail:</p>
						<input id="add_question_mail_<?php echo $moderator['user_id'];?>" class="mail" type="email"  name="yourmail" value=""><br>
						<p>Question name:</p>
						<input id="add_question_topic_name_<?php echo $moderator['user_id'];?>" class="tema" type="text" name="tema" value=""><br>
						<p>Description:</p>
						<textarea id="add_question_desc_<?php echo $moderator['user_id'];?>" name="question" rows="4"></textarea>
						<button class="button button_form" type="button" onclick="ContactToogle('#moderator_<?php echo $moderator['user_id'];?>','#message_<?php echo $moderator['user_id'];?>');">Cancel</button>
						<button id="add_question_submit_<?php echo $moderator['user_id'];?>" class="button button_form" type="button" onclick="">Submit</button>
						<script>
							document.getElementById('add_question_submit_' + <?php echo json_encode($moderator['user_id'], JSON_HEX_TAG); ?>).onclick = function ()
							{
								
								callPHP("type=topic" + "&forum=2"
										+ "&name=" + document.getElementById('add_question_topic_name_' + <?php echo json_encode($moderator['user_id'], JSON_HEX_TAG); ?>).value
										+ "&user=" + document.getElementById('add_question_mail_' + <?php echo json_encode($moderator['user_id'], JSON_HEX_TAG); ?>).value
										+ "&desc=" + document.getElementById('add_question_desc_' + <?php echo json_encode($moderator['user_id'], JSON_HEX_TAG); ?>).value
										+ "&moderator=" + <?php echo json_encode($moderator['user_id'], JSON_HEX_TAG); ?>);
								ContactToogle('#moderator_' + <?php echo json_encode($moderator['user_id'], JSON_HEX_TAG); ?>,'#message_' + <?php echo json_encode($moderator['user_id'], JSON_HEX_TAG); ?>);
							}
						</script>
						
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>

<article id="tim">
	<div class="container article under_nav team">
		<div class="row">
			<div class="col-md-12 text-center pb35 nadpis">
				<h1>Lorem ipsum dolor sit amet.</h1>
				<h4>Lorem ipsum dolor sit amet.</h4>
			</div>
		</div>
		<div id="moderators_row" class="row">
			<?php
			$conn = db_connect();
			$moderators = getModerators($conn);
			$rows = mysqli_num_rows($moderators);
			for ($i = 0 ; $i < $rows ; $i++)
			{
				generateModerator(mysqli_fetch_array($moderators));
			}
			mysqli_close($conn);
			?>
			
		</div>
	</div>
	<a id="chevron-tim" onclick="ArrowLeftChangePage();" class="chevron chevron_right text-center"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
	<a onclick="ArrowRightChangePage();" class="chevron chevron_left text-center"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
</article>