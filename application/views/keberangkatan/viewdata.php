<script type="text/javascript" src="jquery-1.7.min.js"></script>
<script>
	// function select_data($id,$nama, $jabatan, $unit, $tglam, $tujuan, $tglb, $tglp) {
	// 	$("#id").val($id);
	// 	$("#nama").val($nama);
	// 	$("#jabatan").val($jabatan);
	// 	$("#unit").val($unit);
	// 	$("#tglam").val($tglam);
	// 	$("#tujuan").val($tujuan);
	// 	$("#tglb").val($tglb);
	// 	$("#tglp").val($tglp);
		

	// }
	function select_data($id, $nama, $jabatan, $unit, $tglam, $tujuan, $tglb, $tglp) {
		$("#id").val($id);
		$("#nama").val($nama);
		$("#jabatan").val($jabatan);
		$("#unit").val($unit);
		$("#tglam").val($tglam);
		$("#tujuan").val($tujuan);
		$("#tglb").val($tglb);
		$("#tglp").val($tglp);
	}

	// $(window).load(function(){
	// 	$("#tujuan").change(function() {
	// 		console.log($("#tujuan").val());
	// 		if ($("#tujuan").val() == 'null') {
	// 			document.getElementById("b_edit").style.visibility = 'visible'; 
	// 			} else {
	// 				document.getElementById("b_edit").style.visibility = 'hidden'; 
	// 			}
	// 		});
	// 	});
	
		// $(window).load(function(){
		// $("#tuj").change(function() {
			
		// 	if ($("#tuj").val() == 'null') {
		// 		document.getElementById("b_edit").style.visibility = 'visible'; 
		// 		} else {
		// 			document.getElementById("b_edit").style.visibility = 'hidden'; 
		// 		}
		// 	});


 //Inisiasi awal penggunaan jQuery
// 		 $(document).ready(function(){
//   //Ketika elemen class sembunyi di klik maka elemen class gambar sembunyi
//         $('.sembunyi').click(function(){
//    //Sembunyikan elemen class gambar
//   		 $('.sembunyi').hide();        
//         });
// 			 });

	// function select_ubah($id, $nama, $jabatan, $unit, $agt, 
	// 					$mka, $validity, $approval, $tglam, $tujuan, $tglb, $tglp) {
	// 	$("#id").val($id);
	// 	$("#nama").val($nama);
	// 	$("#jabatan").val($jabatan);
	// 	$("#unit").val($unit);
	// 	$("#agt").val($agt);
	// 	$("#mka").val($mka);
	// 	$("#validity").val($validity);
	// 	$("#approval").val($approval);
	// 	$("#tglam").val($tglam);
	// 	$("#tujuan").val($tujuan);
	// 	$("#tglb").val($tglb);
	// 	$("#tglp").val($tglp);

	// }

	function refresh($id,$nama, $jabatan, $unit, $tglam, $tujuan, $tglb, $tglp) {
		$("#id").val("");
		$("#nama").val("");
		$("#jabatan").val("");
		$("#unit").val("");
		$("#tglam").val("");
		$("#tujuan").val("");
		$("#tglb").val("");
		$("#tglp").val("");
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
 			<!-- <div class="box-header with-border">
				<div class="pull-left">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"
						onclick="refresh()">
						<i class="fa fa-plus-circle"></i> &nbsp;Tambah Data
					</button>
				</div>
			</div> -->
			<div class="box-body">
 					<div class="table table-responsive">
					
					<table class="table table-bordered table-striped" id="table1" style="width:100%">
						<thead>
							<tr>
								<th style="text-align:center" >No</th>
								<th style="text-align:center" >No Pegawai</th>
								<th style="text-align:center" >Nama Pegawai</th>
								<th style="text-align:center" >Jabatan</th>
								<th style="text-align:center" >Unit Pegawai</th>
								<th style="text-align:center" >Nama Anggota Keluarga</th>
								<th style="text-align:center" >Tanggal MKA 30 Tahun</th>
								<th style="text-align:center" >Validity Pengambilan</th>
								<th style="text-align:center" >Approval</th>
								<th style="text-align:center" >Tanggal Pengambilan Paket</th>
								<th style="text-align:center" >Tujuan</th>
                                <th style="text-align:center" >Tanggal Berangkat</th>
                                <th style="text-align:center" >Tanggal Pulang</th>
								<th style="text-align:center">Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no =1;
								$datalaporan = $this->db->query("SELECT * FROM keberangkatan");
								foreach ($datalaporan->result() as $l) { ?>
									<tr>
										<td style="text-align:center"><?php echo $no++ ?></td>
										<td style="text-align:center"><?php echo $l->id ?></td>
										<td><?php echo $l->nama ?></td>
										<td style="text-align:center"><?php echo $l->jabatan ?></td>
										<td style="text-align:center"><?php echo $l->unit ?></td>
										<td style="text-align:center"><?php echo $l->agt_klrg ?></td>
										<td style="text-align:center"><?php echo $l->tgl_30 ?></td>
										<td style="text-align:center"><?php echo $l->tgl_validity ?></td>
										<?php if($l->tujuan ==null) { ?>
										<td style="text-align:center"><?php echo $l->approv ?></td>
										<?php }else{ ?>
											<td style="text-align:center"><?php echo "Used" ?></td>
											<?php } ?>
										<td style="text-align:center"><?php echo $l->tgl_ambil ?></td>
										<td style="text-align:center" id="tuj"><?php echo $l->tujuan ?></td>
										<td style="text-align:center"><?php echo $l->tgl_brngkt ?></td>
										<td style="text-align:center"><?php echo $l->tgl_plng ?></td>
										 
										<td style="text-align:center" >
										<?php if($l->tujuan ==null) { ?>
											<a style="cursor: pointer;" onclick="select_data(
												'<?php echo $l->id ?>',
												'<?php echo $l->nama ?>',
												'<?php echo $l->jabatan ?>',
												'<?php echo $l->unit ?>',
												'<?php echo $l->tgl_ambil ?>',
												'<?php echo $l->tujuan ?>',
												'<?php echo $l->tgl_brngkt ?>',
												'<?php echo $l->tgl_plng ?>'

											)" data-toggle="modal" data-target="#modal-ubah">
												<button class="btn btn-info btn-xs" >
													<i class="fa fa-edit"></i>Edit
												</button>
											</a>
										</td>
										<?php } ?>
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


<div class="modal fade" id="modal-ubah" role="dialog">
	<div class="modal-dialog">
		<form action="<?php echo site_url('keberangkatan/ubah') ?>" method="post" accept-charset="utf-8">
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
									<label for="" class="col-sm-3 control-label">No Pegawai</label>
									<div class="col-sm-4">
										<input type="text" name="id" id="id" class="form-control" value=""
											placeholder="Masukkan No Pegawai" required="" readonly>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Nama Pegawai</label>
									<div class="col-sm-7">
										<input type="text" name="nama" id="nama" class="form-control" value=""
											placeholder="Masukkan Nama Pegawai" required="" readonly>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Jabatan</label>
									<div class="col-sm-5">
										<input type="text" name="jabatan" id="jabatan" class="form-control" value=""
											placeholder="Masukkan Jabatan" required="" readonly>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Unit Pegawai</label>
									<div class="col-sm-5">
										<input type="text" name="unit" id="unit" class="form-control" value=""
											placeholder="Masukkan Unit Pegawai" required="" readonly>
									</div>
								</div>
								<!-- <div class="form-group">
									<label for="" class="col-sm-3 control-label">Nama Anggota Keluarga</label>
									<div class="col-sm-5">
										<input type="text" name="agt" id="agt" class="form-control" value=""
											placeholder="Masukkan Anggota Keluarga" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Tanggal MKA 30Th</label>
									<div class="col-sm-5">
										<input type="date" name="mka" id="mka" class="form-control" value=""
											placeholder="Masukkan Tanggal MKA 30Th" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Validity</label>
									<div class="col-sm-5">
										<input type="date" name="validity" id="validity" class="form-control" 
										value=""
											placeholder="Masukkan Tanggal Validity" required="" >
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Approval</label>
									<div class="col-sm-5">
										<select name="approval" id="approval" class="form-control">
											<option value="" selected>-- Pilih --</option>
											<option value="Approved">Approved</option>
										</select>
									</div>
								</div> -->
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Tanggal Ambil</label>
									<div class="col-sm-5">
										<input type="date" name="tglam" id="tglam" 
										class="form-control" value="" placeholder="Masukkan Tanggal Ambil" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Tujuan</label>
									<div class="col-sm-5">
										<input type="text" name="tujuan" id="tujuan" 
										class="form-control" value="" placeholder="Masukkan Tujuan" required="">
									</div>
								</div>
                                <div class="form-group">
									<label for="" class="col-sm-3 control-label">Tanggal Berangkat</label>
									<div class="col-sm-5">
										<input type="date" name="tglb" id="tglb" 
										class="form-control" value="" placeholder="Masukkan Tanggal Berangkat" required="">
									</div>
								</div>
                                <div class="form-group">
									<label for="" class="col-sm-3 control-label">Tanggal Pulang</label>
									<div class="col-sm-5">
										<input type="date" name="tglp" id="tglp" 
										class="form-control" value="" placeholder="Masukkan Tanggal Pulang" required="">
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a onClick="return confirm('Anda Yakin Ingin Mengubah Data ?')">
					<button type="submit" class="btn btn-primary">
						<i class="glyphicon glyphicon-ok"></i> &nbsp; Simpan
					</button>
					</a>
				</div>
			</div>
		</form>
	</div>
</div>

