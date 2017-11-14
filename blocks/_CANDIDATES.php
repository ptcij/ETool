<table id="candidate-bootstrap-table" class="table">
    <thead>
	<!--<th data-field="state" data-checkbox="true"></th>-->
	<th data-field="id" data-sortable="true">ID</th>
	<th data-field="party">Party</th>
	<th data-field="aspirant">Aspirant</th>
	<th data-field="deputy">Deputy</th>
	<th data-field="gender">Gender</th>
	<th data-field="age">Age</th>
	<th data-field="qualification">Qualification</th>
    </thead>
    <tbody>
	<?php
	    $candidates = $election->getCandidates();
	    
	    $count = 1;
	    for($i = 0; $i < count($candidates); $i++) {
		$candidate = $candidates[$i];
	?>
	<tr>
	    <td><?php echo $count; ?></td>
	    <td><?php echo $candidate["party"]; ?></td>
	    <td><?php echo $candidate["aspirant"]; ?></td>
	    <td><?php echo $candidate["deputy"]; ?></td>
	    <td><?php echo $candidate["gender"]; ?></td>
	    <td><?php echo $candidate["age"]; ?></td>
	    <td><?php echo $candidate["qualification"]; ?></td>
	</tr>
	<?php 
	    $count++;
	    }
	?>
    </tbody>
</table>