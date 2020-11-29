<?php 
 include_once 'templet/header.php';
 include_once 'templet/sidebar.php';
if(empty($_SESSION['username'])) {
	header('Location: ../index.php');
} else {

	?>

	<div class="container-fluid" id="container-wrapper">
		<div class="card mb-5" >
			<div class="card-header" style="background-color:mintcream">
				<div class="row">
					<div class="col-sm-6">
                        <h3>DATA USER</h3>
                        <?php if(isset($_SESSION['pesan'])){ ?>
                            <span class="alert alert-<?= $_SESSION['warna'] ?>">
                            <?php echo $_SESSION['pesan'] ?>
                        </span>
                         <?php unset($_SESSION['pesan']); unset($_SESSION['warna']); } ?>
					</div>
					<div class="col-sm-6 text-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
							Tambah User
						</button>
					</div>
				</div>
			</div>
			<div class="card-body">

				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover" id="tableUser" style="width: 100%">
						<thead>	
							<tr>
                                <th>No</th>
                                <th>usernam</th>
                                <th>password</th>
                                <th>Status Aktif</th>
                                <th>Level</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                              include '../functions/db.php';
                              $no = 1;
                              $query = mysqli_query($link, "SELECT * FROM admin");
                              while ($data = mysqli_fetch_array($query)) { 
                         ?>
                         <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['username'] ?></td>
                                <td><button id="tombol_password" data-id="<?php echo $data['id'] ?>" class="btn btn-success">password</button></td>
                                <td><?php echo $data['status_aktif'] ?></td>
                                <td><?php echo $data['level'] ?></td>
                                <td>
                                <a class="btn btn-danger" onclick="return confirm('Yakin mau hapus ?')" href="aksiHapus.php?id=<?php echo $data['id'] ?>&hapus=dataUser"><i class="fa fa-trash"></i></a>
                                <button data-id="<?php echo $data['id'] ?>" id="tombolEditUser" class="btn btn-info"><i class="fa fa-edit"></i></button>
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
			<form method="post" action="aksiTambah.php?tambah=data_user">
				<div class="modal-body">
				<div class="form-group">
						<label>Username</label>
						<input required="" type="text" name="username" class="form-control">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input required="" minlength="3" type="text" name="password" class="form-control">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select require name="jenis_kelamin" id="jenis_kelamin" class="form-control">
							<option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
							<option value="laki-laki">Laki-Laki</option>
							<option value="perempuan">Perempuan</option>
						</select>
                    </div>
                    <div class="form-group">
						<label>Level</label>
						<select require name="level" id="level" class="form-control">
							<option value="" disabled selected hidden>Pilih Level</option>
							<option value="superadmin">Super Admin</option>
							<option value="admin">Admin</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="tambahUser" class="btn btn-primary">Tambah</button>
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
			<form id="form_edit" method="post" action="aksiEdit.php?edit=dataUser">
				
			</form>
		</div>
	</div>
</div>
<!-- end -->



<!-- modal password data -->
<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal Rubah Password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_password" method="post" action="aksiEdit.php?edit=editPassword">
			
			</form>
		</div>
	</div>
</div>
<!-- end -->




<script>
	$(document).ready(function(){

		let table = $('#tableUser').DataTable({
			"paging": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			async: true
		})
    
  $(document).ready(function(){
    $(document).on('click','#tombolEditUser', function(){
      let id = $(this).data('id');
      
      $.ajax({
        url : 'getData.php?get=dataUser',
        data : {'id': id},
        type : 'post',
        dataType : 'json',
        success: function(hasil){
            $('#form_edit').html(`<div class="modal-body">
				<div class="form-group">
						<label>Username</label>
						<input required="" type="text" name="username" class="form-control" value="${hasil.username}">
						<input required="" type="hidden" name="id" class="form-control" value="${hasil.id}">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select require name="jenis_kelamin" id="jenis_kelamin" class="form-control">
							<option ${hasil.jenis_kelamin == 'laki-laki'?'selected':''} value="laki-laki">Laki-Laki</option>
							<option  ${hasil.jenis_kelamin == 'perempuan'?'selected':''} value="perempuan">Perempuan</option>
						</select>
                    </div>
                    <div class="form-group">
						<label>Level</label>
						<select require name="level" id="level" class="form-control">
							<option ${hasil.level == 'superadmin'?'selected':''} value="superadmin">Super Admin</option>
							<option ${hasil.level == 'admin'?'selected':''}  value="admin">Admin</option>
						</select>
					</div>
                    <div class="form-group">
						<label>Status Aktif</label>
						<select require name="status_aktif" id="status_aktif" class="form-control">
							<option ${hasil.status_aktif == 'y'?'selected':''} value="y">Ya</option>
							<option ${hasil.status_aktif == 'n'?'selected':''}  value="n">No</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="editUser" class="btn btn-primary">Edit</button>
				</div>`)
                $("#modalEdit").modal('show')
        }

      })
    })
    	//tampil form password
		$(document).on('click', '#tombol_password', function(){
			const id = $(this).data('id');
			$('#form_password').html(`<div class="modal-body">
				<div class="form-group">
					<label for="password">Password</label>
					<input required type="text" name="password" class="form-control" minlength="3">
					<input type="hidden" name="id" class="form-control" value="${id}">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" name="editPassword" class="btn btn-primary">Ganti</button>
			</div>`);
			$('#modalPassword').modal('show');
		})
		//end

  })


	})
</script>

<?php include_once 'templet/footer.php'; } ?>

