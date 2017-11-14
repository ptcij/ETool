<div>
    <?php $st = new State($election->getStateId()); ?> 
    <div class="row">
	<div class="col-lg-3 col-sm-6">
	    <div class="card card-pricing" data-background="color" data-color="blue">
		<div class="card-body">
		    <h6 class="card-category">Registered Voters</h6>
		    <h2 class="card-title">
			<?php echo number_format($election->getRegVoters()); ?>
		    </h2>
		</div>
		<div class="card-footer">
		    <hr />
		    <div class="stats">
			<i class="ti-reload"></i> <?php echo $util->time_elapsed_string($election->getDateAdded()); ?>
		    </div>
		</div>
	    </div>
	</div>


	<div class="col-lg-3 col-sm-6">
	    <div class="card card-pricing" data-background="color" data-color="blue">
		<div class="card-body">
		    <h6 class="card-category">Accredited Voters</h6>
		    <h2 class="card-title">
			<?php echo number_format($election->getAcrVoters()); ?>
		    </h2>
		</div>
		<div class="card-footer">
		    <hr />
		    <div class="stats">
			<i class="ti-reload"></i> <?php echo $util->time_elapsed_string($election->getDateAdded()); ?>
		    </div>
		</div>
	    </div>
	</div>


	<div class="col-lg-3 col-sm-6">
	    <div class="card card-pricing" data-background="color" data-color="blue">
		<div class="card-body">
		    <h6 class="card-category">Votes Cast</h6>
		    <h2 class="card-title">
			<?php echo number_format($election->getVotesCast()); ?>
		    </h2>
		</div>
		<div class="card-footer">
		    <hr />
		    <div class="stats">
			<i class="ti-reload"></i> <?php echo $util->time_elapsed_string($election->getDateAdded()); ?>
		    </div>
		</div>
	    </div>
	</div>


	<div class="col-lg-3 col-sm-6">
	    <div class="card card-pricing" data-background="color" data-color="blue">
		<div class="card-body">
		    <h6 class="card-category">Valid Votes</h6>
		    <h2 class="card-title">
			<?php echo number_format($election->getValidVotes()); ?>
		    </h2>
		</div>
		<div class="card-footer">
		    <hr />
		    <div class="stats">
			<i class="ti-reload"></i> <?php echo $util->time_elapsed_string($election->getDateAdded()); ?>
		    </div>
		</div>
	    </div>
	</div>


	<div class="col-lg-3 col-sm-6">
	    <div class="card card-pricing" data-background="color" data-color="blue">
		<div class="card-body">
		    <h6 class="card-category">Rejected Votes</h6>
		    <h1 class="card-title">
			<?php echo number_format($election->getRejVotes()); ?>
		    </h1>
		</div>
		<div class="card-footer">
		    <hr />
		    <div class="stats">
			<i class="ti-reload"></i> <?php echo $util->time_elapsed_string($election->getDateAdded()); ?>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>
<div>
    <h3 class="title">Results</h3>
    <table id="bootstrap-table" class="table">
	<thead>
	    <!--<th data-field="state" data-checkbox="true"></th>-->
	    <th data-field="id" data-sortable="true" class="text-center">ID</th>
	    <th data-field="party">Party</th>
	    <th data-field="aspirant">Aspirant</th>
	    <th data-field="deputy">Deputy</th>
	    <th rel="tooltip" 
		title="From <?php echo $election->getResultsCountLG(); ?> result(s) out of <?php echo $st->getLocalGCount(); ?> Local Governments">
		Votes <small>(LG Level)</small>
	    </th>
	    <th rel="tooltip" 
		title="From <?php echo $election->getResultsCountRA(); ?> result(s) out of <?php echo $st->getRACount(); ?> Registration Area">
		Votes <small>(RA Level)</small>
	    </th>
	    <th rel="tooltip" 
		title="From <?php echo $election->getResultsCountPU(); ?> result(s) out of <?php echo $st->getPUCount(); ?> Polling Units">
		Votes <small>(PU Level)</small>
	    </th>
	</thead>
	<tbody>
	    <?php
		$count = 1;
		for($i = 0; $i < count($candidates); $i++) {
		    $candidate = $candidates[$i];
		    $party = new PoliticalParty($candidate["partyId"]);
	    ?>
	    <tr>
		<td class="text-center"><?php echo $count; ?></td>
		<td><?php echo $party->getInitials(); ?></td>
		<td><?php echo $candidate["aspirant"]; ?></td>
		<td><?php echo $candidate["deputy"]; ?></td>
		<td><?php echo number_format($election->getTotalVotesLG($candidate["partyId"])); ?></td>
		<td><?php echo number_format($election->getTotalVotesRA($candidate["partyId"])); ?></td>
		<td><?php echo number_format($election->getTotalVotesPU($candidate["partyId"])); ?></td>
	    </tr>
	    <?php $count++; } ?>
	</tbody>
    </table>
</div>
<div>
    <h3 class="title">According To Local Governments</h3>
    <div class="row">
	<?php
	    $lgs = $st->getLocalGovs();
	    for($i = 0; $i < count($lgs); $i++) {
		$lg = $lgs[$i];
	?>
	<div class="col-md-3" style="margin-bottom: 16px;">
	    <button data-toggle="modal" data-target="#localg-<?php echo $lg["id"]; ?>" 
		    type="button" class="btn btn-danger btn-round">
		<?php echo $lg["name"]; ?>
	    </button>
	</div>
	<?php } ?>
    </div>
</div>

<?php
    for($i = 0; $i < count($lgs); $i++) {
	$lg = $lgs[$i];
?>
<!-- Modal For Adding ElectionL -->
<div class="modal fade" id="localg-<?php echo $lg["id"]; ?>" role='dialog'>
    <div class="modal-dialog animated modal-lg">
	<div class="modal-content">
	    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title"><?php echo $lg["name"]; ?></h4>
	    </div>
	    <div class="modal-body">  
		<table id="bootstrap-table" class="table">
		    <thead>
			<!--<th data-field="state" data-checkbox="true"></th>-->
			<th data-field="lg-id" data-sortable="true" class="text-center">ID</th>
			<th data-field="lg-party">Party</th>
			<th data-field="lg-aspirant">Aspirant</th>
			<th data-field="lg-deputy">Deputy</th>
			<th data-field="lg-votes">Votes</th>
		    </thead>
		    <tbody>
			<?php
			    $count = 1;
			    for($j = 0; $j < count($candidates); $j++) {
				$candidate = $candidates[$j];
				$party = new PoliticalParty($candidate["partyId"]);
			?>
			<tr>
			    <td class="text-center"><?php echo $count; ?></td>
			    <td><?php echo $party->getInitials(); ?></td>
			    <td><?php echo $candidate["aspirant"]; ?></td>
			    <td><?php echo $candidate["deputy"]; ?></td>
			    <td>
				<?php 
				    $value = $election->getPartyVotesLG($candidate["partyId"],$lg["id"]);
				    $value1 = number_format($value) != NULL ? number_format($value) : $value; 
				    echo $value1;
				?>
			    </td>
			</tr>
			<?php $count++; } ?>
		    </tbody>
		</table>
		<hr />
		<div>
		    <h4 class="title">Registration Areas</h4>
		    <div class="row">
			<?php
			    $localg = new LocalGov($lg["id"]);
			    $RAs = $localg->getRAs();
			    for($m = 0; $m < count($RAs); $m++) {
				$RA = $RAs[$m];
			?>
			<div class="col-md-3">
			    <button data-toggle="modal" data-target="" 
				    type="button" class="btn btn-danger btn-round" style="margin-bottom:16px;">
				<?php echo $RA["name"]; ?>
			    </button>
			</div>
			<?php } ?>
		    </div>
		</div>
	    </div> 
	</div>
    </div>
</div>
<?php } ?>

<!-- Modal For Adding ElectionL -->
<div class="modal fade" id="addResult" role='dialog'>
    <div class="modal-dialog animated">
	<div class="modal-content">
	    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Update Result</h4>
	    </div>
	    <div class="modal-body">  
		<form>
		    <div class="form-group">
			<label>Select Party</label>
			<select class="form-control" id="party-result">
			    <option>Select</option>
			    <?php 
				$parties = PoliticalParty::getParties($db->getConnectionID());
				
				for($i = 0; $i < count($parties); $i++) {
				    $party = $parties[$i];
			    ?>
			    <option value="<?php echo $party["id"] ?>">
				<?php echo "[".$party["initials"]."] ".$party["name"]; ?>
			    </option>
			    <?php } ?>
			</select>
		    </div>
		    <div class="form-group">
			<label>Select Localgovernment</label>
			<select class="form-control" id="localg">
			    <option>Select</option>
			    <?php 
				$sttId = $election->getStateId();
				$state = new State($sttId);
				$localGovmnts = $state->getLocalGovernments();
				
				for($i = 0; $i < count($localGovmnts); $i++) {
				    $localGovmnt = $localGovmnts[$i];
			    ?>
			    <option value="<?php echo $localGovmnt["id"] ?>">
				<?php echo $localGovmnt["name"]; ?>
			    </option>
			    <?php } ?>
			</select>
		    </div>
		    
		    <div class="form-group">
			<label>Registered Voters</label>
			<input type="text" id="regVoters" class="form-control" placeholder="Registered Voters..." />
		    </div>
		    
		    <div class="form-group">
			<label>Accredited Voters</label>
			<input type="text" id="acrVoters" class="form-control" placeholder="Accredited Voters..." />
		    </div>
		    
		    <div class="form-group">
			<label>Votes Cast</label>
			<input type="text" id="votesCast" class="form-control" placeholder="Votes Cast..." />
		    </div>
		    
		    <div class="form-group">
			<label>Valid Votes</label>
			<input type="text" id="validVotes" class="form-control" placeholder="Valid Votes..." />
		    </div>
		    
		    <div class="form-group">
			<label>Rejected Votes</label>
			<input type="text" id="rejVotes" class="form-control" placeholder="Rejected Votes..." />
		    </div>

		    <div class="form-group">
			<button id="addResultBtn" type="button" class="btn btn-round">
			    <i class="fa fa-plus-square"></i>
			    Add
			</button>
		    </div>
		</form>
	    </div>
	    <div class="modal-footer">

	    </div>        
	</div>
    </div>
</div>