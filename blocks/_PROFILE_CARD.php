<div class="card card-profile">
    <div class="card-cover" style="background-image: url('/assets/img/profile_car_bg.jpg')">
    </div>
    <div class="card-avatar border-white">
	<a href="#avatar">
	    <?php if($citizen->getImageUrl() != "") { ?>
	    <img src="<?php echo $citizen->getImageUrl(); ?>" alt="..."/>
	    <?php } else { ?>
	    <img src="/assets/img/default-avatar.png" alt="..."/>
	    <?php } ?>
	</a>
    </div>
    <div class="card-body">
	<h4 class="card-title"><?php echo $citizen->getName(); ?></h4>
	<h6 class="card-category"><?php echo $citizen->getOccupation(); ?></h6>

	<div class="card-footer text-center">
	    <button type="button" class="btn btn-danger btn-just-icon btn-lg">
		<i class="nc-icon nc-user-run" aria-hidden="true"></i>
		<?php echo $citizen->getFollowingCount(); ?>
	    </button>
	    <button type="button" class="btn btn-danger btn-just-icon btn-lg">
		<i class="nc-icon nc-circle-10" aria-hidden="true"></i>
		<?php echo $citizen->getFollowersCount(); ?>
	    </button>
	    <button type="button" class="btn btn-danger btn-just-icon btn-lg">
		<i class="nc-icon nc-camera-compact" aria-hidden="true"></i>
		<?php echo $citizen->getWatchedProjectsCount(); ?>
	    </button>
	</div>
    </div>
</div> <!-- end card -->