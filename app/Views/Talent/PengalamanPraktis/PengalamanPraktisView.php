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
                    <button type="button" class="btn btn-success" id="add-lain"><i class="far fa-plus-square pr-2"></i>Tambah Pengalaman</button>
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
            createOption('.bulan_awal-'+lainIndex, '30', 'id_group');
            createOption('.bulan_akhir-'+lainIndex, '30', 'id_group');
            createOption('.jenis_pengalaman-'+lainIndex, '38', 'id_group');
            updateLainNumbering();
        } else {
            for (let i = 0; i < data_Parse.length; i++) {
                lainIndex++;
                
                addLainSection(lainIndex);
                $('.id-'+lainIndex).val(data_Parse[i]['id']) ;
                $('.nama_pengalaman-'+lainIndex).val(data_Parse[i]['nama_pengalaman']) ;
                $('.detail_pengalaman-'+lainIndex).val(data_Parse[i]['detail_pengalaman']) ;
                $('.tahun_awal-'+lainIndex).val(data_Parse[i]['tahun_awal']) ;
                $('.tahun_akhir-'+lainIndex).val(data_Parse[i]['tahun_akhir']) ;
                $('.keterangan-'+lainIndex).val(data_Parse[i]['keterangan']) ;
                
                createOption('.bulan_awal-'+lainIndex, '30', 'id_group',data_Parse[i]['bulan_awal']);
                createOption('.bulan_akhir-'+lainIndex, '30', 'id_group',data_Parse[i]['bulan_akhir']);
                createOption('.jenis_pengalaman-'+lainIndex, '38', 'id_group',data_Parse[i]['jenis_pengalaman']);

                updateLainNumbering();
            }
        }

        // Add new lain section on button click
        $('#add-lain').click(function() {
            lainIndex++;
            addLainSection(lainIndex);
            createOption('.bulan_awal-'+lainIndex, '30', 'id_group');
            createOption('.bulan_akhir-'+lainIndex, '30', 'id_group');
            createOption('.jenis_pengalaman-'+lainIndex, '38', 'id_group');
            updateLainNumbering();
        });

        function addLainSection(index) {
            var LainSection = `
                <div class="form-group lain-section" data-index="${index}">
                    <div class="card-header rounded text-light" style="padding-top: 15px; padding-bottom: 15px; background-color: #bcbcbc; ">
                        <h5 class="lain-number">No. ${index}</h5>
                    </div>

                <div class="input-group">
                    <div class="form-group col-sm-6 ">
                        <input class="form-control id-${index}" type="text" name="id[]" placeholder="id Lain"  style="width:100%" readonly hidden/>
                        <label class="col-form-label">Jenis / Tipe</label>
                        <select class="form-control jenis_pengalaman-${index}"  name="jenis_pengalaman[]" required>
                            <option value="">Pilih Salah Satu</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Nama</label>
                        <input class="form-control nama_pengalaman-${index}" type="text" name="nama_pengalaman[]" style="width:100%;" placeholder="Nama Mesin / Software / Lainnya" />
                    </div>
                </div>
                
                <div class="input-group">
                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Bulan Tahun Mulai</label>
                        <div class="input-group">
                            <select class="form-control bulan_awal-${index}"  name="bulan_awal[]">
                                <option value="">Pilih Salah Satu</option>
                            </select>
                            <input type="number" class="form-control tahun_awal-${index}" name="tahun_awal[]" placeholder="Tahun Awal">
                        </div>
                    </div>

                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Bulan Tahun Akhir</label>
                        <div class="input-group">
                            <select class="form-control bulan_akhir-${index}"  name="bulan_akhir[]">
                                <option value="">Pilih Salah Satu</option>
                            </select>
                            <input type="number" class="form-control tahun_akhir-${index}" name="tahun_akhir[]" placeholder="Tahun Akhir">
                        </div>
                    </div>
                </div>
            
                <div class="input-group">

                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Detail</label>
                        <textarea maxlength="500" class="form-control detail_pengalaman-${index}" rows="5" name="detail_pengalaman[]" placeholder="Detail Tentang Yang Dikerjakan (Max : 500 Karakter)"></textarea>
                    </div>
                    
                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Keterangan</label>
                        <textarea maxlength="500" class="form-control keterangan-${index}" rows="5" name="keterangan[]" placeholder="Keterangan Lain (Max : 500 Karakter)"></textarea>
                    </div>
                </div>
                
                <div class="col-sm-3 col-md-2 col-lg-3 col-xl-6 mt-3">
                    <button type="button" class="btn btn-danger remove-lain"><i class="far fa-minus-square pr-2"></i>Hapus Pengalaman</button>
                </div>
                <hr class="bg-info" >
                </div>
            `;
            $('#lain-container').append(LainSection);


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