<!-- Modal -->
<div class="modal fade" id="project-timeline-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Project Timeline</h4>
      </div>
      <div class="modal-body">
	    <ul class="timeline">
	    <?php
		$sql = "SELECT * FROM PROJECTTIMELINE WHERE projectId = '$projectId'";
		$query = new Query($sql, $db->getConnectionID());

		if($query->error()) {
		    echo $query->getError();
		    die();
		}

		$counter = 0;

		while($row = $query->fetchRow()) {
		    $counter++;
	    ?>
	    <li class="<?php if($counter % 2 == 0) {echo "timeline-inverted";} ?>">
		<div class="timeline-badge <?php if($counter % 2 == 1) {echo "danger";} else {echo "success";} ?>">
		    <i class="ti-gallery"></i>
		</div>
		<div class="timeline-panel">
		    <div class="timeline-heading">
			<span class="label label-danger"><?php echo $row[2]; ?></span>
		    </div>
		    <div class="timeline-body">
			<?php echo $row[3]; ?>
		    </div>
		    <h6>
			<i class="ti-time"></i>
			<?php echo $util->time_elapsed_string($row[4]); ?>
		    </h6>
		</div>
	    </li>
	    <?php } ?>
	    </ul>
      </div>
    </div>
  </div>
</div>