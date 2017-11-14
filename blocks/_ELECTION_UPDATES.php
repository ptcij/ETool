<div class="card card-timeline card-plain">
    <div class="card-content">
	<ul class="timeline">
	    <?php
		$updates = $election->getUpdates(0, 10);
		$count = 1;
		for($i = 0; $i < count($updates); $i++) {
		    $update = $updates[$i];
	    ?>
	    <li class="<?php if($count % 2 == 0) {echo "timeline-inverted";} ?>">
		<div class="timeline-badge info"></div>
		<div class="timeline-panel">
		    <div class="timeline-heading">
			<span class="label label-success"><?php echo $update["title"]; ?></span>
		    </div>
		    <div class="timeline-body">
			<?php echo $update["desc"]; ?>
			<h6>
			    <i class="ti-time"></i>
			    <?php echo $util->time_elapsed_string($update["date"]); ?>
			</h6>
			<hr>
			<div class="btn-group">
			    <button id="del-<?php echo $update["id"]; ?>" 
				    type="button" class="btn btn-info delete-update">
				<i class="ti-minus icon-danger"></i> delete
			    </button>
			</div>
		    </div>
		</div>
	    </li>
	    <?php $count++; } ?>
	</ul>
    </div>
</div>

<!-- Modal For Adding ElectionL -->
<div class="modal fade" id="addUpdate" role='dialog'>
    <div class="modal-dialog animated">
	<div class="modal-content">
	    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">New Update</h4>
	    </div>
	    <div class="modal-body">  
		<form>
		    <div class="form-group">
			<label>Title</label>
			<input type="text" id="title" class="form-control" placeholder="Title..." />
		    </div>

		    <div class="form-group">
			<label>Description</label>
			<textarea class="form-control" id="description" placeholder="Description..."></textarea>
		    </div>

		    <div class="form-group">
			<button id="addUpdateBtn" type="button" class="btn btn-round">
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