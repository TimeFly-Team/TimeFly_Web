
<?php
function generateModerator($moderator)
{
	$id = $moderator['user_id'];
	echo '
	<div class="col-md-4 cols">
		<div class="person">
			<img src="media/img/portret.jpg" alt="clen_tymu">
			<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_moderator_'.$id.'" aria-expanded="false" aria-controls="collapse_moderator_'.$id.'" onclick="ShowLabel(\'#label_'.$id.'\',\'#collapse_moderator_'.$id.'\');">
				<div class="info text-center">
				<h1>'.$moderator['name'].'</h1>
				</div>
				<p class="inf" id="label_'.$id.'">+ More information</p>
			</a>
			<div id="collapse_moderator_'.$id.'" class="collapse" role="tabpanel" aria-expanded="false">
				<div id="moderator_'.$id.'" class="card-block contact">
					<p>Tel: '.$moderator['property1'].'</p>
					<p>Email: '.$moderator['property2'].'</p>
					<p>Twiter: '.$moderator['property3'].'</p>
					<button class="button button_kontakt" type="button" onclick="ContactToogle(\'#message_'.$id.'\',\'#moderator_'.$id.'\');">Contact</button>
				</div>
				<div id="message_'.$id.'" class="message" >
					<form class="send_message">
						<p>Your mail:</p>
						<input id="add_question_mail_'.$id.'" class="mail" type="email"  name="yourmail" value=""><br>
						<p>Question name:</p>
						<input id="add_question_topic_name_'.$id.'" class="tema" type="text" name="tema" value=""><br>
						<p>Description:</p>
						<textarea id="add_question_desc_'.$id.'" name="question" rows="4"></textarea>
						<button class="button button_form" type="button" onclick="ContactToogle(\'#moderator_'.$id.'\',\'#message_'.$id.'\');">Cancel</button>
						<button id="add_question_submit_'.$id.'" class="button button_form" type="button" onclick="">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>';
}
?>

<article id="tim">
	<div class="container article under_nav team">
		<div class="row">
			<div class="col-md-12 text-center pb35 nadpis">
				<h1>TimeFly team</h1>
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