<script>
	function select_data($id, $uname, $level) {
		$("#id").val($id);
		$("#uname").val($uname);
		$("#level").val($level);
		
	}

	function select_ubah($id, $uname, $level) {
		$("#id2").val($id);
		$("#uname2").val($uname);
		$("#level2").val($level);
	} 

	

	function refresh($id, $uname, $level) {
		$("#id").val("");
		$("#uname").val("");
		$("#level").val("");
		
	}

</script>
<?php 
	$data =$this->session->flashdata('suksess');
	if ($data!="") { ?>
<div class="alert alert-success" role="alert"><strong>Sukses!!</strong>
	<?php echo $data; ?>
	<button type="button" class="close" data-dismiss="alert" aria-label="close"></button>
	<span aria-hidden="true"></span>
</div>
<?php }
?>
<div class="row">
	<!-- left column -->
	<div class="col-md-12">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="pull-left">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"
						onclick="refresh()">
						<i class="fa fa-plus-circle"></i> &nbsp;Tambah Data
					</button>
				</div>
				
			</div>
			<div class="box-body">
				<div class="table table-responsive">
				<table class="table table-bordered table-striped" id="table2" style="width:100%">
						<thead>
							<tr>
								<th style="text-align:center" width="30px" >No</th>
								<th style="text-align:center" >User Name</th>
								<th style="text-align:center" >Password</th>
								<th style="text-align:center" >Level User</th>
								<th style="text-align:center">Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no =1;
								$datalaporan = $this->db->query("SELECT * FROM user");
								foreach ($datalaporan->result() as $l) { ?>
							<tr>
								<td style="text-align:center"><?php echo $no++ ?></td>
								<td style="text-align:center"><?php echo $l->username ?></td>
								<td><?php echo $l->password ?></td>
								<td style="text-align:center"><?php echo $l->level ?></td>
								<td style="text-align:center">
									<a style="cursor: pointer;" onclick="select_ubah(
												'<?php echo $l->id ?>',
												'<?php echo $l->username ?>',
												'<?php echo $l->level ?>'

											)" data-toggle="modal" data-target="#modal-ubah">
										<button class="btn btn-info btn-xs">
											<i class="fa fa-edit"></i>Edit
										</button>
									</a>
									<a href="<?php base_url()?>admin/hapus/<?php echo $l->id; ?>"
									onClick="return confirm('Anda Yakin Ingin Menghapus Data ?')">
										<button class="btn btn-danger btn-xs">
											<i class="fa fa-trash-o"></i>Delete
										</button>
									</a>
								</td>
							</tr>
							<?php }
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-tambah" role="dialog">
	<div class="modal-dialog">
		<form action="<?php echo site_url('admin/simpan') ?>" method="post" accept-charset="utf-8">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal"></button>
					<h4 class="modal-title">Tambah Data</h4>
				</div>

				<div class="modal-body">
					<div class="col-md-12">
						<div class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">User Name</label>
									<div class="col-sm-7">
										<input type="text" name="uname" id="uname" class="form-control" value=""
											placeholder="Masukkan User Name" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Password</label>
									<div class="col-sm-7">
										<input type="password" name="pass" id="pass" class="form-control" value=""
											placeholder="Masukkan Password" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Level User</label>
									<div class="col-sm-5">
										<select name="level" id="level" class="form-control">
											<option value=" " selected>-- Pilih Level User--</option>
											<option value="Full Akses">Full Akses</option>
											<option value="Approval">Approval</option>
											<option value="Keberangkatan">Keberangkatan</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">
						<i class="glyphicon glyphicon-ok"></i> &nbsp; Simpan
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="modal-ubah" role="dialog">
	<div class="modal-dialog">
		<form action="<?php echo site_url('admin/simpan') ?>" method="post" accept-charset="utf-8">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal"></button>
					<h4 class="modal-title">Ubah Data</h4>
				</div>

				<div class="modal-body">
					<div class="col-md-12">
						<div class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">User Name</label>
									<div class="col-sm-7">
										<input type="hidden" name="id" id="id2">
										<input type="text" name="uname" id="uname2" class="form-control" value=""
											placeholder="Masukkan User Name" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Password</label>
									<div class="col-sm-7">
										<input type="password" name="pass" id="pass2" class="form-control" value=""
											placeholder="Masukkan Password" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Level User</label>
									<div class="col-sm-5">
										<select name="level" id="level2" class="form-control">
											<option value=" " selected>-- Pilih Level User--</option>
											<option value="Full Akses">Full Akses</option>
											<option value="Approval">Approval</option>
											<option value="Keberangkatan">Keberangkatan</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">
						<i class="glyphicon glyphicon-ok"></i> &nbsp; Simpan
					</button>
				</div>
			</div>
		</form>
	</div>
</div>



