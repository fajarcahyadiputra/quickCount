<?php
session_start();
if(empty($_SESSION['username'])) {
	Header('Location: ../index.php');
} else {

include_once 'templet/header.php';
include_once 'templet/sidebar.php';

?>
	<div class="container-fluid" id="container-wrapper">
		<div class="card mb-5" >
			<div class="card-header" style="background-color:mintcream">
				<div class="row">
					<div class="col-sm-6">
                        <h3>DATA TPS</h3>
                        <?php if(isset($_SESSION['pesan'])){ ?>
                            <span class="alert alert-<?= $_SESSION['warna'] ?>">
                            <?php echo $_SESSION['pesan'] ?>
                        </span>
                         <?php unset($_SESSION['pesan']); unset($_SESSION['warna']); } ?>
					</div>
					<div class="col-sm-6 text-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
							Tambah Data
						</button>
					</div>
				</div>
			</div>
			<div class="card-body">

				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover" id="tableKecamatan" style="width: 100%">
						<thead>	
							<tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumblah Suara</th>
                                <th>Foto</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                              include '../functions/db.php';
                              $no = 1;
                              $query = mysqli_query($link, "SELECT * FROM tps");
                              while ($data = mysqli_fetch_array($query)) { 
                         ?>
                         <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['nama'] ?></td>
                                <td><?php echo $data['jumblah_suara'] ?></td>
                                <td><img width="150" src="assets/tps/<?php echo $data['foto'] ?>" alt=""></td>
                                <td>
                                <a class="btn btn-danger" onclick="return confirm('Yakin mau hapus ?')" href="aksiHapus.php?id=<?php echo $data['id'] ?>&foto=<?php echo $data['foto'] ?>&hapus=dataTps"><i class="fa fa-trash"></i></a>
                                <button data-id="<?php echo $data['id'] ?>" id="tombolEdit" class="btn btn-info"><i class="fa fa-edit"></i></button>
                                </td>
                         </tr>
                        <?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- Modal tambah-->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal Tambah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="aksiTambah.php?tambah=data_tps" enctype="multipart/form-data">
				<div class="modal-body">
				<div   div class="form-group">
						<label>Nama</label>
						<input required="" type="text" name="nama" class="form-control">
					</div>
                </div>
                <div class="modal-body">
				    <div div class="form-group">
						<label>Jumblah Suara</label>
						<input required="" type="number" name="jumblah_suara" class="form-control">
					</div>
                </div>
                <div class="modal-body">
				    <div div class="form-group">
						<label>Foto</label>
						<input required="" type="file" name="foto" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="tambahTps" class="btn btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end -->

<!-- modal edit data -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal Edit Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_edit" method="post" action="aksiEdit.php?edit=dataTps" enctype="multipart/form-data">
				
			</form>
		</div>
	</div>
</div>
<!-- end -->





<script>
	$(document).ready(function(){

		let table = $('#tableKecamatan').DataTable({
			"paging": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			async: true
		})
    
  $(document).ready(function(){
    $(document).on('click','#tombolEdit', function(){
      let id = $(this).data('id');
      
      $.ajax({
        url : 'getData.php?get=dataTps',
        data : {'id': id},
        type : 'post',
        dataType : 'json',
        success: function(hasil){
            $('#form_edit').html(`	<div class="modal-body">
				<div   div class="form-group">
						<label>Nama</label>
						<input required="" type="text" name="nama" class="form-control" value="${hasil.nama}">
						<input required="" type="hidden" name="id" class="form-control" value="${hasil.id}">
					</div>
                </div>
                <div class="modal-body">
				    <div div class="form-group">
						<label>Jumblah Suara</label>
						<input required="" type="number" name="jumblah_suara" class="form-control" value="${hasil.jumblah_suara}">
					</div>
                </div>
                <div class="modal-body">
				    <div div class="form-group">
						<label>Foto</label><br>
                        <img width="150" src="assets/tps/${hasil.foto}"/>
						<input  type="file" name="foto_baru" class="form-control">
						<input hidden type="text" name="foto_lama" value="${hasil.foto}">
                        <small>Jika Ingin Menganti Foto Pilih Foto</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="editTps" class="btn btn-primary">Edit</button>
				</div>`)
            $("#modalEdit").modal('show')
        }

      })
    })
    
  })


	})
</script>

<?php include_once 'templet/footer.php'; } ?>

