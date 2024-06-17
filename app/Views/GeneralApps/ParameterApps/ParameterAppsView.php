<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?=$current_module['judul_module']?></h5>
	</div>
	
	<div class="card-body">
        <?php
		 // by eko : berfungsi untuk memunculkan tombol atau tidak berdasarkan role  
			if(strtolower($auth_tambah) == 'yes'){
				echo '<a href="'.current_url().'/add" class="btn btn-success btn-xs"><i class="fa fa-plus pr-1"></i> Tambah Data</a>';
			} 
			if(strtolower($auth_ubah) == 'all'){
				echo '<a href="'.current_url().'/add" class="btn btn-warning btn-xs ml-1"><i class="fa fa-edit pr-1"></i> Ubah Data</a>';
			} 
			if(strtolower($auth_hapus) == 'all'){
				echo '<a href="'.current_url().'/delete" class="btn btn-danger btn-xs ml-1"><i class="fa fa-times pr-1"></i> Hapus Data</a>';
			}
		?>
		<button id="popupButton">Show Selected Row Data</button>
			<hr/>
			<div class="">
			<!-- table-striped table-bordered table-hover  -->
			<!-- jika ingin memunculkan garis hilankan class table-border karena menggunakan class nya bootstrap -->
			<table id="table1" class="table table-striped table-hover table-bordered " >
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

		 // Menangani klik tombol untuk menampilkan data baris yang dipilih
		 $('#popupButton').on('click', function () {
			var selectedData = contentTable.row('.selected').data();
			if (selectedData) {
				alert(
					'Nama: ' + selectedData.kode_group + '\n' +
					'Posisi: ' + selectedData.nama_group + '\n'
				);
			} else {
				alert('Tidak ada baris yang dipilih!');
			}
		});

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
			return (
				'Full name: ' +
				d.kode_group +
				' ' +
				d.nama_group +
				'<br>' +
				'<br>' +
				'The child row can contain any data you wish, including links, images, inner tables etc.'
			);
		}
		// batas menangani detail row

	});


</script>