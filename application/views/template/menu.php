<ul class="sidebar-menu tree" data-widget="tree">
	<li class="header">MAIN MENU</li>
	<li class="<?php if($this->uri->segment(1)=='home') echo 'active';?>">
		<a href="<?php echo site_url('home') ?>">
			<i class="fa fa-home"></i> <span>Home</span>
		</a>
	</li>
			<li class="<?php if($this->uri->segment(1)=='crew') echo 'active';?>">
				<a href="<?php echo site_url('crew') ?>">
					<i class="fa fa-list-alt"></i> <span>MKA 30 Tahun</span>
				</a>
			</li>
		

	<li class="<?php if($this->uri->segment(1)=='approval') echo 'active';?>">
		<a href="<?php echo site_url('approval') ?>">
			<i class="fa fa-folder-open"></i> <span>Approval</span>
		</a>
	</li>
	<li class="<?php if($this->uri->segment(1)=='keberangkatan2') echo 'active';?>">
		<a href="<?php echo site_url('keberangkatan2') ?>">
			<i class="fa fa-book"></i> <span>Keberangkatan</span>
		</a>
	</li>
	<li class="<?php if($this->uri->segment(1)=='admin') echo 'active';?>">
		<a href="<?php echo site_url('admin') ?>">
			<i class="fa fa-user"></i> <span>Manage User</span>
		</a>
	</li>
		
	

</ul>
