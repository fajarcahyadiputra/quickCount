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
                        <h3>DATA DESA</h3>
                        <?php if(isset($_SESSION['pesan'])){ ?>
                            <span class="alert alert-<?= $_SESSION['warna'] ?>">
                            <?php echo $_SESSION['pesan'] ?>
                        </span>
                         <?php unset($_SESSION['pesan']); unset($_SESSION['warna']); } ?>
					</div>
					<div class="col-sm-6 text-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
							Tambah Desa
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
                                <th>Provin</th>
                                <th>Nama</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                              include '../functions/db.php';
                              $no = 1;
                              $query = mysqli_query($link, "SELECT * FROM desa");
                              while ($data = mysqli_fetch_array($query)) { 

                             $kecamatan = mysqli_query($link, "SELECT * FROM kecamatan where id=".$data['id_kecamatan']."");
                             $data_keamatan = mysqli_fetch_array($kecamatan);
                              
                         ?>
                         <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data_keamatan['nama'] ?></td>
                                <td><?php echo $data['nama'] ?></td>
                                <td>
                                <a class="btn btn-danger" onclick="return confirm('Yakin mau hapus ?')" href="aksiHapus.php?id=<?php echo $data['id'] ?>&hapus=dataDesa"><i class="fa fa-trash"></i></a>
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
			<form method="post" action="aksiTambah.php?tambah=data_desa">
				<div class="modal-body">
				    <div   div class="form-group">
						<label>Nama Kecamatan</label>
                        <select name="id_kecamatan" id="id_kecamatan" class="form-control">
                            <option value="" disabled selected hidden>Pilih Kecamatan</option>
                            <?php 
                            $kc =  mysqli_query($link, "SELECT * FROM kecamatan");
                            while($dt_kc = mysqli_fetch_array($kc)):
                         ?>
                            <option value="<?php echo $dt_kc['id'] ?>"><?= $dt_kc['nama'] ?></option>
                         <?php endwhile ?>
                        </select>
                    </div>
                    <div  div class="form-group">
						<label>Nama Desa</label>
						<input required="" type="text" name="nama" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="tambahDesa" class="btn btn-primary">Tambah</button>
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
			<form id="form_edit" method="post" action="aksiEdit.php?edit=dataDesa">
				
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
        url : 'getData.php?get=dataDesa',
        data : {'id': id},
        type : 'post',
        dataType : 'json',
        success: function(hasil){
            $('#form_edit').html(`<div class="modal-body">
				    <div   div class="form-group">
						<label>Nama Kecamatan</label>
                        <select name="id_kecamatan" id="id_kecamatan" class="form-control">
                           
                            <?php 
                            $kc =  mysqli_query($link, "SELECT * FROM kecamatan");
                            while($dt_kc = mysqli_fetch_array($kc)):
                         ?>
                            <option ${hasil.id_kecamatan == <?php echo $dt_kc['id'] ?>} value="<?php echo $dt_kc['id'] ?>"><?= $dt_kc['nama'] ?></option>
                         <?php endwhile ?>
                        </select>
                    </div>
                    <div  div class="form-group">
						<label>Nama Desa</label>
						<input required="" type="text" name="nama" class="form-control" value="${hasil.nama}">
						<input required="" type="hidden" name="id" class="form-control" value="${hasil.id}">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="editDesa" class="btn btn-primary">Edit</button>
				</div>`)
            $("#modalEdit").modal('show')
        }

      })
    })
    
  })


	})
</script>

<?php include_once 'templet/footer.php'; } ?>

