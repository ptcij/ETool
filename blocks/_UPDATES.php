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
			<hr>
			<h6>
			    <i class="ti-time"></i>
			    <?php echo $util->time_elapsed_string($update["date"]); ?>
			</h6>
		    </div>
		</div>
	    </li>
	    <?php $count++; } ?>
	</ul>
    </div>
</div>