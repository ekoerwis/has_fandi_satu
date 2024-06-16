<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?=$current_module['judul_module']?></h5>
	</div>
	
	<div class="card-body">
        <?php
		 // by eko : berfungsi untuk memunculkan tombol atau tidak berdasarkan role  
			if(strtolower($auth_tambah) == 'yes'){
		?>
		    <a href="<?=current_url()?>/add" class="btn btn-success btn-xs"><i class="fa fa-plus pr-1"></i> Tambah Data</a>
		    <hr/>
        <?php }?>

			<div class="table-responsive">
			<table id="table1" class="table table-striped table-bordered table-hover" data-page-length='10'>
			<thead>
			<tr>
				<!-- <th>No</th> -->
				<th>Kode Group</th>
				<th>Nama Group</th>
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

       $('#table1').DataTable({
            ajax:{ 
                url : "<?php echo current_url().'/fetchAll' ; ?>",
                method : 'post' 
            },
            processing: true,
            serverSide: true,
            columns: [
                { data: 'nama'},
                { data: 'npm'}
            ],
        });

	});


</script>