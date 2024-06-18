<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?=$current_module['judul_module']?></h5>
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
				echo '<a href="'.current_url().'/add" class="btn btn-success btn-xs"><i class="fa fa-plus pr-1"></i> Tambah Data</a>';
			} 
			if(strtolower($auth_ubah) == 'all'){
				echo '<button id="editButton" class="btn btn-warning btn-xs ml-1"><i class="fa fa-edit pr-1"></i> Ubah Data</button>';
			} 
			if(strtolower($auth_hapus) == 'all'){
				helper('deleteModal');
				echo '<button id="deleteButton" class="btn btn-danger btn-xs ml-1"><i class="fa fa-times pr-1"></i> Hapus Data</button>';
			}
		?>

			<hr/>
			<div class="table-responsive">
				<!-- table-striped table-bordered table-hover  -->
				<!-- jika ingin memunculkan garis hilankan class table-border karena menggunakan class nya bootstrap -->
				<table id="table1" class="table table-striped table-hover table-bordered" >
					<thead>
						<tr >
							<!-- <th>No</th> -->
							<th style="text-align: center;" width = "50px"></th>
							<th style="text-align: center;">Kode Group</th>
							<th style="text-align: center;">Nama Group</th>
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
	helper('deleteModal');
	echo deleteModal();
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
            columns: [
				{
					className: 'dt-control',
					orderable: false,
					data: null,
					defaultContent: ''
				},
                { data: 'kode_group'},
                { data: 'nama_group'}
            ],
			order: [[1, 'asc']],
			// columnDefs: [
			// 	{ "orderable": false, "targets": 0 }
			// ],
        });

		// menangani single select
		contentTable.on('click', 'tbody tr', function (e) {
			let classList = e.currentTarget.classList;
 
			if (classList.contains('selected')) {
				classList.remove('selected');
			}
			else {
				contentTable.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
				classList.add('selected');
			}
		});

		 // Menangani klik tombol Edit
		 $('#editButton').on('click', function () {
			var selectedData = contentTable.row('.selected').data();
			if (selectedData) {
				url = "<?php echo current_url().'/edit?id='; ?>" + selectedData.id_group;
                window.open(url, "_self");
			} else {
				alert('Tidak ada baris yang dipilih!');
			}
		});

		 // Menangani klik tombol Hapus
		 $('#deleteButton').on('click', function () {
			var selectedData = contentTable.row('.selected').data();
			if (selectedData) {
				$('#modalBody').html(
					'Apakah Anda Yakin Akan Menghapus? <br>' +
					'Kode : ' + selectedData.kode_group + '<br>' +
					'Nama: ' + selectedData.nama_group + '<br>' 
           		 );
				$('#deleteModal').modal('show');
			} else {
				alert('Tidak ada baris yang dipilih!');
			}
		});

		
		$('#confirmDelete').on('click', function () {
			var selectedData = contentTable.row('.selected').data();
			if (selectedData) {
				url = "<?php echo current_url().'?action=delete&id='; ?>" + selectedData.id_group;
                window.open(url, "_self");
			} else {
				alert('Tidak ada baris yang dipilih!');
			}
		});

		 //Batas  Menangani klik tombol Hapus

		// menangani detail row
		$('#table1 tbody').on('click', 'td.dt-control', function () {
                var tr = $(this).closest('tr');
                var row = contentTable.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });

		function format(d) {

			var detail = d.dataDetail;


			var htmlDetail = "<table class='table table-light'><thead class='thead-dark'><tr><th style='text-align:center;'>Kode</th><th  style='text-align:center;'>Nama</th><th  style='text-align:center;'>Urutan</th></tr></thead><tbody>"

			if(detail.length < 1){
				htmlDetail += "<tr style='text-align:center;'><td colspan=3> Tidak Memiliki Detail</td></tr>"
			} else {
				for (var i = 0; i < detail.length; i++) {
					var data_seq = '';
					if(detail[i].sequence != null){
						data_seq=detail[i].sequence ; 
					}
					htmlDetail += '<tr><td>' + detail[i].value_parameter + '</td><td>' + detail[i].label_parameter + '</td><td>' + data_seq + '</td></tr>';
				}
			}

			htmlDetail += "</tbody></table>"

			return (htmlDetail);
		}
		// batas menangani detail row

	});


</script>