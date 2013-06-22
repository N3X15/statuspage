
	<div class="wrapper">
		<div id="content">
			<?foreach($this->facilities  as $facility):?>
			<div class="datacenter">
				<div class="dchead">
					<h3><?=$facility['friendly_name']?></h3>
					<a href="https://twitter.com/<?=$this->twitter_handle?>" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @<?=$this->twitter_handle?></a>
				</div>

				<table class="services">
					<tr><?foreach($facility['services'] as $service):?>
						<td><span id="changeservice-<?=$service['id']?>"><img src="images/ico_<?=$service['status']?>_large.gif" alt="<?=$service['status']?>}" /></span> <?=$service['friendly_name']?></td><?endforeach?>
					</tr>
				</table>

				<table class="perday">
					<tr>
						<?foreach($facility['summary'] as $day=>$status):?><th><?=$day?></th><?endforeach;?>
					</tr>
					<tr>
						<?foreach($facility['summary'] as $day=>$status):?><td><img src="images/ico_<?=$status?>_small.gif" alt="<?=$status?>" /></td><?endforeach;?>
					</tr>
				</table>

				<div class="rightstuff">
					<div class="uhHuh">
						<div class="title">Scheduled Maintenance</div>
						<?if(count($facility['scheduled']) > 0):?>
						<ul class="maintschedule">
							<?foreach($facility['scheduled'] as $date => $events):?><li><?=$date?>
								<ul>
									<?foreach($events as $event):?><li>
										<span class="time"><?=strftime('%I:%M %p %Z',$event['timeopened'])?></span>
										<?=(strlen($event['title'])>26) ? substr($event['title'],0,26).'...' : $event['title'] ?><?if($event['maintenancedesc']):?>
										<span class="readmore"><a href="#" id="readmore-<?=$event['id']?>">Read More</a></span><?endif;?>
									<?endforeach;?></li>
								</ul>
							</li>
							<?endforeach;?>
						<?else:?>
						<p>There is no maintenance scheduled at this time.</p><?endif;?>
					</div>
					<?if(isset($textarea)):?>
					<div class="uhHuh">
						<div class="title"><?=$textarea['heading']?></div>
						<p><?$textarea['text']?></p>
					</div>
					<?endif;?>
				</div>

				<div class="log">


					<?foreach($facility['incidents'] as $day => $incidents):?>
					<h4><?=$day?></h4>
					
					<?if(count($incidents)>0):foreach($incidents as $incident):?>
					<div class="incident severity-<?=$incident['severity']?>">
						<div class="incidentheader">
							<span id="changeseverity-<?=$incident['id']?>"><img src="images/ico_<?=$incident['severity']?>_small.gif" alt="<?=$incident['severity']?>" /></span>
							<span class="title" id="changetitle-<?=$incident['id']?>"><?=$incident['title']?></span>
							<div class="status"><strong>Status:</strong> <span id="changestatus-<?=$incident['id']?>"><?=$incident['status']?></span></div>
						</div>
						
						<div class="updates">
							<?if(count($incident['updates']) > 0):?><?foreach($incident['updates'] as $update):?>
							<div class="update">
								<span class="timestamp"><?=strftime('%I:%M %p %Z',$update['timeadded'])?></span>
								<span class="message"><?=$update['message']?></span>
							</div>
							<?endforeach;?><?endif;?>
							<?if(Authentication::amLoggedIn()):?><p>
								<form action="" method="post" class="microupdate">
									<input type="text" name="update" class="updatebox" id="updateto<?=$incident['id']?>" />
									<p class="posttotwitter">
										<input type="checkbox" name="twitter" class="micrototwitter" checked="CHECKED" /> Post to Twitter
									</p>
									<input type="hidden" name="incidentid" value="<?=$incident['id']?>">
							</form>
							<?endif;?>
						</div>
					</div>
					<?endforeach;?>
					<?else:?>
						<p>No recent incidents were found.</p>
					<?endif;?>
					<?endforeach;?>
				</div>
			</div>
			<?endforeach;?>
		</div>
	</div>

<?if(Authentication::amLoggedIn()):?>
	<div id="addincident" class="ui-widget">
		<form action="" method="post" id="addincidentform">
		<fieldset>
				<label for="facilities_id">Facility:</label>
				<select name="facilities_id" id="ni_facilities_id">
					<?foreach($this->facilities as $facility):?><option value="<?=$facility['id']?>"><?=$facility['friendly_name']?></option><?endforeach;?>
				</select>
				<label for="timeopened">Date/Time of Incident:</label>
				<input type="text" name="timeopened" id="timeopened" value="<?=strftime("%m/%d/%Y %I:%M %p")?>" />
				<label for="title">Short Title:</label>
				<input type="text" name="title" id="title" />
				<div id="maintfields">
					<label for="maintenancedesc">Full Description of Maintenance:</label>
					<textarea id="maintenancedesc" name="maintenancedesc"></textarea>
				</div>
				<label for="severity">Severity:</label>
				<select name="severity" id="severity">
					<option>warning</option>
					<option>offline</option>
				</select>
				<label for="status">Status:</label>
				<select name="status" id="status">
					<option>Investigating</option>
					<option>Implementing Fix</option>
					<option>Resolved</option>
				</select>
				<div id="hidemaintenance">
					<label for="initialupdate">Initial Update:</label>
					<input type="text" name="update" id="initialupdate" />
				</div>
				<label for="incidenttwitter">Send to Twitter:</label>
				<input type="checkbox" name="twitter" id="incidenttwitter" checked="CHECKED" />
		</fieldset>
		</form>
	</div>



<?foreach($this->facilities as $facility):
	foreach($facility['incidents'] as $day => $incidents):
		foreach($incidents as $incident):?>
	<script type="text/javascript">
	$("#changestatus-<?=$incident['id']?>").editable('save.php', {
		data	: " {'Investigating':'Investigating','Implementing Fix':'Implementing Fix','Resolved':'Resolved', 'selected':'<?=$incident['status']?>'}",
		type	: 'select',
		submit	: 'OK',
		style	: 'display:inline' });
	$("#changeseverity-<?=$incident['id']?>").editable('save.php', {
		data	: " {'warning':'Warning','offline':'Offline', 'selected':'<?=$incident['severity']?>'}",
		type	: 'select',
		submit	: 'OK',
		style	: 'display:inline' });
	$("#changetitle-<?=$incident['id']?>").editable('save.php', { width: 250, style: 'display:inline' });
	</script>

	<div id="editincident<?=$incident['id']?>" class="edit-incident">
		<form action="" method="post">
			
		</form>
	</div>
	<?
		endforeach;
	endforeach;?>
<?	foreach($facility['services'] as $day => $service):
		$severity='';
		if(array_key_exists('severity', $service))
			$severity=", 'selected':'{$service['severity']}'";
?>
	<script type="text/javascript">
	$("#changeservice-<?=$service['id']?>").editable('save.php', {
		data	: " {'online':'Online','warning':'Warning','offline':'Offline'<?=$severity?>}",
		type	: 'select',
		submit	: 'OK',
		style	: 'display:inline' });
	</script>
<?	endforeach;
endforeach;?>
<?endif;?>

<div id="readmorebox"></div>
<?foreach($this->facilities as $facility):?><?if(count($facility['scheduled']) > 0):?>
	<script type="text/javascript">
		$("#readmorebox").dialog({ autoOpen: false, title: 'Maintenance Description', width: 500, height: 300 });
<?foreach($facility['scheduled'] as $day => $events):?><?foreach($events as $event):?>
		$("#readmore-<?=$event['id']?>").click(function(){
			$("#readmorebox").dialog('close');
			$("#readmorebox").html('<p><?=strftime('%m/%d/%Y %I:%M %p %Z',$event['timeopened'])?><br /><strong><?=addslashes($event['title'])?></strong></p></p><p><?=trim(addslashes(str_replace("\r",'',str_replace("\n",'',nl2br(htmlspecialchars($event['maintenancedesc']))))))?></p>');
			$("#readmorebox").dialog('open');
			return false;
		});
<?endforeach;?><?endforeach;?>
	</script>
<?endif;?>
<?endforeach;?>
