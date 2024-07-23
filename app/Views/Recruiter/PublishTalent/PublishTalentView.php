<style>
    /* css untuk memberikan jeda antara table dan page dan search */
    #table1_wrapper .justify-content-md-center {
        margin-bottom: 10px;
        margin-top: 10px;
    }
</style>
<div class="card">
	<div class="card-header bg-danger text-light rounded">
		<h5 class="card-title rounded"><?=$current_module['judul_module']?></h5>
	</div>

	<?php
			if (!empty($message)) {
				show_message($message['message'], $message['status'], $message['dismiss']);
			}
		?>
	
	<div class="card-body">

            <form id="filterForm" class="form-inline">
				<div class="form-inline pr-2 pb-2">
					<label  for="jenis_sertifikat_jepang" class=" col-form-label pr-2">Bahasa Jepang :</label>
                    <select class="form-control jenis_sertifikat_jepang rounded" id="jenis_sertifikat_jepang" name="jenis_sertifikat_jepang"  >
                        <option value="">Pilih Sertifikat Bahasa</option>
                    </select>
				</div>
				<div class="form-inline pr-2 pb-2">
					<label  for="sertifikasi" class=" col-form-label pr-2">Sertifikasi :</label>
                    <select class="form-control sertifikasi rounded" id="sertifikasi" name="sertifikasi"  >
                        <option value="">Pilih Sertifikat</option>
                    </select>
				</div>
				<div class="form-inline pr-2 pb-2">
					<label  for="pengalaman_praktis" class=" col-form-label pr-2">Keahlian :</label>
                    <select class="form-control pengalaman_praktis rounded" id="pengalaman_praktis" name="pengalaman_praktis" >
                        <option value="">Pilih Keahlian</option>
                    </select>
				</div>
				<div class="form-inline pr-2 pb-2">
                <button type="button" class="btn btn-primary rounded" id="searchButton">Search</button>
                </div>  
            </form>
			<hr/>

        <div class="col-12 row" id="item-container">


        </div>

	</div>
    
    <div class="row col-12 mb-2 ml-3">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                <ul class="pagination" id="pagination">
                </ul>
            </nav>
        </div>
    </div>
</div>

		

	<?php
	// helper('deleteModal');
	// echo deleteModal();
	?>

<script type="text/javascript">

    function fetchItems(p_jenis_sertifikat_jepang='',p_sertifikasi='',p_pengalaman_praktis='', page = 1) {
            $.ajax({
                url: "<?php echo current_url().'/fetchAll' ; ?>",
                method: 'get',
                data: { 
                    p_jenis_sertifikat_jepang: p_jenis_sertifikat_jepang, 
                    p_sertifikasi: p_sertifikasi, 
                    p_pengalaman_praktis: p_pengalaman_praktis, 
                    page: page 
                },
                dataType: 'json',
                success: function(data) {
                    let itemsHtml = '';
                    $.each(data.items, function(index, item) {
                        // for(var i =0 ; i<10; i++){
                        var foto ="";
                        if(item.foto == "" || item.foto == null){
                            foto = "../public/images/foto/default_male.png";
                        } else {
                            foto = `../public/files/talent/${item.id_user}/${item.foto}`;
                        }
                        itemsHtml += `
                        <div class="card border border-danger rounded m-3" style="width: 20rem;">
                            <img class="card-img-top" src="${foto}" alt="Card image cap">
                            <div class="card-body text-center">
                                <a class="card-text text-center font-weight-bold text-uppercase">${item.nama_lengkap}</a>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>Umur</b> : ${item.umur} Tahun</li>
                                <li class="list-group-item"><b>Bahasa Jepang</b> : ${item.sertifikat_jepang}</li>
                                <li class="list-group-item"><b>Sertifikasi</b> : ${item.sertifikat_keahlian}</li>
                                <li class="list-group-item"><b>Keahlian</b> : ${item.pengalaman_praktis}</li>
                            </ul>
                            <div class="card-body text-center">
                                <button class="btn btn-warning">Detail</button>
                                <button class="btn btn-success">Proses Talent</button>
                            </div>
                        </div>
                        `;
                        // }
                    });
                    $('#item-container').html(itemsHtml);

                    let paginationHtml = '';
                     // First and Previous buttons
                     if (data.current_page > 1) {
                        paginationHtml += `<li class="page-item">
                                            <a class="page-link" href="javascript:void(0);" data-page="1">First</a></li>`;
                        paginationHtml += `<li class="page-item">
                                            <a class="page-link" href="javascript:void(0);" data-page="${data.current_page - 1}">&lt;</a></li>`;
                    }

                    // Page numbers
                    for (let i = 1; i <= data.total_pages; i++) {
                        paginationHtml += `<li class="page-item ${i == data.current_page ? 'active' : ''}">
                                            <a class="page-link" href="javascript:void(0);" data-page="${i}">${i}</a></li>`;
                    }

                    // Next and Last buttons
                    if (data.current_page < data.total_pages) {
                        paginationHtml += `<li class="page-item">
                                            <a class="page-link" href="javascript:void(0);" data-page="${parseInt(data.current_page) + 1}">&gt;</a></li>`;
                        paginationHtml += `<li class="page-item">
                                            <a class="page-link" href="javascript:void(0);" data-page="${data.total_pages}">Last</a></li>`;
                    }
                    
                    $('#pagination').html(paginationHtml);
                }
            });
        }


        $(document).ready( function(){

            createOption('.jenis_sertifikat_jepang', '35', 'id_group');
            createOption('.sertifikasi', '37', 'id_group');
            createOption('.pengalaman_praktis', '38', 'id_group');

            fetchItems();

            $('#searchButton').click(function() {
                const p_jenis_sertifikat_jepang = $('#jenis_sertifikat_jepang').val();
                const p_sertifikasi = $('#sertifikasi').val();
                const p_pengalaman_praktis = $('#pengalaman_praktis').val();
                fetchItems(p_jenis_sertifikat_jepang,p_sertifikasi,p_pengalaman_praktis);
                // console.log(query);

                // fetchItems();
            });

            $(document).on('click', '.page-link', function() {
                const page = $(this).data('page');
                const p_jenis_sertifikat_jepang = $('#jenis_sertifikat_jepang').val();
                const p_sertifikasi = $('#sertifikasi').val();
                const p_pengalaman_praktis = $('#pengalaman_praktis').val();

                fetchItems(p_jenis_sertifikat_jepang,p_sertifikasi,p_pengalaman_praktis, page);
            });

        });

            
    function createOption(id_input='', id_parametergroup='',column_parameter='id_parameter', defaultSelected =''){
            $.ajax({
                url: "<?= current_url().'/getParameter' ?>",
                method: 'POST',
                data:{
                    id : id_parametergroup ,
                    column : column_parameter
                },
                dataType: 'json',
                success: function(response) {
                    var listOption = $(id_input);
                    response.forEach(function(responseData) {
                        var selected = responseData.value_parameter == defaultSelected ? 'selected' : '';
                        listOption.append('<option value="' + responseData.value_parameter + '" ' + selected + '>' + responseData.label_parameter + '</option>');
                    });
                }
            });
        }

</script>