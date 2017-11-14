<table id="candidate-bootstrap-table" class="table">
    <thead>
	<!--<th data-field="state" data-checkbox="true"></th>-->
    <th data-field="id" data-sortable="true" class="text-center">ID</th>
    <th data-field="party">Party</th>
    <th data-field="aspirant">Aspirant</th>
    <th data-field="deputy">Deputy</th>
    <th data-field="gender">Gender</th>
    <th data-field="age">Age</th>
    <th data-field="qualification">Qualification</th>
    <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
</thead>
<tbody>
    <?php
	$candidates = $election->getCandidates();
	
	for($i = 0; $i < count($candidates); $i++) {
	    $candidate = $candidates[$i];
    ?>
    <tr>
	<td><?php echo $candidate["partyId"]."-".$candidate["electionId"]; ?></td>
	<td><?php echo $candidate["party"]; ?></td>
	<td><?php echo $candidate["aspirant"]; ?></td>
	<td><?php echo $candidate["deputy"]; ?></td>
	<td><?php echo $candidate["gender"]; ?></td>
	<td><?php echo $candidate["age"]; ?></td>
	<td><?php echo $candidate["qualification"]; ?></td>
	<td></td>
    </tr>
    <?php 
	}
    ?>
</tbody>
</table>

<!-- Modal For Adding ElectionL -->
<div class="modal fade" id="addCandidate" role='dialog'>
    <div class="modal-dialog animated">
	<div class="modal-content">
	    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">New Candidate</h4>
	    </div>
	    <div class="modal-body">  
		<form>
		    <div class="form-group">
			<label>Select Party</label>
			<select class="form-control" id="party">
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
		    <input type="hidden" id="electionId" value="<?php echo $electionId; ?>" />
		    <div class="form-group">
			<label>Aspirant</label>
			<input type="text" id="aspirant" class="form-control" placeholder="Aspirant..." />
		    </div>

		    <div class="form-group">
			<label>Deputy</label>
			<input type="text" id="deputy" class="form-control" placeholder="Deputy..." />
		    </div>
		    
		    <div class="form-group">
			<label>Gender</label>
			<input type="text" id="gender" class="form-control" placeholder="Gender..." />
		    </div>
		    
		    <div class="form-group">
			<label>Age</label>
			<input type="text" id="age" class="form-control" placeholder="Age..." />
		    </div>
		    
		    <div class="form-group">
			<label>Qualification</label>
			<input type="text" id="qualification" class="form-control" placeholder="Qualification..." />
		    </div>

		    <div class="form-group">
			<button id="addCandidateBtn" type="button" class="btn btn-round">
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