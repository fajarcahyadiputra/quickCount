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
                        <h3>DATA TEAM KORDES</h3>
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
                                <th>Jenis Kelamin</th>
                                <th>Nomer HP</th>
                                <th>Alamat</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                              include '../functions/db.php';
                              $no = 1;
                              $query = mysqli_query($link, "SELECT * FROM team_kordes");
                              while ($data = mysqli_fetch_array($query)) { 
                         ?>
                         <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['nama'] ?></td>
                                <td><?php echo $data['jenis_kelamin'] ?></td>
                                <td><?php echo $data['no_hp'] ?></td>
                                <td><?php echo $data['alamat'] ?></td>
                                <td>
                                <a class="btn btn-danger" onclick="return confirm('Yakin mau hapus ?')" href="aksiHapus.php?id=<?php echo $data['id'] ?>&hapus=dataKordes"><i class="fa fa-trash"></i></a>
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
			<form method="post" action="aksiTambah.php?tambah=data_kordes">
				<div class="modal-body">
				    <div   div class="form-group">
						<label>Nama</label>
						<input required="" type="text" name="nama" class="form-control">
                    </div>
                    <div   div class="form-group">
						<label>Jenis Kelamin</label>
						<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div   div class="form-group">
						<label>Nomer HP</label>
						<input required="" type="text" name="no_hp" class="form-control">
                    </div>
                    <div div class="form-group">
						<label>Alamat</label>
						<input required="" type="text" name="alamat" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="tambahKordes" class="btn btn-primary">Tambah</button>
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
			<form id="form_edit" method="post" action="aksiEdit.php?edit=dataKordes">
				
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
        url : 'getData.php?get=dataKordes',
        data : {'id': id},
        type : 'post',
        dataType : 'json',
        success: function(hasil){
            $('#form_edit').html(`<div class="modal-body">
				    <div   div class="form-group">
						<label>Nama</label>
						<input required="" type="text" name="nama" class="form-control" value="${hasil.nama}">
						<input required="" type="hidden" name="id" class="form-control" value="${hasil.id}">
                    </div>
                    <div   div class="form-group">
						<label>Jenis Kelamin</label>
						<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option ${hasil.jenis_kelamin == 'laki-laki'?'selected':''} value="laki-laki">Laki-Laki</option>
                            <option ${hasil.jenis_kelamin == 'perempuan'?'selected':''} value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div   div class="form-group">
						<label>Nomer HP</label>
						<input required="" type="text" name="no_hp" class="form-control" value="${hasil.no_hp}">
                    </div>
                    <div div class="form-group">
						<label>Alamat</label>
						<input required="" type="text" name="alamat" class="form-control" value="${hasil.alamat}">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="editKordes" class="btn btn-primary">EDit</button>
				</div>`)
            $("#modalEdit").modal('show')
        }

      })
    })
    
  })


	})
</script>

<?php include_once 'templet/footer.php'; } ?>

