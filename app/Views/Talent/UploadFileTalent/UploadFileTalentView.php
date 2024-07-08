<div class="card">
	<div class="card-header bg-danger text-light">
		<h5 class="card-title"><?=$title?></h5> <i><?=$subtitle?></i>
	</div>
	<div class="card-body">
		
		<?php

		if (!empty($message)) {
			show_message($message['message'], $message['status'], $message['dismiss']);
		}
		?>
		<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
        

			<div class="tab-content" id="myTabContent">

            
                <!-- bagian Lainnya -->
                
                <div id="lain-container">
                    <!-- Dynamic Lainnya input will be added here -->
                </div>
                <div class="col-sm-3 col-md-2 col-lg-3 col-xl-6 mt-3">
                    <button type="button" class="btn btn-success" id="add-lain"><i class="far fa-plus-square pr-2"></i>Tambah File</button>
                </div>


                
                <!--batas detail -->
                
                <div class="form-group row mb-0 mt-3">
                    <div class="col-sm-5">
						<button type="submit" name="submit" value="submit" class="btn btn-primary"><i class="far fa-save pr-2"></i>Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>


<script>
    $(document).ready(function(){

         // Add initial Lain section
         var lainIndex = 0;

        var data_JSON = '<?php echo json_encode($data); ?>';
        var data_Parse = JSON.parse(data_JSON);

        if(data_Parse.length == 0){
            lainIndex++;
            addLainSection(lainIndex);
            createOption('.jenis_dokumen-'+lainIndex, '39', 'id_group');
            updateLainNumbering();
        } else {
            for (let i = 0; i < data_Parse.length; i++) {
                lainIndex++;
                
                addLainSection(lainIndex);
                $('.id-'+lainIndex).val(data_Parse[i]['id']) ;
                $('.keterangan-'+lainIndex).val(data_Parse[i]['keterangan']) ;
                $('.label-customFile-'+lainIndex).html(data_Parse[i]['nama_file_ori']) ;
                createOption('.jenis_dokumen-'+lainIndex, '39', 'id_group',data_Parse[i]['jenis_dokumen']);
                
                if(data_Parse[i]['nama_file_new'].length > 0){
                    $('.download-file-'+lainIndex).val(data_Parse[i]['id']) ;
                    $('.div-download-'+lainIndex).removeAttr('hidden');
                }
                // $('.div-download-'+lainIndex).attr(data_Parse[i]['nama_file_new']) ;


                updateLainNumbering();
            }
        }

        // Add new lain section on button click
        $('#add-lain').click(function() {
            lainIndex++;
            addLainSection(lainIndex);
            createOption('.jenis_dokumen-'+lainIndex, '39', 'id_group');
            updateLainNumbering();
        });

        function addLainSection(index) {
            var button_hapus = '';
            if(index > 1 ){
                button_hapus = `
                <div class="col-sm-3 col-md-2 col-lg-3 col-xl-6 mt-3">
                    <button type="button" class="btn btn-danger remove-lain"><i class="far fa-minus-square pr-2"></i>Hapus File</button>
                </div>`;
            }
            var LainSection = `
                <div class="form-group lain-section" data-index="${index}">

                <div class="input-group">
                    <div class="form-group text-center bg-secondary rounded text-light border-right col-sm-1" style="">
                        <label class="col-form-label">#</label>
                        <h5 class="col-form-label lain-number">${index}</h5>
                    </div>
                    <div class="form-group col-sm-2 ">
                        <input class="form-control id-${index}" type="text" name="id[]" placeholder="id Lain"  style="width:100%" readonly hidden/>
                        <label class="col-form-label">Jenis Dokumen</label>
                        <select class="form-control jenis_dokumen-${index}"  name="jenis_dokumen[]" required>
                            <option value="">Pilih Salah Satu</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4 ">
                        <label class="col-form-label">Keterangan</label>
                        <input class="form-control keterangan-${index}" type="text" name="keterangan[]" style="width:100%;" placeholder="Keterangan Dokumen" />
                    </div>
                    <div class="form-group col-sm-4 ">
                        <label class="col-form-label label-file-${index}" id="label-file-${index}">File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input customFile-${index}" name="fileupload[]" id="customFile-${index}" multiple >
                            <label class="custom-file-label label-customFile-${index}" for="customFile-${index}">Maks Size : 10MB, Format : .jpg .png .pdf</label>
                        </div>
                    </div>

                    <div class="col-sm-1 text-center div-download-${index}" hidden>
                        <label class="col-form-label">Action</label>
                        <button type="button" class="btn btn-warning rounded download-file-${index}" onclick="downloadFile(this.value)"><i class="fas fa-file-download pr-2" value=""></i>Download</button>
                    </div>

                </div>
                ${button_hapus}
                <hr class="bg-info" >
                </div>
            `;
            $('#lain-container').append(LainSection);

            // Add event listener for file input to display file name
            $('#customFile-' + index).change(function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
            });

            // Add event listener for select change to update file label
            $('.jenis_dokumen-' + index).change(function() {
                var selectedValue = $(this).val();
                if (selectedValue == 1) {
                    $('#label-file-' + index).html('File (LATAR BELAKANG BIRU)');
                } else {
                    $('#label-file-' + index).html('File');
                }
            });

        }

        function updateLainNumbering() {
            $('#lain-container .lain-section').each(function(index) {
                $(this).find('.lain-number').text('No. ' + (index + 1));
            });
        }

        // Remove child section on button click
        $(document).on('click', '.remove-lain', function() {
            $(this).closest('.lain-section').remove();
            updateLainNumbering();
        });

        
        
        // batas lain

});


function downloadFile(value=''){
    console.log(value);
    url = "<?php echo current_url().'/downloadFile?id='; ?>" + value;
    window.open(url, "_self");
}

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