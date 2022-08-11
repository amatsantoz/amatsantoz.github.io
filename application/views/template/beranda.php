<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Halo</h3>
			</div>
			<div class="box-body">
				<div class="callout callout-info">
					<h4>Selamat Datang</h4>
					<p>Silahkan  Pilih Salah Satu Menu Dibawah Ini.</p>
				</div>
			</div>
			<section class="content">
					<div class="row">
					<div class="col-md-3">
						<center>
						<div class="<?php if($this->uri->segment(1)=='crew') echo 'active';?>">
								<a href="<?php echo site_url('crew') ?>">
									<button type="button" class="btn btn-primary btn-lg">
									<i class="fa fa-list-alt"></i>  &nbsp;Data MKA 30 Tahun
									</button>
								</a>
							</div>
							</center>
					</div>
					<div class="col-md-3">
						<center>
						<div class="<?php if($this->uri->segment(1)=='approval') echo 'active';?>">
								<a href="<?php echo site_url('approval') ?>">
									<button type="button" class="btn btn-primary btn-lg">
									<i class="fa fa-folder-open"></i>  &nbsp; Approval	
									</button>
								</a>
							</div>
							</center>
					</div>
					<div class="col-md-3">
						<center>
						<div class="<?php if($this->uri->segment(1)=='keberangkatan2') echo 'active';?>">
								<a href="<?php echo site_url('keberangkatan2') ?>">
									<button type="button" class="btn btn-primary btn-lg">
									<i class="fa fa-book"></i>  &nbsp;Keberangkatan	
									</button>
								</a>
							</div>
							</center>
					</div>
					<div class="col-md-3">
						<center>
						<div class="<?php if($this->uri->segment(1)=='admin') echo 'active';?>">
								<a href="<?php echo site_url('admin') ?>">
									<button type="button" class="btn btn-primary btn-lg">
									<i class="fa fa-id-card"></i>  &nbsp;Manage User	
									</button>
								</a>
							</div>
							</center>
					</div>
		</div>
	</div>
</div>