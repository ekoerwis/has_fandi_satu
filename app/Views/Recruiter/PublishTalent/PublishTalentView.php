<style>
    /* css untuk memberikan jeda antara table dan page dan search */
    #table1_wrapper .justify-content-md-center {
        margin-bottom: 10px;
        margin-top: 10px;
    }
</style>
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

            <form id="filterForm" class="form-inline">
				<div class="form-inline pr-2">
					<label  for="publish_filter" class=" col-form-label pr-2">Status :</label>
                    <select class="form-control" id="publish_filter" name="publish_filter" style="width: 150px;">
                        <option value="">Pilih Semua</option>
                        <option value="1">Published</option>
                        <option value="0">UnPublished</option>
                    </select>
				</div>
                <button type="button" class="btn btn-primary rounded btn-md" id="searchButton">Search</button>
            </form>
			<hr/>


        <!-- <div class="row">
            <div class="col-md-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination" id="pagination">
                    </ul>
                </nav>
            </div>
        </div> -->

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

    function fetchItems(query = '', page = 1) {
            $.ajax({
                url: "<?php echo current_url().'/fetchAll' ; ?>",
                method: 'POST',
                data: { 
                    query: query, 
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
                        <div class="card border border-info rounded m-1" style="width: 20rem;">
                            <img class="card-img-top" src="${foto}" alt="Card image cap">
                            <div class="card-body text-center">
                                <a class="card-text text-center font-weight-bold text-uppercase">${item.nama_lengkap}</a>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Umur : ${item.umur} Tahun</li>
                                <li class="list-group-item">Bahasa Jepang : ${item.sertifikat_jepang}</li>
                                <li class="list-group-item">Keahlian : ${item.sertifikat_keahlian}</li>
                                <li class="list-group-item">Pengalaman : ${item.pengalaman_praktis}</li>
                            </ul>
                            <div class="card-body">
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                        </div>
                        `;
                        // }
                    });
                    $('#item-container').html(itemsHtml);

                    let paginationHtml = '';
                    for (let i = 1; i <= data.total_pages; i++) {
                        paginationHtml += `<li class="page-item ${i === data.current_page ? 'active' : ''}">
                                            <a class="page-link" href="javascript:void(0);" data-page="${i}">${i}</a></li>`;
                    }
                    $('#pagination').html(paginationHtml);
                }
            });
        }


        $(document).ready( function(){
            fetchItems();

            $('#searchButton').click(function() {
                const query = $('#publish_filter').val();
                fetchItems(query);
                // console.log(query);

                // fetchItems();
            });

            $(document).on('click', '.page-link', function() {
                const page = $(this).data('page');
                const query = $('#publish_filter').val();
                fetchItems(query, page);
            });

        });

</script>