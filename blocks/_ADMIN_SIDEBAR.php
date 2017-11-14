<div class="sidebar" data-background-color="brown" data-active-color="info">
    <!--
	Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
	Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->
    <div class="sidebar-wrapper">
	<div class="logo">
	    <a href="/cms/" class="simple-text logo-mini">
		PTET
	    </a>

	    <a href="/cms/" class="simple-text logo-normal">
		PremiumTimes ET
	    </a>
	</div>
	<div class="user">
	    <div class="info">
		<?php if($moderator->getImageUrl() != "") { ?>
		<div class="photo">
		    <img src="/assets/img/moderators/<?php echo $moderator->getImageUrl(); ?>" />
		</div>
		<?php } else { ?>
		<div class="photo">
		    <img src="/assets/img/default-avatar.png" />
		</div>
		<?php } ?>
		<a data-toggle="collapse" href="#collapseExample" class="collapsed">
		    <span>
			<?php echo $moderator->getName(); ?>
			<b class="caret"></b>
		    </span>
		</a>
		<div class="clearfix"></div>

		<div class="collapse" id="collapseExample">
		    <ul class="nav">
			<li>
			    <a href="/cms/profile/">
				<span class="sidebar-mini">Mp</span>
				<span class="sidebar-normal">My Profile</span>
			    </a>
			</li>
			<li>
			    <a href="/cms/logout/">
				<span class="sidebar-mini">L</span>
				<span class="sidebar-normal">Logout</span>
			    </a>
			</li>
		    </ul>
		</div>
	    </div>
	</div>
	<ul class="nav">
	    <li>
		<a href="/cms/dashboard/">
		    <i class="ti-dashboard"></i>
		    <p>Dashboard</p>
		</a>
	    </li>
	    <li>
		<a href="/cms/political-parties/">
		    <i class="ti-dashboard"></i>
		    <p>Political Parties</p>
		</a>
	    </li>
	    <li>
		<a href="/cms/elections/">
		    <i class="ti-dashboard"></i>
		    <p>Elections</p>
		</a>
	    </li>
	    <!--<li>
		<a data-toggle="collapse" href="#tablesExamples">
		    <i class="ti-clipboard"></i>
		    <p>
			Dropdown
			<b class="caret"></b>
		    </p>
		</a>
		<div class="collapse" id="tablesExamples">
		    <ul class="nav">
			<li>
			    <a href="/cms/projects/browse/">
				<span class="sidebar-mini">B</span>
				<span class="sidebar-normal">Browse</span>
			    </a>
			</li>
		    </ul>
		</div>
	    </li>-->
	</ul>
    </div>
</div>