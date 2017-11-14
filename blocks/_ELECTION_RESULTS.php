<div>
    <?php $st = new State($election->getStateId()); ?>
    <div class="row">
	<div class="col-lg-3 col-sm-6">
	    <div class="card">
		<div class="card-content">
		    <div class="numbers">
			<p>Registered Voters</p>
			<?php echo number_format($election->getRegVoters()); ?>
		    </div>
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
	    <div class="card">
		<div class="card-content">
		    <div class="numbers">
			<p>Accredited Voters</p>
			<?php echo number_format($election->getAcrVoters()); ?>
		    </div>
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
	    <div class="card">
		<div class="card-content">
		    <div class="numbers">
			<p>Votes Cast</p>
			<?php echo number_format($election->getVotesCast()); ?>
		    </div>
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
	    <div class="card">
		<div class="card-content">
		    <div class="numbers">
			<p>Valid Votes</p>
			<?php echo number_format($election->getValidVotes()); ?>
		    </div>
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
	    <div class="card">
		<div class="card-content">
		    <div class="numbers">
			<p>Rejected Votes</p>
			<?php echo number_format($election->getRejVotes()); ?>
		    </div>
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
	    <th data-field="votes-lg" rel="tooltip" 
		title="From <?php echo $election->getResultsCountLG(); ?> result(s) out of <?php echo $st->getLocalGCount(); ?> Local Governments">
		Votes <small>(LG Level)</small>
	    </th>
	    <th data-field="votes-ra" rel="tooltip" 
		title="From <?php echo $election->getResultsCountRA(); ?> result(s) out of <?php echo $st->getRACount(); ?> Registration Area">
		Votes <small>(RA Level)</small>
	    </th>
	    <th data-field="votes-pu" rel="tooltip" 
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
	<div class="col-md-3">
	    <button data-toggle="modal" data-target="#localg-<?php echo $lg["id"]; ?>" 
		    type="button" class="btn btn-default" style="margin-bottom:16px;">
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
				    $value1 = number_format($value) !== NULL ? number_format($value) : $value; 
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
				    type="button" class="btn btn-default" style="margin-bottom:16px;">
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

<!-- Modal For Adding ELECTION result at polling unit -->
<div class="modal fade" id="addResult" role='dialog'>
    <div class="modal-dialog animated">
	<div class="modal-content">
	    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Add Result</h4>
	    </div>
	    <div class="modal-body">  
		<form id="addResultForm">
		    <div class="form-group">
			<input type="radio" name="resultLevel" id="level-pu" value="level-pu">
			<label for="level-pu">
			    Polling Unit
			</label>
			
			<input type="radio" name="resultLevel" id="level-ra" value="level-ra">
			<label for="level-ra">
			    Registration Area
			</label>
			
			<input type="radio" name="resultLevel" id="level-lg" value="level-lg">
			<label for="level-lg">
			    Local Gov
			</label>
		    </div>
		    
		    <div id="party-div" class="form-group">
			<label>Select Party <small>(Required)</small></label>
			<select class="form-control" id="party-result">
			    <option>Select</option>
			    <?php 				
				for($i = 0; $i < count($candidates); $i++) {
				    $candidate = $candidates[$i];
				    $party = new PoliticalParty($candidate["partyId"]);
			    ?>
			    <option value="<?php echo $party->getId(); ?>">
				<?php echo "[".$party->getInitials()."] ".$party->getName(); ?>
			    </option>
			    <?php } ?>
			</select>
		    </div>
		    
		    <div id="lg-div" class="form-group">
			<label>Select Localgovernment <small>(Required)</small></label>
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
		    
		    <div id="ra-div" class="form-group">
			<label>Select Registration Area <small>(Required)</small></label>
			<select class="form-control" id="ra">
			    <option>Select</option>
			</select>
		    </div>
		    
		    <div id="pu-div" class="form-group">
			<label>Select Polling Unit <small>(Required)</small></label>
			<select class="form-control" id="pu">
			    <option>Select</option>
			</select>
		    </div>
		    
		    <div id="votes-div" class="form-group">
			<label>Votes <small>(Required)</small></label>
			<input type="number" id="votes" class="form-control" placeholder="Votes..." />
		    </div>

		    <div id="button-div" class="form-group">
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