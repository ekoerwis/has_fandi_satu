<div class="card">
	<div class="card-header bg-info text-light rounded">
		<h5 class="card-title rounded"><?=$current_module['judul_module']?></h5>
	</div>

	<?php
			if (!empty($message)) {
				show_message($message['message'], $message['status'], $message['dismiss']);
			}
		?>
	
	<div class="card-body">
        <?php
		 // by eko : berfungsi untuk memunculkan tombol atau tidak berdasarkan role  
			if(strtolower($auth_tambah) == 'yes'){
				echo '<a href="'.current_url().'?action=add" class="btn btn-success btn-xs"><i class="fa fa-plus pr-1"></i> Tambah Data</a>';
			} 
			if(strtolower($auth_ubah) == 'all'){
				echo '&nbsp; <a href="'.current_url().'?action=edit" class="btn btn-warning btn-xs"><i class="fa fa-edit pr-1"></i> Ubah Data</a>';
				// echo '<button id="editButton" class="btn btn-warning btn-xs ml-1"><i class="fa fa-edit pr-1"></i> Ubah Data</button>';
			} 
			if(strtolower($auth_hapus) == 'all'){
				helper('deleteModal');
				echo '&nbsp; <a href="'.current_url().'?action=delete" class="btn btn-danger btn-xs"><i class="fa fa-times pr-1"></i> Hapus Data</a>';
				// echo '<button id="deleteButton" class="btn btn-danger btn-xs ml-1"><i class="fa fa-times pr-1"></i> Hapus Data</button>';
			}
		?>

			<hr/>
			<div class="table-responsive">
				<!-- table-striped table-bordered table-hover  -->
				<!-- jika ingin memunculkan garis hilankan class table-border karena menggunakan class nya bootstrap -->
				<table id="table1" class="table table-striped table-hover table-border" >
					<thead>
						<tr >
							<!-- <th>No</th> -->
							<th style="text-align: center;">No</th>
							<th style="text-align: center;">Foto</th>
							<th style="text-align: center;">ID User</th>
							<th style="text-align: center;">Username</th>
							<th style="text-align: center;">Nama</th>
							<th style="text-align: center;">Email</th>
							<th style="text-align: center;">Kelamin</th>
							<th style="text-align: center;">No. Telp</th>
							<th style="text-align: center;">Tanggal Daftar</th>
							<th style="text-align: center;">Tanggal Verifikasi</th>
							<th style="text-align: center;">Data Diri</th>
							<th style="text-align: center;">Data Baju Tambahan</th>
							<th style="text-align: center;">Riwayat Pendidikan</th>
							<th style="text-align: center;">Riwayat Pekerjaan</th>
							<th style="text-align: center;">Data Keluarga</th>
							<th style="text-align: center;">Skill Bahasa</th>
							<th style="text-align: center;">Skill Sertifikat</th>
							<th style="text-align: center;">Pengalaman Praktis</th>
							<th style="text-align: center;">File Upload</th>
							<!-- <th>Aksi</th> -->
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
	</div>
</div>

	<?php
	// helper('deleteModal');
	// echo deleteModal();
	?>

<script type="text/javascript">

	$(document).ready( function(){

       var contentTable = $('#table1').DataTable({
            ajax:{ 
                url : "<?php echo current_url().'/fetchAll' ; ?>",
                method : 'post' 
            },
            processing: true,
            serverSide: true,
            scrollX: true, // Enable horizontal scrolling
            // fixedColumns: {
            //     leftColumns: 5 // Freeze the first column
            // },
            columns: [
				{
					data: null, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },                    
                    defaultContent: '', 
                    orderable: false, 
                    searchable: false
				},
                {   
                    data: 'fotopribadi',
                    render: function(data, type, row) {
                        var foto = '<img src="<?= $dataBaseUrl ?>/public/images/foto/default_male.png" alt="Foto" width="50" height="50">';
                        if(data != null){
                            foto = '<img src="<?= $dataBaseUrl ?>/public/files/talent/'+row.id_user+'/'+data +'" alt="Foto" width="50" height="50">';
                        } else {
                            if(row.sex == '0'){
                                foto = '<img src="<?= $dataBaseUrl ?>/public/images/foto/default_female.png" alt="Foto" width="50" height="50">';
                            }
                        }
                        return foto;
                    }
                },
                { 
                    data: 'id_user',
                    width: "70px"},
                { 
                    data: 'username',
                    width: "150px",
                },
                { 
                    data: 'nama',
                    width: "150px",
                },
                { 
                    data: 'email',
                    width: "150px",
                },
                { 
                    data: 'sex_label',
                    width: "80px",
                    orderable: false, 
                },
                { data: 'phone',
                    orderable: false, 
                    searchable: false},
                { 
                    data: 'created',
                    orderable: false, 
                    searchable: false,
                    width: "150px",
                },
                { 
                    data: 'verified',
                    orderable: false, 
                    searchable: false,
                    width: "150px",
                },
                { 
                    data: 'datadiri',
                    orderable: false, 
                    searchable: false,
                    width: "70px",
                },
                { data: 'databaju_tambahan',
                    orderable: false, 
                    searchable: false,
                    width: "70px"},
                { data: 'riwayat_pendidikan',
                    orderable: false, 
                    searchable: false},
                { data: 'riwayat_pekerjaan',
                    orderable: false, 
                    searchable: false},
                { data: 'data_keluarga',
                    orderable: false, 
                    searchable: false},
                { data: 'skill_bahasa',
                    orderable: false, 
                    searchable: false},
                { data: 'skill_sertifikat',
                    orderable: false, 
                    searchable: false},
                { data: 'pengalaman_praktis',
                    orderable: false, 
                    searchable: false},
                { data: 'file_upload',
                    orderable: false, 
                    searchable: false},
            ],
            order: [[2, 'asc']],
        });


	});


</script>